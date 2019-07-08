<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

	public $timestamps = false;

	public function products()
	{
		return $this->hasMany("App\Product");
	}

}
