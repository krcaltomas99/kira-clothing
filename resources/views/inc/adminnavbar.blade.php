<nav class="navbar navbar-expand-md navbar-light navbar-kira">
	<a class="navbar-brand admin pr-3" href="{{ route("admin.index") }}">
		Kira Admin
	</a>
	<p class="mb-0"><a target="_blank" href="{{ route("home") }}">Home</a></p>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
	        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto d-block d-md-none">
			<li class="nav-item">
				<a class="nav-link" href="{{ route("products.index") }}">Products</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
				   aria-haspopup="true" aria-expanded="false">
					Products dropdown
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route("products.index") }}">Products</a>
					<a class="dropdown-item" href="{{ route("products.create") }}">Add a product</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{ route("sections.index") }}">Categories</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{ route("tags.index") }}">Tags</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route("sliders.index") }}">Slider</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route("collections.index") }}">Collections</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown"
				   aria-haspopup="true" aria-expanded="false">
					Users dropdown
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown1">
					<a class="dropdown-item" href="{{ route("admin.users.clients") }}">Customers</a>
					<a class="dropdown-item" href="{{ route("admin.users.employees") }}">Employees</a>
					<a class="dropdown-item" href="{{ route("admin.users.user") }}">Users</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route("collections.index") }}">Orders</a>
			</li>
		</ul>
	</div>
</nav>

<div class="leftnav">
	<div class="profile text-left">
		<div class="adminuser-wrapper p-3">
			<div class="row">
				<div class="col-2">
					<div class="ui avatar">
						<img class="image" src="{{ Auth::user()->getAvatar() }}">
					</div>
				</div>
				<div class="col-10">
					<span class="d-inline-block medium">{{ Auth::user()->name }}</span>
					<div class="clearfix"></div>
					<small class="mt-2 d-inline-block">{{ Auth::user()->role }}</small>
					<small class="d-inline-block px-1"> |</small>
					<small class="mt-2 d-inline-block text-primary">
						<a class="text-danger" href="{{ route('logout') }}"
						   onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('logout') }}</a>
					</small>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
					@if(Auth::user()->isSuperAdmin())
						<small><a onclick="return confirm('You are about to migrate the database. Are you sure?')"
						          href="{{ route("migrate") }}">migrate</a></small>
						<small class="d-inline-block px-1"> |</small>
						<small><a onclick="return confirm('You are about to rollback the database. Are you sure?')"
						          class="text-danger" href={{ route("rollback") }}>rollback</a></small>
					@endif
				</div>
			</div>
		</div>

		<ul class="admin-abilities mb-3">
			<div class="btn-group dropright btn-block">
				<button type="button"
				        class="btn btn-light btn-block btn-wave
@if(Request::is('KC-admin/products*') || Request::is('KC-admin/sections*') || Request::is('KC-admin/tags*')) active @endif"
				        @if(!Request::is('KC-admin/products*') && !Request::is('KC-admin/sections*') && !Request::is('KC-admin/tags*')) data-additional-styles="dark" @endif>
					<a href="{{ route("products.index") }}">
						<i class="fas fa-box-open"></i> Products
					</a>
				</button>
				<button type="button"
				        class="btn btn-light dropdown-toggle dropdown-toggle-split @if(Request::is('KC-admin/products*')
				         || Request::is('KC-admin/sections*')
				         || Request::is("KC-admin/tags*")) active @endif"
				        data-toggle="dropdown"
				        aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropright</span>
				</button>
				<div class="dropdown-menu">
					<h6 class="ml-3 mt-3 bold">Products</h6>
					<a href="{{ route("products.index") }}" class="dropdown-item a-wave">
						<i class="fas fa-list-ol mr-2"></i>
						Products
					</a>
					<a href="{{ route("products.create") }}" class="dropdown-item a-wave">
						<i class="fas fa-plus mr-2"></i>
						Add a product
					</a>
					<div class="dropdown-divider"></div>
					<h6 class="ml-3 mt-3 bold">Categories</h6>
					<a href="{{ route("sections.index") }}" class="dropdown-item a-wave">
						<i class="fas fa-list-ol mr-2"></i>
						Categories
					</a>
					<div class="dropdown-divider"></div>
					<h6 class="ml-3 mt-3 bold">Tags</h6>
					<a href="{{ route("tags.index") }}" class="dropdown-item a-wave">
						<i class="fas fa-list-ol mr-2"></i>
						Tags
					</a>
				</div>
			</div>
			@if(Request::is('KC-admin/products*') || Request::is('KC-admin/sections*') || Request::is("KC-admin/tags*"))
				<ul class="admin-leftsubbar">
					<li>
						<a href="{{ route("products.index") }}">
							Products
						</a>
					</li>
					<li>
						<a href="{{ route("products.create") }}">
							Add a product
						</a>
					</li>
					<li>
						<a href="{{ route("sections.index") }}">
							Categories
						</a>
					</li>
					<li>
						<a href="{{ route("tags.index") }}">
							Tags
						</a>
					</li>
				</ul>
			@endif

			<div class="btn-group dropright btn-block">
				<button type="button"
				        class="btn btn-light btn-block btn-wave @if(Request::is('KC-admin/sliders*')) active @endif"
				        @if(!Request::is('KC-admin/sliders*')) data-additional-styles="dark" @endif>
					<a href="{{ route("sliders.index") }}">
						<i class="fas fa-ad"></i> Slider
					</a>
				</button>
				<button type="button"
				        class="btn btn-light dropdown-toggle
				        dropdown-toggle-split @if(Request::is('KC-admin/sliders*')) active @endif"
				        data-toggle="dropdown"
				        aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropright</span>
				</button>
				<div class="dropdown-menu">
					<a href="{{ route("sliders.index") }}" class="dropdown-item a-wave">
						<i class="fas fa-list-ol mr-2"></i>
						Slides
					</a>
					<a href="{{ route("sliders.create") }}" class="dropdown-item a-wave">
						<i class="fas fa-plus mr-2"></i>
						Add a slide
					</a>
				</div>
			</div>
			@if(Request::is('KC-admin/sliders*'))
				<ul class="admin-leftsubbar">
					<li>
						<a href="{{ route("sliders.index") }}">
							Slides
						</a>
					</li>
					<li>
						<a href="{{ route("sliders.create") }}">
							Add a slide
						</a>
					</li>

				</ul>
			@endif

			<div class="btn-group dropright btn-block">
				<button type="button"
				        class="btn btn-light btn-block btn-wave @if(Request::is('KC-admin/collections*')) active @endif"
				        @if(!Request::is('KC-admin/collections*')) data-additional-styles="dark" @endif>
					<a href="{{ route("collections.index") }}">
						<i class="fas fa-camera-retro"></i> Collections
					</a>
				</button>
				<button type="button"
				        class="btn btn-light dropdown-toggle dropdown-toggle-split @if(Request::is('KC-admin/collections*')) active @endif"
				        data-toggle="dropdown"
				        aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropright</span>
				</button>
				<div class="dropdown-menu">
					<a href="{{ route("collections.index") }}" class="dropdown-item a-wave">
						<i class="fas fa-list-ol mr-2"></i>
						Collections
					</a>
					<a href="{{ route("collections.create") }}" class="dropdown-item a-wave">
						<i class="fas fa-plus mr-2"></i>
						Add a collection
					</a>
				</div>
			</div>
			@if( Request::is('KC-admin/collections*'))
				<ul class="admin-leftsubbar menu">
					<li>
						<a href="{{ route("collections.index") }}">
							Collections
						</a>
					</li>
					<li>
						<a href="{{ route("collections.create") }}">
							Add a collection
						</a>
					</li>

				</ul>
			@endif

			<div class="btn-group dropright btn-block">
				<button type="button"
				        class="btn btn-light btn-block btn-wave @if(Request::is('KC-admin/user*')) active @endif"
				        @if(!Request::is('KC-admin/user*')) data-additional-styles="dark" @endif>
					<a href="{{ route("admin.users.user") }}">
						<i class="fas fa-users"></i> Users
					</a>
				</button>
				<button type="button"
				        class="btn btn-light dropdown-toggle dropdown-toggle-split @if(Request::is('KC-admin/user/*')) active @endif"
				        data-toggle="dropdown"
				        aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropright</span>
				</button>
				<div class="dropdown-menu">
					<a class="text-left dropdown-item a-wave" href="{{ route("admin.users.clients") }}">
						Customers
					</a>
					<a class="text-left dropdown-item a-wave" href="{{ route("admin.users.employees") }}">
						Employees
					</a>
					<a class="text-left dropdown-item a-wave" href="{{ route("admin.users.user") }}">
						Users
					</a>
				</div>
			</div>
			@if(Request::is('KC-admin/user*'))
				<ul class="admin-leftsubbar">
					<li>
						<a href="{{ route("admin.users.clients") }}">
							Customers
						</a>
					</li>
					<li>
						<a href="{{ route("admin.users.employees") }}">
							Employees
						</a>
					</li>
					<li>
						<a href="{{ route("admin.users.user") }}">
							Users
						</a>
					</li>
				</ul>
			@endif
			<li class="dropright">
				<button type="button"
				        class="btn btn-light btn-block btn-wave @if(Request::is('KC-admin/orders*')) active @endif"
				        @if(!Request::is('KC-admin/orders*')) data-additional-styles="dark" @endif>
					<a href="{{ route("admin.orders.index") }}">
						<i class="fas fa-shopping-basket"></i> Orders
					</a>
				</button>
			</li>

		</ul>
	</div>
</div>