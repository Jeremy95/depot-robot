	<?php $this->assign('title', 'Mon Google'); ?> <?php $this->assign('robot', 'Mon robot'); ?>
	
	<?php if(!empty($keywords)){ ?>
	<?php foreach ($keywords as $key => $keyword): ?>
		<p>
			<a href="<?php echo $keyword['Search']['url']; ?>"><?php echo $keyword['Search']['titre']; ?></a><br>
			<span>
				<?php echo $keyword['Search']['url']; ?>
			</span><br>
		</p>
			
		<p>
			
			<?php echo $keyword['Search']['keywords']; ?><br>
			<?php echo $keyword['Search']['description']; ?><br>
		</p>
		
	<?php endforeach ?>
	
	<?php } ?>
	
