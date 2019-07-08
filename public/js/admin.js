var disabled = true;
var ids = [];

$(".a-wave").googleclick();
$('.selectpicker').selectpicker();

function findGetParameter(parameterName) {
	var result = null,
		tmp = [];
	location.search.substr(1).split("&").forEach(function (item) {
		tmp = item.split("=");
		if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
	});
	return result;
}

$("table.sortable thead a").each(function () {
	var shortUrl = window.location.href.split("?")[0];
	var sort = $(this).data("sortable");
	var sortUrl = findGetParameter("sort");
	var order = findGetParameter("order");
	var page = findGetParameter("page");
	var q = findGetParameter("q");
	var orderLink = "";
	var pageLink = "";
	var qLink = "";

	var sortLink = "?sort=" + sort;

	if (order === "asc") {
		orderLink = "&order=desc";
	} else if (!order || order === "desc") {
		orderLink = "&order=asc";
	}
	if (order && sort !== sortUrl) {
		orderLink = "&order=" + order;
	}
	if (page) {
		pageLink = "&page=" + page;
	}
	if (q) {
		qLink = "&q=" + q;
	}

	var urlLink = shortUrl + sortLink + orderLink + pageLink + qLink;
	$(this).attr("href", urlLink);
});


$("#product_delete_multiple").click(function (e) {
	e.preventDefault();
	var $that = $(this);
	var ids = [];
	var checkedButtons = $(".product-imgs input:checked");
	checkedButtons.each(function () {
		ids.push($(this).val());
	});
	$.ajax({
		url: "../destroyImages",
		dataType: "JSON",
		method: "post",
		data: {
			"ids": ids,
			"_token": $("meta[name='csrf-token']").attr("content"),
			"_method": "DELETE"
		},
		success: function () {
			checkedButtons.parent().remove();
			$that.addClass("disabled");
			$that.attr("disabled");
		}
	});
	return false;
});

$(document).on("change", ".product-imgs input", function () {
	var $product_delete_multiple = $("#product_delete_multiple");
	$(".product-imgs").each(function () {
		if ($(this).find("input").is(":checked")) {
			disabled = false;
			return false;
		} else {
			disabled = true
		}
	});

	if (!disabled) {
		$product_delete_multiple.removeAttr("disabled");
		$product_delete_multiple.removeClass("disabled");
	} else {
		$product_delete_multiple.attr("disabled");
		$product_delete_multiple.addClass("disabled");
	}
});

$(".add-color").click(function () {
	var $inputs = $(".tab-colors").find(".color-input");
	console.log($inputs.length);
	$(this).parents(".form-group").before(
		"<div class=\"form-group row\">" +
		"<label for=\"value[" + $inputs.length + "]\" class=\"col-sm-3 col-form-label text-mt-right\">Color # " + $inputs.length + "</label>" +
		"<div class=\"col-sm-8\">" +
		"<input name=\"value[" + $inputs.length + "]\" type=\"text\" value=\"\" id=\"value[" + $inputs.length + "]\" class=\"form-control color-input\">" +
		"</div>" +
		"</div>"
	);
});

if ($("#tags").length) {
	$('#tags').selectize({
		plugins: ['restore_on_backspace'],
		delimiter: ',',
		persist: false,
		create: function (input) {
			return {
				value: input,
				text: input
			}
		}
	});
}
