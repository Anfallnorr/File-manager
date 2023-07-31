/* ****************************************************** */
/* **************** CALCUL TTC / HT / TVA *************** */
/* ****************************************************** */
// Avec la valeur décimale de TVA = taux de TVA/100
function getHt(tax, ttc) {
	// PV HT =  Px TTC / (1+valeur décimale de TVA)
	getTax = tax / 100;
	let getPriceHt = ttc / (1 + getTax);
	
	return getPriceHt.toFixed(2);
}
function getTtc(tax, ht) {
	// PV TTC = Px HT * (1+ valeur décimale de TVA)
	getTax = tax / 100;
	let getPriceTtc = ttc * (1 + getTax);
	
	return getPriceTtc.toFixed(2);
}
function getTva(tax, ht) {
	// TVA = PV HT * valeur décimale de TVA
	getTax = tax / 100;
	let getPriceTva = ttc * getTax;
	
	return getPriceTva.toFixed(2);
}

/* ****************************************************************** */
/* ************************ GET DATE 2 DIGITS *********************** */
/* ****************************************************************** */
function getDate2Digits(date) {
	if( date < 10 ) {
		return '0'+ date;
	}
	return date;
}

/* ****************************************************************** */
/* ************************ GET WEEKEND DATES *********************** */
/* ****************************************************************** */
/* function getWeekendRanges() {
	const currentDate = new Date(); // Date actuelle
	const endDate = new Date(); // Date de fin (2 mois plus tard)
	endDate.setMonth(endDate.getMonth() + 2);
	
	const weekendRanges = [];
	
	while (currentDate <= endDate) {
		// const start = new Date(currentDate);
		const start = new Date(currentDate.getTime());
		let end = new Date(currentDate);
		
		// Trouver le prochain samedi
		// console.log(end.getDay());
		while (end.getDay() !== 6) {
			end.setDate(end.getDate() + 1);
		}
		
		if (end > endDate) {
			break; // Si le prochain samedi est après la date de fin, sortir de la boucle
		}
		
		const weekendRange = {
			start: formatDate(start),
			end: formatDate(end),
		};
		
		weekendRanges.push(weekendRange);
		
		currentDate.setDate(end.getDate() + 86400000); // Passer au jour suivant après la fin du week-end
	}
	
	return weekendRanges;
}

function formatDate(date) {
	const year = date.getFullYear();
	const month = (date.getMonth() + 1).toString().padStart(2, '0');
	const day = date.getDate().toString().padStart(2, '0');
	return `${year}-${month}-${day}`;
}

// Utilisation de la fonction pour récupérer les périodes de week-end
const weekendRanges = getWeekendRanges();

// Affichage des périodes de week-end
weekendRanges.forEach(range => {
	console.log(range);
}); */

/* ****************************************************************** */
/* **************** CLEAR FOM FIELDS EMAIL / PASSWORD *************** */
/* ****************************************************************** */
// Désactiver l'autocomplétion des champs de formulaire
/* function clearFields() {
    let emailField = document.querySelectorAll('[type="email"]'),
		passwordField = document.querySelectorAll('[type="password"]');
	
	if (emailField) {
		Object.entries(emailField).forEach(([key, value]) => {
			value.value = '';
		});
	}
	
	if (passwordField) {
		Object.entries(passwordField).forEach(([key, value]) => {
			value.value = '';
		});
	}
}
setTimeout(() => {
	clearFields();
}, 520); */

/* ***************************************************************** */
/* ************************** DRAGSELECTOR ************************* */
/* ***************************************************************** */
function dragSelector(event) {
	// let eTarget = event.target;
	var div = document.createElement('div'),
		targetElements = [],
		isMouseDown = true;
	
	div.className = 'drag-selector';
	div.style.width = 0 +"px";
	div.style.height = 0 +"px";
	
	document.querySelector('body').append(div);
	
	posx1 = event.pageX;
	posy1 = event.pageY;
	
	div.style.top = posy1 +"px";
	div.style.left = posx1 +"px";
	
	document.addEventListener('mousemove', function dragSelectorMousemove(ev) {
		if (!isMouseDown) return;
		
		var draggableElements = document.querySelectorAll('.draggable'),
			newTargetElements = [];
		
		posx2 = ev.pageX;
		posy2 = ev.pageY;
		
		if ((posx1 - posx2) < 0) {
			div.style.width = Math.round(posx2 - posx1) +"px";
		} else {
			div.style.width = Math.round(posx1 - posx2) +"px";
			div.style.left = posx2 +"px";
		}
		
		if( (posy1 - posy2) < 0 ) {
			div.style.height = Math.round(posy2 - posy1) +"px";
		} else {
			div.style.height = Math.round(posy1 - posy2) +"px";
			div.style.top = posy2 +"px";
		}
		
		draggableElements.forEach(function(element) {
			var rect = element.getBoundingClientRect(),
				elementX = rect.left + window.scrollX,
				elementY = rect.top + window.scrollY,
				elementWidth = element.offsetWidth,
				elementHeight = element.offsetHeight;
			
			var selectionRect = div.getBoundingClientRect(),
				selectionX = selectionRect.left + window.scrollX,
				selectionY = selectionRect.top + window.scrollY,
				selectionWidth = div.offsetWidth,
				selectionHeight = div.offsetHeight;
			
			if (selectionX <= elementX + elementWidth && 
			selectionY <= elementY + elementHeight && 
			selectionX + selectionWidth >= elementX && 
			selectionY + selectionHeight >= elementY) {
				newTargetElements.push(element);
			}
		});
		
		targetElements.forEach(function(element) {
			if (!newTargetElements.includes(element)) {
				var checkbox = element.querySelector('[type="checkbox"]');
				if (checkbox) {
					checkbox.checked = false;
				}
			}
		});
		
		newTargetElements.forEach(function(element) {
			var checkbox = element.querySelector('[type="checkbox"]');
			if (checkbox) {
				checkbox.checked = true;
			}
		});
		
		targetElements = newTargetElements;
	});
	
	document.addEventListener('mouseup', function dragSelectorMouseup() {
		targetElements = [];
		isMouseDown = false;
		
		setTimeout(function() {
			div.remove();
		}, 100);
	});
	
	return true;
}

/* *********************************************************** */
/* **************** SHOW / HIDE / SWITCH MODAL *************** */
/* *********************************************************** */
function showModal(selector) {
	$(selector).modal('show');
}
function hideModal(selector) {
	$(selector).modal('hide');
}
function switchModal(selectorHidden, selectorShown) {
	$(selectorHidden).modal('hide');
	$(selectorShown).modal('show');
}

/* ************************************************************* */
/* *********************** DATE FORMATER *********************** */
/* ************************************************************* */
// dateFormater("19/05/2023 15:30");
// console.log(dateFormater());
// console.log(dateFormater("19/05/2023 15:30"));
/* function dateFormater(dateOrigine) {
	if (typeof dateOrigine != "undefined" && dateOrigine != "") {
		// Divise la date en parties (jour, mois, année, heure, minute)
		var partiesDate = dateOrigine.split(" "),
			dateParts = partiesDate[0].split("/"),
			// heureParties = partiesDate[1].split(":");
			hourParts = partiesDate[1].split(":");
		
		// Crée un nouvel objet Date en utilisant les parties extraites
		var newDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0], hourParts[0], hourParts[1]);
		
		// Formate la date au format "YYYY-MM-DD HH:mm"
		var dateFormatee = newDate.toISOString().slice(0, 16).replace("T", " ");
		
		return dateFormatee;
	} else {
		return "";
	}
} */

/* ********************************************************* */
/* ********************* GET ALERT FILE ******************** */
/* ********************************************************* */
// function displayAlert(file, message, type = "success", icon = "bx bx-check-circle") {
function getAlert(message, type = "success", icon = "bx bx-check-circle") {
	return fetch("/templates/tpls/alert.html")
	.then(response => response.text())
	.then(html => {
		html = html.replace(/{{type}}/g, type);
		html = html.replace(/{{message}}/g, message);
		html = html.replace(/{{icon}}/g, icon);
		
		return html;
	});
}

/* ******************************************************************************************* */
/* ********************** REMOVE / ADD BACKSPACE | ACCENT | SPECIALCHARS ********************* */
/* ******************************************************************************************* */
// removeAccents("Café au lait"); // affiche "Cafe au lait"
function removeAccents(text) {
	return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

// removeSpecialChar("Bonjour ! Comment ça va ?") // affiche "Bonjour Comment a va"
function removeSpecialChar(text) {
	let newText = text.replace(/[^\w\s]|_/g, "");
	
	// Supprimer le symbole en fin de chaîne s'il y a
	if (newText.slice(-1) === " ") {
		newText = newText.slice(0, -1);
	}
	
	return newText.replace("  ", " ");
}

// removeBackspace("Hello World !", "+", true);// affiche "Hello+World+!"
function removeBackspace(text, symbol, pregReplace = false) {
	let newText = "";
	
	if (pregReplace === true) {
		// Supprimer les caractères spéciaux et les accents
		newText = text.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
		newText = newText.replace(/[^\w\s]|_/g, "");
		
		// Supprimer les symboles spécifiés
		const symbolsToRemove = [",", "'", '"', ";", ":", "-", "_", ".", "(", ")", "[", "]", "+", "="];
		symbolsToRemove.forEach((symbolToRemove) => {
			newText = newText.split(symbolToRemove).join("");
		});
	} else {
		newText = text;
	}
	
	newText = newText.split(" ").join(symbol);
	
	// Supprimer le symbole en début de chaîne s'il y a
	if (newText.indexOf(symbol) === 0) {
		newText = newText.slice(1);
	}
	
	// Supprimer le symbole en fin de chaîne s'il y a
	if (newText.slice(-1) === symbol) {
		newText = newText.slice(0, -1);
	}
	
	return newText;
}

// addBackspace("Hello+World+!", "+"); // affiche "Hello World !"
function addBackspace(text, symbol) {
	let newText = text.replace(new RegExp(`\\${symbol}`, 'g'), " ");
	return newText;
}

/* ***************************************************** */
/* ********************** CLEAN CACHE ********************* */
/* ***************************************************** */
function cleanCache() {
	// caches.keys().then(function(names) {
		// for (let name of names) {
			// caches.delete(name);
		// }
	// });
}

/* ***************************************************** */
/* ******************* CUSTOM CONSOLE ****************** */
/* ***************************************************** */
// customLog("qsfge", "Une erreur est survenue sur la fonction `sessionTrackTabs` !");
function customLog(e, group) {
	let styles = "padding: 5px 10px; background-color: #550000; color: #ffffff; border: 1px solid #ffffff; border-radius: 5px; font-style: italic; border: 1px solid black; font-size: 1.2em;";
	
	console.group(group);
		console.trace("%c"+ e, styles);
	console.groupEnd(group);
}

/* *********************************************************** */
/* ********************** GET CONTROLLER ********************* */
/* *********************************************************** */
// console.log(getController());
function getController() {
	let location = window.location.pathname;
	return location.split("/")[1];
}

/* ***************************************************** */
/* ********************** GET VIEW ********************* */
/* ***************************************************** */
// console.log(getView());
function getView() {
	let location = window.location.pathname;
	return location.split("/")[2];
}

/* ************************************************************* */
/* ********************* SORT FILES BY TYPE ******************** */
/* ************************************************************* */
// const files = [
	// { name: 'file1.jpg', type: 'image/jpeg', size: 1024, lastModified: 1617034502000 },
	// { name: 'file2.png', type: 'image/png', size: 2048, lastModified: 1617034502000 },
	// { name: 'file3.mp3', type: 'audio/mpeg', size: 3072, lastModified: 1617034502000 },
	// { name: 'file4.ogg', type: 'audio/ogg', size: 4096, lastModified: 1617034502000 },
	// { name: 'file5.docx', type: 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', size: 5120, lastModified: 1617034502000 },
	// { name: 'file6.pdf', type: 'application/pdf', size: 6144, lastModified: 1617034502000 }
// ];
// const sortedFiles = sortFilesByType(files);
// console.log(sortedFiles);
function sortFilesByType(files) {
	// const sortedFiles = {
		// images: [],
		// audios: [],
		// videos: [],
		// documents: [],
		// others: []
	// };

	// for (const file of files) {
		// const fileInfo = {
			// name: file.name,
			// size: file.size,
			// lastModified: file.lastModified
		// };

		// if (file.type.startsWith('image/')) {
			// sortedFiles.images.push(fileInfo);
		// } else if (file.type.startsWith('audio/')) {
			// sortedFiles.audios.push(fileInfo);
		// } else if (file.type.startsWith('video/')) {
			// sortedFiles.videos.push(fileInfo);
		// } else if (file.type.startsWith('application/pdf') || file.type.startsWith('application/msword') || file.type.startsWith('application/vnd.ms-excel') || file.type.startsWith('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') || file.type.startsWith('application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
			// sortedFiles.documents.push(fileInfo);
		// } else {
			// sortedFiles.others.push(fileInfo);
		// }
	// }

	// return sortedFiles;
}

/* **************************************************************** */
/* ********************** IMAGE BASE64 > FILE ********************* */
/* **************************************************************** */
// Fonction pour convertir une représentation d'image au format base64 en un objet File
function dataUrlToFile(dataURL, filename) {
	// var arr = dataURL.split(',');
	// var mime = arr[0].match(/:(.*?);/)[1];
	// var bstr = atob(arr[1]);
	// var n = bstr.length;
	// var u8arr = new Uint8Array(n);
	
	// while (n--) {
		// u8arr[n] = bstr.charCodeAt(n);
	// }
	
	// return new File([u8arr], filename, { type: mime });
}

/* *************************************************************** */
/* ********************** GET IMAGE FROM URL ********************* */
/* *************************************************************** */
// La fonction getImageFromURL permet de charger une image à partir 
// d'une URL donnée et de la transformer en objet img HTML. 
// Le paramètre classImg permet d'ajouter une classe CSS à l'élément img généré.
function getImageFromUrl(url, classImg = "") {
	url = window.location.origin + url;
	
	return new Promise((resolve, reject) => {
		const img = new Image();
		img.crossOrigin = "Anonymous";
		img.onload = () => {
			const canvas = document.createElement("canvas");
			const ctx = canvas.getContext("2d");
			canvas.width = img.width;
			canvas.height = img.height;
			ctx.drawImage(img, 0, 0);
			
			const dataURL = canvas.toDataURL("image/png");
			const imgElement = document.createElement("img");
			imgElement.src = dataURL;
			imgElement.className = classImg;
			resolve(imgElement);
		};
		img.onerror = () => {
			reject(new Error("Failed to load image"));
		};
		img.src = url;
	});
}