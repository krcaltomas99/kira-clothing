<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;


class Product extends Model
{

	public function section()
	{
		return $this->belongsTo("App\Section");
	}


	public function collection()
	{
		return $this->belongsTo("App\Collection");
	}


	public function user()
	{
		return $this->belongsTo("App\User");
	}


	public function images()
	{
		return $this->hasMany("App\ProductImage");
	}


	public function color()
	{
		return $this->hasMany("App\ProductColor");
	}

	/**
	 * Get the tags for sociated product
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany("App\Tag", "product_tags")->withTimestamps();
	}


	public function quantities()
	{
		return $this->hasMany("App\ProductSize", "product_id");
	}


	public function sizes()
	{
		return $this->belongsToMany("App\Size", "product_sizes");
	}


	public function group()
	{
		return $this->belongsTo("App\Group");
	}


	public function children()
	{
		return $this->hasMany("App\Product", "sku_id");
	}


	public function parent()
	{
		return $this->belongsTo("App\Product", "sku_id");
	}


	public function ratings()
	{
		return $this->hasMany("App\ProductRating");
	}


	public function presentPrice(): string
	{
		if (function_exists("money_format")) {
			return money_format('$%i', $this->price * 1.21);

		} else {
			return "$" . number_format((float)$this->price * 1.21, 2, ".", "");
		}
	}


	public function presentPriceWithQty(int $qty): string
	{
		if (function_exists("money_format")) {
			return money_format('$%i', $this->price * $qty);

		} else {
			return "$" . number_format((float)$this->price * $qty, 2, ".", "");
		}
	}


	function presentPriceWithQtyWithTax(int $qty): string
	{
		if (function_exists("money_format")) {
			return money_format('$%i', $this->price * 1.21 * $qty);

		} else {
			return "$" . number_format((float)$this->price * 1.21 * $qty, 2, ".", "");
		}
	}


	public function presentPriceWIithoutTax(): string
	{
		if (function_exists("money_format")) {
			return money_format('$%i', $this->price);

		} else {
			return "$" . number_format((float)$this->price, 2, ".", "");
		}
	}


	public function getCoverImg(): string
	{
		return secure_asset("storage/product_images/" . $this->nahled_photo);
	}


	public function getCoverImgMin(): string
	{
		return secure_asset("storage/product_images/" . $this->nahled_photo_min);
	}


	public function getCoverImgUltraMin(): string
	{
		return secure_asset("storage/product_images/" . $this->nahled_photo_ultra_min);
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getProductImages()
	{
		return $this->images();
	}


	public function hasQuantities(): bool
	{
		$total = 0;
		foreach ($this->quantities as $quantity) {
			$total = $total + $quantity->qty;
		}

		if ($total <= 0) {
			return false;
		}
		return true;
	}


	public function getSizeNameBySizeId(int $id): string
	{
		$name = "";
		foreach ($this->sizes as $size) {
			if ($size->id === $id) {
				$name = $size->name;
			}
		}
		return $name;
	}


	public function isSku()
	{
		return (bool)$this->parent;
	}


	public function hasSku()
	{
		return $this->children()->count();
	}


	public function getMainSku()
	{
		if ($this->isSku()) {
			return $this->parent;
		}

		return $this;
	}


	public function addSold()
	{
		$this->sold = $this->sold + 1;
		$this->save();
	}

}
