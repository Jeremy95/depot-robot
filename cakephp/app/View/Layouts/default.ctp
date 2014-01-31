<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<title><?php $title_for_layout; ?></title>
		<meta name="viewport" content="with=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<link href="css/bootstrap.css" rel="stylesheet">
			<style type="text/css">
			body {
				padding-top: 60px;
				padding-bottom: 40px;
			}
			</style>
			<?php echo $this->Html->css('bootstrap'); ?>
			<?php echo $this->Html->css('bootstrap-responsive'); ?>
			<?php echo $this->fetch('css'); ?>
		</head>

	<body>

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<a class="brand" href="<?php echo $this->Html->url(array('action' => 'index')); ?>"><?php echo $this->fetch('title'); ?></a>
			<a class="brand" href="<?php echo $this->Html->url(array('action' => 'robot')); ?>"><?php echo $this->fetch('robot'); ?></a>

		</div>
	</div>
	
	<div class="container">
	<div class="row">
	<p>&nbsp;</p>
		<?php echo $this->fetch('content'); ?>
	</div>
	</div>
	
	<?php echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'); ?>	
	<?php echo $this->Html->script('bootstrap'); ?>	
	<?php echo $this->fetch('script'); ?>

	</body>
</html>


