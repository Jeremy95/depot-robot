<h1>Bravo</h1>

<p>Votre lien a bien était raccourcis !</p>

<p>
	<a href="<?php echo $this->Html->url(array('action' => 'view', $id)); ?>" class="btn">
		<?php echo $this->Html->url(array('action' => 'view', $id), true); ?>
	</a>
</p>