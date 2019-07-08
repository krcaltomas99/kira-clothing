<nav class="navbar navbar-expand-md navbar-light navbar-kira">
	<div class="container">
		<a class="navbar-brand" href="<?php echo e(url('/')); ?>">
			<?php echo e(config('app.name', 'Kira')); ?>

		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
		        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto position-relative">
				<?php if(auth()->guard()->guest()): ?>
					<li class="nav-item">
						<a data-additional-styles="dark" class="nav-link btn-blank mr-sm-3"
						   href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn-blank btn-blank-primary"
						   href="<?php echo e(route('register')); ?>"><?php echo e(__('Sign up')); ?></a>
					</li>
				<?php else: ?>
					<li class="user-show clickable">
						<div class="avatar float-left">
							<img class="image" src="<?php echo e(Auth::user()->getAvatar()); ?>">
						</div>
						<i class="angle down icon float-left avatar-angle-down"></i>
					</li>
					<li class="usermenu-to-show">
						<div class="usermenu">
							<div class="usermenu-header">
								<div class="row">
									<div class="col-3">
										<div class="avatar wrap-img-full">
											<img class="image" src="<?php echo e(Auth::user()->getAvatar()); ?>">
										</div>
									</div>
									<div class="col-9">
										<strong><?php echo e(Auth::user()->name); ?></strong>
										<small><?php echo e(Auth::user()->email); ?></small>
									</div>
								</div>
							</div>
							<div class="usermenu-body">
								<a href="">
									<div class="usermenu-list">
										<div class="row">
											<div class="col-3"><i class="fas fa-shopping-basket"></i></div>
											<div class="col-9 text">
												Basket
											</div>
										</div>
									</div>
								</a>
								<a  href="<?php echo e(route('logout')); ?>"
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

							</div>
						</div>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>
<div class="subnav">
	<div class="container">
		<ul>
			<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li><?php echo e($section->name); ?></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</div>
</div>