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
			<div class="panel panel-default" id="show_overview_panel">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-clock-o"></i> <?php wh(__('Show')); ?></h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" id="show_form">
						<input type="hidden" name="data[id]">
						<input type="hidden" name="data[event_id]">

						<div class="form-group">
							<label class="col-md-3 control-label"><?php wh(__('Begin Date and Time*')); ?></label>

							<div class="col-md-9">
								<input type="datetime" id="begin" name="data[begin]" class="form-control"
								       maxlength="255" required="required">

								<p class="help-block"></p>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<div class="col-md-offset-3 col-md-9">
								<button type="button" id="show_save" class="btn btn-primary">
									<?php wh(__('Save')); ?>
								</button>
								<button type="button" id="show_cancel" class="btn btn-default">
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
