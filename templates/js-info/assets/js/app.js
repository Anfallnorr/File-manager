$(function() {
	"use strict";
	
	// new PerfectScrollbar(".header-message-list"),
	if( $('.header-notifications-list').length > 0 ) {
		new PerfectScrollbar(".header-notifications-list");
	}
	
	$(".mobile-search-icon").on("click", function() {
		$(".search-bar").addClass("full-search-bar");
	}), 
	
	$(".search-close").on("click", function() {
		$(".search-bar").removeClass("full-search-bar");
	}), 
	
	$(".mobile-toggle-menu").on("click", function() {
		$(".wrapper").addClass("toggled");
	}), $(".toggle-icon").click(function() {
		$(".wrapper").hasClass("toggled") ? ($(".wrapper").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) : ($(".wrapper").addClass("toggled"), $(".sidebar-wrapper").hover(function() {
			$(".wrapper").addClass("sidebar-hovered");
		}, function() {
			$(".wrapper").removeClass("sidebar-hovered");
		}))
	}), $(document).ready(function() {
		$(window).on("scroll", function() {
			$(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut();
		}), $(".back-to-top").on("click", function() {
			return $("html, body").animate({
				scrollTop: 0
			}, 600), !1
		})
	}),
	
	$(document).ready(function () {
		$(window).on("scroll", function () {
			if ($(this).scrollTop() > 60) {
				$('.topbar').addClass('bg-dark');
			} else {
				$('.topbar').removeClass('bg-dark');
			}
		});
		$('.back-to-top').on("click", function () {
			$("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
		});
	});
	
	$(function() {
		for (var e = window.location, o = $(".metismenu li a").filter(function() {
				return this.href == e
			}).addClass("").parent().addClass("mm-active"); o.is("li");) o = o.parent("").addClass("mm-show").parent("").addClass("mm-active")
	}), $(function() {
		$("#menu").metisMenu();
	}), $(".chat-toggle-btn").on("click", function() {
		$(".chat-wrapper").toggleClass("chat-toggled");
	}), $(".chat-toggle-btn-mobile").on("click", function() {
		$(".chat-wrapper").removeClass("chat-toggled");
	}), $(".email-toggle-btn").on("click", function() {
		$(".email-wrapper").toggleClass("email-toggled");
	}), $(".email-toggle-btn-mobile").on("click", function() {
		$(".email-wrapper").removeClass("email-toggled");
	}), $(".compose-mail-btn").on("click", function() {
		$(".compose-mail-popup").show();
	}), $(".compose-mail-close").on("click", function() {
		$(".compose-mail-popup").hide();
	}),
	
	
	$(".switcher-btn").on("click", function() {
		$(".switcher-wrapper").toggleClass("switcher-toggled");
	}), $(".close-switcher").on("click", function() {
		$(".switcher-wrapper").removeClass("switcher-toggled");
	}),
	
	
	$('.radio-bg [name="theme_bg"]').click(function() {
		getThemeBg($(this).attr('id'));
	});

	function getThemeBg(theme) {
		$('body').attr('bgtheme', "bg-"+ theme);
	}
	
	/* $('#theme1').click(theme1);
    $('#theme2').click(theme2);
    $('#theme3').click(theme3);
    $('#theme4').click(theme4);
    $('#theme5').click(theme5);
    $('#theme6').click(theme6);
    $('#theme7').click(theme7);
    $('#theme8').click(theme8);
    $('#theme9').click(theme9);
    $('#theme10').click(theme10);
    $('#theme11').click(theme11);
    $('#theme12').click(theme12);
    $('#theme13').click(theme13);
    $('#theme14').click(theme14);
    $('#theme15').click(theme15);
    $('#theme16').click(theme16);
    $('#theme17').click(theme17);
    $('#theme18').click(theme18);
    $('#theme19').click(theme19);
    $('#theme20').click(theme20);
    $('#theme21').click(theme21);
    $('#theme22').click(theme22);
    $('#theme23').click(theme23);
    $('#theme24').click(theme24);
    $('#theme25').click(theme25);
    $('#theme26').click(theme26);
    $('#theme27').click(theme27);
    $('#theme28').click(theme28);
    $('#theme50').click(theme50);
    $('#theme51').click(theme51);
    $('#theme52').click(theme52);
    $('#theme53').click(theme53);
    $('#theme54').click(theme54);
    $('#theme55').click(theme55);
    $('#theme56').click(theme56);
    $('#theme57').click(theme57);
    $('#theme58').click(theme58); */
	/* function theme1() {$('body').attr('class', 'bg-theme bg-theme1');}
	function theme2() {$('body').attr('class', 'bg-theme bg-theme2');}
	function theme3() {$('body').attr('class', 'bg-theme bg-theme3');}
	function theme4() {$('body').attr('class', 'bg-theme bg-theme4');}
	function theme5() {$('body').attr('class', 'bg-theme bg-theme5');}
	function theme6() {$('body').attr('class', 'bg-theme bg-theme6');}
	function theme7() {$('body').attr('class', 'bg-theme bg-theme7');}
	function theme8() {$('body').attr('class', 'bg-theme bg-theme8');}
	function theme9() {$('body').attr('class', 'bg-theme bg-theme9');}
	function theme10() {$('body').attr('class', 'bg-theme bg-theme10');}
	function theme11() {$('body').attr('class', 'bg-theme bg-theme11');}
	function theme12() {$('body').attr('class', 'bg-theme bg-theme12');}
	function theme13() {$('body').attr('class', 'bg-theme bg-theme13');}
	function theme14() {$('body').attr('class', 'bg-theme bg-theme14');}
	function theme15() {$('body').attr('class', 'bg-theme bg-theme15');}
	function theme16() {$('body').attr('class', 'bg-theme bg-theme16');}
	function theme17() {$('body').attr('class', 'bg-theme bg-theme17');}
	function theme18() {$('body').attr('class', 'bg-theme bg-theme18');}
	function theme19() {$('body').attr('class', 'bg-theme bg-theme19');}
	function theme20() {$('body').attr('class', 'bg-theme bg-theme20');}
	function theme21() {$('body').attr('class', 'bg-theme bg-theme21');}
	function theme22() {$('body').attr('class', 'bg-theme bg-theme22');}
	function theme23() {$('body').attr('class', 'bg-theme bg-theme23');}
	function theme24() {$('body').attr('class', 'bg-theme bg-theme24');}
	function theme25() {$('body').attr('class', 'bg-theme bg-theme25');}
	function theme26() {$('body').attr('class', 'bg-theme bg-theme26');}
	function theme27() {$('body').attr('class', 'bg-theme bg-theme27');}
	function theme28() {$('body').attr('class', 'bg-theme bg-theme28');}
	function theme50() {$('body').attr('class', 'bg-theme bg-theme50');}
	function theme51() {$('body').attr('class', 'bg-theme bg-theme51');}
	function theme52() {$('body').attr('class', 'bg-theme bg-theme52');}
	function theme53() {$('body').attr('class', 'bg-theme bg-theme53');}
	function theme54() {$('body').attr('class', 'bg-theme bg-theme54');}
	function theme55() {$('body').attr('class', 'bg-theme bg-theme55');}
	function theme56() {$('body').attr('class', 'bg-theme bg-theme56');}
	function theme57() {$('body').attr('class', 'bg-theme bg-theme57');}
	function theme58() {$('body').attr('class', 'bg-theme bg-theme58');} */
});