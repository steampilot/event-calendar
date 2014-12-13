<?php
echo('Hello World');
?>
<div id="content" class="container">
    <div class="jumbotron">
        <h1>Steampilot Event Calendar</h1>
        <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <p><a class="btn btn-lg btn-success" href="#" role="button">Archive</a></p>
    </div>
</div>
<div class="container" id="event_featurette">
	<div class="row featurette" id_event_featurette_row>
		<div class="col-md-7">
			<div class="row">
				<h2 class="featurette-heading">First Event</h2>
				<p>
					<small class="text-muted">LineUp JarlsDavis, John Stocker</small></h2>
				</p>
				<p class="lead text-justify">
					Donec ullamcorper nulla non metus auctor fringilla.
					Vestibulum id ligula porta felis euismod semper.
					Praesent commodo cursus magna, vel scelerisque nisl consectetur.
					Fusce dapibus, tellus ac cursus commodo.
					Donec ullamcorper nulla non metus auctor fringilla.
					Vestibulum id ligula porta felis euismod semper.
					Praesent commodo cursus magna, vel scelerisque nisl consectetur.
					Fusce dapibus, tellus ac cursus commodo.
					Donec ullamcorper nulla non metus auctor fringilla.
					Vestibulum id ligula porta felis euismod semper.
					Praesent commodo cursus magna, vel scelerisque nisl consectetur.
					Fusce dapibus, tellus ac cursus commodo.
				</p>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-3" id="event_shows_column">
					<h3><small>Scheduled Shows</small></h3>
					<table class="table table-bordered table-striped table-hover table-condensed">
						<tbody>This Should not be visible</tbody>
					</table>
				</div>
				<div class="col-md-4 col-sm-4" id="event_prices_column">
					<h3><small>Ticket Prices</small></h3>
					<table class="table table-bordered table-striped table-hover table-condensed">
						<tbody></tbody>
					</table>
				</div>
				<div class="col-md-4 col-sm-4" id="event_links_column">
					<h3><small>Links & Infos</small></h3>
					<table class="table table-bordered table-striped table-hover table-condensed">
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-sm-5">
			<?php
			echo $this->Html->image('Event/1.jpg', array('alt' => 'Event Picture')); ?>
		</div>
	</div>
</div>
	<hr class="featurette-divider">

