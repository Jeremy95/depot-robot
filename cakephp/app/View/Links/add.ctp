<?php echo $this->assign('title', 'Mon Raccourcisseur D\'url'); ?>

<h1>Raccourcir un lien</h1>

<?php echo $this->Form->create('Link'); ?>

<?php echo $this->Form->input('url', array('label' => 'Votre lien', 
							'placeholder' => 'http://monlien.fr')); ?>
							
<?php echo $this->Form->end('Raccourcir le lien'); ?>