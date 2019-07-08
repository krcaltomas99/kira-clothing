<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'product_id', 'value'
	];

	public function product(){
		return $this->belongsTo("App\Product");
	}
}
