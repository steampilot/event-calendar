/**
 * Created by Jerome Roethlisberger on 30.11.2014.
 */
if (!app.priceCategories) {
	app.priceCategories = {};
}
app.priceCategories.Index = function(config){
	//this Class Object
	var $this = this;
	//class and member variables
	this.config = config;
	this.init = function() {
		$('#priceCategory_add').on('click', this.btnPriceCategoryAdd_onClick);
		$('#priceCategory_table tbody').hide();
		$('#priceCategory_add_nav_tabs > li > a').on('show.bs.tab', this.navTabs_onShow);
		$this.filterTable('active');
	};

	this.load = function(){
		$d.showLoad();
		app.rpc('PriceCategories.loadIndex', null, function(res){
			if(!$d.handleResponse(res)){
				return;
			}
			$this.loadTable(res.result);
		});
	};
	this.loadTable = function(result){
		var table = $('#priceCategory_table');
		var tbody = table.find('tbody');
		tbody.html('');
		if (!result){
			return;
		}
		var row = $('#priceCategory_table_row_tpl').clone();
		var tpl = row.html();
		var html = '';
		for(var i in result.priceCategories) {
			var row = result.priceCategories[i];
			var id = row.id;
			row.href = 'PriceCategories/edit?'+ $.param({id:id});
			html = $d.template(tpl, row);
			tbody.append(html);
		}
		//register action button events
		$(tbody).find('button[name=priceCategory_edit]').on('click', $this.priceCategoryEdit_onClick);
		$(tbody).find('button[name=priceCategory_delete]').on('click',$this.priceCategoryDelete_onClick);
		// hide delete button for deleted Genres
		$(tbody).find("tr[data-filter='inactive'] button[name=priceCategory_remove]").hide();
		// enable tooltips
		$(tbody).find('[data-toggle=tooltip]').tooltip();
		$this.reloadTable;
	};

	/**
	 * Filter table by search filter
	 *
	 * @param {type} strFilter active, inaktive, all
	 * @returns {undefined}
	 */
	this.filterTable = function(strFilter) {
		var table = $('#priceCategory_table');
		table.find("tbody tr").each(function() {
			var strDataFilter = $(this).attr('data-filter');
			if (strFilter === 'all' || strDataFilter === strFilter) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
		$('#priceCategory_table tbody').show();
	};

	/**
	 * Refresh current tab filter
	 *
	 * @returns {undefined}
	 */
	this.reloadTable = function() {
		var strFilter = $('#priceCategory_add_nav_tabs li.active a').attr('data-filter');
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
	this.btnPriceCategoryAdd_onClick = function() {
		app.redirect('PriceCategories/add');
	};

	/**
	 * Handle click
	 *
	 * @returns {undefined}
	 */
	this.priceCategoryEdit_onClick = function() {
		var strUrl = $(this).attr('data-href');
		app.redirect(strUrl);
	};

	/**
	 * Handle click
	 *
	 * @returns {undefined}
	 */
	this.priceCategoryDelete_onClick = function() {

		var id = $(this).attr('data-id');

		$d.confirm(__('Do you really want to delete this genre?'), function(status) {

			if (!status) {
				return;
			}

			var params = {
				id: id
			};

			$d.showLoad();
			app.rpc('PriceCategories.delete', params, function(res) {
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
	var page = new app.priceCategories.Index();
	page.load();
});

