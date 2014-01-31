<?php
class User extends AppModel{

	public $actsAs = array('Acl' => array('type' => 'requester'));
	
	public $validate = array(
	'username' => array(
	'rule' => 'notEmpty',
	'message' => 'This field cannot be left blank.'
	),
	'password' => array(
	'rule' => 'notEmpty',
	'message' => 'This field cannot be left blank.'
	),
	'email' => array(
	'rule' => 'email',
	'message' => 'Please supply a valid mail adress.'
	),
	
	'username' => array(
		'alphanum' => array(
			'rule' => 'alphaNumeric',
			'message' => 'Username can only be letters and numbers'
			),
			'fieldsize' => array(
			'rule' => array('between',6,40),
			'message' => 'Username mut be between 6 and 40 chars.'
			),
			'nodupes' => array(
			'rule' => 'isUnique',
			'message' => 'This user already exists.'
			)
	),
	'password' => array(
		'fieldsize' => array(
			'rule' => array('between', 6,40),
			'message' => 'Username mut be between 6 and 40 chars.'
		)
	),
	'email' => array(
		'validemail' => array(
			'rule' => 'email',
			'message' => 'Please supply a valid mail adress.'
		),
		'nodupes' => array(
			'rule' => 'isUnique',
			'message' => 'This email is already in use.'
		)
	)
);
	
}
?>