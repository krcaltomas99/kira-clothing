<nav class="navbar navbar-expand-sm navbar-light navbar-kira">
	<div class="container position-relative">

		<!-- Favorites and cart -->
		<div class="cartmenu-to-show icon-menus menu-to-show">
			<div class="usermenu">
				<div class="usermenu-header">
					<ul class="cartmenu-ul mb-0">
						<li class="active">Cart</li>
					</ul>
				</div>
				<div class="usermenu-body"></div>
			</div>
		</div>

		<div class="favoritemenu-to-show icon-menus menu-to-show">
			<div class="usermenu">
				<div class="usermenu-header">
					<ul class="cartmenu-ul mb-0">
						<li class="active">Favorite</li>
					</ul>
				</div>
				<div class="usermenu-body"></div>
			</div>
		</div>

		<div class="hamburger d-sm-none">
			<i class="fas fa-bars"></i>
		</div>
		<a class="navbar-brand mx-auto mx-sm-0" href="{{ url('/') }}">
			{{ config('app.name') }}
		</a>
		<h1 class="visuallyhidden">
			{{ config("app.name") }} / {{ config("app.description") }}
		</h1>
		<div class="search-bar mr-auto ml-4 d-none d-sm-block">
			{{ Form::open(["url"=>route("searchProducts"), "method"=>"get"]) }}
			{{ Form::text("q", session("q"), ["class"=>"form-control action-search", "placeholder"=>"Search...", "autocomplete"=>"off"]) }}
			<i class="fas fa-times-circle @if(!session("q")) hide @endif"></i>
			{{ Form::close() }}
			<div class="results">
				<div class="results-head">
					Products
				</div>
				<div class="results-body">
					<div class="row product-results item-results"></div>
				</div>

				<div class="results-head small might-like">
					Suggested products
				</div>
				<div class="results-body might-like-body">
					<div class="row item-results tag-results"></div>
				</div>

				<div class="results-head">
					Categories
				</div>
				<div class="results-body">
					<div class="row categories-results item-results"></div>
				</div>

				<div class="results-head">
					Collections
				</div>
				<div class="results-body">
					<div class="row collection-results item-results"></div>
				</div>
			</div>
		</div>

		<!-- Right Side Of Navbar -->
		<ul class="navbar-nav ml-0 ml-xs-auto position-relative">
			<li class="favorite-show clickable mr-1">
				<span class="cart-bubble-count favorite @auth @if(Auth::user()->favoriteproducts()->count() > 0) notempty @endif @endauth">
					@auth
						@if(Auth::user()->favoriteproducts()->count() > 0)
							{{ Auth::user()->favoriteproducts()->count() }}
						@endif
					@endauth
				</span>
				<i class="far fa-heart"></i>
			</li>
			<li class="cart-show clickable mr-2">
				<span class="cart-bubble-count @if(Cart::count() > 0) notempty @endif">
					@if(Cart::count() > 0)
						{{ Cart::content()->count() }}
					@endif
				</span>
				<i class="fas fa-shopping-cart"></i>
			</li>
			<li class="user-show clickable">
				<div class="avatar float-left">
					@auth
						<img class="image" src="{{ Auth::user()->getAvatar() }}" alt="avatar">
					@else
						<img class="image" src="{{ secure_asset("storage/userAvatars/user.png") }}" alt="avatar">
					@endauth
				</div>
			</li>
			<li class="usermenu-to-show menu-to-show">
				<div class="usermenu">
					<div class="usermenu-header">
						<div class="row">
							<div class="col-3">
								<div class="avatar wrap-img-full">
									@auth
										<img class="image" src="{{ Auth::user()->getAvatar() }}" alt="avatar">
									@else
										<img class="image" src="{{ secure_asset("storage/userAvatars/user.png") }}"
										     alt="Default avatar image">
									@endauth
								</div>
							</div>
							<div class="col-9">
								@auth
									<strong class="d-block">{{ Auth::user()->name }}</strong>
									<small>{{ Auth::user()->email }}</small>
								@else
									<strong class="d-block">Guest</strong>
								@endauth
							</div>
						</div>
					</div>
					<div class="usermenu-body">
						@auth
							@if(Auth::user()->isAdmin())
								<a href=" {{ route("admin.index") }}">
									<div class="usermenu-list">
										<div class="row">
											<div class="col-3"><i class="fas fa-user-lock"></i></div>
											<div class="col-9 text">
												Admin
											</div>
										</div>
									</div>
								</a>
							@endif
						@endauth
						<a href="{{ route("cart.index") }}">
							<div class="usermenu-list">
								<div class="row">
									<div class="col-3"><i class="fas fa-shopping-basket"></i></div>
									<div class="col-9 text">
										Cart
									</div>
								</div>
							</div>
						</a>
						@auth
							<a href="{{ route("users.orders") }}">
								<div class="usermenu-list">
									<div class="row">
										<div class="col-3"><i class="fas fa-box-open"></i></div>
										<div class="col-9">
											Orders
										</div>
									</div>
								</div>
							</a>
							<div class="divider"></div>
							<a href="{{ route("users.index") }}">
								<div class="usermenu-list">
									<div class="row">
										<div class="col-3"><i class="fas fa-cogs"></i></div>
										<div class="col-9 text">
											Settings
										</div>
									</div>
								</div>
							</a>
							<a href="{{ route('logout') }}"
							   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
								<div class="usermenu-list">
									<div class="row">
										<div class="col-3">
											<i class="fas fa-sign-out-alt"></i>
										</div>
										<div class="col-9 text">
											{{ __('Logout') }}
										</div>
									</div>
								</div>
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						@else
							<a href="{{ route("login") }}">
								<div class="usermenu-list">
									<div class="row">
										<div class="col-3">
											<i class="fas fa-sign-in-alt"></i>
										</div>
										<div class="col-9 text">
											{{ __('Log in') }}
										</div>
									</div>
								</div>
							</a>
							<a href="{{ route("register") }}">
								<div class="usermenu-list">
									<div class="row">
										<div class="col-3">
											<i class="fas fa-user-plus"></i>
										</div>
										<div class="col-9 text">
											{{ __('Register') }}
										</div>
									</div>
								</div>
							</a>
						@endauth
					</div>
				</div>
			</li>
		</ul>
	</div>
</nav>

<div class="subnav">
	<div class="container">
		<ul class="subnav-nav d-none d-sm-block">
			@foreach($sections as $section)
				<li class="menu-item" data-toggle="categories-{{ $section->slug }}">
					<a href="{{ route("homesections.show", $section->slug) }}">{{ $section->name }}</a>
				</li>
				@if($section->children()->count() > 0)
					<li class="menu-subcategories">
						<ul class="subcategories categories-{{ $section->slug }}">
							@foreach($section->children as $child)
								<li>
									<a href="{{ route("homesections.show", $child->slug) }}">{{ $child->name }}</a>
								</li>
							@endforeach
						</ul>
					</li>
				@endif
			@endforeach
		</ul>

		<div class="search-bar mr-auto d-block d-sm-none">
			{{ Form::open(["url"=>route("searchProducts"), "method"=>"get", "class"=>"mobile-search"]) }}
			{{ Form::text("q", session("q"), ["class"=>"form-control action-search mobile", "placeholder"=>"Search...", "autocomplete"=>"off"]) }}
			<i class="fas fa-times-circle hide"></i>
			{{ Form::close() }}
			<div class="results">
				<div class="results-head">
					<span class="float-left">Products</span>
					<div class="fas fa-times close"></div>
					<div class="clearfix"></div>
				</div>
				<div class="results-body">
					<div class="row product-results mobile item-results"></div>
				</div>

				<div class="results-head small might-like">
					Suggested products
				</div>
				<div class="results-body might-like-body">
					<div class="row item-results tag-results mobile"></div>
				</div>

				<div class="results-head">
					Categories
				</div>
				<div class="results-body">
					<div class="row categories-results mobile item-results"></div>
				</div>

				<div class="results-head">
					Collections
				</div>
				<div class="results-body">
					<div class="row collection-results mobile item-results"></div>
				</div>
			</div>
		</div>
		<ul class="mobile-subnav-nav d-block d-sm-none">
			@foreach($sections as $section)
				<li class="menu-item" data-toggle="categories-{{ $section->slug }}">
					<a href="{{ route("homesections.show", $section->slug) }}">{{ $section->name }}</a>
					@if($section->children()->count() > 0)
						<i class="fas fa-plus p-4 float-right d-inline-block d-sm-none"></i>
					@endif
				</li>
				@if($section->children()->count() > 0)
					<li class="menu-subcategories">
						<ul class="subcategories mobile categories-{{ $section->slug }}">
							@foreach($section->children as $child)
								<li>
									<a href="{{ route("homesections.show", $child->slug) }}">{{ $child->name }}</a>
								</li>
							@endforeach
						</ul>
					</li>
				@endif
			@endforeach
			<li class="hamburger ham-close d-block d-sm-none">
				<i class="fas fa-times"></i>
			</li>
		</ul>
	</div>
</div>
