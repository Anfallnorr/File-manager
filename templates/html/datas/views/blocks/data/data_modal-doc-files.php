<!-- BEGIN MODAL DOC FILES -->
<div class="modal fade" id="modal_doc_files" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Documents</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer" title="Fermer"></button>
			</div>
			<div class="modal-body">
				<?php foreach($docBasename as $key => $doc) {
					echo '<a href="/datas/data'. $docBasePath[$key] .'" class="btn btn-light text-start mb-1 w-100">'. basename($doc) .'</a>';
				} ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal" title="Fermer"><i class="bi bi-arrow-left-circle"></i> Fermer</button>
			</div>
		</div>
	</div>
</div>
<!-- END MODAL DOC FILES -->