<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{

	public $timestamps = false;


	public function products()
	{
		return $this->hasMany("App\Product");
	}


	public function getImg(): string
	{
		return "storage/collection_images/" . $this->cover_img;
	}

	public function addClick(): void
	{
		$this->clicks = $this->clicks + 1;
		$this->save();
	}

	public function getCoverImg(): string
	{
		return secure_asset("storage/collection_images/" . $this->cover_img);
	}

}
