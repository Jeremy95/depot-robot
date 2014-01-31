<?php
class ProductsController extends AppController{
	var $scaffold;
	public $components = array('Acl');
	
	public function add(){
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)){
				$user = $this->Session->read('user');
				$this->Acl->allow(	'Users',
									array(	'model' => 'Product',
											'foreign_key' => $this->Product->id),
											'read');
				$this->Acl->allow( array( 'model' => 'User',
										  'foreign_key' => $user['id']),
									array(	'model' => 'Product',
											'foreign_key' => $this->Product-id));
				$this->Session->setFlash(__('The product has been saved'));
				$this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash(__('The product could not be saved. Please, Try again.'));
			}
		}
		$dealers = $this->Product->Dealer->find('list');
		$this->set(compact('dealers'));
	}
}
?>