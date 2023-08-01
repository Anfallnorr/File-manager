<?php
// debug($this);
// debug($this_view);
?>
<!-- context menu -->
<div id="context-menu" class="card bg-dark radius-10 overflow-hidden context-menu context-menu-normal">
	<?php /*<img src="/images/bg-themes/17.png" class="card-img-top" alt="bg-themes 17">*/ ?>
	<div class="card-body">
		<h5 class="card-title mb-0"><?php echo $this_view['short_label'] ?></h5>
		<?php /*<p class="card-text">Some quick example text</p>*/ ?>
	</div>
	<ul class="list-group list-group-flush context-menu__items">
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="add"><i class="bx bx-add-to-queue fs-16"></i> <?php $langs->lang("ADD_NEW", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="download"><i class="bx bx-download fs-16"></i> <?php $langs->lang("DOWNLOAD", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="zip"><i class="bx bx-archive-in fs-16"></i> <?php $langs->lang("ZIP", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="unzip"><i class="bx bx-archive-out fs-16"></i> <?php $langs->lang("UNZIP", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="move"><i class="bx bx-move fs-16"></i> <?php $langs->lang("MOVE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="rename"><i class="bx bx-rename fs-16"></i> <?php $langs->lang("RENAME", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="activate"><i class="bx bx-check fs-16"></i> <?php $langs->lang("ACTIVATE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="deactivate"><i class="bx bx-x fs-16"></i> <?php $langs->lang("DEACTIVATE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="copy"><i class="bx bx-copy fs-16"></i> <?php $langs->lang("COPY", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="paste"><i class="bx bx-paste fs-16"></i> <?php $langs->lang("PASTE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="edit"><i class="bx bx-edit fs-16"></i> <?php $langs->lang("EDIT", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="share"><i class="bx bx-share fs-16"></i> <?php $langs->lang("SHARE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="approve"><i class="bx bx-calendar-edit fs-16"></i> <?php $langs->lang("APPROVE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="select"><i class="bx bx-checkbox-checked fs-16"></i> <?php $langs->lang("SELECT", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="selects"><i class="bx bx-select-multiple fs-16"></i> <?php $langs->lang("SELECTS", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="insight"><i class="bx bx-show-alt fs-16"></i> <?php $langs->lang("INSIGHT", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="logascustomer"><i class="bx bx-log-in fs-16"></i> <?php $langs->lang("LOGASCUSTOMER", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="cleanFile"><i class="bx bx-file-blank fs-16"></i> <?php $langs->lang("CLEANFILE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="delete"><i class="bx bx-trash fs-16"></i> <?php $langs->lang("DELETE", "contextmenu") ?></a>
		</li>
		<li class="list-group-item btn-light context-menu__item">
			<a href="#" class="context-menu__link" context-action="cancel"><i class="bx bx-trash fs-16"></i> <?php $langs->lang("CANCEL", "contextmenu") ?></a>
		</li>
	</ul>
	<div class="card-body">
		<div class="d-flex">
			<div class="btn-group">
				<a href="#" class="card-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><?php $langs->lang("BULK_ACTION", "contextmenu") ?></a>
				<ul class="dropdown-menu">
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massDownload"><i class="bx bx-download fs-16"></i> <?php $langs->lang("MASS_DOWNLOAD", "contextmenu") ?></a>
					</li>
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massMove"><i class="bx bx-move fs-16"></i> <?php $langs->lang("MASS_MOVE", "contextmenu") ?></a>
					</li>
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massRename"><i class="bx bx-rename fs-16"></i> <?php $langs->lang("MASS_RENAME", "contextmenu") ?></a>
					</li>
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massActivate"><i class="bx bx-check fs-16"></i> <?php $langs->lang("MASS_ACTIVATE", "contextmenu") ?></a>
					</li>
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massDeactivate"><i class="bx bx-x fs-16"></i> <?php $langs->lang("MASS_DEACTIVATE", "contextmenu") ?></a>
					</li>
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massSwitchState"><i class="bx bx-intersect fs-16"></i> <?php $langs->lang("MASS_SWITCH_STATE", "contextmenu") ?></a>
					</li>
					<li class="dropdown-item context-menu__item">
						<a href="#" class="context-menu__link" context-action="massDelete"><i class="bx bx-trash fs-16"></i> <?php $langs->lang("MASS_DELETE", "contextmenu") ?></a>
					</li>
				</ul>
			</div>
			<div class="ms-auto btn-group">
				<span class="card-link" onclick="toggleMenuOff()"><?php $langs->lang("CLOSE", "contextmenu") ?></span>
			</div>
		</div>
		
	</div>
</div>
<!-- end context menu -->