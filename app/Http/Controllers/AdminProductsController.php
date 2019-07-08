<?php

namespace App\Http\Controllers;

use App\Product;
use App\Section;
use App\Collection;
use App\ProductImage;
use App\ProductColor;
use App\ProductSize;
use App\Tag;
use App\Group;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;
use \Gumlet\ImageResize;
use Pusher\Pusher;


class AdminProductsController extends Controller
{

	public function __construct()
	{
		$this->middleware('employee', ['except' => ['destroy']]);
		$this->middleware('superadmin', ['only' => ['destroy']]);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$allowedSorts = ["id", "name", "gender", "section", "collections"];
		$allowedOrder = ["asc", "desc", "ASC", "DESC"];
		$sort = Input::get("sort");
		$order = Input::get("order");
		$search = Input::get("q");
		$products = Product::join("sections", "products.section_id", "=", "sections.id");

		if (!$sort) {
			$sort = "id";
		}
		if (!$order) {
			$order = "desc";
		}

		if (!in_array($order, $allowedOrder)) {
			$request->session()->flash("error", "Order not allowed");
			return back();
		}
		if (!in_array($sort, $allowedSorts)) {
			$request->session()->flash("error", "Sort not allowed");
			return back();
		}

		switch ($sort) {
			case "collections":
				{
					$products = $products->leftjoin("collections", "products.collection_id", "=", "collections.id")->orderBy("collections.name", $order);
				}
				break;
			case "section":
				{
					$products = $products->orderBy("sections.name", $order);
				}
				break;
			case "gender":
				{
					$products = $products->orderBy("products.gender", $order);
				}
				break;
			case "name":
				{
					$products = $products->orderBy("products.name", $order);
				}
				break;
			default:
				{
					$products = $products->orderBy("products.id", $order);
				}
		}

		if ($search) {
			$products = $products->where("products.name", "LIKE", "%{$search}%")->orderBy("products.name", $order);
		}

		$products = $products->select("products.*")->paginate(12);

		return view("admin.products.index")->with("products", $products);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$sections = Section::all();
		$colections = Collection::all();
		$products = Product::all();

		$selectedSection = array();
		$selectedColection = array();
		$selectedProduct = array();

		foreach ($sections as $section) {
			$selectedSection[$section->id] = $section->name;
		}

		foreach ($colections as $colection) {
			$selectedColection[$colection->id] = $colection->name;
		}

		foreach ($products as $product) {
			$selectedProduct[$product->id] = $product->name;
		}

		return view("admin.products.create", compact('selectedColection', 'selectedSection', 'selectedProduct'));
	}


	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Gumlet\ImageResizeException
	 * @throws \Pusher\PusherException
	 */
	public function store(Request $request)
	{
		//Validace
		$request->validate([
			"name" => "required",
			"cover_image" => "required|image|max:4196",
			"price" => "required|regex:/^\d*(\.\d{1,2})?$/",
			"textarea" => "required"
		]);

		$product = new Product;

		if ($request->input("group") !== NULL) {
			$passedProduct = Product::find($request->input("group"));

			if ($passedProduct->group_id !== NULL) {
				$product->group_id = $passedProduct->group_id;
			} else {
				$group = new Group;
				$group->save();
				$product->group_id = $group->id;
				$passedProduct->group_id = $group->id;
				$passedProduct->save();
			}
		}

		//Kontrola a nahrání fotky
		if ($request->hasFile("cover_image")) {
			$widthToResize = 800;
			$widthToResizeMin = 300;
			$widthToResizeUltraMin = 100;
			$pathToStore = "storage/product_images/";
			$productColors = [];

			$image = $request->file("cover_image");
			//Get filename with the extension
			$filenameWithExt = $image->getClientOriginalName();
			//Get just file name
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//Get just extension
			$ext = $image->getClientOriginalExtension();
			//Filename to store
			$fileNameToStore = $filename . "_" . time() . "." . $ext;
			$fileNameToStoreMin = $filename . "_" . time() . "_min." . $ext;
			$fileNameToStoreUltraMin = $filename . "_" . time() . "_ultra_min." . $ext;

			$path = $pathToStore . $fileNameToStore;
			$path_min = $pathToStore . $fileNameToStoreMin;
			$path_ultra_min = $pathToStore . $fileNameToStoreUltraMin;

			$image_resize = new ImageResize($image->getRealPath());
			$image_resize_min = new ImageResize($image->getRealPath());
			$image_resize_ultra_min = new ImageResize($image->getRealPath());

			$image_resize->resizeToWidth($widthToResize);
			$image_resize_min->resizeToWidth($widthToResizeMin);
			$image_resize_ultra_min->resizeToWidth($widthToResizeUltraMin);

			//Upload
			$image_resize_ultra_min->save($path_ultra_min);
			$image_resize_min->save($path_min);
			$image_resize->save($path);

			//Recognized colors
			$palette = Palette::fromFilename($path);
			$extractor = new ColorExtractor($palette);
			$colors = $extractor->extract(3);

			foreach ($colors as $color) {
				$productColors[] = new ProductColor(["value" => Color::fromIntToHex($color)]);
			}

			$product->nahled_photo = $fileNameToStore;
			$product->nahled_photo_min = $fileNameToStoreMin;
			$product->nahled_photo_ultra_min = $fileNameToStoreUltraMin;
		}

		$product->name = $request->input("name");
		$product->gender = $request->input("gender");
		$product->section_id = $request->input("sections");
		$product->text = $request->input("textarea");
		$product->collection_id = $request->input("colections");
		$product->user_id = $request->user()->id;
		$product->price = $request->input("price");
		$product->slug = str_slug($request->input("name"));
		$product->save();

		$product->color()->saveMany($productColors);
		$product->sizes()->attach([1, 2, 3, 4, 5]);

		$options = array(
			'cluster' => 'eu',
			'useTLS' => true
		);
		$pusher = new Pusher(
			env('PUSHER_APP_KEY'),
			env('PUSHER_APP_SECRET'),
			env('PUSHER_APP_ID'),
			$options
		);

		$data["message"] = "New product has just been added.";
		$data["product"] = $product;
		$pusher->trigger('kira-pusher', 'product-added', $data);

		return redirect(route("products.edit", $product->id))->with("success", "Product has been added");
	}


	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Gumlet\ImageResizeException
	 */
	public function storeSku(Request $request)
	{
		$request->validate([
			"sku_name" => "required",
			"sku_cover_image" => "required|image|max:4196",
			"sku_price" => "required|regex:/^\d*(\.\d{1,2})?$/",
			"sku_textarea" => "required"
		]);

		$productSKU = new Product;
		$product = Product::findOrFail($request->input("product_id"));

		if (!$product) {
			return back()->with("Not a valid product");
		}

		if ($request->hasFile("sku_cover_image")) {
			$widthToResize = 800;
			$widthToResizeMin = 300;
			$widthToResizeUltraMin = 100;
			$pathToStore = "storage/product_images/";
			$productColors = [];

			$image = $request->file("sku_cover_image");
			//Get filename with the extension
			$filenameWithExt = $image->getClientOriginalName();
			//Get just file name
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//Get just extension
			$ext = $image->getClientOriginalExtension();
			//Filename to store
			$fileNameToStore = $filename . "_" . time() . "." . $ext;
			$fileNameToStoreMin = $filename . "_" . time() . "_min." . $ext;
			$fileNameToStoreUltraMin = $filename . "_" . time() . "_ultra_min." . $ext;

			$path = $pathToStore . $fileNameToStore;
			$path_min = $pathToStore . $fileNameToStoreMin;
			$path_ultra_min = $pathToStore . $fileNameToStoreUltraMin;

			$image_resize = new ImageResize($image->getRealPath());
			$image_resize_min = new ImageResize($image->getRealPath());
			$image_resize_ultra_min = new ImageResize($image->getRealPath());

			$image_resize->resizeToWidth($widthToResize);
			$image_resize_min->resizeToWidth($widthToResizeMin);
			$image_resize_ultra_min->resizeToWidth($widthToResizeUltraMin);

			//Upload
			$image_resize_ultra_min->save($path_ultra_min);
			$image_resize_min->save($path_min);
			$image_resize->save($path);

			//Recognized colors
			$palette = Palette::fromFilename($path);
			$extractor = new ColorExtractor($palette);
			$colors = $extractor->extract(3);

			foreach ($colors as $color) {
				$productColors[] = new ProductColor(["value" => Color::fromIntToHex($color)]);
			}

			$productSKU->nahled_photo = $fileNameToStore;
			$productSKU->nahled_photo_min = $fileNameToStoreMin;
			$productSKU->nahled_photo_ultra_min = $fileNameToStoreUltraMin;
		}

		$productSKU->name = $request->input("sku_name");
		$productSKU->gender = $request->input("sku_gender");
		$productSKU->section_id = $product->section_id;
		$productSKU->text = $request->input("sku_textarea");
		$productSKU->collection_id = $product->collection_id;
		$productSKU->user_id = $request->user()->id;
		$productSKU->price = $request->input("sku_price");
		$productSKU->slug = str_slug($request->input("sku_name"));
		$productSKU->sku_id = $product->id;
		$productSKU->save();

		$productSKU->color()->saveMany($productColors);
		$productSKU->sizes()->attach([1, 2, 3, 4, 5]);

		foreach ($product->tags as $tag) {
			$productSKU->tags()->attach($tag->id);
		}

		return redirect(route("products.edit", $productSKU->id))->with("success", "Product has been added");
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(int $id)
	{
		$sections = Section::all();
		$product = Product::findOrFail($id);
		$products = Product::all();
		$collections = Collection::all();
		$productImages = Product::join("product_images", "products.id", "=", "product_images.product_id")
			->where("products.id", "=", $product->id)
			->orderBy("product_images.position", "asc")
			->select("product_images.*")
			->get();
		$selectedSection = [];
		$selectedProduct = [];
		$productTags = [];

		foreach ($sections as $section) {
			$selectedSection[$section->id] = $section->name;
		}

		foreach ($product->tags as $tag) {
			array_push($productTags, $tag->name);
		}
		$tags = implode(",", $productTags);

		foreach ($products as $productItem) {
			$selectedProduct[$productItem->id] = $productItem->name;
		}

		return view("admin.products.edit", compact("selectedSection", "product", "collections", "tags", "selectedProduct", "productImages"));
	}


	/**
	 * @param Request $request
	 * @param int $id
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Pusher\PusherException
	 */
	public function update(Request $request, int $id)
	{
		$product = Product::findOrFail($id);

		$this->validate($request, [
			"name" => "required",
			"price" => "required|regex:/^\d*(\.\d{1,2})?$/",
			"textarea" => "required",
			"gender" => "required"
		]);

		if ($request->input("group") !== NULL) {
			$passedProduct = Product::find($request->input("group"));

			if ($passedProduct->group_id !== NULL) {
				$product->group_id = $passedProduct->group_id;
			} else {
				$group = new Group;
				$group->save();
				$product->group_id = $group->id;
				$passedProduct->group_id = $group->id;
				$passedProduct->save();
			}

		} else {
			if ($product->group_id !== NULL) {
				$productGroup = Group::find($product->group_id);
				if ($productGroup->products->count() - 1 < 1) {
					$product->group_id = NULL;
					$product->save();
					$productGroup->delete();
				}
				$product->group_id = NULL;
			}
		}

		if ($request->input("price") < $product->price) {
			$options = array(
				'cluster' => 'eu',
				'useTLS' => true
			);
			$pusher = new Pusher(
				env('PUSHER_APP_KEY'),
				env('PUSHER_APP_SECRET'),
				env('PUSHER_APP_ID'),
				$options
			);

			$data["message"] = "The price has just been changed. Check it out! :)";
			$data["product"] = $product;
			$pusher->trigger('kira-pusher', 'price-changed', $data);
		}

		$product->name = $request->input("name");
		$product->gender = $request->input("gender");
		$product->section_id = $request->input("sections");
		$product->text = $request->input("textarea");
		$product->collection_id = $request->input("colections");
		$product->price = $request->input("price");
		$product->slug = str_slug($request->input("name"));
		$product->save();

		return redirect(route("products.edit", ["id" => $product->id, "#tab-information"]))->with("success", "The product has been updated");
	}


	/**
	 * @param Request $request
	 * @param int $id
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Gumlet\ImageResizeException
	 */
	public function updatePhotos(Request $request, int $id)
	{
		$product = Product::findOrFail($id);

		$this->validate($request, [
			"cover_image" => "image",
		]);

		if ($request->hasFile("cover_image")) {
			$widthToResize = 800;
			$widthToResizeMin = 300;
			$widthToResizeUltraMin = 100;
			$image = $request->file("cover_image");
			$productColors = [];
			//Get filename with the extension
			$filenameWithExt = $image->getClientOriginalName();
			//Get just file name
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//Get just extension
			$ext = $image->getClientOriginalExtension();
			//Filename to store
			$fileNameToStore = $filename . "_" . time() . "." . $ext;
			$fileNameToStoreMin = $filename . "_" . time() . "_min." . $ext;
			$fileNameToStoreUltraMin = $filename . "_" . time() . "_ultra_min." . $ext;

			//public path
			$path = "storage/product_images/" . $fileNameToStore;
			$path_min = "storage/product_images/" . $fileNameToStoreMin;
			$path_ultra_min = "storage/product_images/" . $fileNameToStoreUltraMin;

			$image_resize = new ImageResize($image->getRealPath());
			$image_resize_min = new ImageResize($image->getRealPath());
			$image_resize_ultra_min = new ImageResize($image->getRealPath());

			$image_resize->resizeToWidth($widthToResize);
			$image_resize_min->resizeToWidth($widthToResizeMin);
			$image_resize_ultra_min->resizeToWidth($widthToResizeUltraMin);

			Storage::delete("public/product_images/" . $product->nahled_photo);
			Storage::delete("public/product_images/" . $product->nahled_photo_min);
			Storage::delete("public/product_images/" . $product->nahled_photo_ultra_min);

			$product->nahled_photo = $fileNameToStore;
			$product->nahled_photo_min = $fileNameToStoreMin;
			$product->nahled_photo_ultra_min = $fileNameToStoreUltraMin;

			//Upload
			$image_resize_ultra_min->save($path_ultra_min);
			$image_resize_min->save($path_min);
			$image_resize->save($path);

			//Recognized colors
			$palette = Palette::fromFilename($path);
			$extractor = new ColorExtractor($palette);
			$colors = $extractor->extract(3);

			foreach ($colors as $color) {
				$productColors[] = new ProductColor(["value" => Color::fromIntToHex($color)]);
			}

			$product->color()->delete();
			$product->color()->saveMany($productColors);
			$product->save();

			return redirect(route("products.edit", ["id" => $product->id, "#tab-photos"]))->with("success", "The photos have been updated");
		}

		return redirect(route("products.edit", ["id" => $product->id, "#tab-photos"]))->with("status", "Nothing has been changed");
	}


	public function updatePhotosPosition(Request $request)
	{
		$productIds = $request->input("ids");

		foreach ($productIds as $key => $item) {
			$productImage = ProductImage::findOrFail($item);
			$productImage->position = $key + 1;
			$productImage->save();
		}

		return response()->json(["success" => true]);
	}


	public function updateTags(Request $request, int $id)
	{
		$product = Product::findOrFail($id);
		$productTags = $product->tags;

		$tags = explode(",", $request->input("tags"));
		$tagIds = array();
		foreach ($tags as $tag) {
			if (empty($tag)) continue;
			$tagExists = Tag::where("name", $tag)->first();
			if ($tagExists) {
				array_push($tagIds, $tagExists->id);
				continue;
			}

			$newTag = new Tag;
			$newTag->name = $tag;
			$newTag->save();

			array_push($tagIds, $newTag->id);
		}

		$product->tags()->sync($tagIds);

		foreach ($productTags as $tag) {
			if ($tag->products()->count() === 0) {
				$tag->delete();
			}
		}

		return redirect(route("products.edit", ["id" => $product->id, "#tab-tags"]))->with("success", "The tags have been updated");
	}


	public function updateQuantities(Request $request, int $id)
	{
		$product = Product::findOrFail($id);
		foreach ($request->input("size") as $value => $key) {
			if ($key === NULL) {
				$key = 0;
			}
			$productQuantity = ProductSize::where("id", $value)->first();
			$productQuantity->qty = $key;
			$productQuantity->save();
		}

		return redirect(route("products.edit", ["id" => $product->id, "#tab-quantity"]))->with("success", "The quantities have been updated");
	}


	public function updateColors(Request $request, int $id)
	{
		$product = Product::findOrFail($id);
		if ($product->color()->delete()) {
			foreach ($request->input("value") as $color) {
				if (!empty($color)) {
					$productColor = new ProductColor(["value" => $color]);
					$product->color()->save($productColor);
				}
			}

			return redirect()->route("products.edit", ["id" => $product->id, "#tab-colors"])->with("success", "The colors have been changed");
		}

		return redirect()->route("products.edit", ["id" => $product->id, "#tab-colors"])->with("error", "The colors weren't deleted");
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$product = Product::findOrFail($id);

		if (!$product->isSku()) {
			foreach ($product->children as $productSku) {
				Storage::delete("public/product_images/" . $productSku->nahled_photo);
				Storage::delete("public/product_images/" . $productSku->nahled_photo_min);
				Storage::delete("public/product_images/" . $productSku->nahled_photo_ultra_min);
				$productSku->color()->delete();

				$productImages = $productSku->images;
				foreach ($productImages as $prodImage) {
					Storage::delete("public/product_images/" . $prodImage->name);
				}

				$productSku->images()->delete();
				$productSku->quantities()->delete();
				$productSku->delete();
			}
		}

		Storage::delete("public/product_images/" . $product->nahled_photo);
		Storage::delete("public/product_images/" . $product->nahled_photo_min);
		Storage::delete("public/product_images/" . $product->nahled_photo_ultra_min);
		$product->color()->delete();

		$productImages = $product->images;
		foreach ($productImages as $prodImage) {
			Storage::delete("public/product_images/" . $prodImage->name);
		}

		$product->images()->delete();
		$product->quantities()->delete();
		$product->delete();

		return redirect(route("products.index"))->with("success", "Product has been deleted");
	}


	public function destroyImg($id)
	{
		$image = ProductImage::findOrFail($id);
		$productId = $image->product->id;
		Storage::delete("public/product_images/" . $image->name);
		$image->delete();

		return redirect(route("products.edit", ["id" => $productId, "#tab-photos"]))->with("success", "The image was deleted");
	}


	public function destroyMultipleImages(Request $request)
	{
		foreach ($request->input("ids") as $id) {
			$this->destroyImg($id);
		}

		return response()->json([
			"message" => "Successfully removed images"
		]);
	}


	public function ajaxImgUpload(Request $request, $productId)
	{
		if ($request->ajax()) {

			$image = new ProductImage;
			$file = $request->file("file");

			$filenameWithExt = $file->getClientOriginalName();
			//Get just file name
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//Get just extension
			$ext = $file->getClientOriginalExtension();
			//Filename to store
			$fileNameToStore = $filename . "_" . time() . "." . $ext;
			$path = "storage/product_images/";

			$file->move($path, $fileNameToStore);

			$image->product_id = $productId;
			$image->name = $fileNameToStore;
			if ($image->save()) {
				return response()->json([
					"message" => "Successfully uploaded",
					"success" => 1,
					"id" => $image->id,
					"name" => $image->name
				]);
			}

			return response()->json([
				"message" => "An error occured",
				"success" => 0
			]);
		}

		return redirect()->back();
	}


	public function uploadMultipleImages(Request $request)
	{
		if ($request->ajax()) {
			if ($request->hasFile("file")) {
				$file = $request->file("file");
				$image = new ProductImage;

				$filenameWithExt = $file->getClientOriginalName();
				//Get just file name
				$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
				//Get just extension
				$ext = $file->getClientOriginalExtension();
				//Filename to store
				$fileNameToStore = $filename . "_" . time() . "." . $ext;
				$path = "storage/product_images/";
				$file->move($path, $fileNameToStore);

				$image->product_id = NULL;
				$image->name = $fileNameToStore;
				$image->save();
				return response()->json([
					"id" => $image->id
				]);
			}

			return response()->json([
				"message" => "No file specified"
			]);

		} else {
			return redirect()->back();
		}
	}

}
