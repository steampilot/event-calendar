<div class="footer">
	<div class="container">
		<div class="navbar-header">
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
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<a class="brand" href="#">
				</a>
			</ul>
		</div>
	</div>
</div>
