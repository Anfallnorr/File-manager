<?php

defined('_EXEC') or die;

if( !empty($this->requests->params) ) {
	$query_params = '/'. implode("/", $this->requests->params);
} else {
	$query_params = "";
}

// debug($this->theme);
// debug($params);
// debug($config);
// debug($req_view);
// debug($this_controller);
// debug($this_view);
// debug($this_seo);
// debug($this->requests->controller);
// debug($this->requests->view);
// debug($this->requests->seos);
// debug($metas);
// debug($getMetas);
// debug($seo);
// debug($css_files);
?>

<?php /*<meta http-equiv="X-UA-Compatible" content="IE=edge">*/ ?>
<!-- Required meta tags -->
<meta charset="utf-8">
<?php /*<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=5.0">*/ ?>
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta property="og:title" content="<?php echo ( !is_null($this_seo) ) ? $this_seo['title'] : $config->MetaTitle ?>">
<meta property="og:description" content="<?php echo ( !is_null($this_seo) ) ? $this_seo['description'] : $config->MetaDesc ?>">
<meta property="og:url" content="<?php echo $config->siteurl . $this->requests->controller .'/'. $this->requests->view . $query_params ?>">
<meta property="og:site_name" content="<?php echo $config->sitename ?>">
<meta property="og:type" content="website">

<link rel="dns-prefetch" href="https://ajax.googleapis.com">

<!-- SEO -->
<meta name="robots" content="<?php echo ( !is_null($this_seo) ) ? $this_seo['robots'] : $config->robots ?>">
<meta name="description" content="<?php echo ( !is_null($this_seo) ) ? $this_seo['description'] : $config->MetaDesc ?>">
<meta name="author" content="<?php echo $config->MetaAuthor ?>">
<meta name="generator" content="CRM version <?php echo $config->MetaVersion ?>">
<title><?php echo $config->sitename ?> - <?php echo ( !is_null($this_seo) ) ? $this_seo['title'] : $config->MetaTitle ?></title>

<!-- favicon -->
<?php /*<link href="/templates/<?php echo $this->theme ?>/favicon.ico" type="image/vnd.microsoft.icon" rel="icon">
<link href="/templates/<?php echo $this->theme ?>/favicon.ico" type="image/x-icon" rel="shortcut icon">*/ ?>
<link href="<?php echo $params['favicon_site'] ?>" type="image/vnd.microsoft.icon" rel="icon" />
<link href="<?php echo $params['favicon_site'] ?>" type="image/x-icon" rel="shortcut icon" />

<?php if( $this->requests->controller !== "authentications" && $this->requests->controller !== "errors" ) : ?>
	<!-- plugins -->
	<?php /*<script src="/js/plugins/tinymce/tinymce-6.0.2.min.js" type="text/javascript"></script>*/ ?>
	<script src="https://cdn.tiny.cloud/1/rrgunau4wp3tf3nt1814lbfugzf89zva82xsxngdfrmd65nt/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
	<link href="/js/plugins/notifications/css/lobibox.min.css" type="text/css" rel="stylesheet" />
	<link href="/js/plugins/<?php echo $this->theme ?>/simplebar/css/simplebar.min.css" type="text/css" rel="stylesheet" />
	<link href="/js/plugins/<?php echo $this->theme ?>/perfect-scrollbar/css/perfect-scrollbar.min.css" type="text/css" rel="stylesheet" />
	<link href="/js/plugins/<?php echo $this->theme ?>/metismenu/css/metisMenu.min.css" type="text/css" rel="stylesheet" />
	<link href="/js/plugins/<?php echo $this->theme ?>/datatable/css/dataTables.bootstrap5.min.css" type="text/css" rel="stylesheet" />
	<?php /*<link href="/js/plugins/DataTables-bs5/DataTables-1.13.5/css/dataTables.bootstrap5.min.css" type="text/css" rel="stylesheet" />*/ ?>
	<link href="/js/plugins/input-tags/css/tagsinput.css" type="text/css" rel="stylesheet" />
	
	<link href="/js/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css" type="text/css" rel="stylesheet" />
	<link href="/js/plugins/bootstrap-material-datetimepicker/css/material-icons.css" type="text/css" rel="stylesheet" />
	
	<?php /*<link href="/js/plugins/<?php echo $this->theme ?>/select2/css/select2.min.css" type="text/css" rel="stylesheet" />
	<link href="/js/plugins/<?php echo $this->theme ?>/select2/css/select2-bootstrap4.css" type="text/css" rel="stylesheet" />*/ ?>
	
	<?php if( $params['pre_loader'] !== 0 ) { ?>
		<!-- loader -->
		<link href="/templates/<?php echo $this->theme ?>/assets/css/pace.minimal.css" type="text/css" rel="stylesheet" />
		<?php /*<link href="/templates/<?php echo $this->theme ?>/assets/css/pace.min.css" type="text/css" rel="stylesheet" />*/ ?>
		<script src="/templates/<?php echo $this->theme ?>/assets/js/pace.min.js" type="text/javascript"></script>
	<?php } ?>
	<?php if( $this->requests->controller == "dashboards" ) { ?>
		<link href="/js/plugins/jvectormap/jquery-jvectormap-2.0.5.css" rel="stylesheet" />
		<link href="/js/plugins/apexcharts-bundle_v3.40.0/css/apexcharts.css" type="text/css" rel="stylesheet" />
	<?php } ?>
	<?php if( $this->requests->controller == "customers" ) {
		if( $this->requests->view == "profile" ) { ?>
			<link href="/js/plugins/dropzone/dropzone.min.css" type="text/css" rel="stylesheet" />
			<link href="/js/plugins/cropperjs/dist/cropper.min.css" type="text/css" rel="stylesheet" />
		<?php }
	} ?>
	
	<?php if( $this->requests->controller == "datas" ) {
		if( $this->requests->view == "data" ) {
			if( $params['upload_select'] == "dropzone" ) { ?>
				<link href="/js/plugins/dropzone/dropzone.min.css" rel="stylesheet" />
			<?php }
		}
	} ?>
	
	<?php if( $this->requests->controller == "params" ) {
		if( $this->requests->view == "filesparam" ) { ?>
			<link href="/js/plugins/codemirror-5.65.12/lib/codemirror.css" rel="stylesheet" />
			<link href="/js/plugins/codemirror-5.65.12/theme/eclipse.css" rel="stylesheet" />
			<link href="/js/plugins/codemirror-5.65.12/addon/hint/show-hint.css" rel="stylesheet" />
		<?php }
	} ?>
<?php endif; ?>

<!-- Bootstrap CSS -->
<link href="/templates/<?php echo $this->theme ?>/assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<?php /*<link href="/templates/<?php echo $this->theme ?>/assets/css/bootstrap-5.0.2.css" rel="stylesheet">*/ ?>

<?php /*<link href="/templates/<?php echo $this->theme ?>/assets/css/app.min.css" type="text/css" rel="stylesheet" />*/ ?>
<link href="/templates/<?php echo $this->theme ?>/assets/css/<?php echo $params['menu'] ?>/app.min.css" type="text/css" rel="stylesheet" />
<link href="/templates/<?php echo $this->theme ?>/assets/css/icons.min.css" type="text/css" rel="stylesheet" />
<link href="/templates/<?php echo $this->theme ?>/assets/css/<?php echo $this->theme ?>.css" type="text/css" rel="stylesheet" />
<?php /*if( file_exists(_ROOTURL_ ."/templates/". $this->theme ."/assets/css/". $this->theme .".css") ) : ?>
	<link href="/templates/<?php echo $this->theme ?>/assets/css/<?php echo $this->theme ?>.css" type="text/css" rel="stylesheet">
<?php endif;*/ ?>

<style type="text/css">
/* Chart.js */
/*
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}
*/
</style>

<?php if( file_exists(_ROOTURL_ . $css_files) ) : ?>
	<link href="<?php echo $css_files ?>" type="text/css" rel="stylesheet">
<?php endif; ?>