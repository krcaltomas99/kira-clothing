<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductTag extends Pivot
{
	protected $table = "product_tags";
}
