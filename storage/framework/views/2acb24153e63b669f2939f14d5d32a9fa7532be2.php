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
		<a class="navbar-brand mx-auto mx-sm-0" href="<?php echo e(url('/')); ?>">
			<?php echo e(config('app.name')); ?>

		</a>
		<h1 class="visuallyhidden">
			<?php echo e(config("app.name")); ?> / <?php echo e(config("app.description")); ?>

		</h1>
		<div class="search-bar mr-auto ml-4 d-none d-sm-block">
			<?php echo e(Form::open(["url"=>route("searchProducts"), "method"=>"get"])); ?>

			<?php echo e(Form::text("q", session("q"), ["class"=>"form-control action-search", "placeholder"=>"Search...", "autocomplete"=>"off"])); ?>

			<i class="fas fa-times-circle <?php if(!session("q")): ?> hide <?php endif; ?>"></i>
			<?php echo e(Form::close()); ?>

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
				<span class="cart-bubble-count favorite <?php if(auth()->guard()->check()): ?> <?php if(Auth::user()->favoriteproducts()->count() > 0): ?> notempty <?php endif; ?> <?php endif; ?>">
					<?php if(auth()->guard()->check()): ?>
						<?php if(Auth::user()->favoriteproducts()->count() > 0): ?>
							<?php echo e(Auth::user()->favoriteproducts()->count()); ?>

						<?php endif; ?>
					<?php endif; ?>
				</span>
				<i class="far fa-heart"></i>
			</li>
			<li class="cart-show clickable mr-2">
				<span class="cart-bubble-count <?php if(Cart::count() > 0): ?> notempty <?php endif; ?>">
					<?php if(Cart::count() > 0): ?>
						<?php echo e(Cart::content()->count()); ?>

					<?php endif; ?>
				</span>
				<i class="fas fa-shopping-cart"></i>
			</li>
			<li class="user-show clickable">
				<div class="avatar float-left">
					<?php if(auth()->guard()->check()): ?>
						<img class="image" src="<?php echo e(Auth::user()->getAvatar()); ?>" alt="avatar">
					<?php else: ?>
						<img class="image" src="<?php echo e(secure_asset("storage/userAvatars/user.png")); ?>" alt="avatar">
					<?php endif; ?>
				</div>
			</li>
			<li class="usermenu-to-show menu-to-show">
				<div class="usermenu">
					<div class="usermenu-header">
						<div class="row">
							<div class="col-3">
								<div class="avatar wrap-img-full">
									<?php if(auth()->guard()->check()): ?>
										<img class="image" src="<?php echo e(Auth::user()->getAvatar()); ?>" alt="avatar">
									<?php else: ?>
										<img class="image" src="<?php echo e(secure_asset("storage/userAvatars/user.png")); ?>"
										     alt="Default avatar image">
									<?php endif; ?>
								</div>
							</div>
							<div class="col-9">
								<?php if(auth()->guard()->check()): ?>
									<strong class="d-block"><?php echo e(Auth::user()->name); ?></strong>
									<small><?php echo e(Auth::user()->email); ?></small>
								<?php else: ?>
									<strong class="d-block">Guest</strong>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="usermenu-body">
						<?php if(auth()->guard()->check()): ?>
							<?php if(Auth::user()->isAdmin()): ?>
								<a href=" <?php echo e(route("admin.index")); ?>">
									<div class="usermenu-list">
										<div class="row">
											<div class="col-3"><i class="fas fa-user-lock"></i></div>
											<div class="col-9 text">
												Admin
											</div>
										</div>
									</div>
								</a>
							<?php endif; ?>
						<?php endif; ?>
						<a href="<?php echo e(route("cart.index")); ?>">
							<div class="usermenu-list">
								<div class="row">
									<div class="col-3"><i class="fas fa-shopping-basket"></i></div>
									<div class="col-9 text">
										Cart
									</div>
								</div>
							</div>
						</a>
						<?php if(auth()->guard()->check()): ?>
							<a href="<?php echo e(route("users.orders")); ?>">
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
							<a href="<?php echo e(route("users.index")); ?>">
								<div class="usermenu-list">
									<div class="row">
										<div class="col-3"><i class="fas fa-cogs"></i></div>
										<div class="col-9 text">
											Settings
										</div>
									</div>
								</div>
							</a>
							<a href="<?php echo e(route('logout')); ?>"
							   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
								<div class="usermenu-list">
									<div class="row">
										<div class="col-3">
											<i class="fas fa-sign-out-alt"></i>
										</div>
										<div class="col-9 text">
											<?php echo e(__('Logout')); ?>

										</div>
									</div>
								</div>
							</a>
							<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
								<?php echo csrf_field(); ?>
							</form>
						<?php else: ?>
							<a href="<?php echo e(route("login")); ?>">
								<div class="usermenu-list">
									<div class="row">
										<div class="col-3">
											<i class="fas fa-sign-in-alt"></i>
										</div>
										<div class="col-9 text">
											<?php echo e(__('Log in')); ?>

										</div>
									</div>
								</div>
							</a>
							<a href="<?php echo e(route("register")); ?>">
								<div class="usermenu-list">
									<div class="row">
										<div class="col-3">
											<i class="fas fa-user-plus"></i>
										</div>
										<div class="col-9 text">
											<?php echo e(__('Register')); ?>

										</div>
									</div>
								</div>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</li>
		</ul>
	</div>
</nav>

<div class="subnav">
	<div class="container">
		<ul class="subnav-nav d-none d-sm-block">
			<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li class="menu-item" data-toggle="categories-<?php echo e($section->slug); ?>">
					<a href="<?php echo e(route("homesections.show", $section->slug)); ?>"><?php echo e($section->name); ?></a>
				</li>
				<?php if($section->children()->count() > 0): ?>
					<li class="menu-subcategories">
						<ul class="subcategories categories-<?php echo e($section->slug); ?>">
							<?php $__currentLoopData = $section->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li>
									<a href="<?php echo e(route("homesections.show", $child->slug)); ?>"><?php echo e($child->name); ?></a>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</li>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>

		<div class="search-bar mr-auto d-block d-sm-none">
			<?php echo e(Form::open(["url"=>route("searchProducts"), "method"=>"get", "class"=>"mobile-search"])); ?>

			<?php echo e(Form::text("q", session("q"), ["class"=>"form-control action-search mobile", "placeholder"=>"Search...", "autocomplete"=>"off"])); ?>

			<i class="fas fa-times-circle hide"></i>
			<?php echo e(Form::close()); ?>

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
			<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li class="menu-item" data-toggle="categories-<?php echo e($section->slug); ?>">
					<a href="<?php echo e(route("homesections.show", $section->slug)); ?>"><?php echo e($section->name); ?></a>
					<?php if($section->children()->count() > 0): ?>
						<i class="fas fa-plus p-4 float-right d-inline-block d-sm-none"></i>
					<?php endif; ?>
				</li>
				<?php if($section->children()->count() > 0): ?>
					<li class="menu-subcategories">
						<ul class="subcategories mobile categories-<?php echo e($section->slug); ?>">
							<?php $__currentLoopData = $section->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li>
									<a href="<?php echo e(route("homesections.show", $child->slug)); ?>"><?php echo e($child->name); ?></a>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</li>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<li class="hamburger ham-close d-block d-sm-none">
				<i class="fas fa-times"></i>
			</li>
		</ul>
	</div>
</div>
