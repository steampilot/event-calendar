<div class="footer">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"><?php wh(__('Steampilot') . ' | ' . __('Version') . ' ' . Configure::read
					('App.version') . ' | ' . CakeSession::read('Auth.User.title')); ?></a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<a class="brand" href="#">
				</a>
			</ul>
		</div>
	</div>
</div>
<?php
echo $this->Html->link('Admin', array('action'=> 'dashboard', 'admin' => 'true'));
