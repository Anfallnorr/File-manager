<?php 

$modal = 0;
sort($files, SORT_REGULAR);

foreach($files as $file) :
	if( !in_array($file, $excludeScan) ) :
		$pathInfo = pathinfo($file, PATHINFO_EXTENSION);
		
		if( empty($pathInfo) ) { // IS FOLDER
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
			}
			
			?>
			<div class="col-12 col-sm-6 col-lg-4 task task-folders" data-dirsearch="<?php echo $file ?>">
				<div class="card bg-light _shadow-none border radius-15 droptarget draggable mobile-draggable dragenter dragleave selectable" draggable="true" selectable="false">
					<input type="hidden" value="<?php echo $file ?>" class="drag-files" />
					<input type="hidden" value="<?php echo $folderPath ?>" class="drag-files-path" />
					<input type="hidden" value="<?php echo $folderPath .'/'. $file ?>" class="drop-files-path">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<a href="<?php echo $myFolder .'/'. $file ?>" class="bi-icon-box" title="<?php echo $file ?>"><i class="bi bi-folder img-drag"></i></a>
							<div class="ms-auto">
								<div class="row">
									<div class="col-6">
										<button class="btn py-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Menu <?php echo $file ?>" aria-label="Menu <?php echo $file ?>">
											<i class="bi bi-three-dots-vertical me-0"></i>
										</button>
										<ul class="dropdown-menu dropdown-folder">
											<li><a href="#" class="dropdown-item download-item" data-url="<?php echo $downloadFile ?>" data-bs-toggle="modal" data-bs-target="#modal_download" title="Télécharger <?php echo $file ?>" context="download"><i class="bi bi-download"></i> Télécharger</a></li>
											<li><a href="#" class="dropdown-item compress-item" data-url="<?php echo $compressFile ?>" data-bs-toggle="modal" data-bs-target="#modal_compress" title="Compresser <?php echo $file ?>" context="zip"><i class="bi bi-file-earmark-zip"></i> Compresser</a></li>
											<?php if( $personnalAllDirs != '' ) { ?>
												<li><a href="#" class="dropdown-item move-item" data-bs-toggle="modal" data-bs-target="#modal_move_<?php echo $modal ?>" title="Déplacer <?php echo $file ?>" context="move"><i class="bi bi-arrows-move"></i> Déplacer</a></li>
											<?php } ?>
											<li><a href="#" class="dropdown-item rename-item" data-bs-toggle="modal" data-bs-target="#modal_rename_<?php echo $modal ?>" title="Renommer <?php echo $file ?>" context="rename"><i class="bi bi-input-cursor-text"></i> Renommer</a></li>
											<li><div class="dropdown-divider mb-1"></div></li>
											<li><a href="<?php echo $removeFile ?>" class="dropdown-item delete-item" onclick="return confirm('Voulez-vous vraiment supprimer <?php echo $file ?> ?');" title="Supprimer <?php echo $file ?>" context="delete"><i class="bi bi-trash"></i> Supprimer</a></li>
										</ul>
									</div>
									<div class="col-6">
										<label class="form-check-label _right-checkbox">
											<input type="checkbox" name="select_file[dir][]" value="<?php echo $file ?>" data-type="dir" class="form-check-input fs-22 mt-0" />
										</label>
									</div>
								</div>
							</div>
						</div>
						<h6 class="mb-1 mt-3"><a href="<?php echo $myFolder .'/'. $file ?>" title="<?php echo $file ?>"><?php echo $file ?></a></h6>
						<small><a href="<?php echo $myFolder .'/'. $file ?>" title="<?php echo $fileCounter ?> fichiers"><span class="folder-counter"><?php echo count($dirCounter) ?></span> Dossiers / <span class="file-counter"><?php echo ($fileCounter - count($dirCounter)) ?></span> fichiers</a></small>
					</div>
				</div>
			</div>
			
			<div class="modal fade" id="modal_rename_<?php echo $modal ?>" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Renomer <?php echo $file ?></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" title="Fermer" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="block-form d-none">
								<input name="dir_renamer[path][]" type="hidden" id="dir_renamer_path_<?php echo $modal ?>" value="<?php echo $folderPath ."/". $file ?>" />
							</div>
							<div class="col-md-12">
								<label for="dir_renamer_<?php echo $modal ?>" class="form-label">Renomer un dossier</label>
								<input name="dir_renamer[dir][]" type="text" id="dir_renamer_<?php echo $modal ?>" class="form-control empty" placeholder="<?php echo $file ?>" aria-label="<?php echo $file ?>" data-value="<?php echo $file ?>" autocomplete="off" value="" />
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="Annuler"><i class="bi bi-arrow-left-circle"></i> Annuler</button>
							<button type="submit" class="btn btn-success" title="Renommer"><i class="bi bi-input-cursor-text"></i> Renommer</button>
						</div>
					</div>
				</div>
			</div>
			
			<?php if( $personnalAllDirs != '' ) { ?>
				<div class="modal fade" id="modal_move_<?php echo $modal ?>" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog modal-dialog-scrollable modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Déplacer <?php echo $file ?></h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" title="Fermer" aria-label="Close"></button>
							</div>
							<div class="modal-body text-end">
								<p class="text-start">Sélectionner un dossier :</p>
								<div class="radio radio-success btn btn-light my-1 wp-100 tree-before-0 mb-3 text-start">
									<label>
										<input type="radio" name="dir_move[old_path][]" id="<?php echo $modal ?>_old_path_datas" class="double-check md-radio old_path d-none" value="<?php echo $folderPath .'/'. $file ?>" />
										<input type="radio" name="dir_move[new_path][]" id="<?php echo $modal ?>_new_path_datas" class="double-check md-radio new_path" value="/<?php echo $file ?>" />
										Mes documents
									</label>
								</div>
								<?php foreach($personnalAllDirs as $allDirs) {
									$exploDir = explode('/', $allDirs);
									$sliceDir = array_slice($exploDir, 10);
									$choseDir = end($exploDir);
									
									if( $choseDir == $personnalFolder ) {
										$choseDir = "Mes documents";
									}
									
									if( $file != $choseDir ) {
										$widthPercentMove = "wp-". 100 - ((count($sliceDir) - 1) * 5) ." tree-before-". (count($sliceDir) - 1) * 5; ?>
										<div class="radio radio-success btn btn-light my-1 <?php echo $widthPercentMove ?> text-start">
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
								<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="Annuler"><i class="bi bi-arrow-left-circle"></i> Annuler</button>
								<button type="submit" class="btn btn-success" title="Déplacer"><i class="bi bi-arrows-move"></i> Déplacer</button>
							</div>
						</div>
					</div>
				</div>
			<?php }
		} // IS FOLDER
	endif;
	$modal++;
endforeach; /* GLOBAL FILE */ ?>