<div class="modal fade" id="modal_vid_files" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php $langs->lang("DATA_VIDEOS", "datas") ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php $langs->lang("JSCLOSE") ?>" title="<?php $langs->lang("JSCLOSE") ?>"></button>
			</div>
			<div class="modal-body">
				<?php foreach($vidBasename as $key => $vid) {
					echo '<a href="/datas/data'. $vidBasePath[$key] .'" class="btn btn-light text-start mb-1 w-100">'. basename($vid) .'<span class="float-end badge bg-light rounded-pill">'. basename($vidBasePath[$key]) .'</span></a>';
				} ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="<?php $langs->lang("JSCLOSE") ?>"><i class="bx bx-arrow-back"></i> <?php $langs->lang("JSCLOSE") ?></button>
			</div>
		</div>
	</div>
</div>
