// HTML CSS JSResult Skip Results Iframe
// EDIT ON

// (function()
// {
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
	function clickInsideElement(e, className)
    {
		var el = e.srcElement || e.target;
		// console.log(el);
		if (el.classList.contains(className)) {
			return el;
		} else {
			while (el = el.parentNode) {
				if (el.classList && el.classList.contains(className)) {
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
	function getPosition(e)
    {
		var posx = 0;
		var posy = 0;
		
		if (!e) var e = window.event;
		
		if (e.pageX || e.pageY) {
			posx = e.pageX;
			posy = e.pageY;
		} else if (e.clientX || e.clientY) {
			posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
			posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
		}
		
		return {
			x: posx,
			y: posy
		}
	}
	// console.log(document.getElementById("context-menu"));
	// if (document.getElementById("context-menu") !== null) {
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
		// contextTaskAttrId = "context-id",
		// contextTask = "context-",
		taskItemClassName = "task",
		taskItemInContext,
		clickCoords,
		clickCoordsX,
		clickCoordsY,
		menu = document.querySelector("#context-menu"),
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
	function initContextMenu( getAction = [], getItemClassName = "")
    {
		// console.log(getAction);
		if (getAction != []) {
			constructContextMenu(getAction);
		}
		if (getItemClassName !== "") {
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
	function constructContextMenu( getAction)
    {
		let intersection = contextMenuAction.filter(x => getAction.includes(x));
		// console.log(intersection);
		
		menuItemsLink.forEach(
			function(listObj) {
				if (getAction.includes(listObj.getAttribute(contextMenuAttrAction)) === false) {
					listObj.parentElement.remove();
				}
			}
		);
	}

	/**
	 * Écoute les événements de menu contextuel.
	 */
	function contextListener()
    {
		document.addEventListener("contextmenu", function(e) {
			taskItemInContext = clickInsideElement(e, taskItemClassName);
			
			if (taskItemInContext) {
				// var contextTaskdata = JSON.parse(taskItemInContext.getAttribute("context-data"));
				var action = "";
				// console.log(taskItemInContext);
				
				menuItemsLink.forEach(
					function(inputListObjHref)
                    {
						action = inputListObjHref.getAttribute(contextMenuAttrAction);
						
						// console.log(action);
						// console.log(contextTaskdata);
						// console.log(contextTaskdata[action]);
						
						/**
						 * 
						 * Change les liens du menu contextuel par ceux selectionné
						 * 
						 * 	if (typeof contextTaskdata[action] !== "undefined") {
						 * 		console.log(contextTaskdata[action]);
						 * 		inputListObjHref.setAttribute('href', contextTaskdata[action]);
						 * 	}
						 * 
						 */
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
	function clickListener()
    {
		document.addEventListener("click", function(e) {
			var clickeElIsLink = clickInsideElement(e, contextMenuLinkClassName);

			if (clickeElIsLink) {
				e.preventDefault();
				menuItemListener(clickeElIsLink);
			} else {
				var button = e.which || e.button;
				if (button === 1) {
					toggleMenuOff();
				}
			}
		});
	}

	/**
	 * Écoute les événements keyup.
	 */
	function keyupListener()
    {
		window.onkeyup = function(e) {
			if (e.keyCode === 27) {
				toggleMenuOff();
			}
		}
	}

	/**
	 * Écouteur d'événement de redimensionnement de fenêtre
	 */
	function resizeListener()
    {
		window.onresize = function(e) {
			toggleMenuOff();
		};
	}

	/**
	 * Active le menu contextuel personnalisé.
	 */
	function toggleMenuOn()
    {
		if (menuState !== 1) {
			menuState = 1;
			menu.classList.add(contextMenuActive);
		}
	}

	/**
	 * Désactive le menu contextuel personnalisé.
	 */
	function toggleMenuOff()
    {
		if (menuState !== 0) {
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
	function positionMenu(e)
    {
		clickCoords = getPosition(e);
		clickCoordsX = clickCoords.x;
		clickCoordsY = clickCoords.y;

		menuWidth = menu.offsetWidth + 15;
		menuHeight = menu.offsetHeight + 15;

		windowWidth = window.innerWidth + window.scrollX;
		windowHeight = window.innerHeight + window.scrollY;

		if ((windowWidth - clickCoordsX) < menuWidth) {
			menu.style.left = windowWidth - menuWidth + "px";
		} else {
			menu.style.left = clickCoordsX + "px";
		}

		if ((windowHeight - clickCoordsY) < menuHeight) {
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
	function menuItemListener(link)
    {
		let contextLinkAction = link.getAttribute(contextMenuAttrAction),
			// contextTaskAction = taskItemInContext.getAttribute(contextTaskAttrId),
			// contextTaskContext = taskItemInContext.getAttribute(contextTask + contextLinkAction);
			contextTaskdatas = taskItemInContext.getAttribute('context-data');
			
		var contextTaskdata = JSON.parse(contextTaskdatas);
		
		
		// console.log("Task ID - " + taskItemInContext.getAttribute("context-id"));
		// console.log("Task href - " + taskItemInContext.getAttribute("context-href"));
		// console.log("Task action - " + link.getAttribute("context-action"));
		// console.log("Task href - " + link.getAttribute("data-href"));
		
		// console.log(link.getAttribute("href"));
		// console.log(link);
		// console.log(contextTaskData);
		// console.log(taskItemInContext);
		// console.log(contextTaskAction);
		// console.log(taskItemInContext.parentElement);
		
		if (contextLinkAction == "select") {
			// let taskItemCheck = taskItemInContext.querySelector('input[type="checkbox"], input[type="radio"], select'),
				// taskItemSelect = taskItemInContext.querySelector('select > option');
			let taskItemCheck = taskItemInContext.querySelector('input[type="checkbox"], input[type="radio"], select');
			
			if (taskItemCheck !== null) {
				if (taskItemCheck.checked === false) {
					taskItemCheck.checked = true;
				} else {
					taskItemCheck.checked = false;
				}
			}
			
			// if(taskItemSelect !== null) {
				// console.log(taskItemSelect);
			// }
		} 
		else if (contextLinkAction == "selects") {
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
		else if (contextLinkAction == "massDownload" || contextLinkAction == "massMove" || contextLinkAction == "massRename" || contextLinkAction == "massActivate" || contextLinkAction == "massDeactivate" || contextLinkAction == "massSwitchState" || contextLinkAction == "massDelete") {
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
				// let styles = "padding: 5px 10px; background-color: #550000; color: #ffffff; border: 1px solid #ffffff; border-radius: 5px; font-style: italic; border: 1px solid black; font-size: 1.2em;";
				customLog(e, "Une erreur est survenue sur l'action `"+ contextLinkAction +"` !");
				// console.group("Une erreur est survenue sur l'action `"+ contextLinkAction +"` !");
					// console.trace("%c"+ e, styles);
				// console.groupEnd("Une erreur est survenue sur l'action `"+ contextLinkAction +"` !");
			}
		} 
		else {
			try {
				taskItemInContext.querySelector('[context="'+ contextLinkAction +'"]').click();
				console.log(contextLinkAction);
			}
			catch(e) {
				// let styles = "padding: 5px 10px; background-color: #550000; color: #ffffff; border: 1px solid #ffffff; border-radius: 5px; font-style: italic; border: 1px solid black; font-size: 1.2em;";
				customLog(e, "Une erreur est survenue sur l'action `"+ contextLinkAction +"` !");
				// console.group("Une erreur est survenue sur l'action `"+ contextLinkAction +"` !");
					// console.trace("%c"+ e, styles);
				// console.groupEnd("Une erreur est survenue sur l'action `"+ contextLinkAction +"` !");
			}
		}
		toggleMenuOff();
		
		return true;
	}

	/* function getValues(select)
    {
		var result = [];
		var options = select && select.options;
		var opt;

		for (var i=0, iLen = options.length; i<iLen; i++) {
			opt = options[i];

			if (opt.selected) {
				result.push(opt.value || opt.text);
			}
		}
		return result;
	} */

	/* function getValue(select)
    {
		var result = [];
		var options = select && select.options;
		var opt;

		for (var i=0, iLen = options.length; i<iLen; i++) {
			opt = options[i];

			if (opt.selected) {
				result.push(opt.value || opt.text);
			}
		}
		return result;
	} */
	
	var contextMenuBuilder = `<!-- context menu -->
		<div id="context-menu" class="card bg-dark radius-10 overflow-hidden context-menu context-menu-normal">
			<div class="card-body">
				<h5 class="card-title mb-0">echo $this_view short_label</h5>
			</div>
			<ul class="list-group list-group-flush context-menu__items">
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="add"><i class="bx bx-add-to-queue fs-16"></i> Ajouter nouveau</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="download"><i class="bx bx-download fs-16"></i> Télécharger</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="zip"><i class="bx bx-archive-in fs-16"></i> Zipper</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="unzip"><i class="bx bx-archive-out fs-16"></i> Dézipper</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="move"><i class="bx bx-move fs-16"></i> Déplacer</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="rename"><i class="bx bx-rename fs-16"></i> Renommer</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="activate"><i class="bx bx-check fs-16"></i> Activer</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="deactivate"><i class="bx bx-x fs-16"></i> Désactiver</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="copy"><i class="bx bx-copy fs-16"></i> Copier</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="paste"><i class="bx bx-paste fs-16"></i> coller</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="edit"><i class="bx bx-edit fs-16"></i> Modifier</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="approve"><i class="bx bx-edit fs-16"></i> Approuver</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="select"><i class="bx bx-checkbox-checked fs-16"></i> Sélectionner</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="selects"><i class="bx bx-select-multiple fs-16"></i> Tout sélectionner</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="insight"><i class="bx bx-show-alt fs-16"></i> Aperçu</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="logascustomer"><i class="bx bx-log-in fs-16"></i> Se connecter en tant que</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="cleanFile"><i class="bx bx-file-blank fs-16"></i> Vider le fichier</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="delete"><i class="bx bx-trash fs-16"></i> Supprimer</a>
				</li>
				<li class="list-group-item btn-light context-menu__item">
					<a href="#" class="context-menu__link" context-action="cancel"><i class="bx bx-trash fs-16"></i> Annuler</a>
				</li>
			</ul>
			<div class="card-body">
				<div class="d-flex">
					<div class="btn-group">
						<a href="#" class="card-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action groupé</a>
						<ul class="dropdown-menu">
							<li class="dropdown-item context-menu__item">
								<a href="#" class="context-menu__link" context-action="massDownload"><i class="bx bx-download fs-16"></i> Tout télécharger</a>
							</li>
							<li class="dropdown-item context-menu__item">
								<a href="#" class="context-menu__link" context-action="massMove"><i class="bx bx-move fs-16"></i> Tout déplacer</a>
							</li>
							<li class="dropdown-item context-menu__item">
								<a href="#" class="context-menu__link" context-action="massRename"><i class="bx bx-rename fs-16"></i> Tout renomer</a>
							</li>
							<li class="dropdown-item context-menu__item">
								<a href="#" class="context-menu__link" context-action="massActivate"><i class="bx bx-check fs-16"></i> Tout activer</a>
							</li>
							<li class="dropdown-item context-menu__item">
								<a href="#" class="context-menu__link" context-action="massDeactivate"><i class="bx bx-x fs-16"></i> Tout Désactiver</a>
							</li>
							<li class="dropdown-item context-menu__item">
								<a href="#" class="context-menu__link" context-action="massSwitchState"><i class="bx bx-intersect fs-16"></i> Tout Activer/Désactiver</a>
							</li>
							<li class="dropdown-item context-menu__item">
								<a href="#" class="context-menu__link" context-action="massDelete"><i class="bx bx-trash fs-16"></i> Tout supprimer</a>
							</li>
						</ul>
					</div>
					<div class="ms-auto btn-group">
						<span class="card-link" onclick="toggleMenuOff()">Fermer</span>
					</div>
				</div>
				
			</div>
		</div>
		<!-- end context menu -->`;

	/**
	 * Run the app.
	 */
	// initContextMenu();

// })();