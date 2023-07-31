/* ********************************************** */
/* ****************** DROPZONE ****************** */
/* ********************************************** */
// import Dropzone from "dropzone";

var avatarWidth = $('#avatar_upload').data('width'), /* 500 */
	avatarHeight = $('#avatar_upload').data('height'); /* 500 */
	/*
LISTE EVENEMENTS DROPZONE
https://github.com/dropzone/dropzone/blob/main/src/options.js#L574
*/
// Dropzone.autoDiscover = false;
var image = $('#insight_profile_img'),
	imageCrop = $('#crop_profile_img'),
	imageAvatar = $('#user_avatar'),
	imageProfile = $('#profile_img'),
	formDropzone = $('form#avatar_upload'),
	imageName = $(image).attr('src').substring($(image).attr('src').lastIndexOf('/')+1);

// console.log(imageName);

var avatarUpload = new Dropzone("#avatar_upload", {
	// url: "/upload",
	paramName: "file", // Le `name` qui sera utilisé pour transférer le fichier
	maxFilesize: 20, // MB
	maxFiles: 1,
	acceptedFiles: "image/jpg,image/jpeg",
	// dictDefaultMessage: "Déposer des fichiers ici pour les télécharger",
	addRemoveLinks: true,
	uploadMultiple: false,
	// thumbnailWidth: 250,
	// thumbnailHeight: 250,
	// resizeWidth: avatarWidth,
	// resizeHeight: avatarHeight,
	// resizeMethod: "crop",
	// resizeQuality: 1,
	// capture: "camera",
});

/* Ceux-ci sont explicites et concernent simplement le DragnDrop. */
/* avatarUpload.on("dragstart", function dropzoneDragstart(e) {
	formDropzone.addClass('dragenter');
});
avatarUpload.on("dragend", function dropzoneDragend(e) {
	formDropzone.addClass('dragenter');
});
avatarUpload.on("dragover", function dropzoneDragover(e) {
	formDropzone.addClass('dragenter');
});
avatarUpload.on("dragenter", function dropzoneDragenter(e) {
	formDropzone.addClass('dragenter');
});
avatarUpload.on("dragleave", function dropzoneDragleave(e) {
	formDropzone.removeClass('dragenter');
});
avatarUpload.on("drop", function dropzoneDrop(e) {
	formDropzone.removeClass('dragenter');
}); */

// avatarUpload.on("addedfile", function dropzoneAddedfile(file) {
	/* Appelé lorsqu'un fichier est ajouté à la file d'attente
	Receives `file` */
	// console.log(file);
// });

avatarUpload.on("processing", function dropzoneProcessing(file) {
	/* Appelé lorsqu'un fichier est traité. Puisqu'il y a un signal, tous les fichiers ajoutés ne sont pas traités immédiatement.
	Receives `file` */
	console.log(file);
    // Récupérez les coordonnées du recadrage
});

// avatarUpload.on("sending", function dropzoneSending(file, xhr, formData) {
	/* Appelé juste avant l'envoi du fichier. Obtient l'objet `xhr` comme deuxième paramètre, 
	vous pouvez donc le modifier (par exemple pour ajouter un jeton CSRF) et un objet `formData` 
	pour ajouter des informations supplémentaires. */
	// console.log(file);
	// console.log(xhr);
	// console.log(formData);
// });

// avatarUpload.on("canceled", function dropzoneCanceled(file) {
	// console.log(file);
// });

avatarUpload.on("maxfilesexceeded", function dropzoneMaxfilesexceeded(file) {
	// getNotify("Vous n'êtes pas autorisé à choisir plus d'un fichier !", "warning");
	this.removeFile(file);
	formDropzone.removeClass('file-droped');
});

// avatarUpload.on("error", function dropzoneError(file, message) {
	// /* Appelé chaque fois qu'une erreur se produit
	// Receives `file` and `message` */
	// getNotify("Vous n'êtes pas autorisé à choisir plus d'un fichier !", "warning");
// });

avatarUpload.on("success", function dropzoneSuccess(file, response) {
	// /* Lorsque le téléchargement complet est terminé et réussi
	// Receives `file`
	// Mettre à jour l'image avec le fichier téléchargé */
	response = JSON.parse(response);
	
	if( typeof response.avatar != "undefined" ) {
		image.attr('src', response.avatar);
		// imageCrop.attr('src', response.avatar);
		// imageAvatar.attr('src', response.avatar);
		// imageProfile.attr('src', response.avatar);
		
		changeCropperImg(file);
		
		getNotify("Enregistrement réussi", "success");
	} else {
		getNotify("L'eregistrement a échoué", "warning");
		console.log(response);
	}
});

avatarUpload.on("complete", function dropzoneComplete(file) {
	// /* Lorsque le téléchargement est terminé, soit avec succès, soit avec une erreur.
	// Receives `file` */
	this.removeFile(file);
	formDropzone.removeClass('file-droped');
});
/*
Dropzone.options.avatarUpload = {
	// url: "/customers/profile",
	paramName: "file", // The name that will be used to transfer the file
	maxFilesize: 20, // MB
	maxFiles: 1,
	// addRemoveLinks: true,
	uploadMultiple: false,
	// thumbnailWidth: 250,
	// thumbnailHeight: 250,
	// resizeWidth: avatarWidth,
	// resizeHeight: avatarHeight,
	resizeMethod: "crop",
	resizeQuality: 1,
	// capture: "camera",
	acceptedFiles: "image/jpg,image/jpeg",
	// removedfile: function(file) {
		// file.previewElement.remove();
	// },
	init: function() {
		// alert("toto");
		var image = $('#insight_profile_img'),
			imageCrop = $('#crop_profile_img'),
			imageAvatar = $('#user_avatar'),
			imageProfile = $('#profile_img'),
			formDropzone = $('form#avatar_upload');
		
		this.on("success", function(file, response) {
			// Mettre à jour l'image avec le fichier téléchargé
			response = JSON.parse(response);
			// formDropzone.addClass('file-droped');
			// console.log(file);
			
			if( typeof response.avatar != "undefined" ) {
				// inputImage = document.getElementById('inputImage');
				
				image.attr('src', response.avatar);
				imageCrop.attr('src', response.avatar);
				imageAvatar.attr('src', response.avatar);
				imageProfile.attr('src', response.avatar);
				
				// cropper = new Cropper(imageCrop[0], {});
				changeCropperImg(file);
				
				getNotify("Enregistrement réussi", "success");
			} else {
				getNotify("L'eregistrement a échoué", "warning");
				console.log(response);
			}
		});
		this.on("maxfilesexceeded", function(file) {
			getNotify("Vous n'êtes pas autorisé à choisir plus d'un fichier !", "warning");
			this.removeFile(file);
			formDropzone.removeClass('file-droped');
		});
		this.on("complete", function(file) {
			this.removeFile(file);
			formDropzone.removeClass('file-droped');
		});
		// this.on("dragover", function() {
			// formDropzone.addClass('dragenter');
		// });
		// this.on("dragenter", function() {
			// formDropzone.addClass('dragenter');
		// });
		// this.on("dragleave", function() {
			// formDropzone.removeClass('dragenter');
		// });
	}
};
// Dropzone.options.avatarUpload.init();
*/
/* ********************************************* */
/* ****************** CROPPER ****************** */
/* ********************************************* */
'use strict';
// import 'cropperjs/dist/cropper.css';
// import Cropper from 'cropperjs';

var Cropper = window.Cropper;
var URL = window.URL || window.webkitURL;
var formAction = formDropzone.attr('action');

var container = document.querySelector('.img-container');
// var image = container.getElementsByTagName('img').item(0);
var insightProfileImg = container.getElementsByTagName('img').item(0);
// var insightProfileImg = document.getElementById('crop_profile_img');

var download = document.getElementById('download');
var actions = document.getElementById('actions');

var dataX = $('#cropper_info .crop-detail-x')[0];
var dataY = $('#cropper_info .crop-detail-y')[0];
var dataHeight = $('#cropper_info .crop-detail-height')[0];
var dataWidth = $('#cropper_info .crop-detail-width')[0];
var dataRotate = $('#cropper_info .crop-detail-rotate')[0];
// var dataScaleX = $('#cropper_info .crop-detail-scale-x')[0];
// var dataScaleY = $('#cropper_info .crop-detail-scale-y')[0];

var options = {
	minContainerWidth: 400,
	minContainerHeight: 400,
	maxContainerHeight: 400,
	// minCanvasWidth: 500,
	// minCanvasHeight: 500,
	minCropBoxWidth: 110,
	minCropBoxHeight: 110,
	// viewMode: 1, // 0, 1, 2, 3
	dragMode: 'crop', // crop, move, none
	// responsive: true, // true, false
	// restore: true, // true, false
	autoCropArea: 1,
	// modal: false,
	// guides: false,
	// highlight: false,
	// cropBoxMovable: false,
	// cropBoxResizable: false,
	// zoomOnTouch: false,
	// zoomOnWheel: false,
	toggleDragModeOnDblclick: false,
	aspectRatio: 1 / 1,
	preview: '#img_preview',
	// ready: function (e) {
		// console.log(e.type);
	// },
	// cropstart: function (e) {
		// console.log(e.type, e.detail.action);
	// },
	// cropmove: function (e) {
		// console.log(e.type, e.detail.action);
	// },
	// cropend: function (e) {
		// console.log(e.type, e.detail.action);
	// },
	crop: function (e) {
		var data = e.detail;
		
		// console.log(e.type);
		dataX.value = Math.round(data.x);
		dataY.value = Math.round(data.y);
		dataHeight.value = Math.round(data.height);
		dataWidth.value = Math.round(data.width);
		dataRotate.value = typeof data.rotate !== 'undefined' ? data.rotate : "";
		// dataScaleX.value = typeof data.scaleX !== 'undefined' ? data.scaleX : "";
		// dataScaleY.value = typeof data.scaleY !== 'undefined' ? data.scaleY : "";
	},
	// zoom: function (e) {
		// console.log(e.type, e.detail.ratio);
	// }
};

var cropper = new Cropper(insightProfileImg, options);
var originalImageURL = insightProfileImg.src;
var uploadedImageType = "image/jpeg";
var uploadedImageName = "cropped.jpg";
var uploadedImageURL;
/**/
$('#saveCroppedImg').on('click', function () {   
	// var croppedimage = cropper.getCroppedCanvas().toDataURL("image/png");
	// console.log(croppedimage);
	cropper.getCroppedCanvas().toBlob((blob) => {
	// cropper.getCroppedCanvas().toDataURL((blob) => {
		const formData = new FormData();
		
		// Pass the image file name as the third parameter if necessary.
		// formData.append('croppedImage', blob, imageName);
		formData.append('file', blob);
		// console.log(formData);
		
		// Use `jQuery.ajax` method for example
		$.ajax(formAction, {
			method: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success(response) {
				response = JSON.parse(response);
				
				console.log('Upload success');
				image.attr('src', response.avatar);
				imageCrop.attr('src', response.avatar);
				imageAvatar.attr('src', response.avatar);
				imageProfile.attr('src', response.avatar);
				
				getNotify("Enregistrement réussi", "success");
			},
			error() {
				// console.log('Upload error');
				getNotify("Upload error", "danger");
			},
		});
	}, 'image/jpg');
});

$('#editAvatar2 [data-method="getCroppedCanvas"]').click(function(event) {
	var e = event || window.event;
	var target = e.target || e.srcElement;
	var cropped;
	var result;
	var input;
	
	/* if( target === this || target.disabled || target.className.indexOf('disabled') > -1 ) {
		return;
	} */
	
	var data = {
		method: target.getAttribute('data-method'),
		target: target.getAttribute('data-target'),
		option: target.getAttribute('data-option') || undefined,
		secondOption: target.getAttribute('data-second-option') || undefined
	};
	
	cropped = cropper.cropped;
	console.log(data);
	
	if( data.method ) {
		if( typeof data.target !== 'undefined' ) {
			input = document.querySelector(data.target);
			
			if( !target.hasAttribute('data-option') && data.target && input ) {
				try {
					data.option = JSON.parse(input.value);
				} catch (e) {
					console.log(e.message);
				}
			}
		}
		
		try {
			data.option = JSON.parse(data.option);
		} catch (e) {
			console.log(e.message);
		}
		
		if( uploadedImageType === "image/jpeg" ) {
			if( !data.option ) {
				data.option = {};
			}
			
			data.option.fillColor = "#fff";
		}
		
		result = cropper[data.method](data.option, data.secondOption);
		
		if( result ) {
			// Bootstrap's Modal
			// $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);
			$('#getCroppedCanvasModal .modal-body').html(result);
			
			if(!download.disabled) {
				download.download = uploadedImageName;
				download.href = result.toDataURL(uploadedImageType);
			} /* */
		}
	}
});
/*
'use strict';
// Tooltip
$('[data-toggle="tooltip"]').tooltip();
*/
// Buttons
if(!document.createElement('canvas').getContext) {
	$('button[data-method="getCroppedCanvas"]').prop('disabled', true);
}

if(typeof document.createElement('cropper').style.transition === 'undefined') {
	$('button[data-method="rotate"]').prop('disabled', true);
	$('button[data-method="scale"]').prop('disabled', true);
}
/**/
// Download
if(typeof download.download === 'undefined') {
	download.className += " disabled";
	download.title = "Your browser does not support download";
}

// Options
actions.querySelector('.docs-toggles').onchange = function (event) {
	var e = event || window.event;
	var target = e.target || e.srcElement;
	var cropBoxData;
	var canvasData;
	var isCheckbox;
	var isRadio;
	
	if(!cropper) {
		return;
	}
	
	if(target.tagName.toLowerCase() === "label") {
		target = target.querySelector('input');
	}
	
	isCheckbox = target.type === "checkbox";
	isRadio = target.type === "radio";
	
	if(isCheckbox || isRadio) {
		if (isCheckbox) {
			options[target.name] = target.checked;
			cropBoxData = cropper.getCropBoxData();
			canvasData = cropper.getCanvasData();
			
			options.ready = function () {
			console.log('ready');
			cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
			};
		} else {
			options[target.name] = target.value;
			options.ready = function () {
				console.log('ready');
			};
		}
		
		// Restart
		cropper.destroy();
		cropper = new Cropper(insightProfileImg, options);
	}
};

// Methods
actions.querySelector('.docs-buttons').onclick = function (event) {
	var e = event || window.event;
	var target = e.target || e.srcElement;
	var cropped;
	var result;
	var input;
	var data;
	
	if( !cropper ) {
		return;
	}
	
	while(target !== this) {
		if(target.getAttribute('data-method')) {
			break;
		}
		
		target = target.parentNode;
	}
	
	if( target === this || target.disabled || target.className.indexOf('disabled') > -1 ) {
		return;
	}
	
	data = {
		method: target.getAttribute('data-method'),
		target: target.getAttribute('data-target'),
		option: target.getAttribute('data-option') || undefined,
		secondOption: target.getAttribute('data-second-option') || undefined
	};
	
	cropped = cropper.cropped;
	
	if( data.method ) {
		if( typeof data.target !== 'undefined' ) {
			input = document.querySelector(data.target);
			
			if( !target.hasAttribute('data-option') && data.target && input ) {
				try {
					data.option = JSON.parse(input.value);
				} catch (e) {
					console.log(e.message);
				}
			}
		}
		
		switch (data.method) {
			case 'rotate':
				if( cropped && options.viewMode > 0 ) {
					cropper.clear();
				}
				
				break;
			
			case 'getCroppedCanvas':
				try {
					data.option = JSON.parse(data.option);
				} catch (e) {
					console.log(e.message);
				}
				
				if( uploadedImageType === "image/jpeg" ) {
					if( !data.option ) {
						data.option = {};
					}
					
					data.option.fillColor = "#fff";
				}
				
				break;
		}

		result = cropper[data.method](data.option, data.secondOption);
		// console.log(result);

		switch(data.method) {
			case 'rotate':
				if( cropped && options.viewMode > 0 ) {
					cropper.crop();
				}
				
				break;
			
			case 'scaleX':
			case 'scaleY':
				target.setAttribute('data-option', -data.option);
				break;
			
			case 'getCroppedCanvas':
				if( result ) {
					// Bootstrap's Modal
					// $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);
					$('#getCroppedCanvasModal .modal-body').html(result);
					
					if(!download.disabled) {
						download.download = uploadedImageName;
						download.href = result.toDataURL(uploadedImageType);
					} /* */
				}
				
				break;
			
			case 'destroy':
				cropper = null;
				
				if( uploadedImageURL ) {
					URL.revokeObjectURL(uploadedImageURL);
					uploadedImageURL = '';
					insightProfileImg.src = originalImageURL;
				}
				
				break;
		}
		
		if( typeof result === 'object' && result !== cropper && input ) {
			try {
				input.value = JSON.stringify(result);
			} catch (e) {
				console.log(e.message);
			}
		}
	}
};

document.body.onkeydown = function (event) {
	var e = event || window.event;
	
	// if( e.target !== this || !cropper || this.scrollTop > 300 ) {
	if( e.target !== this || !cropper ) {
		return;
	}
	// console.log(e.keyCode);
	
	switch(e.keyCode) {
		case 37:
			e.preventDefault();
			cropper.move(-1, 0);
			break;
		
		case 38:
			e.preventDefault();
			cropper.move(0, -1);
			break;
		
		case 39:
			e.preventDefault();
			cropper.move(1, 0);
			break;
		
		case 40:
			e.preventDefault();
			cropper.move(0, 1);
			break;
	}
};

// Import image
// var inputImage = document.getElementById('inputImage');
// var inputImage2 = document.getElementById('crop_profile_img2');

function changeCropperImg(newFile) {
	// if( URL ) {
		// inputImage.onchange = function () {
			var files = newFile;
			var file;
			
			console.log(newFile);
			
			if( files ) {
				file = files;
				
				if( /^image\/\w+/.test(file.type) ) {
					uploadedImageType = file.type;
					uploadedImageName = file.name;
					
					if( uploadedImageURL ) {
						URL.revokeObjectURL(uploadedImageURL);
					}
					
					insightProfileImg.src = uploadedImageURL = URL.createObjectURL(file);
					// console.log(insightProfileImg);
					
					if( cropper ) {
						cropper.destroy();
					}
					
					cropper = new Cropper(insightProfileImg, options);
					newFile = null;
				} else {
					window.alert("Please choose an image file.");
				}
			}
		// };
	// } else {
		// inputImage.disabled = true;
		// inputImage.parentNode.className += ' disabled';
	// }
}
/*
if( URL ) {
	inputImage.onchange = function () {
		var files = this.files;
		var file;
		
		if( files && files.length ) {
			file = files[0];
			
			if( /^image\/\w+/.test(file.type) ) {
				uploadedImageType = file.type;
				uploadedImageName = file.name;
				
				if( uploadedImageURL ) {
					URL.revokeObjectURL(uploadedImageURL);
				}
				
				insightProfileImg.src = uploadedImageURL = URL.createObjectURL(file);
				
				if( cropper ) {
					cropper.destroy();
				}
				
				cropper = new Cropper(insightProfileImg, options);
				inputImage.value = null;
			} else {
				window.alert('Please choose an image file.');
			}
		}
	};
} else {
	inputImage.disabled = true;
	inputImage.parentNode.className += ' disabled';
}
*/
