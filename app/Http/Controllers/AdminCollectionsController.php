<?php

namespace App\Http\Controllers;

use App\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Gumlet\ImageResize;

class AdminCollectionsController extends Controller
{

	public function __construct()
	{
		$this->middleware('admin')->only(['create', 'destroy']);
		$this->middleware('employee')->only(['index', 'edit']);
	}


	/**
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$allowedSorts = ["id", "name"];
		$allowedOrder = ["asc", "desc", "ASC", "DESC"];
		$sort = Input::get("sort");
		$order = Input::get("order");
		$search = Input::get("q");

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
		$collections = Collection::orderBy($sort, $order);

		if ($search) {
			$collections = $collections->where("name", "LIKE", "%{$search}%");
		}
		$collections = $collections->paginate(12);

		return view('admin.collections.index')->with('collections', $collections);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.collections.create');
	}


	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Gumlet\ImageResizeException
	 */
	public function store(Request $request)
	{
		$collection = new Collection;

		$request->validate([
			'collection_img' => 'required|image|max:2000',
			'name' => 'required|unique:collections',
		]);

		//Kontrola a nahrání fotky
		if ($request->hasFile('collection_img')) {
			$widthToResize = 1000;
			$widthToResizeMin = 200;
			$image = $request->file('collection_img');
			//Get filename with the extension
			$filenameWithExt = $image->getClientOriginalName();
			//Get just file name
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//Get just extension
			$ext = $image->getClientOriginalExtension();
			//Filename to store
			$fileNameToStore = $filename . '_' . time() . '.' . $ext;
			$fileNameToStoreMin = $filename . '_' . time() . '_min.' . $ext;
			//public path
			$path = 'storage/collection_images/' . $fileNameToStore;
			$path_min = 'storage/collection_images/' . $fileNameToStoreMin;

			$img_resize = new ImageResize($image->getRealPath());
			$img_resize_min = new ImageResize($image->getRealPath());

			$img_resize->resizeToWidth($widthToResize);
			$img_resize_min->resizeToWidth($widthToResizeMin);

			$img_resize->save($path);
			$img_resize_min->save($path_min);

			$collection->cover_img = $fileNameToStore;
			$collection->cover_img_min = $fileNameToStore;
		}

		$collection->slug = str_slug($request->input("name"));
		$collection->name = $request->input('name');
		$collection->clicks = 0;
		$collection->save();

		return redirect('/KC-admin/collections/')->with('success', 'Collection has been added');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$collection = Collection::findOrFail($id);

		if ($collection) {
			return view('admin.collections.edit')->with('collection', $collection);

		} else {
			return back()->with('error', "Collection doesn't exist");
		}
	}


	/**
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Gumlet\ImageResizeException
	 */
	public function update(Request $request, $id)
	{
		$collection = Collection::findOrFail($id);

		$request->validate([
			'collection_img' => 'image',
			'name' => [
				"required",
				Rule::unique('sections')->ignore($collection->id),
			],
		]);

		if ($request->hasFile('collection_img')) {
			$widthToResize = 1000;
			$widthToResizeMin = 200;
			$image = $request->file('collection_img');
			//Get filename with the extension
			$filenameWithExt = $image->getClientOriginalName();
			//Get just file name
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//Get just extension
			$ext = $image->getClientOriginalExtension();
			//Filename to store
			$fileNameToStore = $filename . '_' . time() . '.' . $ext;
			$fileNameToStoreMin = $filename . '_' . time() . '_min.' . $ext;

			//public path
			$path = 'storage/collection_images/' . $fileNameToStore;
			$path_min = 'storage/collection_images/' . $fileNameToStoreMin;

			$img_resize = new ImageResize($image->getRealPath());
			$img_resize->resizeToWidth($widthToResize);

			$img_resize_min = new ImageResize($image->getRealPath());
			$img_resize_min->resizeToWidth($widthToResizeMin);

			Storage::delete('public/collection_images/' . $collection->cover_img);
			Storage::delete('public/collection_images/' . $collection->cover_img_min);

			$img_resize->save($path);
			$img_resize->save($path_min);

			$collection->cover_img = $fileNameToStore;
			$collection->cover_img_min = $fileNameToStoreMin;
		}

		$collection->slug = str_slug($request->input("name"));
		$collection->name = $request->input('name');
		$collection->save();

		return redirect('/KC-admin/collections')->with('success', 'Collection has been updated');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$collection = Collection::findOrFail($id);
		$collectionProducts = $collection->products;
		foreach ($collectionProducts as $product) {
			$product->collection_id = NULL;
			$product->save();
		}
		Storage::delete('public/collection_images/' . $collection->cover_img);
		Storage::delete('public/collection_images/' . $collection->cover_img_min);
		$collection->delete();

		return redirect('/KC-admin/collections')->with("success", "The collection was deleted");
	}
}
