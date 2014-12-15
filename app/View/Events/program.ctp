<div id="content" class="container">
    <div class="jumbotron">
        <h1>Steampilot Event Calendar</h1>
        <p class="lead">Its now 05:00am. Wouldn't we rather like to be on a Event than working night shifts? Of
	        course we would! So lets se what future brings!</p>
	    <?php
	    $currentUser = CakeSession::read('Auth.User.title');
	    if ($currentUser == '') {
		    $currentUser = 'LOGIN';
	    }
	    $linkText = 'Steampilot | Version | '.
		    Configure::read('App.version').
		    ' | '. $currentUser;
	    $linkUrl = array('action' => 'dashboard', 'admin' => 'true');
	    $options = array('class' => 'navbar-brand');
	    echo $this->Html->link($linkText, $linkUrl,$options);
	    ?>
    </div>
</div>
<div class="container" id="event_featurette">
<!-- event_featurette_row -->
	<?php foreach($events as $event){ ?>
		<div class="row featurette">
			<div class="col-md-7">
				<div class="row">
					<h2 class="featurette-heading"><?php wh($event['Event']['title']); ?></h2>
					<p><small class="text-muted"><?php wh($event['Event']['lineup']); ?>/small></p>
					<p class="lead text-justify"> <?php wh($event['Event']['description']) ?> </p>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-3" id="event_shows_table">
						<h3><small>Scheduled Shows</small></h3>
						<table class="table table-bordered table-striped table-hover table-condensed">
							<thead>
								<tr>
									<th>
										Date and Time
									</th>
								</tr>
							</thead>
							<tbody>
							<!-- event_shows_table_row -->

							</tbody>
						</table>
					</div>
					<div class="col-md-4 col-sm-4" id="event_prices_table">
						<h3><small>Ticket Prices</small></h3>
						<table class="table table-bordered table-striped table-hover table-condensed">
							<thead>
							<tr>
								<th>
									Ticket Price
								</th>
								<th>
									Price Category Id
								</th>
							</tr>
							</thead>
							<tbody>
							<!-- event_prices_table_row -->

							</tbody>
						</table>
					</div>
					<div class="col-md-4 col-sm-4" id="event_links_table">
						<h3><small>Links & Infos</small></h3>
						<table class="table table-bordered table-striped table-hover table-condensed">
							<thead>
							<tr>
								<th>
									Web Link
								</th>
								<th>
									Web Link URL
								</th>
							</tr>
							</thead>
							<tbody>
							<!-- event_links_table_row -->
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-sm-5">
				<img src="img/Event/<?php wh($event['Event']['image_file_name']) ?>" alt="<?php wh
				($event['Event']['image_title'])
				?>"
				     class="img
				img-rounded">
			</div>
		</div>
		<hr class="featurette-divider">
	<?php }?>
</div>
