
if (!app.events) {
	app.events = {};
}

app.events.Edit = function(config) {
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
		debugger;
		$('#show_add').on('click', this.btnShowAdd_onClick);
		this.form().on('submit', this.form_onSubmit);
		$('#event_save').on('click', this.save_onClick);
		$('#event_cancel').on('click', this.cancel_onClick);


		$('#title').focus();

		if ($this.config.id > 0) {
			// edit
			$this.load();
		} else {
			$('#event_show_container').hide();
		}
	};

	/**
	 * Load page content
	 *
	 * @returns {undefined}
	 */
	this.load = function() {
		debugger;

		$d.showLoad();

		var form = $this.form();
		form.find(":input[type!='hidden']").prop("deleted", false);

		var params = $this.config;
		app.rpc('Events.loadEdit', params, function(res) {
			if (!$d.handleResponse(res)) {
				return;
			}
			if (res.result.event) {
				$this.loadForm(res.result);
			}
			if (res.result.message) {
				alert(res.result.message);
			}
			$this.loadTable(res.result);
		});

	};

	this.loadTable = function(data) {
		console.log('loadTable_input', data.shows);
		debugger;
		var table = $('#event_show_table');
		var tbody = table.find('tbody');
		tbody.html('');
		if(!data){
			return;
		}
		var row = $('#event_show_table_row_tpl').clone();
		var tpl = row.html();
		var html = '';
		for(var i in data.shows) {
			var row = data.shows[i];
			var id = row.id;
			row.href = 'Show/edit?'+ $.param({id:id});
			html = $d.template(tpl, row);
			tbody.append(html);
		}

		$(tbody).find('button[name=show_edit]').on('click', $this.showEdit_onClick);
		$(tbody).find('button[name=show_remove]').on('click',$this.showRemove_onClick);
		$(tbody).find("tr[data-filter='inactive'] button[name=show_remove]").hide();
		$(tbody).find('[data-toggle=tooltip]').tooltip();
		$this.reloadTable;
	};
	this.btnShowAdd_onClick = function(){
		alert("Adding a show is not yet implemented");
	};
	/**
	 * Refresh current tab filter
	 *
	 * @returns {undefined}
	 */
	this.reloadTable = function() {
		var strFilter = $('#show_add_nav_tabs li.active a').attr('data-filter');
		$this.filterTable(strFilter);
	};


	/**
	 * Returns form
	 *
	 * @returns {jQuery}
	 */
	this.form = function() {
		return $('#event_form');

	};

	/**
	 * Load form content
	 *
	 * @param {object} data
	 * @returns {undefined}
	 */
	this.loadForm = function(data) {
		var event = data.event;
		var form = $this.form();

		$d.resetForm(form);

		// load form
		$d.loadForm({
			form: form,
			data: event
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
		debugger;
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
		app.rpc('Events.saveEvent', data, function(res) {
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
				var strParams = $.param({
					id: res.result.event.id
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
	var page = new app.events.Edit($d.urlParams());
});
