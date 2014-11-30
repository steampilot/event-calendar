/**
 * Created by Jerome Roethlisberger on 30.11.2014.
 */
if (!app.genres) {
	app.genres = {};
}
app.genres.index = function(config){
	//this Class Object
	var $this = this;
	//class and member variables
	this.config = config;
	this.init = function() {
		$('#genre_add').on('click', this.btnGenreAdd_onClick);
		$('#genre_table tbody').hide();
		$('#genre_add_nav_tabs > li > a').on('show.bs.tab', this.navTabs_onShos);
		$this.filterTable('active');
	};

	this.load = function(){
		$d.showLoad();
		app.rpc('Genres.loadIndex', null, function(res){
			if(!$d.handleResponse(res)){
				return;
			}
			$this.loadTable(res.result);
		});
	};
	this.loadTable = function(result){
		var table = $('#genre_table');
		var tbody = table.find('tbody');
		tbody.html('');
		if (!result){
			return;
		}
		var row = $('#genre_table_row_tpl').clone();
		var tpl = row.html();
		var html = '';
		for(var i in result.genres) {
			var row = result.genres[i];
			var token = row['token'];
			var id = row['id'];
			row.href = 'genres/edit?id='+id+'&token='+token;
			if (row.enabled === true) {
				row.filter = 'active';
			} else {
				row.filter = 'inactive';
			}
			html = $d.template(tpl, row);
			tbody.append(html);
		}
		//register action button events
		$(tbody).find('buton[name=genre_edit').on('click', $this.genreEdit_onClick);
		$(tbody).find('button[name=genre_remove').on('click',$this.genreRemove_onClick);
		// hide delete button for deleted genres
		$(tbody).find("tr[data-filter='inactive'] button[name=genre_remove]").hide();
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
		var table = $('#genre_table');
		table.find("tbody tr").each(function() {
			var strDataFilter = $(this).attr('data-filter');
			if (strFilter === 'all' || strDataFilter === strFilter) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
		$('#genre_table tbody').show();
	};

	/**
	 * Refresh current tab filter
	 *
	 * @returns {undefined}
	 */
	this.reloadTable = function() {
		var strFilter = $('#genre_add_nav_tabs li.active a').attr('data-filter');
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
	this.btnGenreAdd_onClick = function() {
		app.redirect('genres/add');
	};

	/**
	 * Handle click
	 *
	 * @returns {undefined}
	 */
	this.genreEdit_onClick = function() {
		var strUrl = $(this).attr('data-href');
		app.redirect(strUrl);
	};

	/**
	 * Handle click
	 *
	 * @returns {undefined}
	 */
	this.genreRemove_onClick = function() {

		var id = $(this).attr('data-id');

		$d.confirm(__('Do you really want to delete this genre?'), function(status) {

			if (!status) {
				return;
			}

			var params = {
				id: id
			};

			$d.showLoad();
			app.rpc('Articles.disableGenre', params, function(res) {
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
	var page = new app.genres.Index();
	page.load();
});

