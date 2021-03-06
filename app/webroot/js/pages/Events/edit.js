
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
		$('#show_add').on('click', this.btnShowAdd_onClick);
		$('#price_add').on('click', this.btnPriceAdd_onClick);
		$('#link_add').on('click', this.btnLinkAdd_onClick);
		this.form().on('submit', this.form_onSubmit);
		$('#event_save').on('click', this.save_onClick);
		$('#event_cancel').on('click', this.cancel_onClick);


		$('#title').focus();

		if ($this.config.id > 0) {
			// edit
			$this.load();
		} else {
			$('#event_show_container').hide();
			$('#event_price_container').hide();
			$('#event_link_container').hide();
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
			$this.loadTableShows(res.result);
			$this.loadTablePrices(res.result);
			$this.loadTableLinks(res.result);
		});

	};

	this.loadTableShows = function(data) {
		var eventId = data.event.id;
		var btn_show_add = $('#show_add');
		btn_show_add.href = 'Shows/add?'+ $.param({eventId:eventId})
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
			row.href = 'Shows/edit?'+ $.param({id:id});
			html = $d.template(tpl, row);
			tbody.append(html);
		}

		$(tbody).find('button[name=show_edit]').on('click', $this.showEdit_onClick);
		$(tbody).find('button[name=show_remove]').on('click',$this.showRemove_onClick);
		$(tbody).find("tr[data-filter='inactive'] button[name=show_remove]").hide();
		$(tbody).find('[data-toggle=tooltip]').tooltip();
		$this.reloadTable;
	};

	this.loadTablePrices = function(data) {
		var eventId = data.event.id;
		var btn_price_add = $('#price_add');
		btn_price_add.href = 'Prices/add?'+ $.param({eventId:eventId})
		var table = $('#event_price_table');
		var tbody = table.find('tbody');
		tbody.html('');
		if(!data){
			return;
		}
		var row = $('#event_price_table_row_tpl').clone();
		var tpl = row.html();
		var html = '';
		for(var i in data.prices) {
			var row = data.prices[i];
			var id = row.id;
			row.href = 'Prices/edit?'+ $.param({id:id});
			html = $d.template(tpl, row);
			tbody.append(html);
		}

		$(tbody).find('button[name=price_edit]').on('click', $this.priceEdit_onClick);
		$(tbody).find('button[name=price_remove]').on('click',$this.priceRemove_onClick);
		$(tbody).find("tr[data-filter='inactive'] button[name=price_remove]").hide();
		$(tbody).find('[data-toggle=tooltip]').tooltip();
		$this.reloadTable;
	};

	this.loadTableLinks = function(data) {
		var eventId = data.event.id;
		var btn_link_add = $('#link_add');
		btn_link_add.href = 'Links/add?'+ $.param({eventId:eventId})
		var table = $('#event_link_table');
		var tbody = table.find('tbody');
		tbody.html('');
		if(!data){
			return;
		}
		var row = $('#event_link_table_row_tpl').clone();
		var tpl = row.html();
		var html = '';
		for(var i in data.links) {
			var row = data.links[i];
			var id = row.id;
			row.href = 'Links/edit?'+ $.param({id:id});
			html = $d.template(tpl, row);
			tbody.append(html);
		}

		$(tbody).find('button[name=link_edit]').on('click', $this.linkEdit_onClick);
		$(tbody).find('button[name=link_remove]').on('click',$this.linkRemove_onClick);
		$(tbody).find("tr[data-filter='inactive'] button[name=link_remove]").hide();
		$(tbody).find('[data-toggle=tooltip]').tooltip();
		$this.reloadTable;
	};

	this.btnShowAdd_onClick = function(){
		var event_id = $this.config.id;
		app.redirect('Shows/add?'+ $.param({event_id:event_id}));
	};

	this.btnPriceAdd_onClick = function(){
		var event_id = $this.config.id;
		app.redirect('Prices/add?'+ $.param({event_id:event_id}));
	};
	this.btnLinkAdd_onClick = function(){
		var event_id = $this.config.id;
		app.redirect('Links/add?'+ $.param({event_id:event_id}));
	};

	this.showEdit_onClick = function() {
		var strUrl = $(this).attr('data-href');
		app.redirect(strUrl);
	};

	this.priceEdit_onClick = function() {
		var strUrl = $(this).attr('data-href');
		app.redirect(strUrl);
	};
	this.linkEdit_onClick = function() {
		var strUrl = $(this).attr('data-href');
		app.redirect(strUrl);
	};

	this.showRemove_onClick = function() {

		var id = $(this).attr('data-id');

		$d.confirm(__('Do you really want to delete this show?'), function(status) {

			if (!status) {
				return;
			}

			var params = {
				id: id
			};

			$d.showLoad();
			app.rpc('Shows.deleteShow', params, function(res) {
				if (!$d.handleResponse(res)) {
					return;
				}

				if (res.result.message) {
					$d.alert(res.result.message);
					return;
				}

				$this.load();
			});
		});
	};

	this.priceRemove_onClick = function() {

		var id = $(this).attr('data-id');

		$d.confirm(__('Do you really want to delete this price?'), function(status) {

			if (!status) {
				return;
			}

			var params = {
				id: id
			};

			$d.showLoad();
			app.rpc('Prices.deleteShow', params, function(res) {
				if (!$d.handleResponse(res)) {
					return;
				}

				if (res.result.message) {
					$d.alert(res.result.message);
					return;
				}

				$this.load();
			});
		});
	};
	this.linkRemove_onClick = function() {

		var id = $(this).attr('data-id');

		$d.confirm(__('Do you really want to delete this web link?'), function(status) {

			if (!status) {
				return;
			}

			var params = {
				id: id
			};

			$d.showLoad();
			app.rpc('Links.deleteLink', params, function(res) {
				if (!$d.handleResponse(res)) {
					return;
				}

				if (res.result.message) {
					$d.alert(res.result.message);
					return;
				}

				$this.load();
			});
		});
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
