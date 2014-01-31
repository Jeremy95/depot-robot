<?php
class Product extends AppModel{
	public $actsAs = array('Acl' => array('type' => 'controlled'));
	public $belongsTo = 'Dealer';
	
	function parentNode() {
		if (!$this->id && empty($this->data)){
			return null;
		}
		$data = $this->data;
		if (empty($this->data)) {
			$data = $this->read();
		}
		if (!$data['Product']['dealer_id']) {
			return null;
		}
		else{
			return array('Dealer' => array('id' => $data['Product']['dealer_id']));
		}
	}
}
?>