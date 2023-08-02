/* https://crm.js-info.fr */
$('a.link-disabled').click(function() { return false; });

$('#function_debug .btn-close-white').click(function () {
	$(this).closest('#function_debug').slideUp();
});

/* if( $('.form-switch input').length > 0 ) {
	if( $('.form-switch input').prop('checked') == false ) {
		$('.form-switch input').val('0');
	}
	
	$('.form-switch input').on('click', function () {
		if( $('.form-switch input').prop('checked') == false ) {
			$('.form-switch input').val('0');
		} else {
			$('.form-switch input').val('1');
		}
	});
} */

// console.log(caches.keys());
/* caches.keys().then(function(names) {
    for (let name of names) {
        caches.delete(name);
    }
}); */
/* caches.keys().then(function(keys) {
	console.log('Caches disponibles :', keys);
}); */

// var url = window.location.href +'?param1=value1&param2=value2#hash-value',
	// parser = new UrlParser(window.location.href),
	// params = parser.getParams(), // { param1: 'value1', param2: 'value2' }
	// param = parser.getParam("param1"), // 'value1'
	// setparam = parser.setParam("param1", "value3"), // param1 = 'value3'
	// removeparam = parser.removeParam("param1"), // param1 = 'undefined'
	// pathname = parser.getPathname(), // '/path/to/resource'
	// hash = parser.getHash(); // '#hash-value'


$(function() {
	/* $('[data-bs-toggle="popover"]').popover({
		html: true,
		trigger: 'focus',
		// sanitize: false
		// content: $(this).attr("data-bs-content")
		// content: function() {
			// var content = $(this).attr("data-bs-content");
			// return $(content).html();
		// }
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
		return new bootstrap.Popover(el, opts)
	});
	
	$('[data-bs-toggle="tooltip"]').tooltip();
	// var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	// var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		// let opts = {
			// html: true,
			// trigger: 'focus'
		// }
		// return new bootstrap.Tooltip(tooltipTriggerEl);
	// });
});

// function _(el) {
	// return document.getElementById(el);
// }

$('.radio-bg [name="theme_bg"]').click(function() {
	getThemeBg($(this).attr('id'));
});

function getThemeBg(theme) {
	$('body').attr('bgtheme', "bg-"+ theme);
}

/* ************************************************** */
/* **************** SHOW / HIDE MODAL *************** */
/* ************************************************** */
/* function showModal(selector) {
	$(selector).modal('show');
}
function hideModal(selector) {
	$(selector).modal('hide');
}
function switchModal(selectorHidden, selectorShown) {
	$(selectorHidden).modal('hide');
	$(selectorShown).modal('show');
} */

/* ************************************************************ */
/* ********************* KEYBOARD SHORTCUT ******************** */
/* ************************************************************ */
/* document.addEventListener('keypress', (event) => {
	let nomTouche = event.key;
	let codeTouche = event.which;

	// console.log(`Touche pressée ${nomTouche}, code : ${codeTouche}`);
}, false); */
if ($('body').hasClass('hotkeys-enabled') == true) {
	// console.log(`Raccourcies clavier activés`);
	customLog(`CTRL + f = Recherche
CTRL + s = Soumet le formulaire
CTRL + a = Sélectionne toutes les cases à cocher`, "Raccourcies clavier activés");

	let keysPressed = [],
		checked = false;
	// let selectedSelect = null;
	// let currentForm = null; // initialisation de la variable qui contiendra le formulaire actuel

	// écoute de l'événement de soumission de formulaire
	/* document.addEventListener('submit', (e) => {
		currentForm = e.target; // mise à jour de la variable avec le formulaire soumis
	}); */

	document.addEventListener('keydown', (e) => {
		const nomTouche = e.key;
		const codeTouche = e.which;
		
		if (keysPressed.indexOf(nomTouche) === -1) {
			keysPressed.push(nomTouche);
		}
		
		let controlKey = keysPressed.indexOf('Control'),
			shiftKey = keysPressed.indexOf('Shift'),
			altKey = keysPressed.indexOf('Alt');
		
		if (controlKey !== -1) {
			if (nomTouche === "f") {
				e.preventDefault();
				
				// Mettre la barre de recherche en focus ici
				$('.search-container input[type="text"]').focus();
				console.log(`Combinaison de touches CTRL + f détectée`);
			} else if (nomTouche === "s") {
				e.preventDefault();
				
				const activeElement = document.activeElement;
				const form = activeElement.form;
					// console.log(activeElement);
				
				// console.log(activeElement);
				// console.log(form);
				if (form) {
					// Enregistrer les données du formulaire ici
					form.submit();
					console.log(`Formulaire enregistré :`, form);
				} else {
					console.log(`Combinaison de touches CTRL + s détectée`);
				}
			} else if (nomTouche === "a") {
				e.preventDefault();
				if (checked == false) {
					$('.content-wrapper input[type="checkbox"]:visible').prop('checked', true);
					checked = true;
				} else {
					$('.content-wrapper input[type="checkbox"]:visible').prop('checked', false);
					checked = false;
				}
				// $('.content-wrapper input[type="checkbox"]:visible').prop('checked', true);
				console.log(`Combinaison de touches CTRL + a détectée`);
			}
		} else if (shiftKey !== -1) {
			// console.log(nomTouche);
			if (nomTouche === "%") {
				e.preventDefault();
				
				console.log(`Combinaison de touches MAJ + % détectée`);
			}
		} else if (altKey !== -1) {
			if (nomTouche === "%") {
				e.preventDefault();
				
				console.log(`Combinaison de touches ALT + % détectée`);
			}
		} else if (nomTouche == "undefined") {
			console.log(`Touches `+ nomTouche +` détectée`);
		}
		/* if (keysPressed.indexOf('Control') !== -1 && nomTouche === 'f') {
			e.preventDefault();
			// Mettre la barre de recherche en focus ici
			console.log('Combinaison de touches CTRL + f détectée');
		} else if (keysPressed.indexOf('Control') !== -1 && nomTouche === 's') {
			e.preventDefault();
			// Enregistre le formulaire ici
			console.log('Combinaison de touches CTRL + s détectée');
		} else {
			console.log('Combinaison de touches CTRL + f détectée');
		} */
	}, false);

	document.addEventListener('keyup', (e) => {
		// console.log(keysPressed);
		const nomTouche = e.key;
		const index = keysPressed.indexOf(nomTouche);
		
		if (index !== -1) {
			keysPressed.splice(index, 1);
		}
	}, false);

	/* document.addEventListener('focus', (e) => {
		if (e.target.tagName === 'SELECT') {
			const nomTouche = e.key;
			const codeTouche = e.which;
			
			if (keysPressed.indexOf(nomTouche) === -1) {
				keysPressed.push(nomTouche);
			}
			
			e.preventDefault();
			
			selectedSelect = e.target;
			const form = selectedSelect.form;
			
			console.log('Selected select:', selectedSelect);
			// console.log('Selected select:', form);
		} else {
			selectedSelect = null;
		}
	}, true); */
}

/* ************************************************ */
/* **************** TABS IN SESSION *************** */
/* ************************************************ */
$('.nav-tabs .nav-link').click(function() {
	sessionTrackTabs($(this).attr('href'), $(this).closest('.accordion-item').find('button').attr('aria-controls'));
});

function sessionTrackTabs(trackTab, accordion) {
// function sessionTrackTabs(trackTab) {
	let view = getView();
	
	if (typeof accordion == "undefined") {
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

/* ***************************************************** */
/* ********************** CLEAN CACHE ********************* */
/* ***************************************************** */
/* function cleanCache() {
	caches.keys().then(function(names) {
		for (let name of names) {
			caches.delete(name);
		}
	});
} */

/* *********************************************************** */
/* ********************** GET CONTROLLER ********************* */
/* *********************************************************** */
/* // console.log(getController());
function getController() {
	let location = window.location.pathname;
	return location.split("/")[1];
} */

/* ***************************************************** */
/* ********************** GET VIEW ********************* */
/* ***************************************************** */
/* // console.log(getView());
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
} */

/* ************************************************************** */
/* ********************** GET RESPONSE ICON ********************* */
/* ************************************************************** */
function getResponseIcon(type = "") {
	let icon = "bi bi-x-square";
	
	if (type == "success") {
		icon = "bi bi-check-circle";
	} 
	else if (type == "warning") {
		icon = "bi bi-exclamation-circle";
	} 
	else if (type == "danger") {
		icon = "bi bi-x-circle";
	}
	
	return icon;
}

/* ******************************************************* */
/* ********************** GET NOTIFY ********************* */
/* ******************************************************* */
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