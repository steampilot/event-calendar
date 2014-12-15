/**
 * Created by Jerome Roethlisberger on 15.12.2014.
 */
app.events.Program = function () {
	this.setRandomBackground = function () {
		var strImg = $('#js_login').attr('data-img');
		if (!strImg) {
			return;
		}
		$('body').css('background-image', 'url(' + strImg + ')');
	};
};

$(function () {
	var program = new app.events.Program();
	program.setRandomBackground();
});
