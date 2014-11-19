<div class="container">
	<div id="login-wraper">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><b><?php wh(__('Login')); ?></b></h3>
			</div>
			<div class="panel-body">
				<?php echo $this->Form->create('Users', array('action' => 'login', 'class' => 'form-signin', 'role' => 'form')); ?>
				<fieldset>
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->Session->flash('auth'); ?>
					<div class="form-group">
						<label><?php wh(__('E-Mail')); ?></label>
						<?php echo $this->Form->input('username', array('value' => '', 'label' => false, 'class' => 'form-control')); ?>
					</div>
					<div class="form-group">
						<label><?php wh(__('Password')); ?></label>
						<?php echo $this->Form->input('password', array('value' => '', 'label' => false, 'class' => 'form-control')); ?>
					</div>
					<input class="btn btn-lg btn-primary btn-block" type="submit" value="Login">

					<div>
						<label>
							<a href="#"><?php wh(__('forgot password')); ?></a>
						</label>
					</div>
				</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(function () {
		$("#UsersUsername").focus();
	});
</script>
