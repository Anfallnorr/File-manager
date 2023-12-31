$('a.link-disabled').click(function() { return false; });

$('#function_debug .btn-close-white').click(function () {
	$(this).closest('#function_debug').slideUp();
});

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
				
				$('.search-container input[type="text"]').focus();
				console.log(`Combinaison de touches CTRL + f détectée`);
			} else if (nomTouche === "s") {
				e.preventDefault();
				
				const activeElement = document.activeElement;
				const form = activeElement.form;
				
				if (form) {
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
				console.log(`Combinaison de touches CTRL + a détectée`);
			}
		} else if (shiftKey !== -1) {
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
			console.log(type);
		}
	});
}
