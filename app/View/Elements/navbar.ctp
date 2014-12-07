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
										<label><?php wh(__('TNW-Number')); ?></label>
										<input class="form-control" name="data[tnw_id]" id="customer_search_tnw_id"
										       type="text" autocomplete="off" maxlength="255">

										<p class="help-block"></p>
									</div>
									<hr>
									<div class="form-group">
										<label><?php wh(__('Lastname*')); ?></label>
										<input type="text" name="data[lastname]" class="form-control" autocomplete="off"
										       required="required" maxlength="255">

										<p class="help-block"></p>
									</div>
									<div class="form-group">
										<label><?php wh(__('Firstname')); ?></label>
										<input type="text" name="data[firstname]" class="form-control"
										       autocomplete="off" maxlength="255">

										<p class="help-block"></p>
									</div>
									<div class="form-group">
										<label><?php wh(__('Date of Birth / Year')); ?></label>
										<input type="text" name="data[date_of_birth]" class="form-control"
										       autocomplete="off" required="required" maxlength="10">

										<p class="help-block"></p>
									</div>
									<div class="form-group">
										<label><?php wh(__('ZIP')); ?></label>
										<input type="text" name="data[postal_code]" class="form-control"
										       required="required" pattern="\d{4,5}" maxlength="5">

										<p class="help-block"></p>
									</div>
									<br>
									<button type="submit" id="customer_search_submit" class="btn btn-primary"><span
											class="fa fa-search"></span> <?php wh(__('Search')); ?></button>
									<button type="button" id="customer_search_reset" class="btn btn-default"><span
											class="fa fa-remove"></span> <?php wh(__('New Search')); ?></button>
									<hr>
									<div id="customer_search_alert">
										<div class="alert alert-danger" role="alert"></div>
									</div>
									<button type="button" id="customer_search_new_customer" class="btn btn-success">
										<span class="fa fa-plus"></span> <?php wh(__('New Customer')); ?>
									</button>
								</form>
							</div>

							<div class='col-md-8'>
								<div style="overflow:auto; max-height: 460px;">
									<table id="navbar_search_result_table"
									       class="table table-bordered table-hover table-striped table-condensed">
										<thead>
										<tr>
											<th><?php wh(__('Lastname')); ?></th>
											<th><?php wh(__('Firstname')); ?></th>
											<th><?php wh(__('Date of birth')); ?></th>
											<th><?php wh(__('ZIP')); ?></th>
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
				<li<?php echo ($strActiveNavbar == 'dashbaord') ? ' class="active"' : '' ?>><a
						href="<?php echo $this->Html->url('/'); ?>"><i
							class="fa fa-home"></i> <?php wh(__('Dashboard')); ?></a></li>
				<li<?php echo ($strActiveNavbar == 'Events') ? ' class="active"' : '' ?>><a
						href="<?php echo $this->Html->url('/events'); ?>"><i
							class="fa fa-user"></i> <?php wh(__('Events')); ?></a></li>
				<li<?php echo ($strActiveNavbar == 'Genres') ? ' class="active"' : '' ?>><a
						href="<?php echo $this->Html->url('/genres'); ?>"><i
							class="fa fa-money"></i> <?php wh(__('Genres')); ?></a></li>
				<li<?php echo ($strActiveNavbar == 'Price Categories') ? ' class="active"' : '' ?>><a
						href="<?php echo $this->Html->url('/price_categories'); ?>"><i
							class="fa fa-bus"></i> <?php wh(__('Price Categories')); ?></a></li>
				<!--
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list-ul"></i> <?php wh(__('Master data')); ?> <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Nav header</li>
						<li><a href="#">Separated link</a></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li>
				-->
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
