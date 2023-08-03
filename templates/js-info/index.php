<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang ?>" lang="<?php echo $lang ?>">
	<head>
		<?php include _ROOTURL_ ."/templates/". $this->theme ."/tpls/head.php" ?>
	</head>
	<body requests="" theme="<?php echo $theme ?>" bgtheme="bg-theme0" class="hidden-x bg-theme data-page datas-data">
		<div class="wrapper">
			<?php /* include _ROOTURL_ ."/templates/". $this->theme ."/tpls/sidebar.php"; */
				include _ROOTURL_ ."/templates/". $this->theme ."/tpls/topbar.php"; ?>
			<div class="page-wrapper">
				<div class="page-content">
					<noscript>
						<div id="notification" class="alert border-0 border-start border-5 border-danger show py-2 bg-light">
							<div class="d-flex align-items-center">
								<div class="fs-35 text-white"><i class="bx bx-info-circle"></i></div>
								<div class="ms-3"><h6 class="mb-0 text-white">danger</h6><div class="text-white"><?php $langs->lang("JSNOSCRIPT") ?></div></div>
							</div>
						</div>
					</noscript>
					
					<div id="notification_ajax" class="preview active d-none"></div>
					<?php if( !empty($this->notifications) ) { ?>
						<div id="notification" class="alert border-0 border-start border-5 border-<?php echo $this->notifications['type']; ?> alert-dismissible fade show py-2">
							<div class="d-flex align-items-center">
								<div class="fs-35 text-white">
									<i class="<?php echo $this->notifications['icon'] ?>"></i>
								</div>
								<div class="ms-3">
									<h6 class="mb-0 text-white"><?php echo $this->notifications['type']; ?></h6>
									<div class="text-white"><?php echo $this->notifications['value']; ?></div>
								</div>
							</div>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?php } ?>
					<?php include _ROOTURL_ ."/templates/". $this->theme ."/tpls/breadcrumb.php";
					if(!empty($view_out)) {
						echo $view_out;
					} else {
						$langs->lang("JSTHERE_WAS_A_PROBLEM");
					} ?>
					
				</div>
			</div>
			<?php include _ROOTURL_ ."/templates/". $this->theme ."/tpls/footer.php" ?>
		</div>
		
		<?php include _ROOTURL_ ."/templates/". $this->theme ."/tpls/context_menu.php";
		include _ROOTURL_ ."/templates/". $this->theme ."/tpls/script.php"; ?>
		<div class="drag-selector"></div>
	</body>
</html>
