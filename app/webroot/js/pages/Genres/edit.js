
if (!app.genres) {
	app.genres = {};
}

app.genres.Edit = function(config) {
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
		$('#genre_save').on('click', this.save_onClick);
		$('#genre_cancel').on('click', this.cancel_onClick);

		$('#title').focus();

		if ($this.config.id > 0) {
			// edit
			$this.load();
		} else {
			// new: set default values
		}
	};

	/**
	 * Load page content
	 *
	 * @returns {undefined}
	 */
	this.load = function() {
		$d.showLoad();

		// allow olny adding price
		var form = $this.form();
		form.find(":input[type!='hidden']").prop("deleted", false);

		var params = $this.config;
		app.rpc('Genres.loadEdit', params, function(res) {
			if (!$d.handleResponse(res)) {
				return;
			}
			if (res.result.genre) {
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
		return $('#genre_form');
	};

	/**
	 * Load form content
	 *
	 * @param {object} data
	 * @returns {undefined}
	 */
	this.loadForm = function(data) {
		//debugger;
		//$d.log(data);
		var genre = data.genre;
		var form = $this.form();

		// reset form
		$d.resetForm(form);

		// load form
		$d.loadForm({
			form: form,
			data: genre
		});
	};

	/**
	 * Handle click
	 *
	 * @returns {undefined}
	 */
	this.cancel_onClick = function() {
		app.redirect('genres');
	};

	/**
	 * Handle click
	 *
	 * @param {type} e
	 * @returns {undefined}
	 */
	this.save_onClick = function(e) {
		//debugger;
		e.preventDefault();
		var form = $this.form();
		var data = $d.getForm(form);

		// input validation
		var boolValid = $this.validateForm();
		if (!boolValid) {
			$d.notify({
				msg: __('Please check your input'),
				type: 'warning'
			});
			return;
		}

		$d.showLoad();
		app.rpc('genres.saveGenre', data, function(res) {
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

			if (res.result.status == 1) {
				$d.notify({
					msg: __('Saved successfully'),
					type: 'success'
				});
				app.redirect('genres');
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
	var page = new app.genres.Edit($d.urlParams());
});
