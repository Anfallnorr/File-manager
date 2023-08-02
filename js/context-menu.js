// HTML CSS JSResult Skip Results Iframe
// EDIT ON

// (function() {
	// "use strict";
	
	//
	// H E L P E R    F U N C T I O N S
	//
	/**
	 * Fonction pour vérifier si nous avons cliqué à l'intérieur d'un élément avec un nom de classe particulier.
	 * 
	 * @param {Object} e L'événement
	 * @param {String} className Le nom de la classe à vérifier
	 * @return {Boolean}
	 */
	function clickInsideElement(e, className) {
		var el = e.srcElement || e.target;
		
		if(el.classList.contains(className)) {
			return el;
		} else {
			while(el = el.parentNode) {
				if(el.classList && el.classList.contains(className)) {
					return el;
				}
			}
		}
		
		return false;
	}
	
	/**
	 * Obtenir la position exacte de l'événement.
	 * 
	 * @param {Object} e L'événement est passé dans
	 * @return {Object} Renvoie la position x et y
	 */
	function getPosition(e) {
		var posx = 0;
		var posy = 0;
		
		if(!e) var e = window.event;
		
		if(e.pageX || e.pageY) {
			posx = e.pageX;
			posy = e.pageY;
		} else if(e.clientX || e.clientY) {
			posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
			posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
		}
		
		return {
			x: posx,
			y: posy
		}
	}
	// console.log(document.getElementById("context-menu"));
	// if( document.getElementById("context-menu") !== null ) {
	//
	// F O N C T I O N S    P R I N C I P A L E S
	//
	/**
	 * Variables.
	 */
	let /*contextMenuClassName = "context-menu",
		contextMenuItemClassName = "context-menu__item",*/
		contextMenuLinkClassName = "context-menu__link",
		contextMenuActive = "context-menu--active",
		contextMenuAttrAction = "context-action",
		contextMenuAction = ['add', 'download', 'zip', 'unzip', 'move', 'rename', 'activate', 'deactivate', 'copy', 'paste', 'edit', 'approve', 'select', 'selects', 'insight', 'logascustomer', 'cleanFile', 'delete', 'cancel', 'massDownload', 'massMove', 'massRename', 'massActivate', 'massDeactivate', 'massSwitchState', 'massDelete'],
		taskItemClassName = "task",
		taskItemInContext,
		clickCoords,
		clickCoordsX,
		clickCoordsY,
		menu = document.querySelector("#context_menu"),
		menuItems = menu.querySelectorAll(".context-menu__item"),
		menuItemsLink = menu.querySelectorAll(".context-menu__item .context-menu__link"),
		menuState = 0,
		menuWidth,
		menuHeight,
		menuPosition,
		menuPositionX,
		menuPositionY,
		windowWidth,
		windowHeight;
	// }
	/**
	 * Initialise l'application.
	 */
	function initContextMenu( getAction = [], getItemClassName = "" ) {
		if( getAction !== [] ) {
			constructContextMenu(getAction);
		}
		if( getItemClassName !== "" ) {
			taskItemClassName = getItemClassName;
		}
		contextListener();
		clickListener();
		keyupListener();
		resizeListener();
	}

	/**
	 * Adapte le menu.
	 * 
	 * @param {Array} getAction Les actions que la page a besoin
	 * @return {Void} Renvoie rien, supprime les éléments du menu non demandé par getAction
	 */
	function constructContextMenu( getAction ) {
		let intersection = contextMenuAction.filter(x => getAction.includes(x));
		
		menuItemsLink.forEach(
			function(listObj) {
				if( getAction.includes(listObj.getAttribute(contextMenuAttrAction)) === false ) {
					listObj.parentElement.remove();
				}
			}
		);
	}

	/**
	 * Écoute les événements de menu contextuel.
	 */
	function contextListener() {
		document.addEventListener("contextmenu", function(e) {
			taskItemInContext = clickInsideElement(e, taskItemClassName);
			
			if(taskItemInContext) {
				menuItemsLink.forEach(
					function(inputListObjHref) {
						action = inputListObjHref.getAttribute(contextMenuAttrAction);
					}
				);
				
				e.preventDefault();
				toggleMenuOn();
				positionMenu(e);
			} else {
				taskItemInContext = null;
				toggleMenuOff();
			}
		});
	}

	/**
	 * Écoute les événements de clic.
	 */
	function clickListener() {
		document.addEventListener("click", function(e) {
			var clickeElIsLink = clickInsideElement(e, contextMenuLinkClassName);

			if(clickeElIsLink) {
				e.preventDefault();
				menuItemListener(clickeElIsLink);
			} else {
				var button = e.which || e.button;
				if(button === 1) {
					toggleMenuOff();
				}
			}
		});
	}

	/**
	 * Écoute les événements keyup.
	 */
	function keyupListener() {
		window.onkeyup = function(e) {
			if(e.keyCode === 27) {
				toggleMenuOff();
			}
		}
	}

	/**
	 * Écouteur d'événement de redimensionnement de fenêtre
	 */
	function resizeListener() {
		window.onresize = function(e) {
			toggleMenuOff();
		};
	}

	/**
	 * Active le menu contextuel personnalisé.
	 */
	function toggleMenuOn() {
		if(menuState !== 1) {
			menuState = 1;
			menu.classList.add(contextMenuActive);
		}
	}

	/**
	 * Désactive le menu contextuel personnalisé.
	 */
	function toggleMenuOff() {
		if(menuState !== 0) {
			menuState = 0;
			menu.classList.remove(contextMenuActive);
		} // return false;
	}

	/**
	 * Positionne correctement le menu.
	 * NOTE : Correction suite au mauvais positionnage de la fenêtre
	 * 		AJOUT DE : window.scrollX
	 * 		AJOUT DE : window.scrollY
	 * 
	 * @param {Object} e L'événement
	 */
	function positionMenu(e) {
		clickCoords = getPosition(e);
		clickCoordsX = clickCoords.x;
		clickCoordsY = clickCoords.y;

		menuWidth = menu.offsetWidth + 15;
		menuHeight = menu.offsetHeight + 15;

		windowWidth = window.innerWidth + window.scrollX;
		windowHeight = window.innerHeight + window.scrollY;

		if((windowWidth - clickCoordsX) < menuWidth) {
			menu.style.left = windowWidth - menuWidth + "px";
		} else {
			menu.style.left = clickCoordsX + "px";
		}

		if((windowHeight - clickCoordsY) < menuHeight) {
			menu.style.top = windowHeight - menuHeight + "px";
		} else {
			menu.style.top = clickCoordsY + "px";
		}
	}

	/**
	 * Fonction d'action qui enregistre une action lorsqu'un lien d'élément de menu est cliqué
	 * 
	 * @param {HTMLElement} link Le lien qui a été cliqué
	 */
	function menuItemListener(link) {
		let contextLinkAction = link.getAttribute(contextMenuAttrAction),
			contextTaskdatas = taskItemInContext.getAttribute('context-data');
			
		var contextTaskdata = JSON.parse(contextTaskdatas);
		
		if( contextLinkAction == "select" ) {
			let taskItemCheck = taskItemInContext.querySelector('input[type="checkbox"], input[type="radio"], select');
			
			if(taskItemCheck !== null) {
				if(taskItemCheck.checked === false) {
					taskItemCheck.checked = true;
				} else {
					taskItemCheck.checked = false;
				}
			}
		} 
		else if( contextLinkAction == "selects" ) {
			let taskItemSelectParent = taskItemInContext.parentElement,
				taskItemSelect = taskItemSelectParent.querySelectorAll('input[type="checkbox"]');
			
			taskItemSelect.forEach(
				function(inputListObj) {
					if(inputListObj.checked === false) {
						inputListObj.checked = true;
					} else {
						inputListObj.checked = false;
					}
				}
			);
		} 
		else if( contextLinkAction == "massDownload" || contextLinkAction == "massMove" || contextLinkAction == "massRename" || contextLinkAction == "massActivate" || contextLinkAction == "massDeactivate" || contextLinkAction == "massSwitchState" || contextLinkAction == "massDelete" ) {
			let taskItemSelectParent = taskItemInContext.parentElement,
				taskItemSelect = taskItemSelectParent.querySelectorAll('input[type="checkbox"]');
			
			taskItemSelect.forEach(
				function(inputListObj) {
					inputListObj.checked = true;
				}
			);
			
			try {
				document.querySelector('[context="'+ contextLinkAction +'"]').click();
				console.log(contextLinkAction);
			}
			catch(e) {
				customLog(e, "Une erreur est survenue sur l'action `"+ contextLinkAction +"` !");
			}
		} 
		else {
			try {
				taskItemInContext.querySelector('[context="'+ contextLinkAction +'"]').click();
				console.log(contextLinkAction);
			}
			catch(e) {
				customLog(e, "Une erreur est survenue sur l'action `"+ contextLinkAction +"` !");
			}
		}
		toggleMenuOff();
		
		return true;
	}

	function getValues(select) {
		var result = [];
		var options = select && select.options;
		var opt;

		for(var i=0, iLen = options.length; i<iLen; i++) {
			opt = options[i];

			if( opt.selected ) {
				result.push(opt.value || opt.text);
			}
		}
		return result;
	}

	function getValue(select) {
		var result = [];
		var options = select && select.options;
		var opt;

		for(var i=0, iLen = options.length; i<iLen; i++) {
			opt = options[i];

			if( opt.selected ) {
				result.push(opt.value || opt.text);
			}
		}
		return result;
	}
	
	/**
	 * Run the app.
	 */
	// initContextMenu();

// })();