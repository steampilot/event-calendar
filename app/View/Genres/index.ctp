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
	<p></p>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel panel-body">

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
			<button type="button" name="genre_remove" data-id="{id}" class="btn btn-danger">
				<span class="fa fa-remove"></span>
				<?php wh(__('Delete')); ?>
			</button>
		</td>
	</tr>
</script>
