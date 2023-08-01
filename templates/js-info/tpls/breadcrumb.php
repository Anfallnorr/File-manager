<?php

defined('_EXEC') or die;

// debug($this->requests);

// debug($customer, true);
// debug($params);
// debug($access);
// debug($getControllers);
// debug($getViews);
// debug($getFunctions);

// debug($this_exclude_controller);
// debug($this_controller);
// debug($this_controller['label']);
// debug($this_exclude_views);
// debug($this_view);
// debug($this_view['label']);

if (empty($this_controller)) {
	$this_controller = $this_exclude_controller;
}
if (empty($this_view)) {
	$this_view = $this_exclude_views;
}

if( !empty($customer) ) :
?>
	<!--breadcrumb-->
	<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
		<div class="breadcrumb-title pe-3"><?php echo $this_controller['label'] ?></div>
		<div class="ps-3">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb mb-0 p-0">
					<li class="breadcrumb-item">
						<a href="javascript:;" title="<?php $langs->lang("JSBACK_TO_HOME") ?>">
							<i class="bx bx-home-alt"></i>
						</a>
					</li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $this_view['label'] ?></li>
				</ol>
			</nav>
		</div>
		<?php if( $customer['access'] <= 2 ) : ?>
			<div class="ms-auto">
				<div class="btn-group">
					<button type="button" class="btn btn-light"><?php $langs->lang("JSACTIONS") ?></button>
					<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
						<span class="visually-hidden">Toggle Dropdown</span>
					</button>
					<div class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end">
						<a class="dropdown-item" href="javascript:;" title="<?php $langs->lang("JSACTION") ?>"><?php $langs->lang("JSACTION") ?></a>
						<a class="dropdown-item" href="javascript:;" title="<?php $langs->lang("JSOTHER_ACTIONS") ?>"><?php $langs->lang("JSOTHER_ACTIONS") ?></a>
						<a class="dropdown-item" href="javascript:;" title="<?php $langs->lang("JSACTION_SOMEWHERE") ?>"><?php $langs->lang("JSACTION_SOMEWHERE") ?></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="/params/param?com=<?php echo $this_controller['name'] .'&view='. $this_view['name'] ?>" title="<?php $langs->lang("JSSETTINGS") ?>"><?php $langs->lang("JSSETTINGS") ?></a>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<!--end breadcrumb-->
<?php endif; ?>