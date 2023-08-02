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
					<img src="/templates/systems/img/default-avatar-hf.png" id="user_avatar" class="user-img" alt="user default avatar">
					<div class="user-info ps-3">
						<p class="user-name mb-0"><?php echo $customer['firstname'] ?></p>
						<p class="designattion mb-0"><?php echo $customer['name'] ?></p>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li><a class="dropdown-item" href="https://crm.js-info.fr" target="_blank" title="Créer un compte"><i class="bx bx-user"></i><span>Créer un compte</span></a></li>
					<li><div class="dropdown-divider mb-0"></div></li>
					<li><a class="dropdown-item" href="https://js-info.fr" target="_blank" title="Visiter le site Js info"><i class="bx bx-download"></i><span>Visiter le site Js info</span></a></li></li>
					<li><a class="dropdown-item" href="https://js-info.fr/nous-contacter" target="_blank" title="Nous contacter"><i class="bx bx-lock"></i><span>Nous contacter</span></a></li></li>
				</ul>
			</div>
		</nav>
	</div>
</header>