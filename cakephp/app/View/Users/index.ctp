<p> Hello ! <?php echo($user['first_name'].' '.$user['last_name']); ?></p>
<?php echo $this->Html->link('knownusers', array('action' => 'knownusers')); ?><br/>
<?php echo $this->Html->link('logout', array('action' => 'logout')); ?>
