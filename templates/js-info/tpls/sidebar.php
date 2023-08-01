<?php

defined('_EXEC') or die;

// $c = $this->requests->controller;
// $v = $this->requests->view;
// $p = $this->requests->params;
// $pages = $this->requests->pages;
// $exclude = explode(',', $params['menu_exclude']);

// $exclude = array(
	// 'authentications',
	// 'legals',
	// 'userparam',
	// 'account',
	// 'appointment',
	// 'orderdetail',
	// 'productdetail',
	// 'editaccessfunction',
	// 'editaccesscontroller',
	// 'editaccessview',
	// 'editseo',
	// 'errors'
// );

// debug($exclude);
// debug($config);
// debug($params);
// debug($req_controller);
// debug($customer);
// debug($pages);
// debug($pages['controllers']);
// debug($pages['views']);
// debug($pages['functions']);
?>
<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<h4 class="logo-text logo">
				<?php /*<img src="/images/logo/logo.png" class="logo-icon logo" alt="logo icon" title="logo icon" />*/ ?>
				<img src="<?php echo $params['logo_site'] ?>" class="logo-icon logo" alt="<?php $langs->lang("LOGO", "sidebar") ?>" title="<?php $langs->lang("LOGO", "sidebar") ?>" />
			</h4>
			<h4 class="logo-text logo-toggled">
				<?php /*<img src="/images/logo/logo-icon.png" class="logo-icon logo-toggled" alt="logo icon" title="logo icon" />*/ ?>
				<img src="<?php echo $params['icon_site'] ?>" class="logo-icon logo-toggled" alt="<?php $langs->lang("LOGO_ICON", "sidebar") ?>" title="<?php $langs->lang("LOGO_ICON", "sidebar") ?>" />
			</h4>
		</div>
		<div class="toggle-icon ms-auto"><i class="bx bx-arrow-to-left"></i></div>
	</div>
	<!--navigation-->
	<?php /*<ul class="metismenu" id="menu">*/ ?>
	<ul class="metismenu sidebar-menu_items ui-sortable" id="menu">
		<?php if( !empty($customer) ) : ?>
			
			<?php foreach($pages['controllers'] as $key => $controller) : 
				// if( $controller['active'] === 1 && $customer['access'] <= $controller['access'] ) :
					// if( !in_array($controller['name'], $exclude) === true ) : 
						if( $controller['name'] === 'customers' && $customer['access'] === 1 ) : // $controller['name'] =customers
							// debug($controller);
							$is_parent = $controller['id_page_view'];
							
							$sub_menu = '<ul>';
								foreach($pages['views'] as $k => $view) { 
									// debug($view);
									if( ($view['is_function'] !== 1) && $view['id_page_controller'] === $controller['id']/* && !in_array($view['name'], $exclude) === true*/ ) {
										$sub_menu .= '<li><a href="/'. $controller['name'] .'/'. $view['name'] .'" title="'. $view['label'] .'"><i class="bx '. $view['icon'] .'"></i>'. $view['label'] .'</a></li>';
									}
								}
							$sub_menu .= '</ul>'; ?>
							
							<li class="sidebar-menu_item ui-state-default ui-sortable-handle" data-datas='<?php echo json_encode(array('id' => $controller['id'], 'name' => $controller['name'])) ?>' data-position="<?php echo $controller['position'] ?>">
								<a href="javascript:;" class="has-arrow" title="Séparateur <?php echo $controller['label'] ?>">
									<div class="parent-icon handle"><i class="bx <?php echo $controller['icon'] ?>"></i></div>
									<div class="menu-title"><?php echo $controller['label'] ?></div>
								</a>
								<?php echo $sub_menu; ?>
							</li>
						
						<?php elseif( $controller['name'] !== "customers" ) : 
						
							$is_parent = $controller['id_page_view'];
							
							if( count($is_parent) > 1 ) {
							
								$sub_menu = '<ul>';
									foreach($pages['views'] as $k => $view) { 
										// debug($view);
										if( ($view['is_function'] !== 1 && $customer['access'] <= $view['access']) && $view['id_page_controller'] === $controller['id']/* && !in_array($view['name'], $exclude) === true*/ ) {
											$sub_menu .= '<li><a href="/'. $controller['name'] .'/'. $view['name'] .'" title="'. $view['label'] .'"><i class="bx '. $view['icon'] .'"></i>'. $view['label'] .'</a></li>';
										}
									}
								$sub_menu .= '</ul>'; ?>
								
								<li class="sidebar-menu_item ui-state-default ui-sortable-handle" data-datas='<?php echo json_encode(array('id' => $controller['id'], 'name' => $controller['name'])) ?>' data-position="<?php echo $controller['position'] ?>">
									<a href="javascript:;" class="has-arrow" title="Séparateur <?php echo $controller['label'] ?>">
										<div class="parent-icon handle"><i class="bx <?php echo $controller['icon'] ?>"></i></div>
										<div class="menu-title"><?php echo $controller['label'] ?></div>
									</a>
									<?php echo $sub_menu; ?>
								</li>
								
							<?php } else { // $is_parent ?>
								
								<li class="sidebar-menu_item ui-state-default ui-sortable-handle" data-datas='<?php echo json_encode(array('id' => $controller['id'], 'name' => $controller['name'])) ?>' data-position="<?php echo $controller['position'] ?>">
									<a href="/<?php echo $controller['name'] .'/'. substr($controller['name'], 0, -1) ?>" class="" title="<?php echo $controller['label'] ?>">
										<div class="parent-icon handle"><i class="bx <?php echo $controller['icon'] ?>"></i></div>
										<?php /*<div class="menu-title"><?php echo utf8_decode($controller['label']) ?></div>*/ ?>
										<div class="menu-title"><?php echo $controller['label'] ?></div>
									</a>
								</li>
								
							<?php } // $is_parent
				
						endif;  // $controller['name']
					// endif; // $exclude
				// endif; // $accessControllers
			endforeach; // $controllers ?>
			
			<?php /*<li>
				<a href="javascript:;" class="has-arrow">
					<div class="parent-icon"><i class="bx bx-task"></i></div>
					<div class="menu-title">Outils</div>
				</a>
				<ul>
					<?php foreach($tools as $tool) {
						if( $tool != '.' && $tool != '..' && $tool != '' && $tool != 'index.php' && $tool != 'index.html' && $tool != 'tpls' && $tool != 'assets' && $tool != 'getPage.php' && $tool != 'functions.php' && $tool != '.htaccess' ) { ?>
							<li><a href="/app/tools/<?php echo $tool ?>"><i class="bx bx-right-arrow-alt"></i><?php echo $tool ?></a></li>
						<?php } ?>
					<?php } ?>
				</ul>
			</li>*/ ?>
			<li class="menu-label"><?php $langs->lang("JS_INFO", "sidebar") ?></li>
			<li>
				<a href="javascript:;" class="has-arrow" title="<?php $langs->lang("JS_INFO_SEPARATOR", "sidebar") ?>">
					<div class="parent-icon"> <i class="bx bx-windows"></i></div>
					<div class="menu-title"><?php $langs->lang("JS_INFO", "sidebar") ?></div>
				</a>
				<ul>
					<li><a href="https://js-info.fr" target="_blank" title="<?php $langs->lang("VISIT_THE_JS_INFO_WEBSITE", "sidebar") ?>"><i class="bx bx-window-open"></i><?php $langs->lang("VISIT_THE_JS_INFO_WEBSITE", "sidebar") ?></a></li>
					<?php if( $customer['access'] <= 4 ) : ?>
						<li><a href="/customers/userparam" title="<?php $langs->lang("CONTACT_US", "sidebar") ?>"><i class="bx bx-support"></i><?php $langs->lang("CONTACT_US", "sidebar") ?></a></li>
					<?php else : ?>
						<li><a href="https://js-info.fr/nous-contacter" target="_blank" title="<?php $langs->lang("CONTACT_US", "sidebar") ?>"><i class="bx bx-support"></i><?php $langs->lang("CONTACT_US", "sidebar") ?></a></li>
					<?php endif; ?>
				</ul>
			</li>
			
		<?php else : ?>
			<li>
				<ul>
					<li class="sidebar-menu_item ui-state-default ui-sortable-handle">
						<a href="/" target="_blank" title="<?php $langs->lang("LOGIN", "sidebar") ?>"><i class="bx bx-window-open"></i> <?php $langs->lang("LOGIN", "sidebar") ?></a>
					</li>
				</ul>
			</li>
			<li class="menu-label"><?php $langs->lang("JS_INFO", "sidebar") ?></li>
			<li>
				<ul>
					<li class="sidebar-menu_item ui-state-default ui-sortable-handle">
						<a href="https://js-info.fr" target="_blank" title="<?php $langs->lang("VISIT_THE_JS_INFO_WEBSITE", "sidebar") ?>"><i class="bx bx-window-open"></i> <?php $langs->lang("VISIT_THE_JS_INFO_WEBSITE", "sidebar") ?></a>
					</li>
					<li class="sidebar-menu_item ui-state-default ui-sortable-handle">
						<a href="https://js-info.fr/nous-contacter" target="_blank" title="<?php $langs->lang("CONTACT_US", "sidebar") ?>"><i class="bx bx-support"></i> <?php $langs->lang("CONTACT_US", "sidebar") ?></a>
					</li>
				</ul>
			</li>
			
		<?php endif; ?>
	</ul>
</div>
<!--end navigation-->