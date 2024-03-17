<div class="modal fade" id="modal_audio_files" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php $langs->lang("DATA_MUSICS", "datas") ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php $langs->lang("JSCLOSE") ?>" title="<?php $langs->lang("JSCLOSE") ?>"></button>
			</div>
			<div class="modal-body">
				<?php foreach ($audioBasename as $key => $audio) {
					echo '<a href="/datas/data'. $audioBasePath[$key] .'" class="btn btn-light text-start mb-1 w-100">'. basename($audio) .'</a>';
				} ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="<?php $langs->lang("JSCLOSE") ?>"><i class="bi bi-arrow-left-circle"></i> <?php $langs->lang("JSCLOSE") ?></button>
			</div>
		</div>
	</div>
</div>
