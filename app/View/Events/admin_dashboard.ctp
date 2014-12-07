<div id="content" class="container">
	<div id="page-wrapper">
		<div class="row">
			<div class="col-md-12">
				<h1><?php wh(__('Dashboard')); ?>
					<small><?php wh(__('Home')); ?></small>
				</h1>
				<?php echo $this->Session->flash(); ?>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php wh(__('Welcome to the admin dashboard!')); ?>
					<?php wh(__('Here you can manage your events, genres and prises.')); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i
								class="fa fa-bar-chart-o"></i> <?php wh(__('List of all the up coming events')); ?></h3>
					</div>
					<div class="panel-body center">
						<canvas id="sales_chart" height="98"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> <?php wh(__('Listed Genres')); ?></h3>
					</div>
					<div class="panel-body center">
						<canvas id="article_month_chart" height="200"/>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i
								class="fa fa-bar-chart-o"></i> <?php wh(__('Listed Price Categories')); ?></h3>
					</div>
					<div class="panel-body center">
						<canvas id="article_year_chart" height="200"/>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>