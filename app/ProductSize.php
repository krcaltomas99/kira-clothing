<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{

	public $timestamps = false;

	public function size()
	{
		return $this->belongsTo("App\Size", "size_id");
	}


	public function product()
	{
		return $this->belongsTo("App\Product");
	}

}
