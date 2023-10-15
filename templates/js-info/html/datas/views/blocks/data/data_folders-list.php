<?php 

$modal = 0;
sort($files, SORT_REGULAR);

foreach($files as $file) :
	$pathInfo = pathinfo($file, PATHINFO_EXTENSION);
	
	if( !in_array($file, $excludeScan) && empty($pathInfo) ) : // IS FOLDER
		$actualDir = _ROOTURL_ ."/uploads/datas/". $personnalFolder . $folderPath ."/". $file;
		$downloadFile = "/datas/data". $folderPath ."?action=download&path=". $folderPath ."&file=". $file ."&type=dir";
		$compressFile = "/datas/data". $folderPath ."?action=archive&path=". $folderPath ."&file=". $file ."&type=dir";
		$removeFile = "/datas/data". $folderPath ."?action=remove&path=". $folderPath ."&file=". $file ."&type=dir";
		$fileCounter = count(scandir($actualDir)) - 3;
		
		$scanActualDir = scandir($actualDir);
		$dirCounter = array();
		
		foreach($scanActualDir as $includeDirs) {
			if( !in_array($includeDirs, $excludeScan) && is_dir($actualDir ."/". $includeDirs) ) {
				$dirCounter[] = $includeDirs;
			}
		} ?>
		<div class="col-12 col-sm-6 col-lg-4 task task-folders" data-dirsearch="<?php echo $file ?>">
			<div class="card shadow-none border radius-15 droptarget draggable mobile-draggable dragenter dragleave selectable" draggable="true" selectable="false">
				<input type="hidden" value="<?php echo $file ?>" class="drag-files" />
				<input type="hidden" value="<?php echo $folderPath ?>" data-id="folder_path" class="drag-files-path" />
				<input type="hidden" value="<?php echo $folderPath .'/'. $file ?>" data-id="foldername_path" class="drop-files-path">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<a href="<?php echo $myFolder .'/'. $file ?>" class="fm-icon-box radius-15" title="<?php echo $file ?>"><i class="bx bxs-folder img-drag"></i></a>
						<div class="ms-auto _fs-22">
							<div class="row">
								<div class="col-6">
									<button class="btn text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="<?php $langs->lang("DATA_MENU", "datas"); echo ' '. $file ?>" aria-label="<?php $langs->lang("DATA_MENU", "datas"); echo ' '. $file ?>">
										<i class="bx bx-dots-horizontal-rounded me-0"></i>
									</button>
									<ul class="dropdown-menu dropdown-folder">
										<li><a href="#" class="dropdown-item download-item" data-url="<?php echo $downloadFile ?>" data-bs-toggle="modal" data-bs-target="#modal_download" title="<?php $langs->lang("DATA_DOWNLOAD", "datas"); echo ' '. $file ?>" context="download"><i class="bx bx-download"></i> <?php $langs->lang("DATA_DOWNLOAD", "datas") ?></a></li>
										<li><a href="#" class="dropdown-item compress-item" data-url="<?php echo $compressFile ?>" data-bs-toggle="modal" data-bs-target="#modal_compress" title="<?php $langs->lang("DATA_ZIP", "datas"); echo ' '. $file ?>" context="zip"><i class="bx bx-archive-in"></i> <?php $langs->lang("DATA_ZIP", "datas") ?></a></li>
										<?php if( $personnalAllDirs != '' ) { ?>
											<li><a href="#" class="dropdown-item move-item" data-bs-toggle="modal" data-bs-target="#modal_move_<?php echo $modal ?>" title="<?php $langs->lang("DATA_MOVE", "datas"); echo ' '. $file ?>" context="move"><i class="bx bx-move"></i> <?php $langs->lang("DATA_MOVE", "datas") ?></a></li>
										<?php } ?>
										<li><a href="#" class="dropdown-item rename-item" data-bs-toggle="modal" data-bs-target="#modal_rename_<?php echo $modal ?>" title="<?php $langs->lang("DATA_RENAME", "datas"); echo ' '. $file ?>" context="rename"><i class="bx bx-rename"></i> <?php $langs->lang("DATA_RENAME", "datas") ?></a></li>
										<li><div class="dropdown-divider mb-1"></div></li>
										<li><a href="<?php echo $removeFile ?>" class="dropdown-item delete-item" onclick="return confirm('<?php $langs->lang("JSARE_YOU_SURE_YOU_WANT_TO_DELETE"); echo ' '. $file ?> ?');" title="<?php $langs->lang("DATA_DELETE", "datas"); echo ' '. $file ?>" context="delete"><i class="bx bx-trash"></i> <?php $langs->lang("DATA_DELETE", "datas") ?></a></li>
									</ul>
								</div>
								<div class="col-6">
									<label class="form-check-label right-checkbox">
										<input type="checkbox" name="select_file[dir][]" value="<?php echo $file ?>" data-type="dir" class="form-check-input fs-22 md-checkbox" />
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="d-flex align-items-center">
						<div class="_user-groups">
							<h6 class="mb-1 mt-3"><a href="<?php echo $myFolder .'/'. $file ?>" title="<?php echo $file ?>"><?php echo $file ?></a></h6>
							<small><a href="<?php echo $myFolder .'/'. $file ?>" title="<?php echo $fileCounter ?> fichiers"><span class="folder-counter"><?php echo count($dirCounter) ?></span> <?php $langs->lang("DATA_FOLDERS_LOW", "datas") ?> / <span class="file-counter"><?php echo ($fileCounter - count($dirCounter)) ?></span> <?php echo $langs->lang("DATA_FILES_LOW", "datas") ?></a></small>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="modal_rename_<?php echo $modal ?>" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><?php $langs->lang("DATA_RENAME", "datas"); echo ' '. $file ?></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" title="<?php $langs->lang("JSCLOSED") ?>" aria-label="<?php $langs->lang("JSCLOSED") ?>"></button>
					</div>
					<div class="modal-body">
						<div class="block-form d-none">
							<input name="dir_renamer[path][]" type="hidden" id="dir_renamer_path_<?php echo $modal ?>" value="<?php echo $folderPath ."/". $file ?>" />
						</div>
						<div class="col-md-12">
							<label for="dir_renamer_<?php echo $modal ?>" class="form-label"><?php $langs->lang("DATA_FOLDERS_LIST_RENAME_A_FOLDER", "datas") ?></label>
							<input name="dir_renamer[dir][]" type="text" id="dir_renamer_<?php echo $modal ?>" class="form-control" placeholder="<?php echo $file ?>" aria-label="<?php echo $file ?>" data-value="<?php echo $file ?>" autocomplete="off" value="" />
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="<?php $langs->lang("JSCANCEL") ?>"><i class="bx bx-arrow-back"></i> <?php $langs->lang("JSCANCEL") ?></button>
						<button type="submit" class="btn btn-light" title="<?php $langs->lang("DATA_RENAME", "datas") ?>"><i class="bx bx-rename"></i> <?php $langs->lang("DATA_RENAME", "datas") ?></button>
					</div>
				</div>
			</div>
		</div>

		<?php if( $personnalAllDirs != '' ) { ?>
			<div class="modal fade" id="modal_move_<?php echo $modal ?>" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog modal-dialog-scrollable modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"><?php $langs->lang("DATA_MOVE", "datas"); echo ' '. $file ?></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" title="Fermé" aria-label="Fermé"></button>
						</div>
						<div class="modal-body text-end">
							<p class="text-start">Sélectionner un dossier :</p>
							<div class="radio radio-success btn btn-light my-1 wp-100 tree-before-0 mb-3 text-start">
								<label>
									<input type="radio" name="dir_move[old_path][]" id="<?php echo $modal ?>_old_path_datas" class="double-check md-radio old_path d-none" value="<?php echo $folderPath .'/'. $file ?>" />
									<input type="radio" name="dir_move[new_path][]" id="<?php echo $modal ?>_new_path_datas" class="double-check md-radio new_path" value="/<?php echo $file ?>" />
									<?php $langs->lang("DATA_FOLDERS_LIST_MY_DOCUMENTS", "datas") ?>
								</label>
							</div>
							<?php foreach($personnalAllDirs as $allDirs) {
								$exploDir = explode('/', $allDirs);
								$sliceDir = array_slice($exploDir, 10);
								$choseDir = end($exploDir);
								
								if( $choseDir == $personnalFolder ) {
									$choseDir = $langs->lang("DATA_FOLDERS_LIST_MY_DOCUMENTS", "datas");
								}
								
								if( $file != $choseDir ) { ?>
									<div class="radio radio-success btn btn-light my-1 wp-<?php echo 100 - ((count($sliceDir) - 1) * 5) .' tree-before-'. (count($sliceDir) - 1) * 5 ?> text-start">
										<label>
											<input type="radio" name="dir_move[old_path][]" id="<?php echo $modal .'_old_path_'. $choseDir ?>" class="double-check md-radio old_path d-none" value="<?php echo $folderPath .'/'. $file ?>" />
											<input type="radio" name="dir_move[new_path][]" id="<?php echo $modal .'_new_path_'. $choseDir ?>" class="double-check md-radio new_path" value="/<?php echo implode("/", $sliceDir) .'/'. $file ?>" />
											<?php echo $choseDir ?>
										</label>
									</div>
								<?php }
							} ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="<?php $langs->lang("JSCANCEL") ?>"><i class="bx bx-arrow-back"></i> <?php $langs->lang("JSCANCEL") ?></button>
							<button type="submit" class="btn btn-light" title="<?php $langs->lang("DATA_MOVE", "datas") ?>"><i class="bx bx-move"></i> <?php $langs->lang("DATA_MOVE", "datas") ?></button>
						</div>
					</div>
				</div>
			</div>
		<?php }
	endif; // IS FOLDER
	$modal++;
endforeach; ?>
