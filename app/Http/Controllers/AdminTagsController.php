<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\ProductTag;
use Illuminate\Support\Facades\Input;

class AdminTagsController extends Controller
{

	public function __construct()
	{
		$this->middleware("employee");
	}

	public $timestamps = false;

	/**
	 * Display a listing of the resource.
	 * @param \Illuminate\Http\Request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$allowedSorts = ["id", "name"];
		$allowedOrder = ["asc", "desc", "ASC", "DESC"];
		$sort = Input::get("sort");
		$order = Input::get("order");

		if (!$sort) {
			$sort = "id";
		}
		if (!$order) {
			$order = "asc";
		}

		if (!in_array($order, $allowedOrder)) {
			$request->session()->flash("error", "Order not allowed");
			return back();
		}
		if (!in_array($sort, $allowedSorts)) {
			$request->session()->flash("error", "Sort not allowed");
			return back();
		}

		$tags = Tag::orderBy($sort, $order)->paginate(12);

		return view("admin.tags.index")->with("tags", $tags);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$tag = Tag::findOrFail($id);
		return view("admin.tags.edit")->with("tag", $tag);
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
		$request->validate([
			"name" => "required"
		]);

		$tag = Tag::findOrFail($id);
		$tag->name = $request->input("name");
		$tag->save();

		return redirect("/KC-admin/tags")->with("success", "The tag has been updated");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$tag = Tag::findOrFail($id);
		$productTags = ProductTag::where("tag_id", $id);
		$productTags->delete();
		$tag->delete();

		return redirect("/KC-admin/tags")->with("success", "The tag has been deleted");
	}
}
