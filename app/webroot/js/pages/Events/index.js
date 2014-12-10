/**
 * Created by ShinKenDo on 07.12.2014.
 */
if (!app.events) {
	app.events = {};
}
app.events.Index = function(config){
	var $this = this;
	this.config = config;
	this.init = function() {
		$('#event_add').on('click', this.btnEventAdd_onClick);
		$('#event_table tbody').hide();
		$('#event_add_nav_tabs > li > a').on('show.bs.tab', this.navTabs_onShow);
		$this.filterTable('active');
	};

	this.load = function(){
		$d.showLoad();
		app.rpc('Events.loadIndex', null, function(res){
			if(!$d.handleResponse(res)){
				return;
			}
			$this.loadTable(res.result);
		});
	};
	this.loadTable = function(result){
		var table = $('#event_table');
		var tbody = table.find('tbody');
		tbody.html('');
		if (!result){
			return;
		}
		var row = $('#event_table_row_tpl').clone();
		var tpl = row.html();
		var html = '';
		for(var i in result.events) {
			var row = result.events[i];
			var id = row.id;
			row.href = 'Events/edit?'+ $.param({id:id});
			html = $d.template(tpl, row);
			tbody.append(html);
		}
		$(tbody).find('button[name=event_edit]').on('click', $this.eventEdit_onClick);
		$(tbody).find('button[name=event_remove]').on('click',$this.eventRemove_onClick);
		$(tbody).find("tr[data-filter='inactive'] button[name=event_remove]").hide();
		$(tbody).find('[data-toggle=tooltip]').tooltip();
		$this.reloadTable;
	};

	/**
	 * Filter table by search filter
	 *
	 * @param {type} strFilter active, inactive, all
	 * @returns {undefined}
	 */
	this.filterTable = function(strFilter) {
		var table = $('#event_table');
		table.find("tbody tr").each(function() {
			var strDataFilter = $(this).attr('data-filter');
			if (strFilter === 'all' || strDataFilter === strFilter) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
		$('#event_table tbody').show();
	};

	/**
	 * Refresh current tab filter
	 *
	 * @returns {undefined}
	 */
	this.reloadTable = function() {
		var strFilter = $('#event_add_nav_tabs li.active a').attr('data-filter');
		$this.filterTable(strFilter);
	};

	/**
	 * Handle tab click
	 *
	 * @returns {undefined}
	 */
	this.navTabs_onShow = function() {
		var strFilter = $(this).attr('data-filter');
		$this.filterTable(strFilter);
	};

	/**
	 * Button: Article add event
	 *
	 * @returns {undefined}
	 */
	this.btnEventAdd_onClick = function() {
		app.redirect('Events/add');
	};

	/**
	 * Handle click
	 *
	 * @returns {undefined}
	 */
	this.eventEdit_onClick = function() {
		var strUrl = $(this).attr('data-href');
		app.redirect(strUrl);
	};

	/**
	 * Handle click
	 *
	 * @returns {undefined}
	 */
	this.eventRemove_onClick = function() {

		var id = $(this).attr('data-id');

		$d.confirm(__('Do you really want to delete this event?'), function(status) {

			if (!status) {
				return;
			}

			var params = {
				id: id
			};

			$d.showLoad();
			app.rpc('Events.deleteEvent', params, function(res) {
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

	this.init();
};

$(function() {
	var page = new app.events.Index();
	page.load();
});

