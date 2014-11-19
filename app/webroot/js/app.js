app = {};

/**
 * Call JSON-RPC 2.0 request
 *
 * @param {string} method
 * @param {object} params
 * @param {object} fnDone
 * @returns {void}
 */
app.rpc = function(method, params, fnDone, fnFail) {
	var parts = method.split('.');
	var strBaseUrl = $('head base').attr('href');
	var strUrl = strBaseUrl + parts[0] + '/rpc';
	var id = 'a' + Math.floor(Math.random() * 9999999) + 1;
	var req = {
		jsonrpc: '2.0',
		id: id,
		method: parts[1],
		params: params
	};
	var json = JSON.stringify(req);

	$.ajax({
		type: 'POST',
		url: strUrl + '?_id=' + id,
		cache: false,
		processData: true,
		data: {json: json}
	}).done(function(response) {
		if (fnDone) {
			fnDone(response);
		}
	}).fail(function(response) {
		if (fnFail) {
			fnFail(response);
		} else {
			alert('Server error: ' + response.statusText);
		}
	});
};

/**
 * Local procedure call (out of the sandbox)
 *
 * @param {string} method
 * @param {object} params
 * @param {object} fnDone
 * @returns {void}
 */
app.lpc = function(method, params, fnDone, fnFail) {
	var strUrl = "http://127.0.0.1:8000/";
	var id = 'a' + Math.floor(Math.random() * 9999999) + 1;
	var req = {
		jsonrpc: '2.0',
		id: id,
		method: method,
		params: params
	};
	var json = JSON.stringify(req);

	$.ajax({
		type: 'POST',
		url: strUrl + '?_id=' + id,
		cache: false,
		processData: true,
		data: {json: json}
	}).done(function(response) {
		if (fnDone) {
			fnDone(response);
		}
	}).fail(function(response) {
		if (fnFail) {
			fnFail(response);
		} else {
			alert('Server error: ' + response.statusText);
		}
	});
};

/**
 * Special CakePHP browser redirection
 *
 * @param {string} path
 * @returns {void}
 */
app.redirect = function(path, replace) {
	var url = $d.getBaseUrl(path);
	$d.redirect(url, replace);
};

/**
 * Show notify on screen
 *
 * @param {object} options
 *
 * Variable name	Type	Posible values	Default
 *
 * type	String	success, error, warning, info	default
 * msg	String	Message
 * position	String	left, center, right, bottom	center
 * width	Integer-String	Number > 0, 'all'	400
 * height	Integer	Number between 0 and 100	60
 * autohide	Boolean	true, false	true
 * opacity	Float	From 0 to 1	1
 * multiline	Boolean	true, false	false
 * fade	Boolean	true, false	false
 * bgcolor	String	HEX color	#444
 * color	String	HEX color	#EEE
 * timeout	Integer	Miliseconds	5000
 * zindex	Integer	The z-index of the notification	null (ignored)
 * offset	Integer	The offset in pixels from the edge of the screen	0
 *
 * @returns {undefined}
 *
 * @link https://github.com/naoxink/notifIt
 */
app.notify = function(options) {
	options = $.extend({
		position: 'center',
		multiline: true,
		zindex: 9999999
	}, options);
	return notif(options);
};

/**
 * Fix for open modal is shifting body content to the left
 * Not required anymore since bootstrap v3.3.1
 */
$.fn.modal.Constructor.prototype.setScrollbar = function() {
	// nada
};

