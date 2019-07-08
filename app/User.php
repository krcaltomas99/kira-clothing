<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'avatar', 'role'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];


	public function products()
	{
		return $this->hasMany("App\Product");
	}


	public function social()
	{
		return $this->hasOne("App\SocialAccount");
	}


	public function favoriteproducts()
	{
		return $this->belongsToMany("App\Product", "favorite_products");
	}


	public function shoppingcart()
	{
		return $this->hasOne("App\Shoppingcart", "identifier");
	}


	public function shipping_address()
	{
		return $this->hasOne("App\ShippingAddress");
	}


	public function favorite_colors()
	{
		return $this->hasMany("App\UserColor");
	}


	public function orders()
	{
		return $this->hasMany("App\Order");
	}


	public function ratings()
	{
		return $this->hasMany("App\ProductRating");
	}


	public function orders_desc()
	{
		return $this->hasMany("App\Order")->orderBy("id", "desc");
	}


	public function getId(): int
	{
		return $this->id;
	}

	public function getRole(): string
	{
		return $this->role;
	}


	public function isSocial(): bool
	{
		if ($this->social) {
			return true;
		}
		return false;
	}


	public function isAvatarSocial(): bool
	{
		$result = strpos($this->avatar, "https://");
		if ($result === 0) {
			return true;
		}
		return false;
	}


	public function getAvatar(): string
	{
		if ($this->isAvatarSocial()) {
			return $this->getSocialAvatar();
		} else {
			return secure_asset($this->getBasicAvatar());
		}
	}


	public function getSocialAvatar(): string
	{
		return $this->avatar;
	}


	public function makeDefaultAvatar()
	{
		$this->avatar = "user.png";
		$this->save();
	}


	public function isDefault()
	{
		return (bool)($this->avatar === "user.png");
	}


	public function getBasicAvatar(): string
	{
		return "storage/userAvatars/" . $this->avatar;
	}


	public function isAdmin(): bool
	{
		return (bool)($this->role !== "customer");
	}


	public function isSuperAdmin(): bool
	{
		return (bool)($this->role === "superadmin");
	}


	public function addToFavorites(int $id)
	{
		$this->favoriteproducts()->attach($id);
	}


	public function removeFromFavorites(int $id)
	{
		$this->favoriteproducts()->detach($id);
	}


	public function isProductFavorite(int $productid): bool
	{
		if ($this->favoriteproducts->contains($productid)) {
			return true;
		}
		return false;
	}
}
