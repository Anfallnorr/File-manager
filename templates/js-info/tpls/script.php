<?php

defined('_EXEC') or die;
// $js_files = "/templates/js-info/html/". $this->requests->controller ."/assets/js/". $this->requests->view .".js";
// debug($customer);
// debug($params);
// debug($this_controller);
// debug($this_view);
// debug($req_controller);
// debug($req_view);
// debug($js_files);

$get_datatables_controller = array("customers", "ecommerces", "messages", "connections", "datas", "params");
$get_datatables_view = array("customer", "editappointment", "categorie", "product", "order", "message", "connection", "log", "data", "access", "fields");
$get_datetimepicker_controller = array("customers", "datas");
$get_datetimepicker_view = array("editappointment", "appointment", "data");
$get_tagsinput_controller = array("customers", "ecommerces", "params");
$get_tagsinput_view = array("editappointment", "editproduct", "editcategorie", "param");

/* if( $params['jquery_migrate'] == 1 ) : ?>
	<script src="/templates/<?php echo $this->theme ?>/assets/js/jquery/jquery-migrate-3.2.2.min.js" type="text/javascript"></script>
<?php endif; */ ?>
<!-- JQuery -->
<?php /*<script src="/templates/<?php echo $this->theme ?>/assets/js/jquery/jquery-3.6.0.min.js" type="text/javascript"></script>*/ ?>
<script src="/js/plugins/jquery/jquery-3.7.0.js" type="text/javascript"></script>
<!-- Bootstrap JS -->
<script src="/templates/<?php echo $this->theme ?>/assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="/js/functions.js" type="text/javascript"></script>
<?php /*<script src="/js/classes/images.js"></script>
<script src="/js/classes/urlparser.js"></script>*/ ?>

<?php if( $this->requests->controller !== "authentications" ) : ?>
	<!-- Plugins -->
	<script src="/js/plugins/<?php echo $this->theme ?>/simplebar/js/simplebar.min.js" type="text/javascript"></script>
	<script src="/js/plugins/<?php echo $this->theme ?>/metismenu/js/metisMenu.min.js" type="text/javascript"></script>
	<script src="/js/plugins/<?php echo $this->theme ?>/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
	
	<?php if( in_array($this->requests->controller, $get_datatables_controller) ) {
		if( in_array($this->requests->view, $get_datatables_view) ) { ?>
			<?php /*<script src="/js/plugins/<?php echo $this->theme ?>/datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
			<script src="/js/plugins/<?php echo $this->theme ?>/datatable/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>*/ ?>
			<script src="/js/plugins/DataTables-bs5/datatables.min.js" type="text/javascript"></script>
			<script src="/js/plugins/DataTables-bs5/DataTables-1.13.5/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
		<?php }
	} ?>
	
	<?php if( in_array($this->requests->controller, $get_datetimepicker_controller) ) {
		if( in_array($this->requests->view, $get_datetimepicker_view) ) { ?>
			<script src="/js/plugins/bootstrap-material-datetimepicker/js/moment.min.js" type="text/javascript"></script>
			<script src="/js/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js" type="text/javascript"></script>
		<?php }
	} ?>
	
	<?php if( $this->requests->controller == "dashboards" ) { ?>
		<script src="/js/plugins/jvectormap/jquery-jvectormap-2.0.5.min.js" type="text/javascript"></script>
		<script src="/js/plugins/jvectormap/maps/fr-mill-fr.js" type="text/javascript"></script>
		<script src="/js/plugins/jvectormap/maps/en-mill-en.js" type="text/javascript"></script>
		<script src="/js/plugins/jvectormap/maps/de-mill-de.js" type="text/javascript"></script>
		<script src="/js/plugins/jvectormap/maps/us-mill-us.js" type="text/javascript"></script>
		<script src="/js/plugins/jvectormap/maps/es-mill-es.js" type="text/javascript"></script>
		<?php /*<script src="/js/plugins/jvectormap/fr_region_mill_fr.js" type="text/javascript"></script>
		<script src="/js/plugins/jvectormap/fr_regions_mill_fr.js" type="text/javascript"></script>
		<script src="/js/plugins/jvectormap/gdp-data_fr.js" type="text/javascript"></script>*/ ?>
		
		<script src="/js/plugins/fullcalendar-6.1.8/dist/index.global.min.js" type="text/javascript"></script>
		<script src="/js/plugins/fullcalendar-6.1.8/packages/core/locales/en-gb.global.min.js" type="text/javascript"></script>
		<script src="/js/plugins/fullcalendar-6.1.8/packages/core/locales/fr.global.min.js" type="text/javascript"></script>
		<script src="/js/plugins/fullcalendar-6.1.8/packages/core/locales/de.global.min.js" type="text/javascript"></script>
		<?php /*
		<script src="/js/plugins/fullcalendar-6.1.8/packages/interaction/index.global.min.js" type="text/javascript"></script>*/ ?>
		<script src="/js/plugins/fullcalendar-6.1.8/packages/bootstrap5/index.global.min.js" type="text/javascript"></script>
		
		<script src="/js/plugins/<?php echo $this->theme ?>/chartjs/js/Chart.min.js" type="text/javascript"></script>
		<?php /*<script src="/js/plugins/<?php echo $this->theme ?>/apexcharts-bundle/js/apexcharts.min.js" type="text/javascript"></script>*/ ?>
		<script src="/js/plugins/apexcharts-bundle_v3.40.0/js/apexcharts.min.js" type="text/javascript"></script>
		<script src="/js/plugins/<?php echo $this->theme ?>/jquery.easy-pie-chart/jquery.easypiechart.min.js" type="text/javascript"></script>
		<script src="/js/plugins/<?php echo $this->theme ?>/sparkline-charts/jquery.sparkline.min.js" type="text/javascript"></script>
		<?php /*<script src="/js/plugins/<?php echo $this->theme ?>/jquery-knob/excanvas.min.js" type="text/javascript"></script>*/ ?>
		<script src="/js/plugins/<?php echo $this->theme ?>/jquery-knob/jquery.knob.min.js" type="text/javascript"></script>
	<?php } ?>
	
	<?php if( $this->requests->controller == "customers" ) {
		if( $this->requests->view == "profile" ) { ?>
			<script src="/js/plugins/dropzone/dropzone.min.js"></script>
			<script src="/js/plugins/cropperjs/dist/cropper.min.js" type="text/javascript"></script>
		<?php }
	} ?>
	
	<?php if( $this->requests->controller == "datas" ) {
		if( $this->requests->view == "data" ) { ?>
			<?php /*<script src="/js/plugins/exif-ajax/exif_v2.3.0.min.js" type="text/javascript"></script>*/ ?>
			
			<?php if( $params['upload_select'] == "normal" ) { ?>
				<script src="/templates/<?php echo $this->theme ?>/html/datas/assets/js/ajax-progress.js" type="text/javascript"></script>
			<?php } elseif( $params['upload_select'] == "ajax" ) { ?>
				<script src="/templates/<?php echo $this->theme ?>/html/datas/assets/js/ajax-upload.js" type="text/javascript"></script>
			<?php } else { ?>
				<script src="/js/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
				<script src="/templates/js-info/html/datas/assets/js/ajax-dropzone.js" type="text/javascript"></script>
				<?php /*<script src="/js/plugins/<?php echo $this->theme ?>/fancy-file-uploader/jquery.ui.widget.js" type="text/javascript"></script>
				<script src="/js/plugins/<?php echo $this->theme ?>/fancy-file-uploader/jquery.fileupload.js" type="text/javascript"></script>
				<script src="/js/plugins/<?php echo $this->theme ?>/fancy-file-uploader/jquery.iframe-transport.js" type="text/javascript"></script>
				<script src="/js/plugins/<?php echo $this->theme ?>/fancy-file-uploader/jquery.fancy-fileupload.js" type="text/javascript"></script>*/ ?>
			<?php }
		/*} elseif( $this->requests->view == "picture" ) {*/
		} elseif( $this->requests->view == "audio" ) { ?>
			<script src="/js/plugins/slick/slick-1.9.0.js" type="text/javascript"></script>
			<script src="/js/plugins/jsmediatags/jsmediatags-3.9.5.min.js" type="text/javascript"></script>
		<?php /*} elseif( $this->requests->view == "video" ) {*/
		}
	} ?>
	
	<?php if( in_array($this->requests->controller, $get_tagsinput_controller) ) {
		if( in_array($this->requests->view, $get_tagsinput_view) ) { ?>
			<script src="/js/plugins/input-tags/js/tagsinput.js" type="text/javascript"></script>
		<?php }
	} ?>
	
	<?php /*if( $this->requests->controller == "params" ) { ?>
		<?php if( $this->requests->view == "editaccesscontroller" ) { ?>
			<script src="/js/plugins/select2/js/select2.min.js"></script>
			<script>
				$('#icons_select').select2({
					theme: 'bootstrap4',
					width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
					placeholder: $(this).data('placeholder'),
					allowClear: Boolean($(this).data('allow-clear')),
				});
			</script>
		<?php } ?>
	<?php }*/ ?>
	
	<?php if( $this->requests->controller == "tools" ) {
		if( $this->requests->view == "dummyimage" ) { ?>
			<script src="/js/classes/imagecreator.js" type="text/javascript"></script>
		<?php }
	} ?>
	
	<?php if( $this->requests->controller == "params" ) {
		if( $this->requests->view == "filesparam" ) { ?>
			<script src="/js/plugins/codemirror-5.65.12/lib/codemirror.js" type="text/javascript"></script>
			<script src="/js/plugins/codemirror-5.65.12/addon/hint/show-hint.js" type="text/javascript"></script>
			<script src="/js/plugins/codemirror-5.65.12/addon/hint/javascript-hint.js" type="text/javascript"></script>
		<?php }
	} ?>
	
	<?php /*if( $this->requests->controller == "tools" ) {*/ ?>
		<script src="/js/plugins/notifications/js/lobibox.min.js" type="text/javascript"></script>
		<script src="/js/plugins/notifications/js/notifications.min.js" type="text/javascript"></script>
		<script src="/js/plugins/notifications/js/notification-custom-script.js" type="text/javascript"></script>
	<?php /*}*/ ?>
	
	<!-- app JS -->
	<script src="/templates/<?php echo $this->theme ?>/assets/js/app.js" type="text/javascript"></script>
	<script src="/templates/<?php echo $this->theme ?>/assets/js/context-menu.js" type="text/javascript"></script>
	<script src="/templates/<?php echo $this->theme ?>/assets/js/<?php echo $this->theme ?>.js" type="text/javascript"></script>
	<?php /*if( file_exists(_ROOTURL_ ."/templates/". $this->theme ."/assets/js/". $this->theme .".js") ) : ?>
		<script src="/templates/<?php echo $this->theme ?>/assets/js/<?php echo $this->theme ?>.js" type="text/javascript"></script>
	<?php endif;*/ ?>
	
	<?php /*if( $customer['access'] <= 0 ) { ?>
		<script src="/js/plugins/jquery-ui-1.13.0.draggable/jquery-ui.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			/*$(function() {
				$("#menu").sortable({
					classes: {
						"ui-sortable": "highlight"
					},
					axis: "y",
					containment: "parent",
					cursor: "move",
					// cursorAt: {
						// top: 5,
						// right: 5,
						// bottom: 5,
						// left: 5
					// },
					// disabled: true,
					// forceHelperSize: true,
					// forcePlaceholderSize: true,
					// grid: [ 20, 49 ],
					handle: ".handle",
					// items: "> li",
					opacity: 0.5,
					// revert: true,
					// serialize: {
						// key: "sort"
						// attribute: "data-position"
					// },
				});
			});*/
			/*
			// $("#menu").on("sortupdate", function(event, ui) {
				// let sidebarPositionMenu = $('#menu > li.sidebar-menu_item');
				// sidebarPositionMenu.each(function(index, element) {
					// element.setAttribute('data-position', getIndexPositionMenu[index]);
				// });
				
				// $.ajax({
					// method: "POST",
					// url: "/models/ajax/ajax?ajax=true",
					// dataType: "html",
					// data: {
						// table: "pages_controller",
						// primaryKey: "id",
						// start_position: getIndexPositionMenu,
						// menus: getMenuInfos,
					// }
				// })
				// .done(function(data) {
					// if( console && console.log ) {
						// console.log( "Sample of data done:", data );
					// }
				// })
				// .fail(function(data) {
					// console.log( "Sample of data fail:", data );
				// });
			// });
		</script>
	<?php }*/
endif; ?>

<?php /*<script>$(function() {$(".knob").knob();}); </script>*/ ?>
<?php if( file_exists(_ROOTURL_ . $js_files) ) : ?>
	<script src="<?php echo $js_files ?>" type="text/javascript"></script>
<?php endif; ?>


