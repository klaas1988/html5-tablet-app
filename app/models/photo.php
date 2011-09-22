<?php
class Photo extends AppModel {
	var $name = 'Photo';
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Geef een bestandsnaam op.',
				'allowEmpty' => false,
				'required' => true,
			),
		),
	);

	var $hasAndBelongsToMany = array(
		'Article' => array(
			'className' => 'Article',
			'joinTable' => 'articles_photos',
			'foreignKey' => 'photo_id',
			'associationForeignKey' => 'article_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

	var $hasOne = array(
		'Edition' => array(
			'className' => 'Edition',
			'foreignKey' => 'photo_id',
			'dependent' => false,
			'conditions' => '',
			'order' => '',
		)
	);
	
	var $actsAs = array('containable');
	
	var $order = 'Photo.id DESC';
	
}
?>
