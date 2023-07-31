/* ********************************************** */
/* ****************** DROPZONE ****************** */
/* ********************************************** */
var formDropzone = $('form#dropzone_form'),
	locationPathname = window.location.pathname;
	
if( formDropzone.length > 0 ) {
	var maxSizeFolder = document.getElementById('max_size_folder').value;
	var dropzoneForm = new Dropzone("#dropzone_form", {
		dictCancelUpload: "Annuler le téléchargement",
		dictRemoveFile: "Effacer le fichier",
		url: locationPathname +"?action=uploadAjax&resize=1&max_size_folder="+ maxSizeFolder,
		paramName: "file_documents",
		maxFilesize: 500, // MB
		maxFiles: 200,
		parallelUploads: 1,
		addRemoveLinks: true,
		uploadMultiple: true,
		resizeQuality: 1
	});

	dropzoneForm.on("maxfilesexceeded", function dropzoneMaxfilesexceeded(file) {
		this.removeFile(file);
		formDropzone.removeClass('file-droped');
	});

	dropzoneForm.on("error", function dropzoneError(file, message) {
		getNotify(message, "danger");
	});

	dropzoneForm.on("success", function dropzoneSuccess(file, response) {
		response = JSON.parse(response);
		
		var waiting = false;
		
		$.each(response.src, function(index, element) {
			if( response.height[index] >= 9000 || response.width[index] >= 9000 ) {
				waiting = true;
				// Créez un élément <canvas>
				var canvas = document.createElement('canvas');
				var context = canvas.getContext('2d');
				
				// Chargez l'image
				var image = new Image();
				image.src = atob(element);
				
				// Attendre que l'image soit chargée
				image.onload = function() {
					// Calculer les dimensions de l'image redimensionnée tout en conservant le ratio
					var maxWidth = 800;
					var maxHeight = image.height * maxWidth / image.width;
					
					// Définir les dimensions du canvas pour correspondre à l'image redimensionnée
					canvas.width = maxWidth;
					canvas.height = maxHeight;
					
					// Dessinez l'image redimensionnée sur le canvas
					context.drawImage(image, 0, 0, maxWidth, maxHeight);
					
					// Convertir le canvas en une représentation de l'image au format base64
					var imageDataURL = canvas.toDataURL(response.type[index]);
					var imageFile = dataUrlToFile(imageDataURL, response.name[index]);
					
					// Effectuer une requête AJAX pour envoyer l'image au serveur
					var formData = new FormData();
					
					formData.append('file_documents[]', imageFile);
					formData.append('max_size_folder', maxSizeFolder);
					formData.append('file_path', $('#file_path').val());
					
					$.ajax({
						type: 'post',
						url: locationPathname +"?action=uploadAjax&resize=0&max_size_folder="+ maxSizeFolder,
						data: formData,
						contentType: false,
						processData: false,
						dataType: "json"
					})
					.done(function(success) {
						getNotify("L'image "+ success.name[index] +" à été miniaturisée : "+ success.width[index] +" x "+ success.height[index] +" !", "success", "auto", "normal");
					})
					.fail(function(xhr, status, error) {
						getNotify(error, "danger");
					});
				};
			}
		});
			
		if( document.getElementById('notification') ) {
			document.getElementById('notification').classList.add("d-none");
		}
		
		if( response[1] == "warning" || response[1] == "danger" ) {
			getNotify(response[0], response[1], "auto", "normal");
		} else {
			let personnalFolder = document.getElementById('file_path').value,
				type = '<i class="bx bxs-check-circle"></i>',
				arrExt = Array("jpg", "jpeg", "png", "bmp", "gif", "svg", "ico", "tif", "webp",
				"doc", "docx", "odf", "odp", "ods", "odt", "otf", "pdf", "ppt", "csv", "pps", "pptx", "xls", "xlsx", "rtf", "txt",
				"mp3", "wav", "wave", "wma", "aac", "mid", "midi", "ogg",
				"mp4", "mpg", "mpeg", "mov", "3gp", "avi");
			
			for( var i = 0; i < response.name.length; i++ ) {
				var tableGrid = `<div class="col-12 col-lg-4 task">
					<div class="card bg-light _shadow-none border radius-15">
						<div class="card-body">
							<div class="d-flex align-items-center">`;
								if( Array("image/jpeg", "image/jpg", "image/png").includes(response.type[i]) ) {
									tableGrid += `<div class="bi-icon-box"><i class="bi bi-file-earmark-text fs-35"></i></div>`;
								} else {
									tableGrid += `<div class="bi-icon-box"><i class="bi bi-file-earmark-text"></i></div>`;
								}
								tableGrid += `<div class="ms-auto">
									<div class="row">
										<div class="col-6">
											<button class="btn py-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
												<i class="bi bi-three-dots-vertical me-0"></i>
											</button>
											<ul class="dropdown-menu dropdown-folder">
												<li><a href="/datas/data`+ personnalFolder +`?action=download&path=`+ personnalFolder +`&file=`+ response.name[i] +`&type=file" class="dropdown-item download-item" context="download"><i class="bi bi-download"></i> `+ DATA_DOWNLOAD +`</a></li>
												<li><a href="#" class="dropdown-item rename-item" data-bs-toggle="modal" data-bs-target="#ajax_modal_rename_`+ i +`" context="rename"><i class="bi bi-input-cursor-text"></i> `+ DATA_RENAME +`</a></li>
												<li><div class="dropdown-divider mb-1"></div></li>
												<li><a href="/datas/data`+ personnalFolder +`?action=remove&path=`+ personnalFolder +`&file=`+ response.name[i] +`&type=file" class="dropdown-item delete-item" onclick="return confirm(\'`+ JSARE_YOU_SURE_YOU_WANT_TO_DELETE +` `+ response.name[i] +` ?\');" context="delete"><i class="bi bi-trash"></i> `+ DATA_DELETE +`</a></li>
											</ul>
										</div>
										<div class="col-6">
											<label class="form-check-label _right-checkbox">
												<input type="checkbox" name="select_file[file][]" value="`+ response.name[i] +`" data-type="file" class="form-check-input fs-22 mt-0" />
											</label>
										</div>
									</div>
								</div>
							</div>
							<h6 class="mb-1 mt-3">`+ response.name[i] +`</h6>
							<small>`+ Math.round(response.size[i] / 1000) +` Ko</small>
						</div>
					</div>
				</div>`;
				$('#ajax_upload_result > .row').append(tableGrid);
				
				var modalFile = `<div class="modal fade" id="ajax_modal_rename_`+ i +`" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">`+ DATA_FILES_LIST_RENAME_A_FILE +`</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" title="`+ JSCLOSED +`" aria-label="`+ JSCLOSED +`"></button>
							</div>
							<div class="modal-body">
								<div class="block-form d-none">
									<input name="file_renamer[path][]" type="hidden" id="ajax_file_renamer_path_`+ i +`" value="`+ personnalFolder +`/`+ response.name[i] +`">
								</div>
								<div class="col-md-12">
									<label for="ajax_file_renamer_`+ i +`" class="form-label">`+ DATA_RENAME +`</label>
									<input name="file_renamer[file][]" type="text" id="ajax_file_renamer_`+ i +`" class="form-control mb-3" value="" placeholder="`+ response.name[i].split('.')[0] +`" autocomplete="off">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="`+ JSCANCEL +`"><i class="bi bi-arrow-left-circle"></i> `+ JSCANCEL +`</button>
								<button type="submit" class="btn btn-success" title="`+ DATA_RENAME +`"><i class="bi bi-input-cursor-text"></i> `+ DATA_RENAME +`</button>
							</div>
						</div>
					</div>
				</div>`;
				$('#ajax_upload_result > .row').append(modalFile);
			}
			
			getNotify(response[0], response[1]);
			if( waiting == true ) {
				getNotify("Veuillez patientez quelques secondes, l'image est en cours de miniaturisation !", "warning", "auto", "normal");
			}
		}
	});

	dropzoneForm.on("complete", function dropzoneComplete(file) {
		this.removeFile(file);
		formDropzone.removeClass('file-droped');
	});
}
