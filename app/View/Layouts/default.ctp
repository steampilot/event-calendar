<?php
if (!empty($arrAssets['css'])) {
	foreach ($arrAssets['css'] as $arrCssFile) {
		$this->Html->css($arrCssFile['path'], $arrCssFile['options']);
	}
}
if (!empty($arrAssets['js'])) {
	foreach ($arrAssets['js'] as $arrJsFile) {
		if (isset($arrJsFile['content'])) {
			$this->Html->scriptBlock($arrJsFile['content'], $arrJsFile['options']);
		} else {
			$this->Html->script($arrJsFile['path'], $arrJsFile['options']);
		}
	}
}
?>
<!DOCTYPE HTML>
<html lang="<?php echo wh(__('en')); ?>">
<head>
	<?php echo $this->Html->charset(); ?>
	<meta charset="UTF-8">
	<title><?php echo $this->fetch('title'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<base href="<?php echo $this->webroot; ?>">
	<?php echo $this->fetch('meta'); ?>
	<?php //echo $this->Html->meta('icon', $strFavicon); ?>
	<?php echo $this->Html->script('jquery.min'); ?>
	<?php echo $this->Html->script('bootstrap.min'); ?>
	<?php echo $this->Html->css('bootstrap.min'); ?>
	<?php echo $this->Html->css('font-awesome.min'); ?>
	<?php echo $this->fetch('css'); ?>
	<?php echo $this->fetch('script'); ?>
</head>
<?php
if (!empty($strNavbar)) {
	echo $this->element($strNavbar);
}
?>
<?php
// if (!empty($arrElements)) {
//	foreach ($arrElements as $arrElement) {
//		echo $this->element($arrElement['name']);
//	}
//}
?>
<?php echo $this->fetch('content'); ?>
<br>
<?php echo $this->element('footer'); ?>
</html>
