<?php

defined('_EXEC') or die;

if( !empty($this->requests->params) ) {
	$query_params = '/'. implode("/", $this->requests->params);
} else {
	$query_params = "";
}

?>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta property="og:title" content="Mes documents">
<meta property="og:description" content="Mes documents">
<meta property="og:url" content="https://crm.js-info.fr/datas/data">
<meta property="og:site_name" content="Js info">
<meta property="og:type" content="website">

<link rel="dns-prefetch" href="https://ajax.googleapis.com">

<!-- SEO -->
<meta name="robots" content="<?php echo $config->robots ?>">
<meta name="description" content="<?php echo $config->MetaDesc ?>">
<meta name="author" content="<?php echo $config->MetaAuthor ?>">
<meta name="generator" content="File manager version <?php echo $config->MetaVersion ?>">
<title><?php echo $config->sitename ?> - <?php echo $config->MetaTitle ?></title>

<!-- favicon -->
<link href="<?php echo $params['favicon_site'] ?>" type="image/vnd.microsoft.icon" rel="icon" />
<link href="<?php echo $params['favicon_site'] ?>" type="image/x-icon" rel="shortcut icon" />

<!-- plugins -->
<link href="/js/plugins/notifications/css/lobibox.min.css" type="text/css" rel="stylesheet" />
<link href="/js/plugins/simplebar/css/simplebar.min.css" type="text/css" rel="stylesheet" />
<link href="/js/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css" type="text/css" rel="stylesheet" />
<link href="/js/plugins/metismenu/css/metisMenu.min.css" type="text/css" rel="stylesheet" />
<link href="/js/plugins/datatable/css/dataTables.bootstrap5.min.css" type="text/css" rel="stylesheet" />

<link href="/templates/<?php echo $this->theme ?>/assets/css/pace.minimal.css" type="text/css" rel="stylesheet">
<script src="/templates/<?php echo $this->theme ?>/assets/js/pace.min.js" type="text/javascript"></script>

<link href="/js/plugins/dropzone/dropzone.min.css" rel="stylesheet" />

<!-- Bootstrap CSS -->
<link href="/templates/<?php echo $this->theme ?>/assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />

<link href="/templates/<?php echo $this->theme ?>/assets/css/app.min.css" type="text/css" rel="stylesheet" />
<link href="/templates/<?php echo $this->theme ?>/assets/css/icons.min.css" type="text/css" rel="stylesheet" />
<link href="/templates/<?php echo $this->theme ?>/assets/css/js-info.css" type="text/css" rel="stylesheet" />

<link href="/templates/<?php echo $this->theme ?>/html/datas/assets/css/data.css" type="text/css" rel="stylesheet">