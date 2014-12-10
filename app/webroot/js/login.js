app.Login = function () {
	this.setRandomBackground = function () {
		var strImg = $('#js_login').attr('data-img');
		if (!strImg) {
			return;
		}
		$('body').css('background-image', 'url(' + strImg + ')');
	};
};

$(function () {
	var login = new app.Login();
	login.setRandomBackground();
});
