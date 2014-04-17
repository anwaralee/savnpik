<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 */
class PageCategory extends AppModel {
	public $uses = array('PageCategory','Page');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'cat_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cat_status' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	/**
	 * hasMany Association
	 *
	 *@var array
	 */
	public $hasMany=array('Page'=>array('className'=>'Page',
                                 'foreignKey'=>'page_category_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                )
                );
}
