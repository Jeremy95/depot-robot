<?php
	
	class Search extends AppModel{
		
		public $validate = array(
			'search' => array(
				'required' => true) 
			);
	}


?>