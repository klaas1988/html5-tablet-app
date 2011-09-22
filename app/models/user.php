<?php
class User extends AppModel {
	var $name = 'User';
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => 'notempty',
				'message' => 'Je moet een naam opgeven',
				'allowEmpty' => false,
				'required' => true,
				'on' => 'create',
			)
		),
		'username' => array(
			'notempty' => array(
				'rule' => 'notempty',
				'message' => 'Je moet een gebruikersnaam opgeven',
				'allowEmpty' => false,
				'required' => true,
				'on' => 'create',
			)
		),
		'password' => array(
			'notempty' => array(
				'rule' => 'notempty',
				'message' => 'Je moet een wachtwoord opgeven',
				'allowEmpty' => false,
				'required' => true,
				'on' => 'create',
			)
		)
	);
	
	var $hasMany = array(
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'order' => 'Article.title ASC',
		)
	);
	
	var $order = 'User.username ASC';
}
?>
