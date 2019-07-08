@extends("layouts.app")

@section("content")
	<style>
		.iubenda-ibadge {
			display: block;
			margin: 20px auto 0 auto;
		}
	</style>
	<div class="col-12">
		<a href="https://www.iubenda.com/privacy-policy/32365074" class="iubenda-white iubenda-embed text-center mt-4"
		   title="Privacy Policy ">Privacy Policy</a>
		<script type="text/javascript">(function (w, d) {
				var loader = function () {
					var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0];
					s.src = "https://cdn.iubenda.com/iubenda.js";
					tag.parentNode.insertBefore(s, tag);
				};
				if (w.addEventListener) {
					w.addEventListener("load", loader, false);
				} else if (w.attachEvent) {
					w.attachEvent("onload", loader);
				} else {
					w.onload = loader;
				}
			})(window, document);</script>
	</div>
@endsection