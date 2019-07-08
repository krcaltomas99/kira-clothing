<nav class="navbar navbar-expand-md navbar-light navbar-kira">
	<a class="navbar-brand pr-3" href="<?php echo e(route("admin.index")); ?>">
		Kira Admin
	</a>
	<p><a href="<?php echo e(route("home")); ?>">Home</a></p>
</nav>

<div class="leftnav">
	<div class="profile text-left">
		<div class="adminuser-wrapper p-3">
			<div class="row">
				<div class="col-2">
					<img class="ui avatar image" src="<?php echo e(Auth::user()->getAvatar()); ?>">
				</div>
				<div class="col-10">
					<span class="d-inline-block medium"><?php echo e(Auth::user()->name); ?></span>
					<div class="clearfix"></div>
					<small class="mt-2 d-inline-block"><?php echo e(Auth::user()->role); ?></small>
					<small class="d-inline-block px-1"> |</small>
					<small class="mt-2 d-inline-block text-primary">
						<a class="text-danger" href="<?php echo e(route('logout')); ?>"
						   onclick="event.preventDefault();document.getElementById('logout-form').submit();"><?php echo e(__('logout')); ?></a>
					</small>
					<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
						<?php echo csrf_field(); ?>
					</form>
				</div>
			</div>
		</div>

		<ul class="admin-abilities mb-3">
			<div class="btn-group dropright btn-block">
				<button type="button"
				        class="btn btn-light btn-block btn-wave
<?php if(Request::is('KC-admin/products*') || Request::is('KC-admin/sections*')): ?> active <?php endif; ?>"
				        <?php if(!Request::is('KC-admin/products*') && !Request::is('KC-admin/sections*')): ?> data-additional-styles="dark" <?php endif; ?>>
					<a href="<?php echo e(route("products.index")); ?>">
						<i class="fas fa-box-open"></i> Products
					</a>
				</button>
				<button type="button"
				        class="btn btn-light dropdown-toggle dropdown-toggle-split <?php if(Request::is('KC-admin/products*') || Request::is('KC-admin/sections*')): ?> active <?php endif; ?>"
				        data-toggle="dropdown"
				        aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropright</span>
				</button>
				<div class="dropdown-menu">
					<h6 class="ml-3 mt-3 bold">Products</h6>
					<a href="<?php echo e(route("products.index")); ?>" class="dropdown-item a-wave">
						<i class="fas fa-list-ol mr-2"></i>
						Products
					</a>
					<a href="<?php echo e(route("products.create")); ?>" class="dropdown-item a-wave">
						<i class="fas fa-plus mr-2"></i>
						Add a product
					</a>
					<div class="dropdown-divider"></div>
					<h6 class="ml-3 mt-3 bold">Categories</h6>
					<a href="<?php echo e(route("sections.index")); ?>" class="dropdown-item a-wave">
						<i class="fas fa-list-ol mr-2"></i>
						Categories
					</a>
					<div class="dropdown-divider"></div>
					<h6 class="ml-3 mt-3 bold">Tags</h6>
					<a href="<?php echo e(route("tags.index")); ?>" class="dropdown-item a-wave">
						<i class="fas fa-list-ol mr-2"></i>
						Tags
					</a>
				</div>
			</div>
			<?php if(Request::is('KC-admin/products*') || Request::is('KC-admin/sections*')): ?>
				<ul class="admin-leftsubbar">
					<li>
						<a href="<?php echo e(route("products.index")); ?>">
							Products
						</a>
					</li>
					<li>
						<a href="<?php echo e(route("products.create")); ?>">
							Add a product
						</a>
					</li>
					<li>
						<a href="<?php echo e(route("sections.index")); ?>">
							Categories
						</a>
					</li>
					<li>
						<a href="<?php echo e(route("tags.index")); ?>">
							Tags
						</a>
					</li>
				</ul>
			<?php endif; ?>

			<div class="btn-group dropright btn-block">
				<button type="button"
				        class="btn btn-light btn-block btn-wave <?php if(Request::is('KC-admin/sliders*')): ?> active <?php endif; ?>"
				        <?php if(!Request::is('KC-admin/sliders*')): ?> data-additional-styles="dark" <?php endif; ?>>
					<a href="<?php echo e(route("sliders.index")); ?>">
						<i class="fas fa-ad"></i> Slider
					</a>
				</button>
				<button type="button"
				        class="btn btn-light dropdown-toggle
				        dropdown-toggle-split <?php if(Request::is('KC-admin/sliders*')): ?> active <?php endif; ?>"
				        data-toggle="dropdown"
				        aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropright</span>
				</button>
				<div class="dropdown-menu">
					<a href="<?php echo e(route("sliders.index")); ?>" class="dropdown-item a-wave">
						<i class="fas fa-list-ol mr-2"></i>
						Slides
					</a>
					<a href="<?php echo e(route("sliders.create")); ?>" class="dropdown-item a-wave">
						<i class="fas fa-plus mr-2"></i>
						Add a slide
					</a>
				</div>
			</div>
			<?php if(Request::is('KC-admin/sliders*')): ?>
				<ul class="admin-leftsubbar">
					<li>
						<a href="<?php echo e(route("sliders.index")); ?>">
							Slides
						</a>
					</li>
					<li>
						<a href="<?php echo e(route("sliders.create")); ?>">
							Add a slide
						</a>
					</li>

				</ul>
			<?php endif; ?>

			<div class="btn-group dropright btn-block">
				<button type="button"
				        class="btn btn-light btn-block btn-wave <?php if(Request::is('KC-admin/collections*')): ?> active <?php endif; ?>"
				        <?php if(!Request::is('KC-admin/collections*')): ?> data-additional-styles="dark" <?php endif; ?>>
					<a href="<?php echo e(route("collections.index")); ?>">
						<i class="fas fa-camera-retro"></i> Collections
					</a>
				</button>
				<button type="button"
				        class="btn btn-light dropdown-toggle dropdown-toggle-split <?php if(Request::is('KC-admin/collections*')): ?> active <?php endif; ?>"
				        data-toggle="dropdown"
				        aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropright</span>
				</button>
				<div class="dropdown-menu">
					<a href="<?php echo e(route("collections.index")); ?>" class="dropdown-item a-wave">
						<i class="fas fa-list-ol mr-2"></i>
						Collections
					</a>
					<a href="<?php echo e(route("collections.create")); ?>" class="dropdown-item a-wave">
						<i class="fas fa-plus mr-2"></i>
						Add a collection
					</a>
				</div>
			</div>
			<?php if( Request::is('KC-admin/collections*')): ?>
				<ul class="admin-leftsubbar menu">
					<li>
						<a href="<?php echo e(route("collections.index")); ?>">
							Collections
						</a>
					</li>
					<li>
						<a href="<?php echo e(route("collections.create")); ?>">
							Add a collection
						</a>
					</li>

				</ul>
			<?php endif; ?>

			<div class="btn-group dropright btn-block">
				<button type="button"
				        class="btn btn-light btn-block btn-wave <?php if(Request::is('KC-admin/topics*')): ?> active <?php endif; ?>"
				        <?php if(!Request::is('KC-admin/topics*')): ?> data-additional-styles="dark" <?php endif; ?>>
					<a href="<?php echo e(route("topics.index")); ?>">
						<i class="fas fa-certificate"></i> Topics
					</a>
				</button>
				<button type="button"
				        class="btn btn-light dropdown-toggle dropdown-toggle-split <?php if(Request::is('KC-admin/topics*')): ?> active <?php endif; ?>"
				        data-toggle="dropdown"
				        aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropright</span>
				</button>
				<div class="dropdown-menu">
					<a href="<?php echo e(route("topics.index")); ?>" class="dropdown-item a-wave">
						<i class="fas fa-list-ol mr-2"></i>
						Topics
					</a>
					<a href="<?php echo e(route("topics.create")); ?>" class="dropdown-item a-wave">
						<i class="fas fa-plus mr-2"></i>
						Add a topic
					</a>
				</div>
			</div>
			<?php if( Request::is('KC-admin/topics*')): ?>
				<ul class="admin-leftsubbar menu">
					<li>
						<a href="<?php echo e(route("topics.index")); ?>">
							Topics
						</a>
					</li>
					<li>
						<a href="<?php echo e(route("topics.create")); ?>">
							Add a topic
						</a>
					</li>

				</ul>
			<?php endif; ?>

			<div class="btn-group dropright btn-block">
				<button type="button"
				        class="btn btn-light btn-block btn-wave <?php if(Request::is('KC-admin/user*')): ?> active <?php endif; ?>"
				        <?php if(!Request::is('KC-admin/user*')): ?> data-additional-styles="dark" <?php endif; ?>>
					<a href="<?php echo e(route("admin.users.user")); ?>">
						<i class="fas fa-users"></i> Users
					</a>
				</button>
				<button type="button"
				        class="btn btn-light dropdown-toggle dropdown-toggle-split <?php if(Request::is('KC-admin/user/*')): ?> active <?php endif; ?>"
				        data-toggle="dropdown"
				        aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropright</span>
				</button>
				<div class="dropdown-menu">
					<a class="text-left dropdown-item a-wave" href="<?php echo e(route("admin.users.clients")); ?>">
						Customers
					</a>
					<a class="text-left dropdown-item a-wave" href="<?php echo e(route("admin.users.employees")); ?>">
						Employees
					</a>
					<a class="text-left dropdown-item a-wave" href="<?php echo e(route("admin.users.user")); ?>">
						Users
					</a>
				</div>
			</div>
			<?php if(Request::is('KC-admin/user*')): ?>
				<ul class="admin-leftsubbar">
					<li>
						<a href="<?php echo e(route("admin.users.clients")); ?>">
							Customers
						</a>
					</li>
					<li>
						<a href="<?php echo e(route("admin.users.employees")); ?>">
							Employees
						</a>
					</li>
					<li>
						<a href="<?php echo e(route("admin.users.user")); ?>">
							Users
						</a>
					</li>
				</ul>
			<?php endif; ?>
		</ul>
	</div>
</div>