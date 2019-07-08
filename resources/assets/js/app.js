/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import "@babel/polyfill";

require('./bootstrap');

//window.Vue = require('vue');

window.Hammer = require('./hammer.min');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

	//new Vue({
//	el: '#app',
//	data: {
//		message: $("#name").val(),
//		price: $("#price").val(),
//	}
//});

var _token = $("meta[name='csrf-token']").attr("content"),
	registerlink = window.location.host + "/register",
	loginlink = window.location.host + "/login",
	$loader = "<div class=\"loading\"></div>",
	$usermenuBody = $(".cartmenu-to-show .usermenu-body"),
	$favoritemenuBody = $(".favoritemenu-to-show .usermenu-body"),
	$favorited = "<i class=\"fas fa-heart favorited\"></i>",
	$basic = "<i class=\"far fa-heart\"></i>",
	authorized = $("body").hasClass("auth"),
	$subnav = $(".subnav"),
	ids = {
		id: {}
	},
	array = [],
	$mightLike = $(".might-like"),
	$mightLikeBody = $(".might-like-body")


checkForFavorites();
drawFavoritesCount();

if (isLocalStorageEmpty("favIds")) {
	localStorage.setItem("favIds", JSON.stringify(ids));
}
if (isLocalStorageEmpty("lastVisited")) {
	localStorage.setItem("lastVisited", JSON.stringify(ids));
}
if (isLocalStorageEmpty("recommended")) {
	localStorage.setItem("recommended", JSON.stringify(array));
}

$.fn.readUrl = function readUrl(input, targetId) {
	if (input.files && input.files[0]) {
		var reader = new FileReader(),
			target = $("#" + targetId);

		reader.onload = function (e) {
			target.attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
};


$(".preview-edit").find(".binded").each(function () {
	var value = $(this).val(),
		target = $(this).data("target");

	$("#" + target).html(value);
});

$(".preview-edit .binded").on("keyup", function () {
	var value = $(this).val(),
		target = $(this).data("target");

	$("#" + target).html(value);
});

$("#cover_image.preview").change(function () {
	var targetId = $(this).data("targetId");
	$(this).readUrl(this, targetId);
});

$(".btn-wave, .btn-blank").googleclick();


//Admin tabbable
var hash = window.location.hash.substr(1);

if (hash && hash.indexOf("tab") === 0) {
	$(".to-tab").hide();
	$("." + hash).show();
	$(".tab a.active").removeClass("active");
	$(".tab a[href='#" + hash + "']").addClass("active");
	$("html,body").scrollTop(0);
}

$(".tabbable .tab a").click(function () {
	var toShow = $(this).attr("href").substr(1);
	$(".to-tab").hide();
	$(".tab a.active").removeClass("active");
	$(this).addClass("active");
	$("." + toShow).show();
	$("html,body").scrollTop(0);
});


//Oprava bootstrapu a jeho iputu, jelikož se nepřepíše na vybrání souboru

var $fileInput = $('input[type=file]');

$fileInput.each(function () {
	var $rawValue = $(this).val();

	if ($rawValue === '') {
		$(this).siblings('label').text('Choose file...');
	} else {
		var $fileName = $rawValue.replace('C:\\fakepath\\', ''),
			$shortenedFileName = $fileName.slice(0, 35);

		if ($fileName.length > 35) {
			$shortenedFileName = $shortenedFileName + '...';
		}

		$(this).siblings('label').text($shortenedFileName);
	}
});

$fileInput.on('change', function () {
	var $rawValue = $(this).val(),
		$fileName = $rawValue.replace('C:\\fakepath\\', ''),
		$shortenedFileName = $fileName.slice(0, 35);

	if ($fileName.length > 35) {
		$shortenedFileName = $shortenedFileName + '...';
	}

	if ($rawValue === "") {
		$shortenedFileName = "Choose file...";
	}

	$(this).siblings('label').text($shortenedFileName);
});

$(".preview").on("change", function () {
	var $rawValue = $(this).val(),
		$fileName = $rawValue.replace('C:\\fakepath\\', '');

	if ($fileName == "") {
		$("#img-prev").attr("src", "/images/placeholder.png");
	}
});

//Popup
$(".kc-popup").click(function () {
	var target = $(this).data("target");
	$("#" + target).fadeIn(200);
	$(".darken").fadeIn(200);
});

$(".darken, .kc.popup .kc-exit").click(function () {
	$(".kc.popup").fadeOut();
	$(".darken").fadeOut(150);
});

$(".darken").click(function () {
	closeUserMenu();
	closeDarken();
});


$(document).on("change", ".modal-sizes input", function () {
	$(".add-to-basket").removeClass("disabled").prop("disabled", false);
});

$(document).on("click", ".size-picker", function () {
	var $checkedInput = $("input[name=modal-choose-size]:checked");

	if ($checkedInput) {
		$(".size-label").find("input[value=" + $checkedInput.data("toggle") + "]").prop("checked", "checked");
		checkIfQtyHigher($checkedInput);
		$("#product-form").submit();
	}
});

$("#product-form").on("submit", function () {
	var $addButton = $("#add_to_basket");
	$addButton.addClass("disabled");
	$addButton.prop("disabled", "disabled");
});

$("#add_to_basket").click(function (e) {
	var availableSizes = $(".size-label").find("input:not(.disabled)");
	if (!$(".size-label").find("input").is(":checked")) {
		e.preventDefault();
		showDarker();
		$(".darker").addClass("modal");
		$("body").prepend(
			"<div class='kc-popup modal-toggle'>" +
			"<div class='close'><i class=\"fas fa-times\"></i></div>" +
			"<h3>Please choose a size</h3>" +
			"<div class='modal-sizes'>" +
			"</div>" +
			"<button disabled class='disabled d-block btn btn-primary mx-auto mb-4 add-to-basket size-picker'>Add to cart</button>" +
			"<p class='text-center'>You can change the size later in the cart. :)</p>" +
			"<div class='buttons'>" +
			"</div>" +
			"</div>"
		);
		for (var i = 0; i < availableSizes.length; i++) {
			$(".modal-sizes").append(
				"<input data-qty='" + $(availableSizes[i]).data("qty") + "' name='modal-choose-size' id='modal-" + $(availableSizes[i]).val() + "' type='radio'  data-toggle='" + $(availableSizes[i]).val() + "' value=''>" +
				"<label for='modal-" + $(availableSizes[i]).val() + "'>" + $(availableSizes[i]).attr("id") + "</label>"
			)
		}
	}
});


$(document).on("click", ".darken.modal, .darker.modal", function () {
	closeAndDestroyModals();
});

var categoriesTimeout;
var $activeSubNavLi = $(".subnav-nav > li.active");
var $subNavLi = $(".subnav-nav > li.menu-item");

//DESKTOP VERZE
function showSubCategories(element) {
	var $elementToShow = $("." + element.data("toggle"));

	if (!$elementToShow.length) {
		return false;
	}
	clearTimeout(categoriesTimeout);

	var left = element.offset().left;
	/* var calculatedLeftOffset = left - (($elementToShow.width() + ($elementToShow.css("padding-left").replace("px", "") * 2) - element.width()) / 2);

	if (calculatedLeftOffset < 0) {
		calculatedLeftOffset = left;
	}
	*/

	element.addClass("active");
	$elementToShow.addClass("active");
	$elementToShow.fadeIn(160);
	$elementToShow.css({
		"left": left
	});
}


function closeSubCategories() {
	$activeSubNavLi = $(".subnav-nav > li.active");
	var $elementToShow = $("." + $activeSubNavLi.data("toggle"));

	$elementToShow.fadeOut(160);
	$elementToShow.removeClass("active");
	$activeSubNavLi.removeClass("active");
}

function closeOtherSubCategories() {
	$activeSubNavLi = $(".subnav-nav > li.active");
	$("." + $activeSubNavLi.data("toggle")).hide();
	$activeSubNavLi.removeClass("active");
	$(".subcategories").removeClass("active");
}

$subNavLi.mouseenter(function () {
	if (!$(this).hasClass("active")) {
		closeOtherSubCategories();
	}
	showSubCategories($(this));
	clearTimeout(categoriesTimeout);
});

$subNavLi.mouseleave(function () {
	categoriesTimeout = setTimeout(closeSubCategories, 500);
});

$(".subcategories:not(.mobile)").hover(
	function () {
		if ($(this).hasClass("active")) {
			clearTimeout(categoriesTimeout);
		} else {
			$activeSubNavLi.addClass("active");
			$(this).addClass("active");
			$(this).fadeIn(160);
		}
	},
	function () {
		categoriesTimeout = setTimeout(closeSubCategories, 500);
	}
);

$(".mobile-subnav-nav > li").click(function () {
	if ($(this).hasClass("active")) {
		closeMobileSubCategories($(this));
	} else {
		openMobileSubCategories($(this));
	}
});

function openMobileSubCategories(element) {
	element.addClass("active");
	$activeSubNavLi = $(".mobile-subnav-nav > li.active");
	var $elementToShow = $(".mobile-subnav-nav").find("." + element.data("toggle"));

	$elementToShow.slideDown(150);
}

function closeMobileSubCategories(element) {
	element.removeClass("active");

	$activeSubNavLi = $(".mobile-subnav-nav > li.active");
	var $elementToShow = $(".mobile-subnav-nav").find("." + element.data("toggle"));

	$elementToShow.slideUp(150);
}


//Toggle usermenu
$(".user-show").click(function () {
	if ($(this).hasClass("active")) {
		closeUserMenu();
		closeDarken();
	} else {
		openUserMenu();
		showDarken();
	}
});

$(".col-form-label").each(function () {
	var $this = $(this);
	if ($this.hasClass("required")) {
		$this.append(
			"<span class='text-danger'> *</span>"
		)
	}
});

$(".avatar.active").click(function () {
	closeUserMenu();
	closeDarken();
});

$(".darker").click(function () {
	closeHamburgerMenu();
	closeDarker();
});

$(".ham-close").click(function () {
	closeHamburgerMenu();
});

$(".results-head .close").click(function () {
	closeSearch();
});

//Nastaveni avatar na bg
$(".avatar, .collection-box").not(".avatar-reg").each(function () {
	var $src = $(this).find("img").attr("src");
	$(this).css({
		"background-image": "url('" + $src + "')"
	});
});

function openUserMenu() {
	$(".user-show .avatar").addClass("active");
	$(".user-show").addClass("active");
	$(".usermenu-to-show").fadeIn(150);
	closeCartMenu();
	closeFavoritesMenu();
}

function closeUserMenu() {
	$(".user-show").removeClass("active");
	$(".user-show .avatar").removeClass("active");
	closeAndDestroyModals();
	$(".usermenu-to-show").fadeOut(150);
}

function closeDarken() {
	$(".darken").fadeOut(150);
	closeAllUserMenus();
	closeSearch();
}

function showDarken() {
	$(".darken").fadeIn(150);
}

function closeDarker() {
	$(".darker").fadeOut(150);
}

function showDarker() {
	$(".darker").fadeIn(150);
}

function closeAllModals() {
	$(".modal-toggle").fadeOut(150);
}

function closeSearch() {
	$(".results").fadeOut(160);
}

function clearSearch() {
	$(".search-bar").find("input").val("");
}

function closeAllUserMenus() {
	$(".user-show, .user-show .avatar, .cart-show, .favorite-show").removeClass("active");
	$(".cartmenu-to-show, .usermenu-to-show, .favoritemenu-to-show").fadeOut(150);
}

function closeAndDestroyModals() {
	$.when($(".modal-toggle").fadeOut(150)).done(function () {
		$(this).remove();
		$(".darker").removeClass("modal").fadeOut(150);
	});
}

$(".search-bar .fa-times-circle").click(function () {
	$(this).fadeOut();
	closeSearch();
	clearSearch();
	axios.get("/clearsearch")
		.then(function () {

		});
});

//INIT SLIDERS
var $slideCount = $(".slide").length,
	hammering = false;

function initSlider() {

	var hp_slider = document.getElementById('hp-slider');
	$(".slide:first-child").addClass("active").fadeIn(1400);

	Hammer(hp_slider).on("swipeleft", function (e) {
		hammering = true;
		var $active = $(".slide.active");

		swipeLeft($active);
	});

	Hammer(hp_slider).on("swiperight", function (e) {
		hammering = true;
		var $active = $(".slide.active");

		swipeRight($active);
	});

	$(".slide").click(function () {
		var slideId = $(this).data("id"),
			redirect = $(this).data("redirect");
		if (!hammering) {
			$.ajax({
				url: "/click",
				method: "post",
				data: {_token: _token, id: slideId},
				complete: function (response) {
					window.location.href = redirect;
				}
			});
		}
	});

	$(".click-left").click(function () {
		var $active = $(".slide.active");
		swipeRight($active);
	});

	$(".click-right").click(function () {
		var $active = $(".slide.active");
		swipeLeft($active);
	});


	$(document).on("click", ".slider_changer li", function () {
		var id = $(this).data("toggle"),
			$active = $(".slide.active");
		swipeToSlide($active, id);
	});

	$(".hp-slider").after(
		"<ul class='slider_changer'></ul>"
	);

	for (var i = 0; i < $slideCount; i++) {
		$(".slider_changer").append(
			"<li data-toggle='" + i + "'>" +
			"<div></div>" +
			"</li>"
		)
	}

	$(document).keydown(function (e) {
		var $active = $(".slide.active");

		switch (e.which) {
			case 37: // left

				swipeLeft($active);
				break;

			case 39: // right
				swipeRight($active);
				break;

			default:
				return; // exit this handler for other keys
		}
		e.preventDefault(); // prevent the default action (scroll / move caret)
	});
}

function swipeLeft(element) {
	$.when(element.fadeOut(200).removeClass("active")).done(function () {
		element.removeClass("anim-right anim-left");
		hammering = false;
	});

	if (element.index() === $slideCount - 1) {
		$(".slide:first-child").fadeIn(150).addClass("active anim-left");

		return true;
	}

	element.next().fadeIn(150).addClass("active anim-left");
}


function swipeRight(element) {
	$.when(element.fadeOut(200).removeClass("active")).done(function () {
		element.removeClass("anim-right anim-left");
		hammering = false;
	});

	if (element.index() === 0) {
		$(".slide:last-child").fadeIn(150).addClass("active anim-right");

		return true;
	}

	element.prev().fadeIn(150).addClass("active anim-right");
}

function swipeToSlide(element, id) {
	var $slideToGo = $(".slide:eq(" + id + ")");
	if ($slideToGo.hasClass("active")) {
		return false;
	}
	var activeSlideIndex = element.index();
	$.when(element.fadeOut(200).removeClass("active")).done(function () {
		element.removeClass("anim-right anim-left");
	});

	if ($slideToGo.index() > activeSlideIndex) {
		return $slideToGo.fadeIn(150).addClass("active anim-left");
	}

	return $slideToGo.fadeIn(150).addClass("active anim-right");
}

if ($("#hp-slider").length) {
	initSlider();
}

$(".load-more-button").click(function (e) {
	var $that = $(this),
		products = $(".products-row .product-box").length;
	e.preventDefault();

	$that.find(".plus").addClass("loading");
	startAjaxLoader();
	axios.get("/loadmoreproducts/" + products)
		.then(function (response) {
			finishAjaxLoader();
			renderLoadMore(response.data, $that);
		})
		.catch(function (error) {
			terminateAjaxLoader();
		});
});


function renderLoadMore(data, element) {
	for (var i = 0; i < data.products.length; i++) {
		var $products = data.products[i],
			children = $products.children.length,
			display = false;

		if (children !== 0) {
			display = true;
		}
		$(".products-row").append(
			"<div class='col-6 col-sm-4 col-md-3'>" +
			"<div class='product-box'>" +
			"<div class='product-head'>" +
			"<a href='/product/" + $products.id + "/" + $products.slug + "'>" +
			"<img src='storage/product_images/" + $products.nahled_photo_min + "' alt='Product box'>" +
			(display ?
				"<div class='variations'>" + (children + 1) + ' variations' + "</div>"
				: '') +
			"</a>" +
			"</div>" +
			"<div class='product-body'>" +
			"<a href='/product/" + $products.id + "/" + $products.slug + "'><p>" + $products.name + "</p></a>" +
			"<span>$" + $products.price + "</span>" +
			"</div>" +
			"</div>" +
			"</div>"
		);
	}

	element.find(".plus").removeClass("loading");
	if (data.more === false) {
		element.remove();
	}
}

$(document).ready(function () {
	var $imagesBox = $(".image-slider"),
		$groupSlider = $(".grouped-products-slider"),
		width = 0;

	if ($imagesBox.length) {
		$imagesBox.find("a").each(function () {
			width = width + $(this).width() + 10;
		});


		if (width > $imagesBox.width()) {
			$imagesBox.lightSlider({
				item: 3,
				slideMargin: 10,
				autoWidth: true,
				speed: 200,
				useCSS: true,
				auto: false,
				pager: false,
				enableDrag: true,
			});
		}
	}

	width = 0;

	if ($groupSlider.length) {
		$groupSlider.find("a").each(function () {
			if ($(this).is(":visible")) {
				width = width + $(this).width() + 10;
			}
		});

		if (width > $(".grouped-products-slider:visible").width()) {
			$groupSlider.lightSlider({
				item: 3,
				slideMargin: 10,
				autoWidth: true,
				speed: 200,
				useCSS: true,
				auto: false,
				pager: true,
				enableDrag: true,
			});
		}
	}

	//fancybox

	$('a[data-fancybox="images"]').fancybox({
		protect: true,
		padding: 0,
	});
});

//AJAX CALLY NA POCITANI

$(".click-count").click(function (e) {
	e.preventDefault();
	var urlToCall = $(this).data("call"),
		redirect = $(this).attr("href"),
		id = $(this).data("id");
	var ajax = $.ajax({
		url: urlToCall,
		method: "POST",
		data: {_token: _token, id: id},
		complete: function () {
			window.location = redirect;
		}
	});

	setTimeout(function () {
		ajax.abort();
		window.location = redirect;
	}, 4000);
});

//HAMBURGER SHOW

$(".hamburger:not(.ham-close)").click(function () {
	var $this = $(this);
	if ($this.hasClass("triggered")) {
		closeHamburgerMenu();
	} else {
		closeAllUserMenus();
		openHamburgerMenu();
		showDarker();
	}
});

function openHamburgerMenu() {
	$subnav.css({
		"left": "0%",
		"opacity": 1
	});
}

function closeHamburgerMenu() {
	if ($(window).width() > 576) {
		return false;
	}
	$subnav.css({
		"left": "-90%",
		"opacity": 0.7
	});
	closeDarker();
	closeDarken();
}


function filterProducts() {
	var $form = $(".min-filter form");
	var value = $form.val();
	console.log(value);
}


$(document).on("click", ".kc-popup .close", function () {
	closeAndDestroyModals();
});

//Cart show

$(".cart-show").click(function () {
	if ($(this).hasClass("active")) {
		closeCartMenu();
		closeDarken();
	} else {
		openCartMenu();
		showDarken();
	}
});

$(".favorite-show").click(function () {
	if ($(this).hasClass("active")) {
		closeFavoritesMenu();
		closeDarken();
	} else {
		openFavoritesMenu();
		showDarken();
	}
});

function openCartMenu() {
	closeFavoritesMenu();
	closeUserMenu();
	getCartContent();
	$(".cart-show").addClass("active");
	$(".cartmenu-to-show").fadeIn(150);
}

function closeCartMenu() {
	$(".cart-show").removeClass("active");
	$(".cartmenu-to-show").fadeOut(150);
}


function openFavoritesMenu() {
	getFavoritesContent($favoritemenuBody);
	closeUserMenu();
	closeCartMenu();
	$(".favoritemenu-to-show").fadeIn(150);
	$(".favorite-show").addClass("active");
}


function closeFavoritesMenu() {
	$(".favorite-show").removeClass("active");
	$(".favoritemenu-to-show").fadeOut(150);
}


//LIGHT SLIDERS
$(".hottest-products").lightSlider({
	item: 3,
	autoWidth: true,
	slideMargin: 10,
	speed: 200,
	useCSS: true,
	auto: false,
	enableDrag: true,
});


$(".size-label input").click(function () {
	checkIfQtyHigher($(this));
});

//Spočítat cenu na init
renderPriceWithTax($(".total-price"));


//Odčítání a přičítání
$(".product-minus").click(function () {
	var $input = $(".qty-box input[type='number']");
	$input.val(checkMinQty($input));
	renderPriceWithTax($(".total-price"));
});

$(".product-plus").click(function () {
	var $input = $(".qty-box input[type='number']");
	$input.val(checkMaxQty($input));
	renderPriceWithTax($(".total-price"));
});

function renderPriceWithTax(element) {
	element.html("$" + (getPriceWithTax(calculatePrice())));
}

function getPriceWithTax(price) {
	return (price * 1.21).toFixed(2);
}

function getPriceWithoutTax(price) {
	return price.toFixed(2);
}

function checkIfQtyHigher(element) {
	var $input = $(".qty-box input[type='number']"),
		maxQty = element.data("qty");
	if ($input.val() > maxQty) {
		$input.val(maxQty);
		toastr["warning"]("Maximum quantity is " + maxQty + "", "Warning");
	}
	renderPriceWithTax($(".total-price"));
}


function addToRecommended(color) {
	if (authorized) {
		axios.post("/addtorecommended", {
			color: color
		})

	} else {
		var recommended = JSON.parse(localStorage.getItem("recommended"));
		if (_.indexOf(recommended, color) !== -1) {
			return false
		}
		if (recommended.length > 2) {
			recommended = _.drop(recommended);
		}
		recommended.push(color);
		localStorage.setItem("recommended", JSON.stringify(recommended));
	}
}

function hexColorDelta(hex1, hex2) {
	hex1 = hex1.replace("#", "");
	hex2 = hex2.replace("#", "");
	// get red/green/blue int values of hex1
	var r1 = parseInt(hex1.substring(0, 2), 16);
	var g1 = parseInt(hex1.substring(2, 4), 16);
	var b1 = parseInt(hex1.substring(4, 6), 16);
	// get red/green/blue int values of hex2
	var r2 = parseInt(hex2.substring(0, 2), 16);
	var g2 = parseInt(hex2.substring(2, 4), 16);
	var b2 = parseInt(hex2.substring(4, 6), 16);
	// calculate differences between reds, greens and blues
	var r = 255 - Math.abs(r1 - r2);
	var g = 255 - Math.abs(g1 - g2);
	var b = 255 - Math.abs(b1 - b2);
	// limit differences between 0 and 1
	r /= 255;
	g /= 255;
	b /= 255;
	// 0 means opposit colors, 1 means same colors
	return (r + g + b) / 3;
}

function renderMightLike(colors, products) {
	var $recommendedSlider = $(".recommended-slider"),
		width = 0,
		maxProductsCounter = 0,
		maxProducts = 10;

	$recommendedSlider.html("");
	if (!colors.length) {
		$(".recommend-container").remove();
		return false;
	}

	products:
		for (var i = 0; i < products.length; i++) {
			var $product = products[i],
				threshold = 0.8,
				productColor = $product.color[0].value;

			for (var m = 0; m < colors.length; m++) {
				var color = colors[m];
				if (hexColorDelta(productColor, color) > threshold) {

					$recommendedSlider.append(
						"<div class='product-box'>" +
						"<a class='d-block' href='/product/" + $product.id + "/" + $product.slug + "'>" +
						"<div class='product-head'>" +
						"<img src='/storage/product_images/" + $product.nahled_photo_min + "' alt='Product box'>" +
						"</div>" +
						"</a>" +
						"<div class='product-body'>" +
						"<a href='/product/" + $product.id + "/" + $product.slug + "'><p>" + $product.name + "</p></a>" +
						"<span>$" + $product.price + "</span>" +
						"</div>" +
						"</div>"
					);

					maxProductsCounter++;
					if (maxProductsCounter >= maxProducts) {
						break products;
					}

					break;
				}
			}
		}


	$recommendedSlider.find(".product-head").each(function () {
		width = width + $(this).width();
	});

	if (width > $recommendedSlider.parents(".recommend-container").width()) {
		$recommendedSlider.lightSlider({
			item: 3,
			slideMargin: 10,
			autoWidth: true,
			speed: 200,
			useCSS: true,
			auto: false,
			pager: true,
			enableDrag: true,
		})
	}
}


if ($(".recommended-slider").length) {
	if (authorized) {
		axios.get("/getrecommendedproducts")
			.then(function (response) {
				var favoriteColors = response.data.colors;
				var allProducts = response.data.products;
				renderMightLike(favoriteColors, allProducts);
			})
			.catch(function (error) {

			})
	} else {
		axios.get("/getrecommendedproducts")
			.then(function (response) {
				var favoriteColors = JSON.parse(localStorage.getItem("recommended"));
				var allProducts = response.data.products;
				renderMightLike(favoriteColors, allProducts);
			})
	}
}


function renderFavorites(products, element) {
	finishAjaxLoader();
	element.find(".loading").remove();
	if (products.success) {
		for (var i = 0; i < products.products.length; i++) {
			var $product = products.products[i],
				$sectionName = $product.sectionName;

			element.prepend(
				"<div class='cartmenu-product'>" +
				"<div class='row'>" +
				"<div class='col-3'>" +
				"<a href='/product/" + $product.id + "/" + $product.slug + "'>" +
				"<img src='/storage/product_images/" + $product.nahled_photo_ultra_min + "' alt='favorite product'>" +
				"</a>" +
				"</div>" +
				"<div class='col-6'>" +
				"<p class='name'><a href='/product/" + $product.id + "/" + $product.slug + "'>" + $product.name + "</a><span>" + $sectionName + "</span></p>" +
				"</div>" +
				"<div class='col-3 text-right'>$" + getPriceWithTax($product.price) + "</div>" +
				"</div>" +
				"</div>"
			);
		}
	} else {
		element.append("<p class='text-center mt-3'>" + products.message + "</p>")
	}

}


function renderCart(products) {
	finishAjaxLoader();
	var $products = products,
		totalPrice = 0,
		price = 0;

	$usermenuBody.find(".loading").remove();
	if ($products.success) {

		for (var i = 0; i < $products.products.length; i++) {
			var $product = $products.products[i],
				$sectionName = $product.sectionName;
			price = getPriceWithTax($product.price * $product.qty);
			totalPrice = totalPrice + parseFloat(price);

			$(".cartmenu-to-show .usermenu-body").prepend(
				"<div class='cartmenu-product'>" +
				"<div class='row'>" +
				"<div class='col-3'>" +
				"<a href='/product/" + $product.id + "/" + $product.slug + "'>" +
				"<img src='/storage/product_images/" + $product.nahled_photo_ultra_min + "' alt='favorite product image'>" +
				"</a>" +
				"</div>" +
				"<div class='col-4'>" +
				"<p class='name'><a href='/product/" + $product.id + "/" + $product.slug + "'>" + $product.name + "</a><span>" + $sectionName + "</span>" +
				"<small>" + $product.chosenSize + "</small>" +
				"</p>" +
				"</div>" +
				"<div class='col-5'><span class='item-qty float-left item-qty'>" + $product.qty + "</span>" +
				"<div data-rowid='" + $product.rowId + "' class='modal-quantity-changers float-left ml-2'>" +
				"<button data-qty='up' class='d-block nobutton'><i	class='fas fa-plus'></i></button>" +
				"<button data-qty='down' class='d-block nobutton'><i class='fas fa-minus'></i></button>" +
				"</div>" +
				"<span class='float-right item-price'>$" + price + "</span>" +
				"</div>" +
				"</div>" +
				"</div>"
			)
		}

		$(".cartmenu-to-show .usermenu").after(
			"<div class='row row-aftermenu'>" +
			"<div class='col-12'>" +
			"<div class='after-usermenu'>" +
			"<div class='row'>" +
			"<div class='col-6'><a href='/cart'>Cart</a></div>" +
			"<div class='col-6 text-right'><a class='mr-2' href='/checkout'>Checkout</a><span class='cart-total'>$" + totalPrice.toFixed(2) + "</span></div>" +
			"</div>" +
			"</div>" +
			"</div>" +
			"</div>"
		)
	} else {
		$(".cartmenu-to-show .usermenu-body").append("<p class='text-center mt-3'>" + $products.message + "</p>");
	}
}


function renderLastVisited(data) {
	var $slider = $(".last-visit-slider"),
		productId = $(".left-product-box").data("id"),
		lastVisited = JSON.parse(localStorage.getItem("lastVisited")),
		length = Object.keys(lastVisited.id).length;

	if (!hasLastVisited() || (valueExists(lastVisited.id, productId) && length === 1)) {
		return $(".last-visited").remove();
	}
	$slider.html("");
	for (var i = data.products.length - 1; i > -1; i--) {
		var $product = data.products[i];
		if ($product.id === productId) {
			continue;
		}

		$slider.append(
			"<div class='product-box'>" +
			"<a href='/product/" + $product.id + "/" + $product.slug + "'>" +
			"<div class='product-head'>" +
			"<img src='/storage/product_images/" + $product.nahled_photo_min + "' alt='product img'>" +
			"</div>" +
			"</a>" +
			"<div class='product-body'>" +
			"<a href='/product/" + $product.id + "/" + $product.slug + "'>" +
			"<p>" + $product.name + "</p>" +
			"</a>" +
			"<span>$" + getPriceWithTax($product.price) + "</span>" +
			"</div>" +
			"</div>"
		);
	}

	var width = 0;

	if ($slider.length) {
		$slider.find(".product-body a").each(function () {
			if ($(this).is(":visible")) {
				width = width + $(this).width() + 10;
			}
		});

		if (width > $(".last-visit-slider:visible").width()) {
			$slider.lightSlider({
				item: 3,
				slideMargin: 10,
				autoWidth: true,
				speed: 200,
				useCSS: true,
				auto: false,
				pager: true,
				enableDrag: true,
			});
		}
	}
}

function getCartContent() {
	startAjaxLoader();
	$usermenuBody.html("");
	$usermenuBody.append("<div class='loading absolute'></div>");
	$(".row-aftermenu").html("");
	axios.get("/getcart")
		.then(function (response) {
			renderCart(response.data);
		})
		.catch(function (error) {
			terminateAjaxLoader();
		})
}

function getFavoritesContent(element) {
	var ids = {};
	startAjaxLoader();
	element.html("");
	element.append("<div class='loading absolute'></div>");
	$(".row-aftermenu").remove();
	if (!isLocalStorageEmpty("favIds")) {
		ids = JSON.parse(localStorage.getItem("favIds"));
	}

	axios.get("/getfavorites", {
		params: {
			ids: ids
		}
	})
		.then(function (response) {
			renderFavorites(response.data, element);
		})
		.catch(function (error) {
			console.log(error);
			restartLocalStorageJson("favIds");
			terminateAjaxLoader();
		})
}

function checkMaxQty(element) {
	var $selectedSize = $(".size-label input:checked"),
		value = parseInt(element.val());
	if (value + 1 > $selectedSize.data("qty")) {
		toastr["info"]("Maximum quantity reached", "Info");
		return $selectedSize.data("qty");
	}
	return value + 1;
}

function checkMinQty(element) {
	var value = parseInt(element.val());
	if (value - 1 < 1) {
		toastr["info"]("Minimum quantity reached", "Info");
		return 1;
	}
	return value - 1;
}

function calculatePrice() {
	var price = $(".total-price").data("price"),
		qty = $(".qty-box input").val();
	return (price * qty).toFixed(2);
}


$(document).on("click", ".modal-ok", function () {
	closeAndDestroyModals();
});

$(document).on("click", ".add-to-basket", function () {
	closeAndDestroyModals();
});

function startAjaxLoader() {
	$(".ajax-loader").append(
		"<div class='loader'></div>"
	);
}

function finishAjaxLoader() {
	var delay = 310;
	setTimeout(function () {
		$(".ajax-loader .loader").addClass("finished");
	}, delay);
	setTimeout(function () {
		$(".ajax-loader .loader").remove();
	}, delay * 2.1);
}

function terminateAjaxLoader() {
	var delay = 310;
	setTimeout(function () {
		$(".ajax-loader .loader").css("background", "red");
	}, delay);
	setTimeout(function () {
		$(".ajax-loader .loader").remove();
	}, delay * 10);
	toastr["error"]("Server error, try again later.", "Error");
}

//Helper functions
function valueExists(jsObj, value) {
	for (var key in jsObj) {
		if (jsObj[key] === value) return true;
	}

	return false;
}

function deleteByValue(jsObj, value) {
	for (var key in jsObj) {
		if (jsObj[key] === value) {
			delete jsObj[key];
			return true;
		}
	}

	return false;
}

function addToFavorites(element, data) {
	if (data.success) {
		if (data.added) {
			heartPopup(element);
		} else {
			heartPopdown(element);
		}
		redrawFavoritesCount(data.count);
	} else {
		var ids = JSON.parse(localStorage.getItem("favIds"));
		//ADD IF DOESNT EXIST
		if (ids === null) {
			ids = {
				id: {
					0: data.productId
				}
			};
			var length = 1;
			heartPopup(element);
			localStorage.setItem("favIds", JSON.stringify(ids));
			redrawFavoritesCount(length);
			return true;
		}

		//CHECK IF EXISTS AND ADD
		if (valueExists(ids.id, data.productId)) {
			deleteByValue(ids.id, data.productId);
			heartPopdown(element);
			ids.id = remapIndexes(ids.id);
		} else {
			length = Object.keys(ids.id).length;
			ids.id[length] = data.productId;
			heartPopup(element);
		}
		length = Object.keys(ids.id).length;
		redrawFavoritesCount(length);
		localStorage.setItem("favIds", JSON.stringify(ids));
	}
}

function redrawFavoritesCount(count) {
	var $element = $(".cart-bubble-count.favorite");

	$element.addClass("notempty");
	$element.html(count);
}

function drawFavoritesCount() {
	if (!authorized && !isLocalStorageEmpty("favIds")) {
		var favIds = JSON.parse(localStorage.getItem("favIds")),
			favCount = Object.keys(favIds.id).length;

		if (favCount > 0) {
			$(".cart-bubble-count.favorite").addClass("notempty").html(favCount);
		}
	}
}


function isLocalStorageEmpty(key) {
	if (localStorage[key]) {
		return false;
	}
	return true;
}

function heartPopup(element) {
	element.append($favorited).find(".far");
	setTimeout(function () {
		element.find(".far").remove();
	}, 200);
}

function heartPopdown(element) {
	element.append($basic).find(".fas").addClass("unfavorited");
	setTimeout(function () {
		element.find(".unfavorited").remove();
	}, 200);
}

function heartPopupHard() {
	$(".add-to-favorites").append("<i class='fas fa-heart'></i>");
}

function checkForFavorites() {
	var ids = JSON.parse(localStorage.getItem("favIds"));
	if (ids === null || authorized) {
		return false;
	}
	var productId = $(".left-product-box").data("id");
	if (valueExists(ids.id, productId)) {
		heartPopupHard();
		return true;
	}
}


$(".add-to-favorites").click(function (e) {
	startAjaxLoader();
	e.preventDefault();
	var $that = $(this),
		call = $(this).attr("href"),
		id = $(this).data("productid");

	axios.post(call, {
		id: id
	})
		.then(function (response) {
			finishAjaxLoader();
			addToFavorites($that, response.data);
		})
		.catch(function (error) {
			console.log(error);
			terminateAjaxLoader();
		});
});


function isNumber(n) {
	return !isNaN(parseFloat(n)) && isFinite(n)
}

//CART COUNTER

$(".quantity-changers button").click(function () {
	startAjaxLoader();
	var data = $(this).data("qty"),
		qty = $(this).parent().parent().find(".item-qty"),
		rowId = $(this).parents(".product-cart").attr("data-rowid"),
		$productItem = $(this).parents(".product-cart");

	if (!isNumber(qty.html())) {
		qty.html(1);

		finishAjaxLoader();
		return alert("Wrong value");
	}

	var wantedQty = parseInt(qty.html());

	switch (data) {
		case "up": {
			axios.post("/cart/update/chngqty", {
				qty: wantedQty + 1,
				rowId: rowId
			})
				.then(function (response) {
					finishAjaxLoader();
					redrawCartItem($productItem, response.data);
				})
				.catch(function (error) {
					terminateAjaxLoader();
				});
		}
			break;
		case "down": {
			axios.post("/cart/update/chngqty", {
				qty: wantedQty - 1,
				rowId: rowId
			})
				.then(function (response) {
					finishAjaxLoader();
					redrawCartItem($productItem, response.data);
				})
				.catch(function (error) {
					terminateAjaxLoader();
				})
		}
			break;
		default: {
			terminateAjaxLoader();
		}
	}
});


function redrawCartItem(element, data) {
	$(".cart-bubble-count:not('.favorite')").html(data.cart_count);
	if (data.delete === true) {
		if (!data.remaining) {
			return document.location.reload();
		}
		redrawCart(data.subtotal, data.tax, data.total, data.cart_count);
		element.remove();
		return toastr["info"](data.message, "Status");
	}

	if (data.success === false) {
		element.find(".item-qty").html(data.maxQty);
		if (data.maxQty < 1) {
			element.remove();
		}
		redrawCart(data.subtotal, data.tax, data.total, data.cart_count);
		toastr["warning"](data.message, "Warning");
		return element.find(".item-price").html(data.productPrice);
	} else {
		element.find(".item-qty").html(data.qty);
		redrawCart(data.subtotal, data.tax, data.total, data.cart_count);
		return element.find(".item-price").html(data.productPrice);
	}
}


function redrawSummary() {

}


function redrawModalCartItem(element, data) {
	if (data.delete === true) {
		if (!data.remaining) {
			closeCartMenu();
		}
		redrawCart(data.subtotal, data.tax, data.total, data.cart_count);
		element.remove();
		return toastr["info"](data.message, "Product removed");
	}

	if (data.success === false) {
		element.find(".item-qty").html(data.maxQty);
		if (data.maxQty < 1) {
			element.remove();
		}
		return toastr["warning"](data.message, "Warning");
	} else {
		element.find(".item-qty").html(data.qty);
		redrawCart(data.subtotal, data.tax, data.total, data.cart_count);
		return element.find(".item-price").html(data.productPrice);
	}
}


function redrawCart(subtotal, tax, total, cart_count) {
	$(".cart-subtotal").html("$" + subtotal);
	$(".cart-tax").html("$" + tax);
	$(".cart-total").html("$" + total);
	$(".cart-count").html(cart_count);
}


$(".ratings .rating").click(function () {
	startAjaxLoader();
	let value = $(this).data("value"),
		id = $(this).parent().data("id"),
		rating_box = $(".rating-box");

	$(this).parent().remove();
	rating_box.find("h6").remove();

	axios.post("/rate", {
		value: value,
		id: id
	})
		.then(function (response) {
			finishAjaxLoader();
			$("h6.to-rate").html(response.data.rating + " / 5");
			rating_box.append("<h6>Thank you for your rating!</h6>");
		})
		.catch(function () {
			terminateAjaxLoader();
		})
});

$(document).on("click", ".modal-quantity-changers button", function () {
	startAjaxLoader();
	var data = $(this).data("qty"),
		qty = $(this).parent().parent().find(".item-qty"),
		rowId = $(this).parent().data("rowid"),
		$cartItem = $(".product-cart[data-rowid='" + rowId + "']"),
		$productItem = $(this).parents(".cartmenu-product");

	if (!isNumber(qty.html())) {
		qty.html(1);

		finishAjaxLoader();
		return alert("Wrong value");
	}

	var wantedQty = parseInt(qty.html());

	switch (data) {
		case "up": {
			axios.post("/cart/update/chngqty", {
				qty: wantedQty + 1,
				rowId: rowId
			})
				.then(function (response) {
					finishAjaxLoader();
					redrawModalCartItem($productItem, response.data);
					redrawCartItem($cartItem, response.data);
				})
				.catch(function (error) {
					terminateAjaxLoader();
				});
		}
			break;
		case "down": {
			axios.post("/cart/update/chngqty", {
				qty: wantedQty - 1,
				rowId: rowId
			})
				.then(function (response) {
					finishAjaxLoader();
					redrawModalCartItem($productItem, response.data);
					redrawCartItem($cartItem, response.data);
				})
				.catch(function (error) {
					terminateAjaxLoader();
				})
		}
			break;
		default: {
			terminateAjaxLoader();
		}
	}
});

function changeSize(element, data) {
	if (data.success) {
		element.find("button.dropdown-toggle").html(data.name);
		element.find(".item-price").html(data.productPrice);
		element.find(".item-qty").html(data.cartItem.qty);
		redrawCart(data.subtotal, data.tax, data.total, data.cart_count);
		redrawRowId(data, element);
		redrawDeleteForm(data);
	} else {
		return toastr["warning"](data.message, "Warning");
	}
}

$(".size-changer a.dropdown-item").click(function (e) {
	startAjaxLoader();
	e.preventDefault();
	if ($(this).hasClass("disabled")) {
		return toastr["warning"]("Not available right now", "Warning");
	}
	var rowId = $(this).parents(".product-cart").attr("data-rowid"),
		sizeId = $(this).data("sizeid"),
		$that = $(this).parents(".product-cart");

	if (!isNumber($that.find(".item-qty").html())) {
		return toastr["warning"]["Unsupported value"];
	}

	axios.post("/cart/update/chngsize", {
		rowId: rowId,
		sizeId: sizeId,
		qty: $that.find(".item-qty").html()
	})
		.then(function (response) {
			changeSize($that, response.data);
			finishAjaxLoader();
		})
		.catch(function (error) {
			console.log(error);
			terminateAjaxLoader();
		})
});

function redrawRowId(data, element) {
	var rowId = data.cartItem.rowId;
	element.attr("data-rowid", rowId);
}

function redrawDeleteForm(data) {
	var action = $(".delete-form").attr("action"),
		newLink = action.replace(_.last(action.split("/")), data.cartItem.rowId);
	$(".delete-form").attr("action", newLink);
}


//Search
$(".action-search:not(.mobile)").on("keyup keypress", _.debounce(searchProducts, 500));
$(".action-search.mobile").on("keyup keypress", _.debounce(searchProductsMobile, 500));

async function searchProducts() {
	console.log("desktop search...");
	startAjaxLoader();
	$(".search-bar .fa-times-circle").fadeIn();
	var q = $(".action-search").val();
	$(".product-results").html("");
	axios.get("/ajax-search", {
		params: {
			q: q
		}
	})
		.then(function (response) {
			renderSearch(response.data, q);
			finishAjaxLoader();
		})
		.catch(function (error) {
			terminateAjaxLoader();
			console.log(error);
		});
}

async function searchProductsMobile() {
	startAjaxLoader();
	var q = $(".action-search.mobile").val();
	$(".search-bar .fa-times-circle").fadeIn();
	$(".product-results").html("");
	axios.get("/ajax-search", {
		params: {
			q: q
		}
	})
		.then(function (response) {
			renderSearch(response.data, q, ".mobile");
			finishAjaxLoader();
		})
		.catch(function (error) {
			terminateAjaxLoader();
		});
}


function renderSearch(data, q, option = ":not(.mobile)") {
	showDarken();
	$(".search-bar .results").fadeIn(160);
	$(".item-results").html("");
	$mightLikeBody.show();
	$mightLike.show();

	if (data.products.length === 0) {
		$(".product-results").append(
			"<div class='col-12 text-center'>No products</div>"
		)
	}

	if (data.categories.length === 0) {
		$(".categories-results").append(
			"<div class='col-12 text-center'>No categories</div>"
		)
	}

	if (data.collections.length === 0) {
		$(".collection-results").append(
			"<div class='col-12 text-center'>No collections</div>"
		)
	}

	for (var i = 0; i < data.products.length; i++) {
		var product = data.products[i],
			src_str = product.name,
			term = q;

		term = term.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");
		var pattern = new RegExp("(" + term + ")", "gi");

		src_str = src_str.replace(pattern, "<em class='highlight'>$1</em>");
		src_str = src_str.replace(/(<em class='highlight'[^<>]*)((<[^>]+>)+)([^<>]*<\/em>)/, "$1</em>$2<em class='highlight'>$4");

		$(".product-results" + option + "").append(
			"<div class='col-12 product-result item-result'>" +
			"<div class='row'>" +
			"<div class='col-3 col-lg-2'><a href='/product/" + product.id + "/" + product.slug + "'>" +
			"<img src='/storage/product_images/" + product.nahled_photo_ultra_min + "' alt='product image'></a></div>" +
			"<div class='col-5'>" +
			"<a href='/product/" + product.id + "/" + product.slug + "'>" + src_str + "</a>" +
			"<small class='d-block'>" + product.section.name + "</small>" +
			"</div>" +
			"<div class='col-4 col-lg-5 text-right'>$" + getPriceWithTax(product.price) + "</div>" +
			"</div>" +
			"</div>"
		);
	}

	for (var u = 0; u < data.tagproducts.length; u++) {
		var tagProd = data.tagproducts[u],
			willRender = true;

		for (var j = 0; j < data.products.length; j++) {
			if (tagProd.id === data.products[j].id) {
				willRender = false;
				break;
			}
		}

		if (willRender) {
			$(".tag-results" + option + "").append(
				"<div class='col-12 product-result item-result'>" +
				"<div class='row'>" +
				"<div class='col-3 col-lg-2'><a href='/product/" + tagProd.id + "/" + tagProd.slug + "'>" +
				"<img src='/storage/product_images/" + tagProd.nahled_photo_ultra_min + "' alt='product image'></a></div>" +
				"<div class='col-5'>" +
				"<a href='/product/" + tagProd.id + "/" + tagProd.slug + "'>" + tagProd.name + "</a>" +
				"<small class='d-block'>" + tagProd.sectionName + "</small>" +
				"</div>" +
				"<div class='col-4 col-lg-5 text-right'>$" + getPriceWithTax(tagProd.price) + "</div>" +
				"</div>" +
				"</div>"
			);
		}
	}

	//IF THERE ARE ANY ITEMS
	if (!$(".might-like-body .product-result").length) {
		$mightLikeBody.hide();
		$mightLike.hide();
	}

	for (var l = 0; l < data.categories.length; l++) {
		var category = data.categories[l],
			src_str = category.name,
			term = q;

		term = term.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");
		pattern = new RegExp("(" + term + ")", "gi");

		src_str = src_str.replace(pattern, "<em class='highlight'>$1</em>");
		src_str = src_str.replace(/(<em class='highlight'[^<>]*)((<[^>]+>)+)([^<>]*<\/em>)/, "$1</em>$2<em class='highlight'>$4");

		$(".categories-results" + option + "").append(
			"<div class='col-12 product-result item-result'>" +
			"<div class='row'>" +
			"<div class='col-12'>" +
			"<a href='/categories/" + category.slug + "'>" + category.name + "</a>" +
			"</div>" +
			"</div>"
		);
	}

	for (var l = 0; l < data.collections.length; l++) {
		var collection = data.collections[l],
			src_str = collection.name,
			term = q;

		term = term.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");
		pattern = new RegExp("(" + term + ")", "gi");

		src_str = src_str.replace(pattern, "<em class='highlight'>$1</em>");
		src_str = src_str.replace(/(<em class='highlight'[^<>]*)((<[^>]+>)+)([^<>]*<\/em>)/, "$1</em>$2<em class='highlight'>$4");

		$(".collection-results" + option + "").append(
			"<div class='col-12 product-result item-result'>" +
			"<div class='row'>" +
			"<div class='col-4 col-lg-3'>" +
			"<a href='/collections/" + collection.slug + "'>" +
			"<img src='/storage/collection_images/" + collection.cover_img_min + "' alt='product image'>" +
			"</a>" +
			"</div>" +
			"<div class='col-7'>" +
			"<a href='/collections/" + collection.slug + "'>" + src_str + "</a>" +
			"</div>" +
			"</div>"
		);
	}
}


function addProductToLastVisited(id) {
	var lastVisited = JSON.parse(localStorage.getItem("lastVisited"));
	if (lastVisited === null) {
		lastVisited = {
			id: {
				0: id
			}
		};
		localStorage.setItem("lastVisited", JSON.stringify(lastVisited));
		return true;
	}

	//CHECK IF EXISTS AND ADD
	var length = Object.keys(lastVisited.id).length;
	if (valueExists(lastVisited.id, id)) {
		return false;
	}
	//CHCI POUZE 8 LAST VISITED PRODUKTŮ
	if (length > 8) {
		delete lastVisited.id[0];
		lastVisited.id = remapIndexes(lastVisited.id);
		lastVisited.id[length - 1] = id;
		return localStorage.setItem("lastVisited", JSON.stringify(lastVisited));
	}
	lastVisited.id[length] = id;

	localStorage.setItem("lastVisited", JSON.stringify(lastVisited));
}

//KDYZ JSEM NA STRANCE PRODUKTU
if ($(".product-page-box").length) {
	var productId = $(".left-product-box").data("id"),
		productColor = $(".left-product-box").data("color");

	addProductToLastVisited(productId);
	getLastVisited();
	addToRecommended(productColor);
}

function getLastVisited() {
	ids = JSON.parse(localStorage.getItem("lastVisited"));
	axios.get("/getlastvisited", {
		params: {
			ids: ids
		}
	})
		.then(function (response) {
			renderLastVisited(response.data);
		})
		.catch(function (error) {
			restartLocalStorageJson("lastVisited");
			abortDrawingLastVisited();
		})
}

function restartLocalStorageJson(key) {
	ids = {
		id: {}
	};
	localStorage.setItem(key, JSON.stringify(ids));
}


function abortDrawingLastVisited() {
	var $slider = $(".last-visit-slider");
	$slider.html("");
}

function hasLastVisited() {
	var lastVisited = JSON.parse(localStorage.getItem("lastVisited"));
	if (lastVisited === null) {
		return false;
	}
	return true;
}

function remapIndexes(obj) {
	var i = 0,
		newObj = {};

	$.each(obj, function (k, v) {
		newObj[i] = v;
		i++;
	});

	return newObj;
}


function appendParamToPagination(url, key, value) {
	if (url.indexOf("&sort=") === -1) {
		return url + "&" + key + "=" + value;
	}

	url = _.dropRight(url.split("&"));

	return url[0] + "&" + key + "=" + value;
}

var $productsFilter = $("form .products-filter");


if ($(".products-pagination").length) {
	var sort = $productsFilter.val(),
		url = location.protocol + "//" + location.host + location.pathname,
		firstChild = $(".products-pagination li.page-item:first-child:not(.disabled)"),
		lastChild = $(".products-pagination li.page-item:last-child:not(.disabled)");

	if (firstChild.length) {
		firstChild.find(".page-link").attr("href", appendParamToPagination(firstChild.find(".page-link").attr("href"), "sort", sort));
	}
	if (lastChild.length) {
		lastChild.find(".page-link").attr("href", appendParamToPagination(lastChild.find(".page-link").attr("href"), "sort", sort));
	}

	$(".products-pagination li.page-item:not(.disabled, :last-child, :first-child)").each(function (e) {
		$(this).html("");
		$(this).append(
			"<a class='page-link' href='" + url + "?page=" + (e + 1) + "&sort=" + sort + "'>" + (e + 1) + "</a>"
		);
	});
}


//FILTERING PRODUCTS
$productsFilter.change(function () {
	startAjaxLoader();
	var slug = $(this).parent().data("slug"),
		sort = $(this).val(),
		$elem = $(".render-category-products"),
		call = $(this).parent().data("call"),
		parameters = {
			0: {
				"name": "page",
				"value": 1
			},
			1: {
				"name": "sort",
				"value": sort
			}
		};

	setParam(parameters);
	$elem.html("");
	$elem.append(
		"<div class='loading absolute medium'></div>"
	);

	$(".products-pagination li.page-item:not(.disabled, :last-child, :first-child)").each(function () {
		$(this).find("a").attr("href", appendParamToPagination($(this).find("a").attr("href"), "sort", sort));
	});

	axios.get(call, {
		params: {
			slug: slug,
			sort: sort
		}
	})
		.then(function (response) {
			finishAjaxLoader();
			renderAjaxProducts(response.data, $elem)
		})
		.catch(function (error) {
			terminateAjaxLoader();
		})
});

function setParam(obj) {
	var length = Object.keys(obj).length,
		str = "",
		operator = "?";


	for (var i = 0; i < length; i++) {
		str += operator + obj[i].name + "=" + obj[i].value;
		operator = "&";
	}

	updateUrl(str)
}

function updateUrl(params = "") {
	if (history.pushState) {
		var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + params;
		window.history.pushState({path: newurl}, "", newurl);
	}
}


function renderAjaxProducts(data, element) {

	element.find(".loading").remove();
	$(".products-pagination .pagination .page-item").removeClass("active");
	$(".products-pagination .pagination .page-item:eq(1)").addClass("active");
	for (var i = 0; i < data.products.data.length; i++) {
		var $product = data.products.data[i];

		element.append(
			"<div class='col-6 col-sm-4 col-md-3'>" +
			"<div class='product-box'>" +
			"<a href='/product/" + $product.id + "/" + $product.slug + "'>" +
			"<div class='product-head'>" +
			"<img src='/storage/product_images/" + $product.nahled_photo_min + "' alt='Product image'>" +
			"</div>" +
			"</a>" +
			"<div class='product-body'>" +
			"<a href='/product/" + $product.id + "/" + $product.slug + "'>" +
			"<p>" + $product.name + "</p></a>" +
			"<span>$" + getPriceWithTax($product.price) + " DOLLARS</span>" +
			"</div>" +
			"</div>" +
			"</div>"
		);
	}


	var lastChild = $(".products-pagination li.page-item:last-child"),
		firstChild = $(".products-pagination li.page-item:first-child"),
		url = window.location.protocol + "//" + window.location.host + window.location.pathname + "?page=2&=" + $(".products-filter").val();

	firstChild.html("");
	lastChild.html("");

	firstChild.addClass("disabled").append(
		"<span class=\"page-link\" aria-hidden=\"true\">‹</span>"
	);
	lastChild.removeClass("disabled").append(
		"<a class='page-link' href='" + url + "' rel='next' aria-label='Next »'>›</a>"
	)

}

Pusher.logToConsole = false;

var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
	cluster: 'eu',
	forceTLS: true
});

var channel = pusher.subscribe('kira-pusher');
channel.bind('product-added', function (data) {
	drawProductPushModal(data);
});
channel.bind('price-changed', function (data) {
	drawProductPushModal(data)
});

function drawProductPushModal(data) {
	$("body").append(
		"<div class='push-modal'>" +
		"<div class='left-modal'>" +
		"<a href='/product/" + data.product.id + "/" + data.product.slug + "'>" +
		"<img class='float-left mr-1' src='/storage/product_images/" + data.product.nahled_photo_ultra_min + "' alt='product image'>" +
		"</a>" +
		"</div>" +
		"<div class='right-modal'>" +
		"<p>" + data.message + "</p>" +
		"<a class='btn btn-outline-primary btn-sm' href='/product/" + data.product.id + "/" + data.product.slug + "'>View product</a>" +
		"</div>" +
		"</div>"
	)
}

//ADMIN FUNCTIONS
var $sortableImages = $("#product-images-edit"),
	$adminSlides = $(".admin-body .slides"),
	sortImages = [],
	sortSlides = [];

if ($sortableImages.length) {
	$sortableImages.sortable({
		stop: function () {
			startAjaxLoader();
			$sortableImages.find("form").each(function (e) {
				sortImages[e] = parseInt($(this).find(".product-imgs").data("id"))
			});
			axios.post("/KC-admin/products/updateImgPosition", {
				ids: sortImages
			})
				.then(function () {
					finishAjaxLoader();
				})
				.catch(function () {
					terminateAjaxLoader();
				})
		}
	});
	$sortableImages.disableSelection();
}

if ($adminSlides.length) {
	$adminSlides.sortable({
		stop: function () {
			startAjaxLoader();
			$adminSlides.find(".slide").each(function (e) {
				console.log($(this).data("id"));
				sortSlides[e] = parseInt($(this).data("id"))
			});
			axios.post("/KC-admin/products/updateSlidesPosition", {
				ids: sortSlides
			})
				.then(function () {
					finishAjaxLoader();
				})
				.catch(function () {
					terminateAjaxLoader();
				})
		}
	});
	$adminSlides.disableSelection();
}

