/* ***************************************************************** */
/* ************************** DRAGSELECTOR ************************* */
/* ***************************************************************** */
function dragSelector(event)
{
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
		
		if ((posy1 - posy2) < 0) {
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

/* ********************************************************* */
/* ********************* GET ALERT FILE ******************** */
/* ********************************************************* */
function getAlert(theme, message, type = "success", icon = "bx bx-check-circle")
{
	return fetch("/templates/"+ theme +"/tpls/alert.html")
	.then(response => response.text())
	.then(html => {
		html = html.replace(/{{type}}/g, type);
		html = html.replace(/{{message}}/g, message);
		html = html.replace(/{{icon}}/g, icon);
		
		return html;
	});
}

/* ***************************************************** */
/* ******************* CUSTOM CONSOLE ****************** */
/* ***************************************************** */
function customLog(e, group)
{
	let styles = "padding: 5px 10px; background-color: #550000; color: #ffffff; border: 1px solid #ffffff; border-radius: 5px; font-style: italic; border: 1px solid black; font-size: 1.2em;";
	
	console.group(group);
		console.trace("%c"+ e, styles);
	console.groupEnd(group);
}

/* **************************************************************** */
/* ********************** IMAGE BASE64 > FILE ********************* */
/* **************************************************************** */
function dataUrlToFile(dataURL, filename)
{
	var arr = dataURL.split(',');
	var mime = arr[0].match(/:(.*?);/)[1];
	var bstr = atob(arr[1]);
	var n = bstr.length;
	var u8arr = new Uint8Array(n);
	
	while (n--) {
		u8arr[n] = bstr.charCodeAt(n);
	}
	
	return new File([u8arr], filename, { type: mime });
}

/* *************************************************************** */
/* ********************** GET IMAGE FROM URL ********************* */
/* *************************************************************** */
function getImageFromUrl(url, classImg = "")
{
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
