<div class="section section-footer">
	<div class="container">
		<div class="row">
			<div class="text-center text-md-left col-12 col-lg-3 col-md-4">
				<h5>Welcome to Kira Clothing!</h5>
				<p>
					This is a graduation project by <a target="_blank" href="https://www.instagram.com/tomkrcal/">Tomáš
						Krčál</a>
					made possible by using <a target="_blank" href="https://laravel.com/">Laravel</a> for back-end and
					<a href="https://getbootstrap.com/">Bootstrap 4</a> with <a target="_blank"
					                                                            href="https://jquery.com/">jQuery</a>
					for the front-end. This website is for testing purposes only
				</p>
			</div>
			<div class="offset-lg-3 offset-md-2"></div>
			<div class="text-center text-md-left col-12 col-md-2">
				<h5>Sitemap</h5>
				<ul>
					<li><a href="<?php echo e(route("home")); ?>">Home</a></li>
					<li><a href="<?php echo e(route("cart.index")); ?>">Cart</a></li>
					<?php if(auth()->guard()->check()): ?>
						<li>
							<a href="<?php echo e(route('logout')); ?>"
							   onclick="event.preventDefault();
                                                     document.getElementById('logout-form2').submit();">
								Log out
							</a>
							<form id="logout-form2" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
								<?php echo csrf_field(); ?>
							</form>
						</li>
					<?php else: ?>
						<li><a href="<?php echo e(route("login")); ?>">Log in</a></li>
						<li><a href="<?php echo e(route("register")); ?>">Register</a></li>
					<?php endif; ?>
				</ul>
			</div>
			<div class="text-center text-md-left col-12 col-md-2">
				<h5>Socials</h5>
				<ul>
					<li><a href="">facebook</a></li>
					<li><a href="">instagram</a></li>
					<li><a href="">youtube</a></li>
					<li><a href="">twitter</a></li>
				</ul>
			</div>
			<div class="text-center text-md-left col-12 col-md-2">
				<h5>Business</h5>
				<ul>
					<li><a href="">Contact</a></li>
					<li><a href="<?php echo e(route("privacypolicy")); ?>">Privacy Policy</a></li>
					<li><a href="">Agreement to service</a></li>
				</ul>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-12">
				<p class="text-center text-dark">&copy; 2019 Tomáš Krčál - All right reserved</p>
			</div>
		</div>
	</div>
</div>