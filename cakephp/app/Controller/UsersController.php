<?php
class UsersController extends AppController{

public $helpers = array('Html', 'Form');

function register(){
	if($this->request->is('post')){
	   $this->request->data['User']['password'] = 
	   		md5($this->request->data['User']['password']);
		if($this->User->save($this->request->data)){
		   $this->Session->setFlash('Your registration information was accepted. ');
		   $this->request->data['User']['id'] = $this->User->id;
		   $this->Session->write('user', $this->request->data['User']);
		   $this->redirect(array('action' => 'index'));
		
		}
		else {
			$this->request->data['User']['password'] = '';
			$this->Session->setFlash('There was a problem with your registration. ');
		}
	}
}

function knownusers(){
	$this->set('knownusers',
				$this->User->find(	'all', 
									array(	'fields' => array(	'id',
																'username',
																'first_name',
																'last_name',),
											'order' => 'id DESC')));
}

function login(){
	if ($this->request->is('post')){
		$results = $this->User->findByUsername($this->request->data['User']['username']);
		
		if ($results && $results['User']['password'] == md5($this->request->data['User']['password'])){
			$this->Session->write('user', $results['User']);
			$this->redirect(array('action' => 'index'));
		}
		else{
			$this->Session->setFlash('Your login information was not accepted.');
		}
	}
}

function logout(){
	$this->Session->delete('user');
	$this->redirect(array('action' => 'login'));
}

function index(){
	if($this->Session->read('user')){
	   $this->set('user', $this->Session->read('user'));
	}
	else{
		$this->redirect(array('action' => 'login'));
	}
}
	
}


?>