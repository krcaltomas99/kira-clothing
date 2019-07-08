<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
	public $timestamps = false;

	public function getCoverImg()
	{
		return secure_asset("storage/slider_images/" . $this->cover_img);
	}

	public function hasDestination(): bool
	{
		return (bool)$this->getDestinationUrl();
	}

	public function getDestinationUrl()
	{
		return $this->url_dest;
	}

	public function addClick()
	{
		$this->clicks = $this->clicks + 1;
		$this->save();
	}

	public function changeActive()
	{
		$this->active = !$this->active;
		$this->save();
	}

	public function isActive()
	{
		return (bool) $this->active;
	}

}
