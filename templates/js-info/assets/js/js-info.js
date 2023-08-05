$('a.link-disabled').click(function() { return false; });

if( $('.pace').length > 0 ) {
	window.onbeforeunload = renderLoading;
}
function renderLoading() {
    Pace.stop();
	
    var paceEle = $(Pace.bar.el);
    paceEle.removeClass('pace-inactive').addClass('pace-active');
    var timer = 0;
    var intervalId = setInterval(frame, 50);

    function frame() {
        if (timer === 96) {
			Pace.stop();
			paceEle.removeClass('pace-active').addClass('pace-inactive');
            clearInterval(intervalId);
        } else {
            timer = timer + 1;
            Pace.bar.progress = timer;
            Pace.bar.render();
        }
    }
}

/* ************************************************************** */
/* ********************** GET RESPONSE ICON ********************* */
/* ************************************************************** */
function getResponseIcon(type = "") {
	let icon = "bx bx-message-square-x";
	
	if (type == "success") {
		icon = "bx bx-check-circle";
	} 
	else if (type == "warning") {
		icon = "bx bx-error";
	} 
	else if (type == "danger") {
		icon = "bx bx-x-circle";
	}
	
	return icon;
}

/* ****************************************************** */
/* ********************** GETNOTIFY ********************* */
/* ****************************************************** */
function getNotify(msg, type, width = 400, size = "mini", position = "bottom right") {
	// Lobibox
	let icon = getResponseIcon(type);
	
	if (type == "danger") {
		type = "error";
	}
	
	Lobibox.notify(type, {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		showClass: 'fadeInDown',
		hideClass: 'fadeUpDown',
		size: size,
		rounded: true,
		icon: icon,
		sound: false,
		position: position,
		width: width,
		msg: msg,
		callback: function ($this, type, ev) {
			console.log(type);
		}
	});
}
