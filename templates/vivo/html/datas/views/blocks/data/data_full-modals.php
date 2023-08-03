<div class="modal fade" id="modal_go_to" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php $langs->lang("DATA_FULL_MODAL_CHOOSING_DESTINATION", "datas") ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" title="<?php $langs->lang("JSCLOSE") ?>" aria-label="<?php $langs->lang("JSCLOSE") ?>"></button>
			</div>
			<div class="modal-body text-end">
				<?php foreach($personnalAllDepthDirs as $allDirs) {
					$goTo = implode('/', $allDirs);
					$choseDir = end($allDirs);
					$scanFolder = scandir(_ROOTURL_ .'/uploads/datas/'. $personnalFolder .'/'. $goTo);
					$widthPercentToGo = 100 - ((count($allDirs) - 1) * 5) .' tree-before-'. (count($allDirs) - 1) * 5;
					
					echo '<a href="/datas/data/'. $goTo .'" class="btn btn-light my-1 wp-'. $widthPercentToGo .' text-start" title="'. $choseDir .'">
						<i class="bi bi-folder"></i> '. $choseDir .'
						<span class="float-end badge shade-green rounded-pill">'. (count($scanFolder) - 3) .'</span>
					</a>';
				} ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="<?php $langs->lang("JSCANCEL") ?>"><i class="bi bi-arrow-left-circle"></i> <?php $langs->lang("JSCANCEL") ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_mass_move" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php $langs->lang("DATA_FULL_MODAL_MOVE_SELECTION", "datas") ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" title="<?php $langs->lang("JSCLOSE") ?>" aria-label="<?php $langs->lang("JSCLOSE") ?>"></button>
			</div>
			<div class="modal-body text-end">
				<p class="text-start"><strong><?php $langs->lang("DATA_FULL_MODAL_SELECT_A_FOLDER", "datas") ?></strong> :</p>
				<div class="radio radio-success btn btn-light my-1 wp-100 tree-before-0 mb-3 text-start">
					<label>
						<input type="radio" name="mass_move[old_path]" id="old_path_datas" class="double-check md-radio old_path d-none" value="<?php echo $folderPath ?>/" />
						<input type="radio" name="mass_move[new_path]" id="new_path_datas" class="double-check md-radio new_path" value="/" />
						<?php $langs->lang("DATA_FULL_MODAL_ROOT", "datas") ?>
					</label>
				</div>
				<?php foreach($personnalAllDirs as $allDirs) {
					$exploDir = explode('/', $allDirs);
					$sliceDir = array_slice($exploDir, 10);
					$allDirs = implode("/", $sliceDir);
					$choseDir = end($exploDir);
					$widthPercentMassMove = 100 - ((count($sliceDir) - 1) * 5) .' tree-before-'. (count($sliceDir) - 1) * 5;
					
					echo '<div class="radio radio-success btn btn-light my-1 wp-'. $widthPercentMassMove .' text-start">
						<label>
							<input type="radio" name="mass_move[old_path]" id="old_path_'. $choseDir .'" class="double-check md-radio old_path d-none" value="'. $folderPath .'" />
							<input type="radio" name="mass_move[new_path]" id="new_path_'. $choseDir .'" class="double-check md-radio new_path" value="/'. $allDirs .'" />
							'. $choseDir .'
						</label>
					</div>';
				} ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="<?php $langs->lang("JSCANCEL") ?>"><i class="bi bi-arrow-left-circle"></i> <?php $langs->lang("JSCANCEL") ?></button>
				<button type="submit" name="action_mass_move" value="action_mass_move" class="btn btn-success"><i class="bi bi-arrows-move"></i> <?php $langs->lang("JSMOVE_SELECTION") ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_mass_renamer" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php $langs->lang("DATA_FULL_MODAL_RENAME_SELECTION", "datas") ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" title="<?php $langs->lang("JSCLOSE") ?>" aria-label="<?php $langs->lang("JSCLOSE") ?>"></button>
			</div>
			<div class="modal-body">
				<div class="block-form d-none">
					<input name="mass_renamer[path]" type="hidden" id="mass_renamer_path" class="form-control empty" value="<?php echo $folderPath .'/' ?>" />
				</div>
				<div class="col-md-12">
					<label for="mass_renamer" class="form-label"><?php $langs->lang("DATA_FULL_MODAL_RENAME_SELECTION", "datas") ?></label>
					<input name="mass_renamer[name]" type="text" id="mass_renamer" class="form-control mb-3 empty" placeholder="<?php $langs->lang("JSRENAME_SELECTION") ?>" aria-label="<?php $langs->lang("JSRENAME_SELECTION") ?>" autocomplete="off" value="" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="<?php $langs->lang("JSCANCEL") ?>"><i class="bi bi-arrow-left-circle"></i> <?php $langs->lang("JSCANCEL") ?></button>
				<button type="submit" name="action_mass_rename" value="action_mass_rename" class="btn btn-success"><i class="bi bi-input-cursor-text"></i> <?php $langs->lang("JSRENAME_SELECTION") ?></button>
			</div>
		</div>
	</div>
</div>
