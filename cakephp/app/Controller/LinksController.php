<?php

class LinksController extends AppController{
	
	public function add() {
		
		
		if($this->request->is('post')){
			
			$link = $this->Link->findByUrl($this->request->data['Link']['url']);
			if(empty($link)){
				$this->Link->create($this->request->data, true);
				$this->Link->save(null, true, array('url'));
				$id = $this->Link->id;
			}
			else{
				$id = $link['Link']['url'];
			}
			$this->set(compact('id'));
			$this->render('add-success');
			
		}
	}
	
	public function view($id) {
		
		$link = $this->Link->findById($id);
		if(empty($link)){
			throw new NotFoundException();
		}
		return $this->redirect($link['Link']['url'], 301);
	}
}

?>