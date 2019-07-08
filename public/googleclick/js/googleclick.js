var clickTimeout;
$.fn.googleclick = function () {
	$(this).css({
		"position": "relative",
		"overflow": "hidden",
	});

	this.mousedown(function (e) {
		stopCleaningUpClicks();
		var additionalStyles = $(this).data("additionalStyles");
		if(!additionalStyles){
			additionalStyles = "";
		}
		var thisOffset = $(this).offset();
		var size = this.offsetWidth;
		var x = e.pageX - thisOffset.left - size / 2;
		var y = e.pageY - thisOffset.top - size / 2;
		var styles = "left:" + x + "px;top:" + y + "px;width:" + size + "px;height:" + size + "px";
		$(this).append("<div class='gc-wave wave " + additionalStyles + "' style=" + styles + "></div>");
		clickTimeout = setTimeout(cleanUpClicks, 2000);
	});

	function cleanUpClicks() {
		$(".gc-wave").remove();
	}

	function stopCleaningUpClicks() {
		clearTimeout(clickTimeout);
	}
};