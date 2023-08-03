<?php defined('_EXEC') or die; ?>
<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<h4 class="logo-text logo">
				<img src="<?php echo $params['logo_site'] ?>" class="logo-icon logo" alt="Logo" title="Logo" />
			</h4>
			<h4 class="logo-text logo-toggled">
				<img src="<?php echo $params['icon_site'] ?>" class="logo-icon logo-toggled" alt="Icône de logo" title="Icône de logo" />
			</h4>
		</div>
		<div class="toggle-icon ms-auto"><i class="bx bx-arrow-to-left"></i></div>
	</div>
	<ul class="metismenu sidebar-menu_items ui-sortable" id="menu">
		<li class="menu-label">Js info</li>
		<li>
			<a href="javascript:;" class="has-arrow" title="Séparateur Js info">
				<div class="parent-icon">
					<i class="bx bx-windows"></i>
				</div>
				<div class="menu-title">Js info</div>
			</a>
			<ul>
				<li class="sidebar-menu_item ui-state-default ui-sortable-handle">
					<a href="https://crm.js-info.fr" target="_blank" title="Créer un compte"><i class="bx bx-window-open"></i> Créer un compte</a>
				</li>
				<li class="sidebar-menu_item ui-state-default ui-sortable-handle">
					<a href="https://js-info.fr" target="_blank" title="Visiter le site Js info"><i class="bx bx-window-open"></i> Visiter le site Js info</a>
				</li>
				<li class="sidebar-menu_item ui-state-default ui-sortable-handle">
					<a href="https://js-info.fr/nous-contacter" target="_blank" title="Nous contacter"><i class="bx bx-support"></i> Nous contacter</a>
				</li>
			</ul>
		</li>
	</ul>
</div>
