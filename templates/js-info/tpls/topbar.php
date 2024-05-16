<?php defined('_EXEC') or die; ?>
<header>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand">
			<div class="top-menu ms-auto">
				<ul class="navbar-nav align-items-center">
					<li class="nav-item">
						<a href="#" class="nav-link fs-28-imp refresh-page" onclick="document.location.reload(true)" title="<?php $langs->lang("REFRESH_THE_PAGE", "topbar") ?>">
							<i class="bx bx-refresh"></i>
						</a>
					</li>
				</ul>
			</div>
			<div class="user-box dropdown">
				<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="<?php echo $customer['firstname'] .' '. $customer['name'] ?>">
					<img src="/templates/systems/img/default-avatar-hf.png" id="user_avatar" class="user-img" alt="<?php $langs->lang("USER_DEFAULT_AVATAR", "topbar") ?>">
					<div class="user-info ps-3">
						<p class="user-name mb-0"><?php echo $customer['firstname'] ?></p>
						<p class="designattion mb-0"><?php echo $customer['name'] ?></p>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li><a class="dropdown-item" href="https://crm.js-info.fr" target="_blank" title="<?php $langs->lang("CREATE_AN_ACCOUNT", "topbar") ?>"><i class="bx bx-user"></i><span><?php $langs->lang("CREATE_AN_ACCOUNT", "topbar") ?></span></a></li>
					<li><div class="dropdown-divider mb-0"></div></li>
					<li><a class="dropdown-item" href="https://js-info.fr" target="_blank" title="<?php $langs->lang("VISIT_THE_JS_INFO_WEBSITE", "topbar") ?>"><i class="bx bx-download"></i><span><?php $langs->lang("VISIT_THE_JS_INFO_WEBSITE", "topbar") ?></span></a></li></li>
					<li><a class="dropdown-item" href="https://js-info.fr/nous-contacter" target="_blank" title="<?php $langs->lang("CONTACT_US", "topbar") ?>"><i class="bx bx-lock"></i><span><?php $langs->lang("CONTACT_US", "topbar") ?></span></a></li></li>
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalLegalNotice" title="<?php $langs->lang("LEGAL_NOTICE", "topbar") ?>"><i class="bx bx-shield"></i><span><?php $langs->lang("LEGAL_NOTICE", "topbar") ?></span></a></li></li>
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalTermsOfUse" title="<?php $langs->lang("TERMS_OF_USE", "topbar") ?>"><i class="bx bx-shield"></i><span><?php $langs->lang("TERMS_OF_USE", "topbar") ?></span></a></li></li>
				</ul>
			</div>
		</nav>
	</div>
</header>

<div class="modal fade" id="modalLegalNotice" tabindex="-1" aria-labelledby="modalLegalNoticeLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="modalLegalNoticeLabel"><?php $langs->lang("LEGAL_NOTICE", "topbar") ?></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php $langs->lang("JSCLOSE") ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalTermsOfUse" tabindex="-1" aria-labelledby="modalTermsOfUseLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="modalTermsOfUseLabel"><?php $langs->lang("TERMS_OF_USE", "topbar") ?></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php $langs->lang("JSCLOSE") ?></button>
			</div>
		</div>
	</div>
</div>
