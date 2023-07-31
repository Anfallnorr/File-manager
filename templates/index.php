<?php

// debug(http_response_code());
// debug($this->theme);
// debug($this->customer);
// debug(gettype($this->customer));
// debug($customer);
// die;

$themeBg = (!empty($customer['theme_bg'])) ? $customer['theme_bg'] : "theme0";
$hotkeys = (!empty($customer['hotkeys']) && $customer['hotkeys'] == '1') ? " hotkeys-enabled" : "";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang ?>" lang="<?php echo $lang ?>" data-bs-theme="_light">
	<head>
		<?php include _ROOTURL_ ."/templates/tpls/head.php" ?>
	</head>
	
	<body requests="" theme="<?php echo $this->theme ?>" bgtheme="bg-<?php echo $themeBg ?>" class="bg-theme <?php echo $this->requests->view ?>-page <?php echo $this->requests->controller .'-'. $this->requests->view . $device['class']; echo $hotkeys ?>">
		<?php if( $params['pre_loader'] !== 0 ) { ?>
			<div id="loading-wrapper"><div class="spinner"><div class="line1"></div><div class="line2"></div><div class="line3"></div><div class="line4"></div><div class="line5"></div><div class="line6"></div></div></div>
		<?php }/**/ ?>
		<div class="page-wrapper no-sidebar">
			<?php /* include _ROOTURL_ ."/templates/tpls/sidebar.php" */ ?>
			<div class="main-container">
				<div class="page-header">
					<div class="toggle-sidebar" id="toggle-sidebar"><i class="bi bi-list"></i></div>
					<?php include _ROOTURL_ ."/templates/tpls/breadcrumb.php";
					include _ROOTURL_ ."/templates/tpls/topbar.php"; ?>
				</div>
				<div class="content-wrapper-scroll">
					<noscript>
						<div id="notification" class="alert border-0 border-start border-5 border-danger show py-2 bg-light">
							<div class="d-flex align-items-center">
								<div class="font-35 text-white"><i class="bx bx-info-circle"></i></div>
								<div class="ms-3"><h6 class="mb-0 text-white">danger</h6><div class="text-white">Veuillez activer JavaScript dans la console, sans ça le site ne fonctionnera pas correctement !</div></div>
							</div>
						</div>
					</noscript>
					<div id="content_wrapper" class="content-wrapper">
						<div id="notification_ajax" class="preview active d-none"></div>
						<?php if( !empty($this->notifications) ) { ?>
							<div id="notification" class="alert alert-<?php echo $this->notifications['type'] ?> border-0 border-start border-5 border-<?php echo $this->notifications['type'] ?> alert-dismissible fade show" role="alert">
								<?php echo $this->notifications['value'] ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php }
						echo (!empty($view_out)) ? $view_out : "Un problème est survenu." ?>
					</div>
					<?php include _ROOTURL_ ."/templates/tpls/footer.php" ?>
				</div>
			</div>
		</div>
		<?php include _ROOTURL_ ."/templates/tpls/context_menu.php";
		include _ROOTURL_ ."/templates/tpls/script.php"; ?>
	</body>
</html>
