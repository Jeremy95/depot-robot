<?php $this->assign('title', 'Mon Google'); ?>  <?php $this->assign('robot', 'Mon robot'); ?>

<?php echo $this->Form->create('Search', array('action' => 'vue')); ?>
<?php echo $this->Form->input('search', array('label' => 'Votre mot clé')); ?>
<?php echo $this->Form->end('Rechercher'); ?>

