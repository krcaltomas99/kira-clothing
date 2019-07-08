<ul>
	<li>
		<a class="<?php if(Request::is("user/settings")): ?> active <?php endif; ?>"
		   href="<?php echo e(route("users.index")); ?>">Profile information</a>
	</li>
	<li>
		<a class="<?php if(Request::is("user/settings/password")): ?> active <?php endif; ?>"
		   href="<?php echo e(route("users.pass")); ?>">Change password</a>
	</li>
	<li>
		<a class="<?php if(Request::is("user/settings/shipping")): ?> active <?php endif; ?>"
		   href="<?php echo e(route("users.shipping")); ?>">Shipping address</a>
	</li>
	<li>
		<a class="<?php if(Request::is("user/orders")): ?> active <?php endif; ?>"
		   href="<?php echo e(route("users.orders")); ?>">Manage orders</a>
	</li>
</ul>