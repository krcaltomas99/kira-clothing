<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{

	public $timestamps = false;


	public function product()
	{
		return $this->belongsTo("App\Product");
	}


	public function user()
	{
		return $this->belongsTo("App\User");
	}

}
