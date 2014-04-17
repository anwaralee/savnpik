<?php
App::uses('AppModel', 'Model');
/**
 * Deal Model
 *
 * @property DealCategory $DealCategory
 * @property Company $Company
 */
class Deal extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please fill out the name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'deal_category_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please select a deal Category',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'company_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please select a company',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		/*'highlights' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please fill up the highlights',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'conditions' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please fill up the conditions',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		), */
		'threshold' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please fill up the threshold for deals',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'marked_price' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please fill up the marked price',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'discount' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please fill up the discount on marked price',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'selling_price' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			'message' => 'Please fill up the selling price',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'expiry_date' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Date can\'t be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		/*'image1' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please select a image',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		), */
		'status' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please select a status',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'DealCategory' => array(
			'className' => 'DealCategory',
			'foreignKey' => 'deal_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
            'counterCache' => true,
            'counterScope' => array(
              'Deal.status' => 1
            )
		),
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
            'counterCache' => true,
		)
	);
}
