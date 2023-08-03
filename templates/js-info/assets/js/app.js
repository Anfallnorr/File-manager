$(function() {
	"use strict";
	
	$(document).ready(function () {
		$(window).on("scroll", function () {
			if ($(this).scrollTop() > 60) {
				$('.topbar').addClass('bg-dark');
			} else {
				$('.topbar').removeClass('bg-dark');
			}
		});
	});
});
