<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

	public $timestamps = false;


	public function products()
	{
		return $this->hasMany("App\Product");
	}


	public function children()
	{
		return $this->hasMany('App\Section', 'parent_id');
	}


	public function parent()
	{
		return $this->belongsTo("App\Section", "parent_id");
	}


	/**
	 * @return integer
	 */
	public function getMaxPosition()
	{
		return Section::max("position");
	}

}
