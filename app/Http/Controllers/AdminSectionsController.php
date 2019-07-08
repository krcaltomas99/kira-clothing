<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;


class AdminSectionsController extends Controller
{

	public function __construct()
	{
		$this->middleware('employee', ['except' => ['destroy']]);
		$this->middleware('admin', ['only' => ['destroy']]);
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
		$sections = Section::orderBy($sort, $order);

		if ($search) {
			$sections = $sections->where("name", "LIKE", "%{$search}%");
		}
		$sections = $sections->paginate(12);
		return view("admin.sections.index")->with("sections", $sections);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$sections = Section::where("parent_id", 0)->get();
		return view("admin.sections.create")->with("sections", $sections);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$section = new Section;

		//Validace
		$request->validate([
			"name" => "required|unique:sections,name"
		]);

		$section->name = $request->input("name");
		$section->parent_id = $request->input("sectionParent");
		$section->slug = str_slug($request->input("name"));
		$section->position = $section->getMaxPosition() + 1;
		$section->save();

		return redirect("/KC-admin/sections/")->with("success", "The category has been created");
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$section = Section::findOrFail($id);
		$sections = Section::all()->where("parent_id", "==", 0)->where("id", "!==", $section->id);
		if ($section) {
			return view("admin.sections.edit", compact("section", "sections"));

		} else {
			return back()->with("error", "Section doesn't exist");
		}
	}


	public function show(Request $request, $id)
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
		$sections = Section::orderBy($sort, $order);

		if ($search) {
			$sections = $sections->where("name", "LIKE", "%{$search}%");
		}
		$sections = $sections->paginate(12);
		$products = Section::findOrFail($id)->products;

		return view("admin.sections.index", compact("sections", "products"));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$section = Section::findOrFail($id);
		$sections = Section::orderBy("position", "asc")->get();
		$i = 1;

		//Validace
		$request->validate([
			"name" => [
				"required",
				Rule::unique('sections')->ignore($section->id),
			],
			"position" => "integer"
		]);

		foreach ($sections as $item) {
			if ($item->id === $section->id) {
				++$i;
				continue;
			}
			if (intval($request->input("position")) == $item->position) {
				++$i;
			}
			$item->position = $i;
			$item->save();
			++$i;
		}

		$section->name = $request->input("name");
		$section->parent_id = $request->input("sectionParent");
		$section->slug = str_slug($request->input("name"));
		$section->position = $request->input("position");
		$section->save();

		return redirect("/KC-admin/sections/")->with("success", "Category has been updated");
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$section = Section::findOrFail($id);
		$productsSection = $section->products;
		foreach ($productsSection as $product) {
			$product->section_id = Section::firstOrFail()->id;
			$product->save();
		}
		$section->delete();

		$sections = Section::all();
		$i = 1;
		foreach ($sections as $item) {
			$item->position = $i;
			$item->save();
			++$i;
		}

		return redirect("/KC-admin/sections")->with("success", "Succesfully deleted category");
	}

}
