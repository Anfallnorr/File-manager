<div id="context_menu" class="card radius-10 overflow-hidden context-menu context-menu-normal">
	<div class="card-body">
		<h5 class="card-title mb-0">Drive</h5>
	</div>
	<ul class="list-group list-group-flush context-menu__items">
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="add"><i class="bi bi-plus-square-dotted fs-16"></i> <?php $langs->lang("ADD_NEW", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="download"><i class="bi bi-download fs-16"></i> <?php $langs->lang("DOWNLOAD", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="zip"><i class="bi bi-file-earmark-zip fs-16"></i> <?php $langs->lang("ZIP", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="unzip"><i class="bi bi-folder-check fs-16"></i> <?php $langs->lang("UNZIP", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="move"><i class="bi bi-arrows-move fs-16"></i> <?php $langs->lang("MOVE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="rename"><i class="bi bi-input-cursor-text fs-16"></i> <?php $langs->lang("RENAME", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="activate"><i class="bi bi-check2 fs-16"></i> <?php $langs->lang("ACTIVATE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="deactivate"><i class="bi bi-x fs-16"></i> <?php $langs->lang("DEACTIVATE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="copy"><i class="bi bi-clipboard-check fs-16"></i> <?php $langs->lang("COPY", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="paste"><i class="bi bi-clipboard-plus fs-16"></i> <?php $langs->lang("PASTE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="edit"><i class="bi bi-pencil-square fs-16"></i> <?php $langs->lang("EDIT", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="share"><i class="bi bi-share fs-16"></i> <?php $langs->lang("SHARE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="approve"><i class="bi bi-calendar2-check fs-16"></i> <?php $langs->lang("APPROVE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="select"><i class="bi bi-check2-square fs-16"></i> <?php $langs->lang("SELECT", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="selects"><i class="bi bi-ui-checks-grid fs-16"></i> <?php $langs->lang("SELECTS", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="insight"><i class="bi bi-eye fs-16"></i> <?php $langs->lang("INSIGHT", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="logascustomer"><i class="bi bi-door-open fs-16"></i> <?php $langs->lang("LOGASCUSTOMER", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="cleanFile"><i class="bi bi-file-earmark-excel fs-16"></i> <?php $langs->lang("CLEANFILE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="delete"><i class="bi bi-trash fs-16"></i> <?php $langs->lang("DELETE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item list-group-item-light list-group-item-action context-menu__item">
			<a href="#" class="context-menu__link" context-action="cancel"><i class="bi bi-arrow-left fs-16"></i> <?php $langs->lang("CANCEL", "contextmenu") ?></a>
		</li>
	</ul>
	<div class="card-body">
		<div class="d-flex">
			<div class="btn-group dropdown">
				<a href="#" class="card-link dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" _aria-expanded="false"><?php $langs->lang("BULK_ACTION", "contextmenu") ?></a>
				<ul class="dropdown-menu">
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massDownload"><i class="bi bi-download fs-16"></i> <?php $langs->lang("MASS_DOWNLOAD", "contextmenu") ?></a>
					</li>
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massMove"><i class="bi bi-arrows-move fs-16"></i> <?php $langs->lang("MASS_MOVE", "contextmenu") ?></a>
					</li>
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massRename"><i class="bi bi-input-cursor-text fs-16"></i> <?php $langs->lang("MASS_RENAME", "contextmenu") ?></a>
					</li>
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massActivate"><i class="bi bi-check2-all fs-16"></i> <?php $langs->lang("MASS_ACTIVATE", "contextmenu") ?></a>
					</li>
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massDeactivate"><i class="bi bi-x-lg fs-16"></i> <?php $langs->lang("MASS_DEACTIVATE", "contextmenu") ?></a>
					</li>
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massSwitchState"><i class="bi bi-intersect fs-16"></i> <?php $langs->lang("MASS_SWITCH_STATE", "contextmenu") ?></a>
					</li>
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massDelete"><i class="bi bi-trash fs-16"></i> <?php $langs->lang("MASS_DELETE", "contextmenu") ?></a>
					</li>
				</ul>
			</div>
			<div class="ms-auto btn-group">
				<span class="card-link" onclick="toggleMenuOff()"><?php $langs->lang("CLOSE", "contextmenu") ?></span>
			</div>
		</div>
	</div>
</div>