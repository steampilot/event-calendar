<div id="content" class="container" xmlns="http://www.w3.org/1999/html">
	<div class="row">
		<div class="col-md-12">
			<h1><?php wh(__('Genres')); ?>
				<small>
					<?php wh('Overview'); ?>
				</small>
			</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<button type="submit" id="genre_add" class="btn btn-primary">
				<span fa fa-plus></span><?php wh(__('Add genre')); ?></span>
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel panel-body">
					<!--Nav tabs-->
					<ul class="nav nav-tabs" role="tablist" id="customer_add_nav_tabs">
						<li class="active">
							<a href="#genre_tab_pane" data-filter="active" role="tab" data-toggle="tab">
								<?php wh(__('Active')); ?></a>
						</li>
						<li>
							<a href="#genre_tab_pane" data-filter="inactive" role="tab" data-toggle="tab">
								<?php wh(__('Inactive/Deleted')); ?></a>
						</li>
						<li>
							<a href="#genre_tab_pane" data-filter="all" role="tab" data-toggle="tab">
								<?php wh(__('All')); ?></a>
						</li>
					</ul>
					<!--Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="genre_tab_pane">
							<table id="genre_table"
							       class="table table-bordered table-hover table-striped table-condensed">
								<thead>
									<tr>
										<th>
											<?php wh(__('Title')); ?>
										</th>
										<th>
											<?php wh(__('Action')); ?>
										</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/html" id="genre_table_row_tpl">
	<tr data-fitler="{filter}">
		<td>
			{title}
		</td>
		<td>
			<button type="button" name="genre_edit" data-href="{href}" class="btn btn-default">
				<span class="fa fa-edit"></span>
				<?php wh(__('Edit')); ?>
			</button>
			<button type="button" name="genre_remove" data-href="{id}" class="btn btn-danger">
				<span class="fa fa-remove"></span>
				<?php wh(__('Delete')); ?>
			</button>
		</td>
	</tr>
</script>
