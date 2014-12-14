<div id="content" class="container">
	<div class="row">
		<div class="col-md-12">
			<h1><?php wh($title_for_layout); ?>
				<small><?php //wh(__('Overview'));          ?></small>
			</h1>
			<?php echo $this->Session->flash(); ?>
		</div>
	</div>
	<p></p>

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default" id="event_overview_panel">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-calendar"></i> <?php wh(__('Event')); ?></h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" id="event_form">
						<input type="hidden" name="data[id]" id="id">

						<div class="form-group">
							<label class="col-md-3 control-label"><?php wh(__('Title*')); ?></label>

							<div class="col-md-9">
								<input type="text" id="title" name="data[title]" class="form-control"
								       maxlength="255" required="required">
								<p class="help-block"></p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?php wh(__('Genre ID*')); ?></label>

							<div class="col-md-9">
								<?php
								echo $this->Component->select(array(
									'name' => 'genre_id',
									'datasource' => 'Genre.getCodelist',
									'attr' => array(
										//'default' => $customer['customer_status_type_id'],
										'required' => 'required',
										//'disabled' => 'disabled'
									)
								));
								?>

								<p class="help-block"></p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?php wh(__('Line Up')); ?></label>

							<div class="col-md-9">
								<input type="text" id="lineup" name="data[lineup]" class="form-control"
								       maxlength="255" >
								<p class="help-block"></p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?php wh(__('Description')); ?></label>

							<div class="col-md-9">
								<input type="text" id="description" name="data[description]" class="form-control">
								<p class="help-block"></p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?php wh(__('Duration')); ?></label>

							<div class="col-md-9">
								<input type="datetime" id="duration" name="data[duration]" class="form-control">
								<p class="help-block"></p>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<div class="col-md-offset-3 col-md-9">
								<button type="button" id="event_save" class="btn btn-primary">
									<?php wh(__('Save')); ?>
								</button>
								<button type="button" id="event_cancel" class="btn btn-default">
									<?php wh(__('Cancel')); ?>
								</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container" id="event_show_container">

	<div class="row">
		<div class="col-md-12">
			<h1>
				List all corresponding Shows
			</h1>
			<button type="submit" id="show_add" class="btn btn-primary">
				<span fa fa-plus></span><?php wh(__('Add a new show')); ?></span>
			</button>
		</div>
	</div>
	<p></p>
	<div class="row">

		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel panel-body">

					<table id="event_show_table"
					       class="table table-bordered table-hover table-striped table-condensed">
						<thead>
						<tr>
							<th>
								<?php wh(__('Date and Time of Begin')); ?>
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
<div class="container" id="event_price_container">

	<div class="row">
		<div class="col-md-12">
			<h1>
				List all corresponding ticket prices
			</h1>
			<button type="submit" id="price_add" class="btn btn-primary">
				<span fa fa-plus></span><?php wh(__('Add a new ticket price category')); ?></span>
			</button>
		</div>
	</div>
	<p></p>
	<div class="row">

		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel panel-body">

					<table id="event_price_table"
					       class="table table-bordered table-hover table-striped table-condensed">
						<thead>
						<tr>
							<th>
								<?php wh(__('Price tag of the ticket')); ?>
							</th>
							<th>
								<?php wh(__('Price category')); ?>
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


<script type="text/html" id="event_show_table_row_tpl">
	<tr data-fitler="{filter}">
		<td>
			{begin}
		</td>
		<td>
			<button type="button" name="show_edit" data-href="{href}" class="btn btn-default">
				<span class="fa fa-edit"></span>
				<?php wh(__('Edit')); ?>
			</button>
			<button type="button" name="show_remove" data-id="{id}" class="btn btn-danger">
				<span class="fa fa-remove"></span>
				<?php wh(__('Delete')); ?>
			</button>
		</td>
	</tr>
</script>

<script type="text/html" id="event_price_table_row_tpl">
	<tr data-fitler="{filter}">
		<td>
			{price}
		</td>
		<td>
			{price_category_id}
		</td>
		<td>
			<button type="button" name="price_edit" data-href="{href}" class="btn btn-default">
				<span class="fa fa-edit"></span>
				<?php wh(__('Edit')); ?>
			</button>
			<button type="button" name="price_remove" data-id="{id}" class="btn btn-danger">
				<span class="fa fa-remove"></span>
				<?php wh(__('Delete')); ?>
			</button>
		</td>
	</tr>
</script>
