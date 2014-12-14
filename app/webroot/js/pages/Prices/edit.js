
if (!app.prices) {
	app.prices = {};
}

app.prices.Edit = function(config) {
	// this object
	var $this = this;

	// options
	this.config = config;


	/**
	 * Init page
	 *
	 * @returns {undefined}
	 */
	this.init = function() {
		this.form().on('submit', this.form_onSubmit);
		$('#price_save').on('click', this.save_onClick);
		$('#price_cancel').on('click', this.cancel_onClick);

		$('#price').focus();

		if ($this.config.id > 0) {
			// edit
			$this.load();
		} else {
			var data = {};
			var price = {};
			data.price = price;
			data.price = $this.config;
			$this.loadForm(data);
		}
	};

	/**
	 * Load page content
	 *
	 * @returns {undefined}
	 */
	this.load = function() {
		$d.showLoad();

		var form = $this.form();
		form.find(":input[type!='hidden']").prop("deleted", false);

		var params = $this.config;
		app.rpc('Prices.loadEdit', params, function(res) {
			if (!$d.handleResponse(res)) {
				return;
			}
			if (res.result.price) {
				$this.loadForm(res.result);
			}
			if (res.result.message) {
				alert(res.result.message);
			}
		});
	};

	/**
	 * Returns form
	 *
	 * @returns {jQuery}
	 */
	this.form = function() {
		return $('#prices_form');
	};

	/**
	 * Load form content
	 *
	 * @param {object} data
	 * @returns {undefined}
	 */
	this.loadForm = function(data) {
		debugger;
		var price = data.price;
		var form = $this.form();

		// reset form
		$d.resetForm(form);

		// load form
		$d.loadForm({
			form: form,
			data: price
		});
	};

	/**
	 * Handle click
	 *
	 * @returns {undefined}
	 */
	this.cancel_onClick = function() {
		app.redirect('events');
	};

	/**
	 * Handle click
	 *
	 * @param {type} e
	 * @returns {undefined}
	 */
	this.save_onClick = function(e) {
		e.preventDefault();
		var form = $this.form();
		var data = $d.getForm(form);
		var boolValid = $this.validateForm();
		if (!boolValid) {
			$d.notify({
				msg: __('Please check your input'),
				type: 'warning'
			});
			return;
		}

		$d.showLoad();
		app.rpc('prices.savePrice', data, function(res) {
			if (!$d.handleResponse(res)) {
				return;
			}

			if (res.result.validation) {
				$d.showValidation(form, res.result.validation);
				return;
			}
			if (res.result.message) {
				$d.alert(res.result.message);
				return;
			}

			console.log(res.result.price.event_id);
			var strParams = $.param({
				id: res.result.price.event_id
			});
			if (res.result.status == 1) {
				$d.notify({
					msg: __('Saved successfully'),
					type: 'success'
				});
				var strUrl = 'events/edit?' + strParams;
				app.redirect(strUrl, true);
			} else {
				$d.notify({
					msg: __('Unknown error occurred'),
					type: 'error'
				});
			}
		});

	};

	/**
	 * Validate form
	 *
	 * @returns {Boolean}
	 */
	this.validateForm = function() {

		var boolReturn = true;
		var form = $this.form();

		$d.resetValidation(form);


		var boolValid = $d.validateRequiredFields(form);
		if (!boolValid) {
			boolReturn = false;
		}

		return boolReturn;
	};


	/**
	 * Prevent from submitting
	 *
	 * @param {object} e
	 * @returns {undefined}
	 */
	this.form_onSubmit = function(e) {
		e.preventDefault();
	};

	this.init();
};

$(function() {
	var page = new app.prices.Edit($d.urlParams());
});
