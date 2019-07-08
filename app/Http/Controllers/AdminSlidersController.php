<?php

namespace App\Http\Controllers;

use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Gumlet\ImageResize;


class AdminSlidersController extends Controller
{

	public function __construct()
	{
		$this->middleware('admin', ['only' => ['create', 'destroy', 'edit']]);
		$this->middleware('employee', ['only' => ['index']]);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$allowedSorts = ["id", "heading", "text", "clicks"];
		$allowedOrder = ["asc", "desc", "ASC", "DESC"];
		$sort = Input::get("sort");
		$order = Input::get("order");
		$activeSlides = Slide::where("active", 1)->orderBy("position", "asc")->get();

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
		$slides = Slide::orderBy($sort, $order);
		$slides = $slides->paginate(12);

		return view("admin.sliders.index", compact("slides", "activeSlides"));
	}

	public function updateSlidesPosition(Request $request)
	{
		$productIds = $request->input("ids");

		foreach ($productIds as $key => $item) {
			$slide = Slide::findOrFail($item);
			$slide->position = $key + 1;
			$slide->save();
		}

		return response()->json(["success" => true]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view("admin.sliders.create");
	}


	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Gumlet\ImageResizeException
	 */
	public function store(Request $request)
	{
		$slide = new Slide;

		$request->validate([
			"slider_image" => "required|image",
			"slider_header" => "required",
			"slider_text" => "required"
		]);

		//Kontrola a nahrání fotky
		if ($request->hasFile("slider_image")) {
			$widthToResize = 1600;
			$image = $request->file("slider_image");
			//Get filename with the extension
			$filenameWithExt = $image->getClientOriginalName();
			//Get just file name
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//Get just extension
			$ext = $image->getClientOriginalExtension();
			//Filename to store
			$fileNameToStore = $filename . "_" . time() . "." . $ext;
			//public path
			$path = "storage/slider_images/" . $fileNameToStore;
			$img_resize = new ImageResize($image->getRealPath());
			$img_resize->resizeToWidth($widthToResize);
			$img_resize->save($path);
		}

		$slide->heading = $request->input("slider_header");
		$slide->text = $request->input("slider_text");
		$slide->cover_img = $fileNameToStore;
		$slide->url_dest = $request->input("slider_link");
		$slide->save();

		return redirect("/KC-admin/sliders/")->with("success", "Slide has been added");

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$slide = Slide::findOrFail($id);

		if ($slide) {
			return view("admin.sliders.edit")->with("slide", $slide);

		} else {
			return back()->with("error", "Slide doesn't exist");
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
		$slide = Slide::findOrFail($id);
		$request->validate([
			"slider_header" => "required",
			"slider_image" => "image",
			"slider_text" => "required"
		]);

		if ($request->hasFile("slider_image")) {
			$widthToResize = 1600;
			$image = $request->file("slider_image");
			//Get filename with the extension
			$filenameWithExt = $image->getClientOriginalName();
			//Get just file name
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//Get just extension
			$ext = $image->getClientOriginalExtension();
			//Filename to store
			$fileNameToStore = $filename . "_" . time() . "." . $ext;
			$path = "storage/slider_images/" . $fileNameToStore;
			$img_resize = new ImageResize($image->getRealPath());
			$img_resize->resizeToWidth($widthToResize);
			$img_resize->save($path);

			Storage::delete("public/slider_images/" . $slide->cover_img);

			$slide->cover_img = $fileNameToStore;
		}

		$slide->heading = $request->input("slider_header");
		$slide->text = $request->input("slider_text");
		$slide->url_dest = $request->input("slider_link");
		$slide->save();

		return redirect("/KC-admin/sliders/")->with("success", "Slide has been updated");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$slide = Slide::findOrFail($id);
		Storage::delete("public/slider_images/" . $slide->cover_img);
		$slide->delete();
		return redirect("/KC-admin/sliders");
	}


	public function changeActive($id)
	{
		$slide = Slide::findOrFail($id);
		$slide->changeActive();

		return redirect("/KC-admin/sliders")->with("success", "The state of the slide has been changed");
	}

}
