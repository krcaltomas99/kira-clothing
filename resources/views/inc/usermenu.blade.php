<ul>
	<li>
		<a class="@if(Request::is("user/settings")) active @endif"
		   href="{{ route("users.index") }}">Profile information</a>
	</li>
	<li>
		<a class="@if(Request::is("user/settings/password")) active @endif"
		   href="{{ route("users.pass") }}">Change password</a>
	</li>
	<li>
		<a class="@if(Request::is("user/settings/shipping")) active @endif"
		   href="{{ route("users.shipping") }}">Shipping address</a>
	</li>
	<li>
		<a class="@if(Request::is("user/orders")) active @endif"
		   href="{{ route("users.orders") }}">Manage orders</a>
	</li>
</ul>