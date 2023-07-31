<!-- BEGIN MODAL IMG FILES -->
<div class="modal fade" id="modal_img_files" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Images</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer" title="Fermer"></button>
			</div>
			<div class="modal-body">
				<?php foreach($imgBasename as $key => $img) {
					echo '<a href="/datas/data'. $imgBasePath[$key] .'" class="btn btn-light text-start mb-1 w-100">'. basename($img) .'<span class="float-end badge bg-success rounded-pill">'. basename($imgBasePath[$key]) .'</span></a>';
				} ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="Fermer"><i class="bi bi-arrow-left-circle"></i> Fermer</button>
			</div>
		</div>
	</div>
</div>
<!-- END MODAL IMG FILES -->