/* https://crm.js-info.fr */
$('a.link-disabled').click(function() { return false; });

$('#function_debug .btn-close-white').click(function () {
	$(this).closest('#function_debug').slideUp();
});

$(function() {
	var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')),
		popoverList = popoverTriggerList.map(function (el) {
		let opts = {
			html: true,
			trigger: 'focus'
		}
		
		return new bootstrap.Popover(el, opts)
	});
	
	$('[data-bs-toggle="tooltip"]').tooltip();
});

$('.radio-bg [name="theme_bg"]').click(function() {
	getThemeBg($(this).attr('id'));
});

function getThemeBg(theme) {
	$('body').attr('bgtheme', "bg-"+ theme);
}

/* ************************************************************ */
/* ********************* KEYBOARD SHORTCUT ******************** */
/* ************************************************************ */
if ($('body').hasClass('hotkeys-enabled') == true) {
	customLog(`CTRL + f = Recherche
CTRL + s = Soumet le formulaire
CTRL + a = Sélectionne toutes les cases à cocher`, "Raccourcies clavier activés");

	let keysPressed = [],
		checked = false;

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
		
	}, false);

	document.addEventListener('keyup', (e) => {
		const nomTouche = e.key;
		const index = keysPressed.indexOf(nomTouche);
		
		if (index !== -1) {
			keysPressed.splice(index, 1);
		}
	}, false);
}

/* ************************************************ */
/* **************** TABS IN SESSION *************** */
/* ************************************************ */
$('.nav-tabs .nav-link').click(function() {
	sessionTrackTabs($(this).attr('href'), $(this).closest('.accordion-item').find('button').attr('aria-controls'));
});

function sessionTrackTabs(trackTab, accordion) {
	let view = getView();
	
	if (typeof accordion == "undefined") {
		accordion = "";
	}
	
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
function getNotify(msg, type, width = 400, size = "mini", position = "bottom right") {
	// Lobibox
	let icon = getResponseIcon(type);
	
	if (type == "danger") {
		type = "error";
	}
	
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