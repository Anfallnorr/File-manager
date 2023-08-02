<?php

if( is_dir(_ROOTURL_ ."/uploads/datas/". $personnalFolder) ) :
	if( !empty($path) ) {
		$folderPath = "/". implode("/", $path);
		$files = scandir(_ROOTURL_ ."/uploads/datas/". $personnalFolder ."/". $folderPath);
	} else {
		$folderPath = "";
		$files = scandir(_ROOTURL_ ."/uploads/datas/". $personnalFolder);
	}
	
	if( $folderPath == "/" ) {
		$folderPath = "";
	}
	
	$excludeScan = array(".", "..", "", "index.php", "index.html", "thumbnails", "miniatures"); ?>
	<script>
		var DATA_DOWNLOAD = "Télécharger";
		var DATA_RENAME = "Renommer";
		var DATA_DELETE = "Supprimer";
		var DATA_FILES_LIST_RENAME_A_FILE = "Renomer un fichier";
		var JSCLOSED = "Fermé";
		var JSCANCEL = "Annuler";
		var JSARE_YOU_SURE_YOU_WANT_TO_DELETE = "Voulez-vous vraiment supprimer";
	</script>
	<div class="card">
		<div class="card-header">
			<div class="card-title">Informations</div>
		</div>
		<div class="card-body">
			<div class="storage<?php if( $expander === "true" ) : echo " icon-reverse"; endif; ?>" data-expand="true">
				<h5 class="mb-0 font-weight-bold"><?php echo $sizeName ?> <span class="float-end">1 GB</span></h5>
				<p class="mb-0 mt-2"><span class="">Espace utilisé <?php echo $totalSize ?>%</span><span class="float-end">100 %</span></p>
				<div class="progress mt-3" style="height:15px;">
					<div class="progress-bar bg-success" role="progressbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Documents" style="width: <?php echo $totalDocSizePercent ?>%" aria-valuenow="<?php echo $totalDocSizePercent ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Espace documents totaux"></div>
					<div class="progress-bar bg-primary" role="progressbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Images" style="width: <?php echo $totalImgSizePercent ?>%" aria-valuenow="<?php echo $totalImgSizePercent ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Espace images totaux"></div>
					<div class="progress-bar bg-info" role="progressbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Musiques" style="width: <?php echo $totalAudioSizePercent ?>%" aria-valuenow="<?php echo $totalAudioSizePercent ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Espace musiques totaux"></div>
					<div class="progress-bar bg-danger" role="progressbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Vidéos" style="width: <?php echo $totalVidSizePercent ?>%" aria-valuenow="<?php echo $totalVidSizePercent ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Espace vidéos totaux"></div>
					<div class="progress-bar bg-warning" role="progressbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Autres fichiers" style="width: <?php echo $totalOtherSizePercent ?>%" aria-valuenow="<?php echo $totalOtherSizePercent ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Espace des autres fichiers totaux"></div>
				</div>
			</div>
			<div class="info-storage list-group mt-3"<?php if( $expander == "false" ) : echo ' style="display: none;"'; endif; ?>>
				<?php if( $nbDocFiles > 0 ) : ?>
					<div class="list-group-item d-flex justify-content-between align-items-center bg-extralight-success">
						<div class="d-flex align-items-center">
							<div class="bg-light-success text-white py-1 px-2 fs-25 radius-10 me-3"><i class="bi bi-file-earmark-text"></i></div>
							<div class="">
								<h6 class="mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_doc_files" title="Documents">Documents</a></h6>
								<p class="mb-0 text-secondary"><?php echo $nbDocFiles .' ' ?> Fichiers</p>
							</div>
						</div>
						<div class="badge shade-green rounded-pill px-3">
							<h6 class="mb-0"><?php echo $docSizeName ?><br />
							<span class="fs-14 text-secondary"><?php echo $totalDocSizePercent ?>%</span></h6>
						</div>
					</div>
				<?php endif;
				if( $nbImgFiles > 0 ) : ?>
					<div class="list-group-item d-flex justify-content-between align-items-center bg-extralight-primary">
						<div class="d-flex align-items-center">
							<div class="bg-light-primary text-white py-1 px-2 fs-25 radius-10 me-3"><i class="bi bi-image-fill"></i></div>
							<div class="">
								<h6 class="mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_img_files" title="Images">Images</a></h6>
								<p class="mb-0 text-secondary"><?php echo $nbImgFiles .' ' ?> Fichiers</p>
							</div>
						</div>
						<div class="badge shade-green rounded-pill px-3">
							<h6 class="mb-0"><?php echo $imgSizeName ?><br />
							<span class="fs-14 text-secondary"><?php echo $totalImgSizePercent ?>%</span></h6>
						</div>
					</div>
				<?php endif;
				if( $nbAudioFiles > 0 ) : ?>
					<div class="list-group-item d-flex justify-content-between align-items-center bg-extralight-info">
						<div class="d-flex align-items-center">
							<div class="bg-light-info text-white py-1 px-2 fs-25 radius-10 me-3"><i class="bi bi-music-note-beamed"></i></div>
							<div class="">
								<h6 class="mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_audio_files" title="Musiques">Musiques</a></h6>
								<p class="mb-0 text-secondary"><?php echo $nbAudioFiles .' ' ?> Fichiers</p>
							</div>
						</div>
						<div class="badge shade-green rounded-pill px-3">
							<h6 class="mb-0"><?php echo $audioSizeName ?><br />
							<span class="fs-14 text-secondary"><?php echo $totalAudioSizePercent ?>%</span></h6>
						</div>
					</div>
				<?php endif;
				if( $nbVidFiles > 0 ) : ?>
					<div class="list-group-item d-flex justify-content-between align-items-center bg-extralight-danger">
						<div class="d-flex align-items-center">
							<div class="bg-light-danger text-white py-1 px-2 fs-25 radius-10 me-3"><i class="bi bi-camera-video"></i></div>
							<div class="">
								<h6 class="mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_vid_files" title="Vidéos">Vidéos</a></h6>
								<p class="mb-0 text-secondary"><?php echo $nbVidFiles .' ' ?> Fichiers</p>
							</div>
						</div>
						<div class="badge shade-green rounded-pill px-3">
							<h6 class="mb-0"><?php echo $vidSizeName ?><br />
							<span class="fs-14 text-secondary"><?php echo $totalVidSizePercent ?>%</span></h6>
						</div>
					</div>
				<?php endif;
				if( $nbOtherFiles > 0 ) : ?>
					<div class="list-group-item d-flex justify-content-between align-items-center bg-extralight-warning">
						<div class="d-flex align-items-center">
							<div class="bg-light-warning text-white py-1 px-2 fs-25 radius-10 me-3"><i class="bi bi-file-earmark-break"></i></div>
							<div class="">
								<h6 class="mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_other_files" title="Autres fichiers">Autres fichiers</a></h6>
								<p class="mb-0 text-secondary"><?php echo $nbOtherFiles .' ' ?>Fichiers</p>
							</div>
						</div>
						<div class="badge shade-green rounded-pill px-3">
							<h6 class="mb-0"><?php echo $otherSizeName ?><br />
							<span class="fs-14 text-secondary"><?php echo $totalOtherSizePercent ?>%</span></h6>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php if( $nbDocFiles > 0 ) {
		include $dataDir ."/data_modal-doc-files.php";
	}
	if( $nbImgFiles > 0 ) {
		include $dataDir ."/data_modal-img-files.php";
	}
	if( $nbAudioFiles > 0 ) {
		include $dataDir ."/data_modal-audio-files.php";
	}
	if( $nbVidFiles > 0 ) {
		include $dataDir ."/data_modal-vid-files.php";
	}
	if( $nbOtherFiles > 0 ) {
		include $dataDir ."/data_modal-other-files.php";
	} ?>
	<div class="card">
		<div class="card-header">
			<div class="card-title">Mon drive</div>
		</div>
		<div class="card-body">
			<form action="" method="post">
				<div class="row">
					<div class="block-form d-none">
						<input name="add_folder" type="hidden" id="fieldAdd_folder" class="form-control empty" value="add_folder" />
					</div>
					<div class="col-md-12 mb-3">
						<div class="input-group">
							<input name="folder_name" type="text" id="fieldFolder_name" class="form-control add-folder empty" placeholder="Ajouter un dossier" aria-label="Ajouter un dossier" autocomplete="off" value="" />
							<button type="submit" class="btn btn-light">Ajouter</button>
						</div>
					</div>
				</div>
			</form>
			<form action="#" id="dropzone_form" class="dropzone h-200" enctype="multipart/form-data">
				<?php $jsPath = (!empty($this->requests->params)) ? "/". implode("/", $this->requests->params) : ""; ?>
				<div class="block-form d-none">
					<input name="max_size_folder" type="hidden" id="max_size_folder" class="form-control empty" value="<?php echo $totalSize ?>" />
				</div>
				<div class="block-form d-none">
					<input name="file_path" type="hidden" id="file_path" class="form-control empty" value="<?php echo $jsPath ?>" />
				</div>
				<div class="dz-message needsclick">
					<button type="button" class="dz-button" title="Déposez vos fichiers ici">Déposez vos fichiers ici</button>
				</div>
			</form>
		</div>
	</div>
	
	<form id="file_zone" class="" action="" method="post">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<?php include $dataDir ."/data_folders-breadcrumb.php" ?>
				</div>
			</div>
			<div class="card-body">
				<div class="d-flex flex-sm-row flex-column">
					<div class="btn-group">
						<a href="#" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_go_to" title="Aller à"><i class="bi bi-folder-symlink"></i> Aller à</a>
					</div>
					<div class="btn-group ms-0 ms-sm-auto mt-1 mt-sm-0">
						<button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Action groupé">Action groupé</button>
						<div class="dropdown-menu _dropdown-menu-right _dropdown-menu-lg-end w-auto">
							<a href="#" class="dropdown-item massdownload-item" data-bs-toggle="modal" data-bs-target="#modal_download" title="Télécharger la sélection" context="massDownload"><i class="bi bi-download"></i> Télécharger la sélection</a>
							<?php if( $personnalAllDirs != '' ) : ?>
								<a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_mass_move" title="Déplacer la sélection" context="massMove"><i class="bi bi-arrows-move"></i> Déplacer la sélection</a>
							<?php endif; ?>
							<a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_mass_renamer" title="Renommer la sélection" context="massRename"><i class="bi bi-input-cursor-text"></i> Renommer la sélection</a>
							<div class="dropdown-divider"></div>
							<span class="dropdown-item">
								<i class="bi bi-trash"></i> <input type="submit" name="action_mass_remove" class="input-inline" onclick="return confirm('Voulez-vous vraiment supprimer ces éléments ?');" title="Supprimer la sélection" value="Supprimer la sélection" context="massDelete" />
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card">
			<div class="card-body">
				<div class="custom-tabs-container">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" data-bs-toggle="tab" href="#tab1" role="tab" aria-selected="true" title="Mon espace personnel">
								<i class="bi bi-lock"></i>Mon espace personnel
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade show active" id="tab1" role="tabpanel">
							<div class="card-title mb-3">Dossiers</div>
							<div class="search-container mb-3 w-300">
								<div class="input-group">
									<input type="text" id="search_folders" class="form-control border bg-light" placeholder="Chercher un dossier">
									<button class="btn" type="button"><i class="bi bi-search"></i></button>
								</div>
							</div>
							<div id="data_folders-list" class="row _mb-3">								
								<?php include $dataDir ."/data_folders-list.php" ?>
							</div>
							<div class="card-title mt-3 mb-3">Fichiers</div>
							<div class="search-container mb-3 w-300">
								<div class="input-group">
									<input type="text" id="search_files" class="form-control border bg-light" placeholder="Chercher un fichier">
									<button class="btn" type="button"><i class="bi bi-search"></i></button>
								</div>
							</div>
							<div id="ajax_upload_result" class="mb-3"><div class="row"></div></div>
							<div id="data_files-list">
								<?php include $dataDir ."/data_files-list.php" ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php if( $personnalAllDirs != '' ) {
			include $dataDir ."/data_full-modals.php";
		} ?>
	</form>
	<?php if( isset($breadcrumb) && !empty($breadcrumb) && $breadcrumb != '' ) : ?>
		<div class="card">
			<div class="card-body">
				<div class="form-actions-footer">
					<?php if( count($breadcrumb) > 1 ) : 
						array_pop($breadcrumb) ?>
						<a href="/datas/data/<?php echo implode('/', $breadcrumb) ?>" class="btn btn-light return-page" title="Retour"><i class="bi bi-arrow-left-circle"></i> <?php echo ucfirst(end($breadcrumb)) ?></a>
					<?php else : ?>
						<a href="/datas/data" class="btn btn-light return-page" title="Retour"><i class="bi bi-arrow-left-circle"></i> Mes documents</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif;
else : ?>
	<div class="card">
		<div class="card-body">
			<form action="" method="post" class="mb-0">
				<div class="row">
					<div class="block-form d-none">
						<input name="add_folder" type="hidden" id="fieldAdd_folder" class="form-control empty" value="add_folder" />
					</div>
					<div class="col-md-12">
						<div class="input-group">
							<input name="folder_name" type="text" id="fieldFolder_name" class="form-control add-folder empty" placeholder="Ajouter un premier dossier" aria-label="Ajouter un premier dossier" autocomplete="off" value="" />
							<button type="submit" class="btn btn-light">Ajouter</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php endif; ?>

<div class="modal fade" id="modal_upload" tabindex="-1" aria-hidden="true"> <!-- modal-upload show -->
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Progression du chargement</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" title="Close" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="progress mb-3" style="height: 15px;">
							<div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-value="0" data-max="100"></div>
							<div class="d-block w-100 text-center pos-absolute lh-15">
								<span class="loading"></span> <span>Accompli</span>
							</div>
						</div>
						<div class="upload-weight">
							<h3 id="status">Chargement en cours... patientez !</h3>
							<p>Chargement : <span id="loading_weight" class="loading-weight"></span> Ko de <span id="total_weight" class="total-weight"></span> Ko</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- BEGIN MODAL COMPRESS -->
<div class="modal fade" id="modal_compress" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Compression du dossier</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body bg-light">
				<div id="compress_result"></div>
				<div class="progress mb-3" style="height: 15px;">
					<div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-value="0" data-max="100"></div>
					<div class="d-block w-100 text-center pos-absolute lh-15">
						<span class="loading"></span> <span>Accompli</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- BEGIN MODAL VIEWER -->
<div class="modal fade" id="modal_viewer" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Aperçu</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" title="Fermer" aria-label="Fermer"></button>
			</div>
			<div class="modal-body p-1">
				<div id="content_result"></div>
				<div class="process justify-content-center align-items-center">
					<div class="spinner-border text-green spinner-w10 _me-2" role="status" aria-hidden="true"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- BEGIN MODAL DOWNLOAD -->
<div class="modal fade" id="modal_download" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Compression en cours...</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" title="Close" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div id="download_result"></div>
				<div id="download_link" class="text-center"></div>
				<div class="process justify-content-center align-items-center">
					<div class="spinner-border text-green spinner-w10 _me-2" role="status" aria-hidden="true"></div>
					<div class="progress">
						<div class="progress-bar shade-green" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"><span>0</span>%</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>