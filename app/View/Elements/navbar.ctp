<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only"><?php wh(__('Menu')); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li id="navbar-search-item" class="dropdown navbar-item-primary">
					<a href="#" id="navbar-search-link" accesskey="s" class="dropdown-toggle" data-toggle="dropdown"><i
							class="fa fa-search"></i> <?php wh(__('Search')); ?></a>

					<div class="dropdown-menu dropdown-menu-search">
						<div class='row'>
							<div class='col-md-4'>
								<form id="customer_search" role="form">
									<div class="form-group">
										<label><?php wh(__('Event Title')); ?></label>
										<input type="text" name="data[title]" class="form-control"
										       autocomplete="off" maxlength="255">

										<p class="help-block"></p>
									</div>
									<br>
									<button type="submit" id="event_search_submit" class="btn btn-primary"><span
											class="fa fa-search"></span> <?php wh(__('Search')); ?></button>
									<button type="button" id="event_search_reset" class="btn btn-default"><span
											class="fa fa-remove"></span> <?php wh(__('New Search')); ?></button>
									<hr>
									<div id="customer_search_alert">
										<div class="alert alert-danger" role="alert"></div>
									</div>
									<button type="button" id="event_search_new_event" class="btn btn-success">
										<span class="fa fa-plus"></span> <?php wh(__('New Event')); ?>
									</button>
								</form>
							</div>

							<div class='col-md-8'>
								<div style="overflow:auto; max-height: 460px;">
									<table id="navbar_search_result_table"
									       class="table table-bordered table-hover table-striped table-condensed">
										<thead>
										<tr>
											<th><?php wh(__('Event Title')); ?></th>
										</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li<?php echo ($strActiveNavbar == 'Front Site') ? ' class="active"' : '' ?>><a
						href="<?php echo $this->Html->url('/'); ?>"><i
							class="fa fa-home"></i> <?php wh(__('Front Site')); ?></a></li>
				<li<?php echo ($strActiveNavbar == 'Events') ? ' class="active"' : '' ?>><a
						href="<?php echo $this->Html->url('/events'); ?>"><i
							class="fa fa-calendar"></i> <?php wh(__('Events')); ?></a></li>
				<li<?php echo ($strActiveNavbar == 'Genres') ? ' class="active"' : '' ?>><a
						href="<?php echo $this->Html->url('/genres'); ?>"><i
							class="fa fa-music"></i> <?php wh(__('Genres')); ?></a></li>
				<li<?php echo ($strActiveNavbar == 'Price Categories') ? ' class="active"' : '' ?>><a
						href="<?php echo $this->Html->url('/price_categories'); ?>"><i
							class="fa fa-money"></i> <?php wh(__('Price Categories')); ?></a></li>

			</ul>
			<ul class="nav navbar-nav navbar-right navbar-user">
				<ul class="nav navbar-nav">
					<li<?php echo ($strActiveNavbar == 'setting') ? ' class="active"' : '' ?>><a
							href="<?php echo $this->Html->url('/settings'); ?>"><i class="fa fa-gear"></i> </a></li>
					<li<?php echo ($strActiveNavbar == 'help') ? ' class="active"' : '' ?>><a
							href="<?php echo $this->Html->url('/help'); ?>"><i class="fa fa-question-circle"></i> </a>
					</li>
					<li><a href="<?php echo $this->Html->url('/users/logout'); ?>"><i class="fa fa-power-off"></i>
						</a></li>
				</ul>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</div>
