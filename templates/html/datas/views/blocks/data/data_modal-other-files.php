<!-- BEGIN MODAL OTHER FILES -->
<div class="modal fade" id="modal_other_files" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Autres fichiers</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer" title="Fermer"></button>
			</div>
			<div class="modal-body">
				<?php foreach($otherBasename as $key => $other) {
					echo '<a href="/datas/data'. $otherBasePath[$key] .'" class="btn btn-light text-start mb-1 w-100">'. basename($other) .'</a>';
				} ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="Fermer"><i class="bi bi-arrow-left-circle"></i> Fermer</button>
			</div>
		</div>
	</div>
</div>
<!-- END MODAL OTHER FILES -->