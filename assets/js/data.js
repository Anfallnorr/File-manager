// if( $("#show_hide_password").length > 0 ) {
	// $("#show_hide_password a").on('click', function (event) {
		// event.preventDefault();
		// if ($('#show_hide_password input').attr("type") == "text") {
			// $('#show_hide_password input').attr('type', 'password');
			// $('#show_hide_password i').addClass("bx-hide");
			// $('#show_hide_password i').removeClass("bx-show");
		// } else if ($('#show_hide_password input').attr("type") == "password") {
			// $('#show_hide_password input').attr('type', 'text');
			// $('#show_hide_password i').removeClass("bx-hide");
			// $('#show_hide_password i').addClass("bx-show");
		// }
	// });
// }
// if( $("#show_hide_confirmed_password").length > 0 ) {
	// $("#show_hide_confirmed_password a").on('click', function (event) {
		// event.preventDefault();
		// if ($('#show_hide_confirmed_password input').attr("type") == "text") {
			// $('#show_hide_confirmed_password input').attr('type', 'password');
			// $('#show_hide_confirmed_password i').addClass("bx-hide");
			// $('#show_hide_confirmed_password i').removeClass("bx-show");
		// } else if ($('#show_hide_confirmed_password input').attr("type") == "password") {
			// $('#show_hide_confirmed_password input').attr('type', 'text');
			// $('#show_hide_confirmed_password i').removeClass("bx-hide");
			// $('#show_hide_confirmed_password i').addClass("bx-show");
		// }
	// });
// }

// $('#date_material_start').bootstrapMaterialDatePicker({
	// format: "DD/MM/YYYY HH:mm",
	// weekStart: 1,
	// minDate: new Date(),
	// switchOnClick: true,
	// clearButton: true,
	// cancelText: "Annuler",
	// clearText: "Vider"
// });
// $('#date_material_end').bootstrapMaterialDatePicker({
	// format: "DD/MM/YYYY HH:mm",
	// weekStart: 1,
	// minDate: new Date(),
	// switchOnClick: true,
	// clearButton: true,
	// cancelText: "Annuler",
	// clearText: "Vider"
// });

/* ********************************************** */
/* ****************** CHECKALL ****************** */
/* ********************************************** */
$('#check_all').on('click',function() {
	if(this.checked) {
		$('#file_zone tbody .form-check-input:visible').each(function() {
			this.checked = true;
		});
	} else {
		$('#file_zone tbody .form-check-input:visible').each(function() {
			this.checked = false;
		});
	}
});
$('.radio.radio-success').on('click',function() {
	$(this).find('input.old_path, input.new_path').prop('checked', true);
	$(this).find('input').addClass('checked');
});

/* *********************************************** */
/* ***************** EXPAND DATA ***************** */
/* *********************************************** */
$('.storage').click(function() {
	$(this).toggleClass('icon-reverse');
	$(this).closest('.card-body').find('.info-storage').slideToggle();
	var expandDatas = $(this).attr('data-expand');
	
	if( $(this).attr('data-expand') === 'true' ) {
		$(this).attr('data-expand', 'false');
	} else {
		$(this).attr('data-expand', 'true');
	}
	$.ajax({
		type: 'post',
		url: '/apps/get/trackExpander',
		data: {expandDatas}
	});
});

/* ************************************************ */
/* ****************** MODAL MOVE ****************** */
/* ************************************************ */
$('.radio.radio-success').on('click',function() {
	$('.radio.radio-success input').removeClass('checked');
	
	$(this).find('input.old_path, input.new_path').prop('checked', true);
	$(this).find('input').addClass('checked');
});
$(document).on('hidden.bs.modal', '[id^="modal_move_"]', function moveModalHidden() {
	$(this).find('.radio.radio-success input').prop('checked', false).removeClass('checked');
});

/* ************************************************ */
/* ******************* DBLCLICK ******************* */
/* ************************************************ */
$(document).on('dblclick', '#data_folders-list .task', function dblclickTask(e) {
	window.location = $(this).find('a[href^="/datas/data"]').attr('href');
	return false;
});
$(document).on('dblclick', '#dataFilesTable tbody tr, #data_shared_files-list tbody tr', function dblclickTr(e) {
	insightView($(this).find('.dropdown-file a.insight-item'));
});

/* *********************************************** */
/* *************** ENTER TO SUBMIT *************** */
/* *********************************************** */
$('#file_zone').on('keydown', function(e) {
	// Vérifier si la touche pressée est la touche "Entrée"
	if (event.keyCode === 13) {
		// Empêcher le comportement par défaut de la touche "Entrée"
		event.preventDefault();
		return false;
	}
});
$(document).on('keyup', '[name="file_move[new_path][]"], [name="file_move[old_path][]"], [name="file_renamer[file][]"], [name="dir_renamer[dir][]"]', function enterToSubmitModal(e) {
	if( e.keyCode == "13" ) {
		$(this).closest('.modal-content').find('.modal-footer [type="submit"]').click();
	}
});
$(document).on('keyup', '[name="folder_name"]', function enterToSubmitNewFolder(e) {
	if( e.keyCode == "13" ) {
		$(this).submit();
	}
});

/* ************************************************ */
/* ************** FILL RENAMER FIELD ************** */
/* ************************************************ */
$(document).on('shown.bs.modal', '[id^="modal_rename_"], [id^="ajax_modal_rename_"]', function renameModalShown() {
	var getInputField = $(this).find('input.form-control');
	getInputField.attr('value', getInputField.attr('placeholder'));
});
$(document).on('hidden.bs.modal', '[id^="modal_rename_"], [id^="ajax_modal_rename_"]', function renameModalHidden() {
	var getInputField = $(this).find('input.form-control');
	getInputField.attr('value', '');
});

/* ************************************************ */
/* ******************** VIEWER ******************** */
/* ************************************************ */
$(document).on('click', '.dropdown-file a.insight-item', function getInsightView() {
	insightView($(this));
});

$(document).on('hidden.bs.modal', '#modal_viewer', function cleanModalViewer() {
	$(this).find('.modal-body #content_result').removeClass('processing').html('');
});

function insightView(data) {
	$('#modal_viewer').modal('show').find('.modal-body #content_result').addClass('processing').html('');
	
	let ext = $(data).data('ext'),
		src = $(data).data('insight-path'),
		basePath = $(data).data('path'),
		filename = $(data).data('filename'),
		arrImg = Array("jpg", "jpeg", "png", "bmp", "gif", "svg", "ico", "tif", "webp"),
		arrDoc = Array("doc", "docx", "odf", "odp", "ods", "odt", "otf", "pdf", "ppt", "csv", "pps", "pptx", "xls", "xlsx", "txt"),
		arrAudio = Array("mp3", "wav", "wave", "wma", "aac", "mid", "midi", "ogg"),
		arrVideo = Array("mp4", "webm", "ogg");
	
	if( arrImg.includes(ext) ) {
		let imgBase = atob(basePath),
			imgThumb = imgBase +"/thumbnails"+ src,
			imgOrig = imgBase + src,
			image = new Image();
		image.src = imgThumb;
		
		image.onload = function() {
			getImageFromUrl(imgThumb, "modal-img").then((imgElement) => {
				$('#modal_viewer .modal-body #content_result').html(imgElement).removeClass('processing');
			}).catch((error) => {
				console.error(error);
			});
		};
		image.onerror = function() {
			getImageFromUrl(imgOrig, "modal-img").then((imgElement) => {
				$('#modal_viewer .modal-body #content_result').html(imgElement).removeClass('processing');
			}).catch((error) => {
				console.error(error);
			});
		};
	}
	else if( arrDoc.includes(ext) ) {
		// console.log("arrDoc");
		$('#modal_viewer .modal-body #content_result').removeClass('processing');
		$('#modal_viewer .modal-body #content_result').html(`<iframe src="`+ (atob(basePath) + src) +`" class="modal-iframe" title="`+ filename +`" allow="fullscreen"></iframe>`);
	}
	else if( arrAudio.includes(ext) ) {
		// console.log("arrAudio");
		$('#modal_viewer .modal-body #content_result').removeClass('processing');
		$('#modal_viewer .modal-body #content_result').html(`<audio class="modal-audio" controls>
			<source src="`+ (atob(basePath) + src) +`" type="audio/`+ ext +`">
			Your browser does not support the audio element.
		</audio>`);
	}
	else if( arrVideo.includes(ext) ) {
		// console.log("arrVideo");
		$('#modal_viewer .modal-body #content_result').removeClass('processing');
		$('#modal_viewer .modal-body #content_result').html(`<video class="modal-video" controls>
			<source src="`+ (atob(basePath) + src) +`" type="video/`+ ext +`">
			Your browser does not support the video tag.
		</video>`);
	}
	else if( ext == "html" || ext == "css" || ext == "js" || ext == "sql" ) {
		// console.log("html");
		$('#modal_viewer .modal-body #content_result').removeClass('processing');
		$('#modal_viewer .modal-body #content_result').html(`<iframe src="`+ (atob(basePath) + src) +`" class="modal-iframe" title="`+ filename +`" allow="fullscreen"></iframe>`);
	} 
	else {
		// console.log("else");
		$('#modal_viewer .modal-body #content_result').removeClass('processing');
		$('#modal_viewer .modal-body #content_result').html(`<div id="notification_modal" class="alert border-0 border-start border-5 border-warning py-2 bg-extralight-warning">
			<div class="d-flex align-items-center">
				<div class="fs-35">
					<i class="bi bi-exclamation-circle"></i>
				</div>
				<div class="ms-3">
					<h6 class="mb-0">warning</h6>
					<div>Aucun aperçu disponible pour `+ filename +` !</div>
				</div>
			</div>
		</div>`);
	}
	
	// $('#modal_viewer .modal-body #content_result').removeClass('processing');
	// console.log(document.querySelector('[href="'+ src +'"]'));
};

/* ******************************************************** */
/* ****************** DRAG AND DROP EVENT ***************** */
/* ******************************************************** */
// https://www.javascripttutorial.net/web-apis/javascript-drag-and-drop/
addEventListener('mousedown', function handleMouseDown(event) {
	let eTarget = event.target;
	let enableDragSelector = null;
	
	if (eTarget.tagName === 'BUTTON' || eTarget.tagName === 'A' || eTarget.tagName === 'INPUT' || eTarget.closest('.storage') || eTarget.closest('.shared-files-table') || eTarget.closest('.modal') || eTarget.closest('#dropzone_form')) {
		return;
	} else if (!eTarget.closest('.draggable') && eTarget.closest('.tab-pane')) {
		enableDragSelector = dragSelector(event);
	} else {
		return;
	}
});

let dragItem = null;

let droptargets = document.querySelectorAll('.droptarget');
droptargets.forEach(droptarget => {
	droptarget.addEventListener('dragover', dragOver);
	droptarget.addEventListener('dragenter', dragEnter);
	droptarget.addEventListener('dragleave', dragLeave);
	droptarget.addEventListener('drop', dragDrop);
});

let draggables = document.querySelectorAll('.draggable');
draggables.forEach(draggable => {
	draggable.addEventListener('dragstart', dragStart)
	draggable.addEventListener('dragend', dragEnd)
});

function dragStart(e) {
	if( $(this).find('input[type="checkbox"]').is(':checked') == true ) {
		let listRowFolders = $(this).closest('#data_folders-list').find('.card .form-check-label input:checked'),
			listRowFiles = $(this).closest('#data_files-list').find('tbody tr input:checked'),
			listRowFoldersLength = listRowFolders.length,
			listRowFilesLength = listRowFiles.length,
			dragItemList = [];
		
		$.each(listRowFolders, function dragStartPushFolders(index, element) {
			$(element).closest('.card').addClass('file-dragged');
			dragItemList.push(element.closest('.card'));
		});
		$.each(listRowFiles, function dragStartPushFiles(index, element) {
			$(element).closest('tr').addClass('file-dragged');
			dragItemList.push(element.closest('tr'));
		});
		
		dragItem = dragItemList;
	} else {
		dragItem = [this];
		$(this).addClass('file-dragged');
	}
	
	let img = $(e.target).find('i.img-drag')[0];
	e.dataTransfer.setDragImage(img, 15, 15);
}
function dragEnd(e) {
	if( $(this).find('input[type="checkbox"]').is(':checked') == true ) {
		let listRowFolders = $(this).closest('#data_folders-list').find('.card .form-check-label input:checked'),
			listRowFiles = $(this).closest('#data_files-list').find('tbody tr input:checked'),
			listRowFilesLength = listRowFiles.length;
		
		$.each(listRowFolders, function dragEndRemoveClassFolders(index, element) {
			$(element).closest('.card').removeClass('file-dragged');
		});
		$.each(listRowFiles, function dragEndRemoveClassFiles(index, element) {
			$(element).closest('tr').removeClass('file-dragged');
		});
	} else {
		$(this).removeClass('file-dragged');
	}
	
	dragItem = null;
}
function dragOver(e) {
	e.preventDefault();
	let dropFiles = $(e.target).closest('.task');
	$(dropFiles).addClass('drag-over').find('a.fm-icon-box').addClass('folder-over-dragged');
}
function dragEnter(e) {
	e.preventDefault();
	let dropFiles = $(e.target).closest('.task');
	$(dropFiles).addClass('drag-over').find('a.fm-icon-box').addClass('folder-over-dragged');
}
function dragLeave(e) {
	e.preventDefault();
	let dropFiles = $(e.target).closest('.task');
	$(dropFiles).removeClass('drag-over').find('a.fm-icon-box').removeClass('folder-over-dragged');
}
function dragDrop(e) {
	e.preventDefault();
	var thisItem = $(this),
		dropFiles = ($(e.target).closest('.task').length > 0) ? $(e.target).closest('.task') : $(e.target).closest('.droptarget'),
		newPath = dropFiles.find('.drop-files-path').val();
	$(dropFiles).removeClass('drag-over').find('a.fm-icon-box').removeClass('folder-over-dragged');
	
	$.each(dragItem, function (index, element) {
		let removeItem = $(element),
			dragFiles = $(element).find('.drag-files').val(),
			oldPath = $(element).find('.drag-files-path').val();
		
		if( oldPath +"/"+ dragFiles != newPath ) {
			$.ajax({
				type: 'post',
				url: '/apps/get/dataDragAndDrop',
				data: {
					'drag_files': dragFiles,
					'old_path': oldPath,
					'new_path': newPath
				},
				dataType: "json"
			})
			.done(function(getDatas) {
				let notif = getDatas.notif,
					data = getDatas.data;
				
				let counterFolder = parseInt(thisItem.find('span.'+ notif[2] +'-counter').text()) + 1;
				thisItem.find('span.'+ notif[2] +'-counter').text(counterFolder);
				
				if( notif[2] == "folder" ) {
					removeItem.closest('.task').addClass('hidden-item').hide();
				} 
				else if( notif[2] == "file" ) {
					removeItem.addClass('hidden-item').hide();
				}
				
				getNotify(notif[0], notif[1]);
			})
			.fail(function(jqXHR, textStatus, response) {
				getNotify("erreur", "danger");
			});
		} else {
			getNotify("Le dossier de destination est le même que le fichier / dossier déplacé", "warning");
		}
	});
}

$(document).on('click', '#cancel_remove_drop', function cancelRemoveDrop() {
	let type = $(this).attr('data-type');
	
	$.ajax({
		type: 'post',
		url: '/apps/get/dataDragAndDrop',
		data: {
			'drag_files': $(this).attr('data-dragFiles'),
			'old_path': $(this).attr('data-oldPath'),
			'new_path': $(this).attr('data-newPath')
		},
		dataType: "json"
	})
	.done(function(getDatas) {
		let notif = getDatas.notif,
			data = getDatas.data;
		
		if( notif[2] == "folder" ) {
			$('#data_folders-list .hidden-item').show();
		} 
		else if( notif[2] == "file" ) {
			$('#data_files-list .hidden-item').show();
		}
	})
	.fail(function(jqXHR, textStatus, response) {
		getNotify("erreur", "danger");
	});
	return false;
});

/* *************************************************** */
/* ******************* ZIP COMPRESS ****************** */
/* *************************************************** */
$(document).on('click', '#data_folders-list .download-item', function downloadFolder(e) {
	e.preventDefault();
	let url = $(this).data('url');
	
	$.ajax({
		type: "POST",
		url: url,
		data: { ajax: true },
		dataType: "json"
	})
	.done(function(response) {
		let icon = getResponseIcon(response[1]);
		
		if( response[2] ) {
			console.log( response[2] );
			$('#download_link').html(`<a href="/uploads/tmp/`+ response[2] +`" type="button" class="btn btn-success mb-3">Télécharger</a>`);
		}
		
		getAlert(response[0], response[1], icon).then(html => {
			$('#download_result').html(html);
		}).catch((error) => {
			console.error(error);
		});
	})
	.fail(function(jqXHR, textStatus, response) {
		getAlert("Erreur", "danger", "bi bi-x-circle").then(html => {
			$('#download_result').html(html);
		}).catch((error) => {
			console.error(error);
		});
	});
});
$(document).on('click', '#data_folders-list .compress-item', function downloadFolder(e) {
	e.preventDefault();
	let url = $(this).data('url');
	
	$.ajax({
		type: "POST",
		url: url,
		data: { ajax: true },
		dataType: "json"
	})
	.done(function(response) {
		var icon = getResponseIcon(response[1]);
		
		getAlert(response[0], response[1], icon).then(html => {
			$('#compress_result').html(html);
		}).catch((error) => {
			console.error(error);
		});
	})
	.fail(function(jqXHR, textStatus, response) {
		let message = "Erreur";
		
		if (jqXHR.status == "500") {
			message += " 500 - Erreur interne du serveur";
		}
		
		getAlert(message, "danger", "bx bx-x-circle").then(html => {
			$('#compress_result').html(html);
		}).catch((error) => {
			console.error(error);
		});
	});
});
$(document).on('hidden.bs.modal', '#modal_download', function downloadModalHidden() {
	$('#download_result').html('');
	$('#download_link').html('');
});
$(document).on('hidden.bs.modal', '#modal_compress', function downloadModalHidden() {
	$('#compress_result').html('');
});
$(document).on('click', '#file_zone .massdownload-item', function massDownload(e) {
	e.preventDefault();
	
	let url = window.location.pathname,
		selectFile = {
			dir: [],
			file: []
		},
		checkedValues = $('input[type=checkbox]:checked').map(function() {
			var dataType = $(this).data('type');
			
			if (typeof dataType != "undefined") {
				return {
					value: this.value,
					type: dataType
				};
			}
		}).get();
	
	$.each(checkedValues, function massDownloadCheckedValues(index, element) {
		selectFile[element.type].push(element.value);
	});
	
	$('#modal_download .process').addClass('processing');
	
	$.ajax({
		type: "POST",
		url: url,
		data: {
			action_mass_download: true,
			select_file: selectFile,
			ajax: true
		},
		dataType: "json"
	})
	.done(function(response) {
		$('#modal_download .process').removeClass('processing');
		let icon = getResponseIcon(response[1]);
		
		if( response[2] ) {
			console.log( response[2] );
			$('#download_link').html(`<a href="/uploads/tmp/`+ response[2] +`" type="button" class="btn btn-success mb-3">Télécharger</a>`);
		}
		
		getAlert(response[0], response[1], icon).then(html => {
			$('#download_result').html(html);
		}).catch((error) => {
			console.error(error);
		});
	})
	.fail(function(jqXHR, textStatus, response) {
		$('#modal_download .process').removeClass('processing');
		let message = "Erreur";
		
		if (jqXHR.status == 500) {
			message += " 500 - Erreur interne du serveur";
		}
		
		getAlert(message, "danger", "bi bi-x-circle").then(html => {
			$('#download_result').html(html);
		}).catch((error) => {
			console.error(error);
		});
	});
});

/* ************************************************* */
/* ******************* SELECTABLE ****************** */
/* ************************************************* */
function selectClicked(e) {
	e.preventDefault();
	console.log($(this));
	console.log(e.target);
}

/* ************************************************* */
/* ****************** CONTEXT MENU ***************** */
/* ************************************************* */
initContextMenu(['download', 'move', 'rename', 'select', 'selects', 'insight', 'delete', 'massDownload', 'massMove', 'massRename', 'massDelete']);

/* ************************************************* */
/* ******************* SEARCH DIRS ***************** */
/* ************************************************* */
$(document).on('input', '#search_folders', function searchFiles() {
	let dirsZone = $('#data_folders-list .task-folders');
		dirsSearch = $(this).val();
	
	if( dirsSearch.length > 1 ) {
		dirsZone.removeClass('d-none');
		
		dirsZone.each(function(index, element) {
			find = $(element).data('dirsearch').toLowerCase();
			
			if( !find.includes(dirsSearch.toLowerCase()) ) {
				$(element).addClass('d-none');
				$(element).find('[type="checkbox"]').prop('checked', false);
			}
		});
	} else {
		$(dirsZone).removeClass('d-none');
	}
});

/* ************************************************ */
/* ****************** SEARCH FILES **************** */
/* ************************************************ */
$(document).on('input', '#search_files', function searchFiles() {
	let filesZone = $('#dataFilesTable tbody tr');
		filesSearch = $(this).val();
	
	if( filesSearch.length > 1 ) {
		filesZone.removeClass('d-none');
		
		filesZone.each(function(index, element) {
			find = $(element).data('filesearch').toLowerCase();
			
			if( !find.includes(filesSearch.toLowerCase()) ) {
				$(element).addClass('d-none');
				$(element).find('[type="checkbox"]').prop('checked', false);
			}
		});
	} else {
		$(filesZone).removeClass('d-none');
	}
});

/* ************************************************* */
/* ******************* DATA TABLE ****************** */
/* ************************************************* */
$('#dataFilesTable').DataTable({
	paging: false,
	searching: false,
	info: false,
	columnDefs: [
		{orderable: false, targets: 0},
		{orderable: false, targets: -1}
	],
	order: [[1, 'asc']]
});
