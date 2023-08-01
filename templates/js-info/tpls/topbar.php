<?php

defined('_EXEC') or die;
// debug($params);
// debug($cParams);
// debug($cParams['quick_access']);
// debug($_SESSION['user']);
// debug($customer);
// debug($this->requests);
// debug($pages);
// debug($accessViews);
// debug($getTop);
// debug($checkNotifications);



// $seconds = strtotime($checkNotifications[0]['date_add']);

// $init = time() - strtotime($checkNotifications[0]['date_add']);
// $hours = floor($init / 3600);
// $minutes = floor(($init / 60) % 60);
// $seconds = $init % 60;

// debug(date("H : m : i", $init));
// debug(time2string($init));

// debug($checkNotifications[0]['date_add']);
// debug(time());
// debug($hours);
// debug($minutes);
// debug($seconds);

// 1668340257391
// 1668340268

?>
<header>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand">
			<div class="mobile-toggle-menu">
				<i class="bx bx-menu"></i>
			</div>
			<div class="search-bar flex-grow-1">
				<div class="position-relative search-bar-box">
					<input name="search_top" type="text" class="form-control search-control" placeholder="<?php $langs->lang("TYPE_TO_SEARCH", "topbar") ?>">
					<span class="position-absolute top-50 search-show translate-middle-y"><i class="bx bx-search"></i></span>
					<span class="position-absolute top-50 search-close translate-middle-y"><i class="bx bx-x"></i></span>
				</div>
			</div>
			<?php if( !empty($customer) ) : ?>
				<div class="top-menu ms-auto">
					<ul class="navbar-nav align-items-center">
						<li class="nav-item mobile-search-icon">
							<a href="#" class="nav-link" title="<?php $langs->lang("RESEARCH", "topbar") ?>">
								<i class="bx bx-search"></i>
							</a>
						</li>
						<?php if( $params['refresh_top'] === 1 ) { ?>
							<li class="nav-item">
								<a href="#" class="nav-link fs-28-imp refresh-page" onclick="document.location.reload(true)" title="<?php $langs->lang("REFRESH_THE_PAGE", "topbar") ?>">
									<i class="bx bx-refresh"></i>
								</a>
							</li>
						<?php }
						if($params['home_top'] === 1 || !empty($customer['quick_access']) ) { ?>
							<li class="nav-item dropdown dropdown-large">
								<a href="#" class="nav-link dropdown-toggle dropdown-toggle-nocaret" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="<?php $langs->lang("QUICK_ACCESS", "topbar") ?>">
									<i class="bx bx-category"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="row row-cols-3 g-3 p-3">
										<?php if( $params['home_top'] === 1 ) : ?>
											<a href="/dashboards/dashboard" class="col text-center" title="<?php $langs->lang("DASHBOARD", "topbar") ?>">
												<div class="app-box mx-auto"><i class="bx bx-home-circle"></i></div>
												<div class="app-title"><?php $langs->lang("HOME", "topbar") ?></div>
											</a>
										<?php endif;
										if( !empty($customer['quick_access']) ) : 
											foreach($customer['quick_access'] as $quick_access) : 
												// if( array_key_exists($quick_access['id_page_view'], $id_quick_access) ) : ?>
													<a href="<?php echo $quick_access['quick_access'] ?>" class="col text-center" title="<?php echo $quick_access['short_label'] ?>">
														<div class="app-box mx-auto"><i class="bx <?php echo $quick_access['icon'] ?>"></i></div>
														<div class="app-title"><?php echo $quick_access['short_label'] ?></div>
													</a>
												<?php // endif;
											endforeach;
										endif; ?>
									</div>
								</div>
							</li>
						<?php }
						if( $params['notif_top'] === 1 ) { ?>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<?php echo (!empty($checkNotifications)) ? '<span class="alert-count notif-counter">'. count($checkNotifications) .'</span>' : '<span class="alert-count notif-counter"></span>' ?>
									<i class="bx bx-bell"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title"><?php $langs->lang("NOTIFICATIONS", "topbar") ?></p>
										</div>
									</a>
									<div class="header-notifications-list" notif_customer="<?php echo $customer['id'] ?>">
										<?php if( !empty($checkNotifications) ) : ?>
											<?php foreach($checkNotifications as $checkNotification) : 
												// debug($checkNotifications);
												$init = time() - strtotime($checkNotification['date_upd']);
												$hours = floor($init / 3600); $minutes = floor($init / 60) % 60; $seconds = $init % 60;
												
												if( $hours > 0 ) { $time = $hours ." h"; } 
												elseif( $minutes > 0 ) { $time = $minutes ." min"; } 
												elseif( $seconds > 0 ) { $time = $seconds ." sec"; } ?>
												<a class="dropdown-item" href="javascript:;" id="<?php echo $checkNotification['id'] ?>">
													<div class="d-flex align-items-center">
														<div class="notify"><i class="bx bx-<?php echo $checkNotification['icon'] ?>"></i></div>
														<div class="flex-grow-1 white-space-initial">
															<h6 class="msg-name"><?php echo /*$checkNotification['type'] */$checkNotification['title'] ?> <span class="msg-time float-end"><?php echo $time ?></span></h6>
															<p class="msg-info"><?php echo $checkNotification['message'] ?></p>
														</div>
													</div>
												</a>
											<?php endforeach; ?>
										<?php /*else : ?>
											<a class="dropdown-item" href="/customers/customer">
												<div class="d-flex align-items-center">
													<div class="notify"><i class="bx bx-group"></i></div>
													<div class="flex-grow-1">
														<h6 class="msg-name">New Customers <span class="msg-time float-end">14 Sec ago</span></h6>
														<p class="msg-info">5 new user registered</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="/ecommerces/order">
												<div class="d-flex align-items-center">
													<div class="notify"><i class="bx bx-cart-alt"></i></div>
													<div class="flex-grow-1">
														<h6 class="msg-name">New Orders <span class="msg-time float-end">2 min ago</span></h6>
														<p class="msg-info">You have recived new orders</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="/customers/downloadarea">
												<div class="d-flex align-items-center">
													<div class="notify"><i class="bx bx-file"></i></div>
													<div class="flex-grow-1">
														<h6 class="msg-name">24 PDF File <span class="msg-time float-end">19 min ago</span></h6>
														<p class="msg-info">The pdf files generated</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="/webmails/webmail">
												<div class="d-flex align-items-center">
													<div class="notify"><i class="bx bx-send"></i></div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Time Response <span class="msg-time float-end">28 min ago</span></h6>
														<p class="msg-info">5.1 min avarage time response</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="/messages/message">
												<div class="d-flex align-items-center">
													<div class="notify"><i class="bx bx-message-detail"></i></div>
													<div class="flex-grow-1">
														<h6 class="msg-name">New Comments <span class="msg-time float-end">4 hrs ago</span></h6>
														<p class="msg-info">New customer comments recived</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="/connections/log">
												<div class="d-flex align-items-center">
													<div class="notify"><i class="bx bx-door-open"></i></div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Defense Alerts <span class="msg-time float-end">2 weeks ago</span></h6>
														<p class="msg-info">45% less alerts last 4 weeks</p>
													</div>
												</div>
											</a>
										<?php */endif; ?>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer"><?php $langs->lang("MARK_ALL_AS_READ", "topbar") ?></div>
									</a>
								</div>
							</li>
						<?php }
						if( $this->session->readSession('admin') !== null && !empty($this->session->readSession('admin')['id']) ) : ?>
							<li class="nav-item">
								<a href="/customers/logascustomer/<?php echo $this->session->readSession('admin')['id'] ?>" class="nav-link position-relative" title="<?php $langs->lang("BACK_TO_THE_ADMINISTRATOR_ACCOUNT", "topbar") ?>">
									<i class='bx bx-door-open'></i>
								</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="user-box dropdown">
					<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="<?php echo $customer['firstname'] .' '. $customer['name'] ?>">
						<?php if( !empty($customer['avatar'] && file_exists(_ROOTURL_ . $customer['avatar'])) ) : ?>
							<?php /*<div class="rounded-circle bg-light top-user-img pos-relative w-42 h-42">*/ ?>
								<img src="<?php echo $customer['avatar'] .'?v='. time() ?>" id="user_avatar" class="user-img" alt="user avatar">
							<?php /*</div>*/ ?>
						<?php else : ?>
							<img src="/templates/system/images/avatars/default-avatar-<?php echo $customer['gender'] ?>.png" id="user_avatar" class="user-img" alt="user default avatar">
						<?php endif; ?>
						<div class="user-info ps-3">
							<p class="user-name mb-0"><?php echo $customer['firstname'] ?></p>
							<p class="designattion mb-0"><?php echo $customer['name'] ?></p>
						</div>
					</a>
					<ul class="dropdown-menu dropdown-menu-end">
						<li><a class="dropdown-item" href="/customers/profile" title="<?php $langs->lang("MY_PROFILE", "topbar") ?>"><i class="bx bx-user"></i><span><?php $langs->lang("MY_PROFILE", "topbar") ?></span></a></li>
						<?php if( $customer['access'] <= 3 ) : ?>
							<li><a class="dropdown-item" href="/customers/account" title="<?php $langs->lang("MY_ACCOUNT", "topbar") ?>"><i class="bx bx-link-alt"></i><span><?php $langs->lang("MY_ACCOUNT", "topbar") ?></span></a></li>
						<?php endif;
						if( $customer['access'] <= 4 ) : ?>
							<li><a class="dropdown-item" href="/customers/appointment" title="<?php $langs->lang("MY_APPOINTMENTS", "topbar") ?>"><i class="bx bx-calendar-event"></i><span><?php $langs->lang("MY_APPOINTMENTS", "topbar") ?></span></a></li>
							<li><a class="dropdown-item" href="/customers/userparam" title="<?php $langs->lang("ACCOUNT_SETTINGS", "topbar") ?>"><i class="bx bx-cog"></i><span><?php $langs->lang("ACCOUNT_SETTINGS", "topbar") ?></span></a></li>
						<?php endif; ?>
						<li><a class="dropdown-item" href="/customers/downloadarea" title="<?php $langs->lang("DOWNLOADS", "topbar") ?>"><i class="bx bx-download"></i><span><?php $langs->lang("DOWNLOADS", "topbar") ?></span></a></li></li>
						<li><a class="dropdown-item" href="/authentications/locksession" title="<?php $langs->lang("LOCK_SESSION", "topbar") ?>"><i class="bx bx-lock"></i><span><?php $langs->lang("LOCK_SESSION", "topbar") ?></span></a></li></li>
						<li><div class="dropdown-divider mb-0"></div></li>
						<li>
							<form class="dropdown-item" id="logout_form" action="/authentications/logout" method="post">
								<i class="bx bx-log-out-circle"></i>
								<input class="" type="submit" name="session_destroy" value="<?php $langs->lang("LOGOUT", "topbar") ?>" title="<?php $langs->lang("LOGOUT", "topbar") ?>" />
							</form>
						</li>
					</ul>
				</div>
			<?php else : ?>
			<?php endif; ?>
		</nav>
	</div>
</header>