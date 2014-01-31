<table>
	<?php
		echo $this->Html->tableHeaders(array(	'ID',
												'Username',
												'First Name',
												'Last Name'));
		foreach ($knownusers as $thisuser) {
			echo $this->Html->tableCells($thisuser['User']);
		}
	?>
</table>