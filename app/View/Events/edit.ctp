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
		<div class="col-md-8">
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
