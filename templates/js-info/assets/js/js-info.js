$('a.link-disabled').click(function() { return false; });

// window.onload = disableAutocomplete;
// disableAutocomplete();

// console.log(caches.keys());
/* caches.keys().then(function(names) {
    for (let name of names) {
        caches.delete(name);
    }
}); */

$(function() {
	// $('[data-bs-toggle="popover"]').popover();
	/* $('[data-bs-toggle="popover"]').popover({
		html: true,
		trigger: 'focus'
	}); */
	var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')),
		popoverList = popoverTriggerList.map(function (el) {
		let opts = {
			html: true,
			trigger: 'focus',
			// animation: false,
		}
		// if (el.hasAttribute('data-bs-content-id')) {
			// opts.content = document.getElementById(el.getAttribute('data-bs-content-id')).innerHTML;
			// opts.html = true;
		// }
		return new bootstrap.Popover(el, opts);
	});
	
	// $('[data-bs-toggle="tooltip"]').tooltip();
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		/* let opts = {
			html: true,
			trigger: 'focus'
		} */
		return new bootstrap.Tooltip(tooltipTriggerEl);
	});
});
/**/

let getSidebarPositionMenu = $('#menu > li.ui-sortable-handle'),
	getMenuInfos = [],
	getIndexPositionMenu = [];

getSidebarPositionMenu.each(function(index, element) {
	getMenuInfos.push(element.getAttribute('data-datas'))
	getIndexPositionMenu.push(element.getAttribute('data-position'))
});

/* FIXED_FOOTER */
// let windowHeightScreen = $(window).height(),
	// htmlHeightScreen = $('html').height();

// if( htmlHeightScreen < windowHeightScreen ) {
	// $('body > .wrapper').addClass('fixed-footer');
// } else {
	// $('body > .wrapper').removeClass('fixed-footer');
// }

/**/
// console.log($('.pace').length);
if( $('.pace').length > 0 ) {
	window.onbeforeunload = renderLoading;
}
function renderLoading() {
    Pace.stop();
    // Enable the bar manually
    var paceEle = $(Pace.bar.el);
    paceEle.removeClass('pace-inactive').addClass('pace-active');
    var timer = 0;
    var intervalId = setInterval(frame, 50);

    function frame() {
        if (timer === 96) {
            // Clear the timer interval once its reached 96%
			Pace.stop();
			paceEle.removeClass('pace-active').addClass('pace-inactive');
            clearInterval(intervalId);
        } else {
            timer = timer + 1;
            // Increase the Percentage of progressbar
            Pace.bar.progress = timer;
            // Call render function to the progress bar and it updates the percentage of the loading bar.
            Pace.bar.render();
        }
    }
}

/*
$('a[href^="/"], a.fm-icon-box, input[type="submit"], form:not(#counter_generator, #pwd_generator) button[type="submit"], a.return-page').click(function() {
	// $('body.mobile-device').addClass('link-loader');
	// $('#waiting_loader').removeClass('d-none');
	if( $(this).find('i') ) {
		$(this).find('i').attr('class', 'spinner-border spinner-border-sm');
		// $(this).append('<i class="spinner-border" role="status"></i>');
	} else if( $(this).hasClass('bx') ) {
		$(this).attr('class', 'spinner-border spinner-border-sm');
	} else {
		$(this).append('<i class="spinner-border" role="status"></i>');
	}
});
*/
/*
document.addEventListener('keydown', (event) => {
	const nomTouche = event.key;
	const codeTouche = event.which;
	
	// console.log(codeTouche);
	
	if (nomTouche === 'Control' || nomTouche === 'Shift' || nomTouche === 'Alt') {
		// Pas d'alerte si seule la touche Control ou Shift est pressée.
		return;
	}
	
	if (event.ctrlKey) {
		// Même si event.key n'est pas 'Control' (par ex., 'a' is pressed),
		// event.ctrlKey peut être true si la touche Ctrl est pressée dans le même temps.
		// $('.search-bar-box > .search-control').focus();
		console.log(`Combinaison de ctrlKey + ${nomTouche}, code : ${codeTouche}`);
	} else {
		console.log(`Touche pressée ${nomTouche}, code : ${codeTouche}`);
	}
}, false);

document.addEventListener('keyup', (event) => {
	const nomTouche = event.key;
	// const codeTouche = event.which;

	// Dès que l'utilisateur relâche la touche Ctrl, la touche n'est plus active.
	// Aussi event.ctrlKey est false.
	if (nomTouche === 'Control') {
		console.log('La touche Control a été relâchée');
	}
	if (nomTouche === 'Shift') {
		console.log('La touche Shift a été relâchée');
	}
	if (nomTouche === 'Alt') {
		console.log('La touche Alt a été relâchée');
	}
}, false);
*/

/* ******************************************************* */
/* **************** MENU TOGGLE IN SESSION *************** */
/* ******************************************************* */
$('.sidebar-header .toggle-icon i').click(function() {
	sessionTrackMenuToggle($(this).closest('.wrapper').hasClass('toggled'));
});

$(".wrapper.toggled .sidebar-wrapper").hover(function() {
	$(".wrapper").addClass("sidebar-hovered");
}, function() {
	$(".wrapper").removeClass("sidebar-hovered");
});

function sessionTrackMenuToggle(hasToggle) {
	// if(hasToggle == true) {
		// var toggle = "not-toggled";
	// } else {
		// var toggle = "";
	// }
	// console.log(location);
	// console.log(view);
	try {
		$.ajax({
			type: 'post',
			// url: '/tools/tracker/trackMenuToggle',
			url: '/apps/get/trackMenuToggle',
			// data: {toggle}
			data: {hasToggle}
		});
	} catch(e) {
		customLog(e, "Une erreur est survenue sur la fonction `sessionTrackMenuToggle` !");
	}
}

/* ************************************************ */
/* **************** TABS IN SESSION *************** */
/* ************************************************ */
$('.nav-tabs:not(.no-track) .nav-link').click(function() {
	sessionTrackTabs($(this).attr('href'), $(this).closest('.accordion-item').find('button').attr('aria-controls'));
});

function sessionTrackTabs(trackTab, accordion) {
// function sessionTrackTabs(trackTab) {
	let view = getView();
	
	if(typeof accordion == "undefined") {
		accordion = "";
	}
	// console.log(location);
	// console.log(view);
	try {
		$.ajax({
			type: 'post',
			// url: '/tools/tracker/tracktabs/'+ view,
			url: '/apps/get/tracktabs/'+ view,
			data: {trackTab, accordion}
		});
	} catch(e) {
		customLog(e, "Une erreur est survenue sur la fonction `sessionTrackTabs` !");
	}
}

/* ********************************************************* */
/* **************** CHECK BELL NOTIFICATIONS *************** */
/* ********************************************************* */
/**/
// if( $('.header-notifications-list') ) {
	// setInterval( notificationsCheck, 10000, $('.header-notifications-list').attr('notif_customer') );

	/* if( $('.alert-count.notif-counter').text() != "" ) {
		$('.alert-count.notif-counter').css('display', 'flex');
	} */
// }


// setTimeout(function() {
		// $('.header-notifications-list').append(`<a class="dropdown-item" href="javascript:;" id="123">
			// <div class="d-flex align-items-center">
				// <div class="notify"><i class="bx bx-send"></i></div>
				// <div class="flex-grow-1">
					// <h6 class="msg-name">TYPE <span class="msg-time float-end">54 MIN</span></h6>
					// <p class="msg-info">VAL MESSAGE</p>
				// </div>
			// </div>
		// </a>`)
	// }, 3000
// );

/* $(document).on('click', '.header-notifications-list > a', function notificationsDelete() {
	let item = $(this),
		id = item.attr('id'),
		result = confirm("Passer cet élément en lu ? Id : "+ id +" ?");
	
	if( result ) {
		try {
			$.ajax({
				type: 'post',
				url: '/apps/get/deleteBellNotification',
				data: {
					'id': id
				},
				dataType: "json"
			})
			.done(function(getDatas) {
				let notif = getDatas;
				
				if( notif[1] == "success" ) {
					var countNotif = parseInt(item.closest('li').find('.alert-count').text());
					countNotif -= 1;
					
					if( countNotif == 0 ) {
						item.closest('li').find('.alert-count').hide();
					} else {
						item.closest('li').find('.alert-count').text(countNotif);
					}
					
					item.remove();
				}
				
				getNotify(notif[0], notif[1]);
			})
			.fail(function(jqXHR, textStatus, response) {
				getNotify(errorText[0], errorText[1]);
			});
		} catch(e) {
			customLog(e, "Une erreur est survenue sur la fonction `notificationsDelete` !");
		}
	}
}); */

/* function notificationsCheck(id) {
	let countElement = $('.header-notifications-list > a').length;
	
	try {
		$.ajax({
			type: 'post',
			url: '/apps/get/getBellNotifications',
			data: {
				'id': id
			},
			dataType: "json"
		})
		.done(function(getDatas) {
			let data = getDatas,
				notifCounter = $('.alert-count.notif-counter'),
				getActualNotif = [],
				appendNotif = "",
				getElement = $('.header-notifications-list > a');
			
			$(getElement).each(function(index, element) {
				getActualNotif.push(parseInt($(this).attr('id')));
			});
			
			console.log(data);
			
			if( countElement < data.getNotif.length ) {
				$.each(data.getNotif, function(key, val) {
					if( !getActualNotif.includes(val.id) ) {
						let init = (Math.floor(Date.now() / 1000) - Math.floor(Date.parse(val.date_upd) / 1000)),
							hours = Math.floor(init / 3600); var minutes = Math.floor(init / 60) % 60; var seconds = init % 60,
							time = "";
						
						if( hours > 0 ) { time = hours +" h"; } 
						else if( minutes > 0 ) { time = minutes +" min"; } 
						else if( seconds > 0 ) { time = seconds +" sec"; }
						
						appendNotif += `<a class="dropdown-item" href="javascript:;" id="`+ val.id +`">
							<div class="d-flex align-items-center">
								<div class="notify"><i class="bx bx-`+ val.icon +`"></i></div>
								<div class="flex-grow-1 white-space-initial">
									<h6 class="msg-name">`+ val.type +` <span class="msg-time float-end">`+ time +`</span></h6>
									<p class="msg-info">`+ val.message +`</p>
								</div>
							</div>
						</a>`;
					}
				});
				if( appendNotif != "" ) {
					var countNotif = parseInt(notifCounter.text());
					
					if( isNaN(countNotif) ) {
						countNotif = 1;
					} else {
						countNotif += 1;
					}
					
					notifCounter.show().text(countNotif);
					notifCounter.css('display', 'flex').text(countNotif);
					
					$('.header-notifications-list').append(appendNotif);
					getNotify(data.notif[0], data.notif[1]);
				}
			}
		})
		.fail(function(jqXHR, textStatus, response) {
			getNotify(errorText[0], errorText[1]);
		});
	} catch(e) {
		customLog(e, "Une erreur est survenue sur la fonction `notificationsCheck` !");
	}
} */

/* ***************************************************** */
/* **************** COLLAPSES IN SESSION *************** */
/* ***************************************************** */
/*$('.accordion .accordion-button').click(function() {
	if($(this).attr('aria-expanded') == "true") {
		// console.log($(this).data('bs-target'));
		sessionTrackCollapses($(this).data('bs-target'));
	}
	// console.log();
});

function sessionTrackCollapses(trackCollapse) {
	let view = getView();
	
	// console.log(view);
	// console.log(trackCollapse);
	try {
		$.ajax({
			type: 'post',
			// url: '/tools/tracker/trackCollapses/'+ view,
			url: '/apps/get/trackCollapses/'+ view,
			data: {trackCollapse}
		});
	} catch(e) {
		customLog(e, "Une erreur est survenue sur la fonction `sessionTrackCollapses` !");
	}
}*/

// localStorage.setItem('trackTabs', {newTabsKey: newTabsVal});
// localStorage.setItem('trackTabs', {'access'});
// console.log(window.location.pathname.split("/")[2]);
// console.log(localStorage.getItem('trackTabs'));
// localStorage.getItem('trackTabs');
// localStorage.clear();







// get = {
    // id: function(el) {
		// return document.getElementById(el);
	// }
// }
// console.log(get.id('notification_ajax'));





/* function _(el) {
	return document.getElementById(el);
} */
// function selector(el) {
	// return document.querySelector(el);
// }
// function selectorAll(el) {
	// return document.querySelectorAll(el);
// }

/* ****************************************************** */
/* **************** CALCUL TTC / HT / TVA *************** */
/* ****************************************************** */
// Avec la valeur décimale de TVA = taux de TVA/100
/* function getHt(tax, ttc) {
	// PV HT =  Px TTC / (1+valeur décimale de TVA)
	getTax = tax / 100;
	let getPriceHt = ttc / (1 + getTax);
	
	return getPriceHt.toFixed(2);
} */
/* function getTtc(tax, ht) {
	// PV TTC = Px HT * (1+ valeur décimale de TVA)
	getTax = tax / 100;
	let getPriceTtc = ttc * (1 + getTax);
	
	return getPriceTtc.toFixed(2);
} */
/* function getTva(tax, ht) {
	// TVA = PV HT * valeur décimale de TVA
	getTax = tax / 100;
	let getPriceTva = ttc * getTax;
	
	return getPriceTva.toFixed(2);
} */

/* ***************************************************** */
/* ********************** GET VIEW ********************* */
/* ***************************************************** */
/* // function getView(path) {
function getView() {
	var location = window.location.pathname;
	return location.split("/")[2];
} */

/* ***************************************************** */
/* ******************* CUSTOM CONSOLE ****************** */
/* ***************************************************** */
/* // customLog("qsfge", "Une erreur est survenue sur la fonction `sessionTrackTabs` !");
// console.dir(window.location);
// console.log(window.location);
function customLog(e, group) {
	let styles = "padding: 5px 10px; background-color: #550000; color: #ffffff; border: 1px solid #ffffff; border-radius: 5px; font-style: italic; border: 1px solid black; font-size: 1.2em;";
	
	console.group(group);
		console.trace("%c"+ e, styles);
	console.groupEnd(group);
	// try {
		// 
	// } catch(e) {
		// customLog(e, "Une erreur est survenue sur la fonction `playPauseMedia` !");
	// }
} */

/* ***************************************************** */
/* ********************* AJAX NOTIF ******************** */
/* ***************************************************** */
function getNotificationAjax(msg, type) {
	let icon = getResponseIcon(type);
	
	// if( type == "success" ) {
		// var icon = "bxs-check-circle";
	// } 
	// else if( type == "warning" ) {
		// var icon = "bxs-info-circle";
	// } 
	// else if( type == "danger" ) {
		// var icon = "bxs-x-circle";
	// } 
	// else {
		// var icon = "bxs-message-square-x";
	// }
	
	if( $('#notification') ) {
		$('#notification').addClass("d-none");
	}
	
	$('#notification_ajax').removeClass("d-none");
	$('#notification_ajax').html(`
		<div class="alert border-0 border-start border-5 border-`+ type +` alert-dismissible fade show py-2">
			<div class="d-flex align-items-center">
				<div class="font-35 text-white"><i class="bx `+ icon +`"></i></div>
				<div class="ms-3">
					<h6 class="mb-0 text-white">`+ type +`</h6>
					<div class="text-white">`+ msg +`</div>
				</div>
			</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	`);
}

/* ************************************************************** */
/* ********************** GET RESPONSE ICON ********************* */
/* ************************************************************** */
function getResponseIcon(type = "") {
	let icon = "bx bx-message-square-x";
	
	if (type == "success") {
		icon = "bx bx-check-circle";
	} 
	else if (type == "warning") {
		icon = "bx bx-error";
	} 
	else if (type == "danger") {
		icon = "bx bx-x-circle";
	}
	
	return icon;
}

/* ****************************************************** */
/* ********************** GETNOTIFY ********************* */
/* ****************************************************** */
/*
https://www.jqueryscript.net/demo/Responsive-jQuery-Message-Box-Notification-Plugin-lobibox/

title: true,                // Title of notification. Do not include it for default title or set custom string. Set this false to disable title
size: 'normal',             // normal, mini, large
showClass: 'flipInX',       // Show animation class. (Uses animate.css)
hideClass: 'zoomOutDown',   // Hide animation class (Uses animate.css)
icon: true,                 // Icon of notification. Leave as is for default icon or set custom string
msg: '',                    // Message of notification
img: null,                  // Image source string
closable: true,             // Make notifications closable
delay: 5000,                // Hide notification after this time (in miliseconds)
delayIndicator: true,       // Show timer indicator
closeOnClick: true,         // Close notifications by clicking on them
width: 400,                 // Width of notification box
sound: true,                // Sound of notification. Set this false to disable sound. Leave as is for default sound or set custom soud path
position: "bottom right"    // Place to show notification. Available options: "top left", "top right", "bottom left", "bottom right"        

//Overriding default options
Lobibox.notify.DEFAULTS = $.extend({}, Lobibox.notify.DEFAULTS, {
    ... //override any options from default options
});
*/
/* $('#showDesktopNotifications').prop('checked', false);
getNotify(`L'autorisation de notification a été bloquée car vous avez rejeté l'invite d'autorisation à plusieurs reprises. 
Cela peut être réinitialisé dans les informations sur la page, accessibles en cliquant sur l'icône de verrouillage à côté de l'URL.`
, "warning", 800, "normal", "top left"); */
function getNotify(msg, type, width = 400, size = "mini", position = "bottom right") {
	// Lobibox
	let icon = getResponseIcon(type);
	
	if (type == "danger") {
		type = "error";
	}
	
	// console.log(msg);
	// console.log(type);
	// console.log(size);
	
	Lobibox.notify(type, {
		// title: type,
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		showClass: 'fadeInDown',
		hideClass: 'fadeUpDown',
		size: size,
		rounded: true,
		icon: icon,
		sound: false,
		position: position,
		width: width,
		msg: msg,
		callback: function ($this, type, ev) {
			//Your code goes here
			console.log(type);
		}
	});
}
/* function getNotify(msg, type, size = "mini") {
	// Lobibox
	var icon = "bx bx-message-square-x";
	
	if( type == "success" ) {
		icon = "bx bx-check-circle";
	} 
	else if( type == "warning" ) {
		icon = "bx bx-error";
	} 
	else if( type == "danger" ) {
		type = "error";
		icon = "bx bx-x-circle";
	}
	
	Lobibox.notify(type, {
		// title: type,
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		size: size,
		rounded: true,
		icon: icon,
		sound: false,
		// position: "top right",
		position: "bottom right",
		msg: msg,
		callback: function ($this, type, ev) {
			//Your code goes here
			console.log(type);
		}
	});
} */
/*
Lobibox.base.OPTIONS = {
//DO NOT change this value. Some functionality is depended on it
    bodyClass       : 'lobibox-open',
//DO NOT change this object. Some functionality is depended on it
    modalClasses : {
        'error'     : 'lobibox-error',
        'success'   : 'lobibox-success',
        'info'      : 'lobibox-info',
        'warning'   : 'lobibox-warning',
        'confirm'   : 'lobibox-confirm',
        'progress'  : 'lobibox-progress',
        'prompt'    : 'lobibox-prompt',
        'default'   : 'lobibox-default',
        'window'    : 'lobibox-window'
    },
//This is option how buttons can be shown. What are buttonsAlign option available values
    buttonsAlign: ['left', 'center', 'right'],
//You can change the title or class of buttons from here or use the same structure object for button when creating messagebox
//closeOnClick : true will close the messagebox when clicking this type of button. Set it to false not to close messagebox when clicking on it
    buttons: {
        ok: {
            'class': 'lobibox-btn lobibox-btn-default',
            text: 'OK',
            closeOnClick: true
        },
        cancel: {
            'class': 'lobibox-btn lobibox-btn-cancel',
            text: 'Cancel',
            closeOnClick: true
        },
        yes: {
            'class': 'lobibox-btn lobibox-btn-yes',
            text: 'Yes',
            closeOnClick: true
        },
        no: {
            'class': 'lobibox-btn lobibox-btn-no',
            text: 'No',
            closeOnClick: true
        }
    }
};


//Overriding default options
Lobibox.base.OPTIONS = $.extend({}, Lobibox.base.OPTIONS, {
    ... //override any options except those above which is written "DO NOT change"
});
*/
/* function getNotifyConfirm(msg) {
	Lobibox.confirm({
		msg: msg,
		callback: function ($this, type, ev) {
			//Your code goes here
			// console.log($this);
			// console.log(type);
			// console.log(ev);
		}
	});
} */

/* function getNotifyAlert(msg, type, size = "mini") {
	Lobibox.alert(type, {
		msg: msg,
		//buttons: ['ok', 'cancel', 'yes', 'no'],
		//Or more powerfull way
		buttons: {
			ok: {
				'class': 'btn btn-info',
				closeOnClick: false
			},
			cancel: {
				'class': 'btn btn-danger',
				closeOnClick: false
			},
			yes: {
				'class': 'btn btn-success',
				closeOnClick: false
			},
			no: {
				'class': 'btn btn-warning',
				closeOnClick: false
			},
			custom: {
				'class': 'btn btn-default',
				text: 'Custom'
			}
		},
		callback: function(lobibox, type) {
			var btnType;
			if (type === 'no') {
				btnType = 'warning';
			}else if (type === 'yes') {
				btnType = 'success'; 
			}else if (type === 'ok') {
				btnType = 'info';
			}else if (type === 'cancel') {
				btnType = 'error';
			}
			Lobibox.notify(btnType, {
				size: size,
				msg: 'This is ' + btnType +' message'
			});
		}
	});
} */