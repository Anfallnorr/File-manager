/*
Lobibox.notify.DEFAULTS = {
	title: true,                // Title of notification. If you do not include the title in options it will automatically takes its value 
	//from Lobibox.notify.OPTIONS object depending of the type of the notifications or set custom string. Set this false to disable title
	size: 'normal',             // normal, mini, large
	soundPath: 'sounds/',   // The folder path where sounds are located
	soundExt: '.ogg',           // Default extension for all sounds
	showClass: 'fadeInDown',    // Show animation class.
	hideClass: 'zoomOut',       // Hide animation class.
	icon: true,                 // Icon of notification. Leave as is for default icon or set custom string
	msg: '',                    // Message of notification
	img: null,                  // Image source string
	closable: true,             // Make notifications closable
	hideCloseButton: false,     // Notification may be closable but you can hide close button and it will be closed by clicking on notification itsef
	delay: 5000,                // Hide notification after this time (in miliseconds)
	delayIndicator: true,       // Show timer indicator
	closeOnClick: true,         // Close notifications by clicking on them
	width: 400,                 // Width of notification box
	sound: true,                // Sound of notification. Set this false to disable sound. Leave as is for default sound or set custom soud path
	// Place to show notification. Available options: "top left", "top right", "bottom left", "bottom right", "center top", "center bottom"
	// It can also be object {left: number, top: number} to position notification at any place
	position: "bottom right",
	iconSource: 'bootstrap',    // "bootstrap" or "fontAwesome" the library which will be used for icons
	rounded: false,             // Whether to make notification corners rounded
	messageHeight: 60,          // Notification message maximum height. This is not for notification itself, this is for <code>.lobibox-notify-msg</code>
	pauseDelayOnHover: true,    // When you mouse over on notification delay (if it is enabled) will be paused.
	onClickUrl: null,           // The url which will be opened when notification is clicked
	showAfterPrevious: false,   // Set this to true if you want notification not to be shown until previous notification is closed. This is useful for notification queues
	continueDelayOnInactiveTab: true, // Continue delay when browser tab is inactive

	// Events
	onClick: null
};
*/
/* Default Notifications */
function default_noti() {
	Lobibox.notify('default', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function info_noti() {
	Lobibox.notify('info', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-info-circle',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function warning_noti() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-error',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function error_noti() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-x-circle',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function success_noti() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-check-circle',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}
/* Rounded corners Notifications */
function round_default_noti() {
	Lobibox.notify('default', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function round_info_noti() {
	Lobibox.notify('info', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		icon: 'bx bx-info-circle',
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function round_warning_noti() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function round_error_noti() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-x-circle',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function round_success_noti() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		icon: 'bx bx-check-circle',
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}
/* Notifications With Images*/
function img_default_noti() {
	Lobibox.notify('default', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		img: 'assets/plugins/notifications/img/1.jpg', //path to image
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function img_info_noti() {
	Lobibox.notify('info', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		icon: 'bx bx-info-circle',
		position: 'top right',
		img: 'assets/plugins/notifications/img/2.jpg', //path to image
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function img_warning_noti() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		img: 'assets/plugins/notifications/img/3.jpg', //path to image
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function img_error_noti() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		icon: 'bx bx-x-circle',
		position: 'top right',
		img: 'assets/plugins/notifications/img/4.jpg', //path to image
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function img_success_noti() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-check-circle',
		img: 'assets/plugins/notifications/img/5.jpg', //path to image
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}
/* Notifications With Images*/
function pos1_default_noti() {
	Lobibox.notify('default', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'center top',
		size: 'mini',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function pos2_info_noti() {
	Lobibox.notify('info', {
		pauseDelayOnHover: true,
		icon: 'bx bx-info-circle',
		continueDelayOnInactiveTab: false,
		position: 'top left',
		size: 'mini',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function pos3_warning_noti() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		size: 'mini',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function pos4_error_noti() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		icon: 'bx bx-x-circle',
		size: 'mini',
		continueDelayOnInactiveTab: false,
		position: 'bottom left',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function pos5_success_noti() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		icon: 'bx bx-check-circle',
		continueDelayOnInactiveTab: false,
		position: 'bottom right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}
/* Animated Notifications*/
function anim1_noti() {
	Lobibox.notify('default', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'center top',
		showClass: 'fadeInDown',
		hideClass: 'fadeOutDown',
		width: 600,
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function anim2_noti() {
	Lobibox.notify('info', {
		pauseDelayOnHover: true,
		icon: 'bx bx-info-circle',
		continueDelayOnInactiveTab: false,
		position: 'center top',
		showClass: 'bounceIn',
		hideClass: 'bounceOut',
		width: 600,
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function anim3_noti() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		icon: 'bx bx-error',
		position: 'center top',
		showClass: 'zoomIn',
		hideClass: 'zoomOut',
		width: 600,
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function anim4_noti() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		icon: '',
		position: 'center top',
		showClass: 'lightSpeedIn',
		hideClass: 'lightSpeedOut',
		icon: 'bx bx-x-circle',
		width: 600,
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function anim5_noti() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'center top',
		showClass: 'rollIn',
		hideClass: 'rollOut',
		icon: 'bx bx-check-circle',
		width: 600,
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}