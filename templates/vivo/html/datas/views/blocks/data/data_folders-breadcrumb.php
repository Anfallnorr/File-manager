<div class="page-breadcrumb d-flex align-items-center">
	<div class="breadcrumb-title pe-3 droptarget">
		<input type="hidden" value="" class="drop-files-path">
		<a href="/datas/data" title="<?php $langs->lang("DATA_BREADCRUMB_MY_DOCUMENTS", "datas") ?>"><?php $langs->lang("DATA_BREADCRUMB_MY_DOCUMENTS", "datas") ?></a>
	</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<?php if( isset($breadcrumb) && !empty($breadcrumb) && $breadcrumb != "" ) {
					$breadcrumbCount = count($breadcrumb);
					$last = end($breadcrumb);
					$pathLink = "";
					
					for( $i = 0; $i < $breadcrumbCount; $i++ ) {
						$pathLink .= "/". $breadcrumb[$i];
						if( $last != $breadcrumb[$i] ) {
							echo '<li class="breadcrumb-item active droptarget" aria-current="page">
								<input type="hidden" value="'. $pathLink .'" class="drop-files-path">
								<a href="/datas/data'. $pathLink .'" class="text-underline" title="'. $breadcrumb[$i] .'">'. $breadcrumb[$i] .'</a>
							</li>';
						} else {
							echo '<li class="breadcrumb-item active" aria-current="page">
								<span>'. $breadcrumb[$i] .'</span>
							</li>';
						}
					}
				} ?>
			</ol>
		</nav>
	</div>
</div>
