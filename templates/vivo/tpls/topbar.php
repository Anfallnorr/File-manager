<?php defined('_EXEC') or die; ?>
<div class="header-actions-container">
	<ul class="header-actions">
		<?php /* TODO */ ?>
		<?php /*<li class="dropdown">
			<a href="#" id="countries" data-toggle="dropdown" aria-haspopup="true">
				<img src="/templates/systems/img/flags/fr.svg" class="flag-img" alt="France" />
			</a>
			<div class="dropdown-menu dropdown-menu-end mini" aria-labelledby="countries">
				<div class="country-container">
					<a href="#">
						<img src="/templates/systems/img/flags/fr.svg" alt="France" />
					</a>
					<a href="#">
						<img src="/templates/systems/img/flags/gb.svg" alt="Great Britain" />
					</a>
					<a href="#">
						<img src="/templates/systems/img/flags/de.svg" alt="Deutchland" />
					</a>
				</div>
			</div>
		</li>
		<li class="dropdown">
			<a href="#" id="theme" data-toggle="dropdown" aria-haspopup="true">
				<i class="bi bi-brush" class="flag-img" alt="vivo"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-end" aria-labelledby="theme">
				<a href="#" class="dropdown-item" title="vivo">Thème : Vivo</a>
				<a href="#" class="dropdown-item" title="js-info">Thème : Js info</a>
			</div>
		</li>*/ ?>
		<li class="dropdown">
			<a href="#" class="refresh-page" onclick="document.location.reload(true)" title="<?php $langs->lang("REFRESH_THE_PAGE", "topbar") ?>">
				<i class="bi bi-arrow-repeat"></i>
			</a>
		</li>
		<li class="dropdown">
			<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
				<span class="user-name d-none d-md-block"><?php echo $customer['firstname'] ?> <?php echo $customer['name'] ?></span>
				<span class="avatar">
					<img src="/templates/systems/img/default-avatar-hf.png" id="user_avatar" alt="<?php $langs->lang("USER_DEFAULT_AVATAR", "topbar") ?>" />
					<span class="status online"></span>
				</span>
			</a>
			<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
				<div class="header-profile-actions">
					<a href="https://crm.js-info.fr" target="_blank" title="<?php $langs->lang("CREATE_AN_ACCOUNT", "topbar") ?>"><?php $langs->lang("CREATE_AN_ACCOUNT", "topbar") ?></a>
					<div class="dropdown-divider mb-0"></div>
					<a href="https://js-info.fr" target="_blank" title="<?php $langs->lang("VISIT_THE_JS_INFO_WEBSITE", "topbar") ?>"><?php $langs->lang("VISIT_THE_JS_INFO_WEBSITE", "topbar") ?></a>
					<a href="https://js-info.fr/nous-contacter" target="_blank" title="<?php $langs->lang("CONTACT_US", "topbar") ?>"><?php $langs->lang("CONTACT_US", "topbar") ?></a>
				</div>
			</div>
		</li>
	</ul>
</div>
