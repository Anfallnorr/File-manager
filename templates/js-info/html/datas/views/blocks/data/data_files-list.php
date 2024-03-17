<div class="_table-responsive-custom table-responsive _mb-4">
	<table id="dataFilesTable" class="table table-striped table-hover display nowrap mb-0 align-middle" style="width: 100%">
		<thead>
			<tr>
				<th width="5%" class="text-center" data-priority="0">
					<label class="form-check-label right-checkbox">
						<input id="check_all" type="checkbox" name="select_file[file][]" class="form-check-input fs-22" />
					</label>
				</th>
				<th width="35%" class="name" data-priority="0"><?php $langs->lang("DATA_FILES_LIST_NAME", "datas") ?></th>
				<th width="10%" class="dimensions"><?php $langs->lang("DATA_FILES_LIST_DIMENSIONS", "datas") ?></th>
				<th width="15%" class="size"><?php $langs->lang("DATA_FILES_LIST_SIZE", "datas") ?></th>
				<th width="25%" class="last-modif"><?php $langs->lang("DATA_FILES_LIST_LAST_MODIFIED", "datas") ?></th>
				<th width="10%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$docArray = array("pdf", "doc", "txt", "html", "css", "js");
			$imgArray = array("jpg", "jpeg", "png", "tif", "webp", "bmp", "ico", "svg", "gif");
			$musicArray = array("mp3", "wav", "wave", "wma", "aac", "mid", "midi", "ogg");
			$vidArray = array("mp4","mpg","mpeg","mov","3gp","avi");
			
			foreach ($files as $file) :
				$pathInfo = pathinfo($file, PATHINFO_EXTENSION);
				
				if (!in_array($file, $excludeScan) && !empty($pathInfo)) : // IS FILE
					$pathToTheFile = _ROOTURL_ ."/uploads/datas/". $personnalFolder . $folderPath ."/". $file;
					$downloadFile = "/datas/data". $folderPath ."?action=download&path=". $folderPath ."&file=". $file ."&type=file";
					$removeFile = "/datas/data". $folderPath ."?action=remove&path=". $folderPath ."&file=". $file ."&type=file";
					$viewFile = $folderPath ."/". $file;
					
					if ($pathInfo == "jpg" || $pathInfo == "jpeg" || $pathInfo == "png" || $pathInfo == "gif") {
						$imgSize = getimagesize($pathToTheFile);
						$imgSize = $imgSize[0] ." x ". $imgSize[1];
					} else {
						$imgSize = "";
					} ?>
					<tr class="task task-files draggable" data-filesearch="<?php echo $file ?>" draggable="true">
						<input type="hidden" name="file_dragged[]" value="<?php echo $file ?>" class="drag-files" />
						<input type="hidden" name="file_dragged_path[]" value="<?php echo $folderPath ?>" class="drag-files-path" />
						<td class="text-center">
							<label class="form-check-label right-checkbox">
								<input type="checkbox" name="select_file[file][]" value="<?php echo $file ?>" data-type="file" class="form-check-input fs-22 md-checkbox" />
							</label>
						</td>
						<td class="file-type-name">
							<div class="d-flex align-items-center">
							<?php if (in_array($pathInfo, $docArray)) { ?>
								<div><i class="bx bxs-file-<?php echo $pathInfo ?> me-2 text-center fs-24 w-36 img-drag"></i></div>
							<?php } elseif (in_array($pathInfo, $imgArray)) { ?>
								<div><i class="bx bxs-image me-2 text-center fs-24 w-36 img-drag"></i></div>
							<?php } elseif (in_array($pathInfo, $musicArray)) { ?>
								<div><i class="bx bxs-music me-2 text-center fs-24 w-36 img-drag"></i></div>
							<?php } elseif (in_array($pathInfo, $vidArray)) { ?>
								<div><i class="bx bxs-video me-2 text-center fs-24 w-36 img-drag"></i></div>
							<?php } else { ?>
								<div><i class="bx bxs-file-doc me-2 text-center fs-24 w-36 img-drag"></i></div>
							<?php } ?>
							<div class="font-weight-bold table-name"><?php echo $file ?></div>
							</div>
						</td>
						<td><?php echo $imgSize ?></td>
						<td><?php echo '<span class="d-none">'. filesize($pathToTheFile) .'</span>'. FileSystems::getSizeName(filesize($pathToTheFile)) ?></td>
						<td><?php echo '<span class="d-none">'. filemtime($pathToTheFile) .'</span>'. date("d/m/Y H:i", filemtime($pathToTheFile)) ?></td>
						<td class="text-center">
							<div class="menu-settings menu-settings-options">
								<button class="btn btn-light w-100 py-0 px-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="<?php $langs->lang("DATA_MENU", "datas"); echo ' '. $file ?>" aria-label="<?php $langs->lang("DATA_MENU", "datas"); echo ' '. $file ?>">
									<i class="bx bx-dots-horizontal-rounded me-0 _fs-24"></i>
								</button>
								<ul class="dropdown-menu dropdown-file pl-5">
									<li class="mb-1"><a href="<?php echo $downloadFile ?>" class="dropdown-item download-item" title="<?php $langs->lang("DATA_DOWNLOAD", "datas"); echo ' '. $file ?>" context="download"><i class="bx bx-download"></i> <?php $langs->lang("DATA_DOWNLOAD", "datas") ?></a></li>
									<?php if ($personnalAllDirs != '') { ?>
										<li class="my-1"><a href="#" class="dropdown-item move-item" data-bs-toggle="modal" data-bs-target="#modal_move_<?php echo $modal ?>" title="<?php $langs->lang("DATA_MOVE", "datas"); echo ' '. $file ?>" context="move"><i class="bx bx-move"></i> <?php $langs->lang("DATA_MOVE", "datas") ?></a></li>
									<?php } ?>
									<li class="my-1"><a href="#" class="dropdown-item rename-item" data-bs-toggle="modal" data-bs-target="#modal_rename_<?php echo $modal ?>" title="<?php $langs->lang("DATA_RENAME", "datas"); echo ' '. $file ?>" context="rename"><i class="bx bx-rename"></i> <?php $langs->lang("DATA_RENAME", "datas") ?></a></li>
									<li><div class="dropdown-divider my-0"></div></li>
									<li class="my-1"><a href="#" class="dropdown-item insight-item" data-bs-toggle="modal" data-bs-target="#modal_viewer" title="<?php $langs->lang("DATA_INSIGHT_OF", "datas"); echo ' '. $file ?>" context="insight" data-insight-path="<?php echo $viewFile ?>" data-path="<?php echo base64_encode("/uploads/datas/". $personnalFolder) ?>" data-filename="<?php echo $file ?>" data-ext="<?php echo $pathInfo ?>"><i class="bx bx-show-alt"></i> <?php $langs->lang("DATA_INSIGHT", "datas") ?></a></li>
									<li><div class="dropdown-divider my-0"></div></li>
									<li class="mt-1"><a href="<?php echo $removeFile ?>" class="dropdown-item delete-item" onclick="return confirm('<?php $langs->lang("JSARE_YOU_SURE_YOU_WANT_TO_DELETE"); echo ' '. $file ?> ?');" title="<?php $langs->lang("DATA_DELETE", "datas"); echo ' '. $file ?>" context="delete"><i class="bx bx-trash"></i> <?php $langs->lang("DATA_DELETE", "datas") ?></a></li>
								</ul>
							</div>
						</td>
					</tr>
					
					<div class="modal fade" id="modal_rename_<?php echo $modal ?>" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title"><?php $langs->lang("DATA_FILES_LIST_RENAME_A_FILE", "datas") ?></h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" title="<?php $langs->lang("JSCLOSED") ?>" aria-label="<?php $langs->lang("JSCLOSED") ?>"></button>
								</div>
								<div class="modal-body">
									<div class="block-form d-none">
										<input name="file_renamer[path][]" type="hidden" id="file_renamer_path_<?php echo $modal ?>" value="<?php echo $folderPath ."/". $file ?>" />
									</div>
									<div class="col-md-12">
										<label for="file_renamer_<?php echo $modal ?>" class="form-label"><?php $langs->lang("DATA_RENAME", "datas") ?></label>
										<input name="file_renamer[file][]" type="text" id="file_renamer_<?php echo $modal ?>" class="form-control mb-3" placeholder="<?php echo pathinfo($file, PATHINFO_FILENAME) ?>" aria-label="<?php echo pathinfo($file, PATHINFO_FILENAME) ?>" autocomplete="off" value="" />
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="<?php $langs->lang("JSCANCEL") ?>"><i class="bx bx-arrow-back"></i> <?php $langs->lang("JSCANCEL") ?></button>
									<button type="submit" class="btn btn-light" title="<?php $langs->lang("DATA_RENAME", "datas") ?>"><i class="bx bx-rename"></i> <?php $langs->lang("DATA_RENAME", "datas") ?></button>
								</div>
							</div>
						</div>
					</div>
					
					<?php if ($personnalAllDirs != '') { ?>
						<div class="modal fade" id="modal_move_<?php echo $modal ?>" tabindex="-1" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title"><?php $langs->lang("DATA_MOVE", "datas"); echo ' '. $file ?></h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" title="<?php $langs->lang("JSCLOSED") ?>" aria-label="<?php $langs->lang("JSCLOSED") ?>"></button>
									</div>
									<div class="modal-body text-end">
										<p class="text-start"><?php $langs->lang("DATA_FILES_LIST_SELECT_FOLDER", "datas") ?></p>
										
										<div class="radio radio-success btn btn-light my-1 wp-100 tree-before-0 mb-3 text-start">
											<label>
												<input type="radio" name="file_move[old_path][]" id="<?php echo $modal ?>_old_path_datas" class="double-check md-radio old_path d-none" value="<?php echo $folderPath .'/'. $file ?>" />
												<input type="radio" name="file_move[new_path][]" id="<?php echo $modal ?>_new_path_datas" class="double-check md-radio new_path" value="/<?php echo $file ?>" />
												<?php $langs->lang("DATA_FILES_LIST_MY_DOCUMENTS", "datas") ?>
											</label>
										</div>
										
										<?php foreach ($personnalAllDirs as $allFiles) {
											$exploFile = explode("/", $allFiles);
											$sliceFile = array_slice($exploFile, 9);
											$choseFile = end($exploFile);
											
											if ($choseFile == $personnalFolder) {
												$choseFile = $langs->lang("DATA_FILES_LIST_MY_DOCUMENTS", "datas");
											} ?>
											<div class="radio radio-success btn btn-light my-1 wp-<?php echo 100 - ((count($sliceFile) - 1) * 5) .' tree-before-'. (count($sliceFile) - 1) * 5 ?> text-start">
												<label>
													<input type="radio" name="file_move[old_path][]" id="<?php echo $modal .'_old_path_'. $choseFile ?>" class="double-check md-radio old_path d-none" value="<?php echo $folderPath .'/'. $file ?>" />
													<input type="radio" name="file_move[new_path][]" id="<?php echo $modal .'_new_path_'. $choseFile ?>" class="double-check md-radio new_path" value="/<?php echo implode("/", $sliceFile) .'/'. $file ?>" />
													<?php echo $choseFile ?>
												</label>
											</div>
										<?php } ?>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="<?php $langs->lang("JSCANCEL") ?>"><i class="bx bx-arrow-back"></i> <?php $langs->lang("JSCANCEL") ?></button>
										<button type="submit" class="btn btn-light" title="<?php $langs->lang("DATA_MOVE", "datas") ?>"><i class="bx bx-move"></i> <?php $langs->lang("DATA_MOVE", "datas") ?></button>
									</div>
								</div>
							</div>
						</div>
					<?php }
				endif; // IS FILE
				$modal++;
			endforeach; /* GLOBAL FILE */ ?>
		</tbody>
	</table>
</div>
