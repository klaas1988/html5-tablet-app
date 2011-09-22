<?php
class Article extends AppModel {
	var $name = 'Article';
	var $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'author_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'U moet een auteur opgeven.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Vul een titel in voor het nieuwsbericht.',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'summary' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Geef een inleidende samenvatting van het nieuwsbericht.',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Het nieuwsbericht moet tekst bevatten.',
				'allowEmpty' => false,
				'required' => true,
			),
		),
	);

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
			'Edition' => array(
			'className' => 'Edition',
			'foreignKey' => 'edition_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
			'Author' => array(
			'className' => 'Author',
			'foreignKey' => 'author_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'Photo' => array(
			'className' => 'Photo',
			'joinTable' => 'articles_photos',
			'foreignKey' => 'article_id',
			'associationForeignKey' => 'photo_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Tag' => array(
			'className' => 'Tag',
			'joinTable' => 'articles_tags',
			'foreignKey' => 'article_id',
			'associationForeignKey' => 'tag_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Book' => array(
			'className' => 'Book',
			'joinTable' => 'articles_books',
			'foreignKey' => 'article_id',
			'associationForeignKey' => 'book_id',
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

	var $actsAs = array('containable');
	
	var $order = array('Article.created' => 'ASC', 'Article.modified' => 'ASC');
	
}
?>
