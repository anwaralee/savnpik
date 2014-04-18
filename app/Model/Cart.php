<?php
App::uses('AppModel', 'Model');
/**
 * Deal Model
 *
 * @property DealCategory $DealCategory
 * @property Company $Company
 */
class Cart extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
    
    
    public $belongsTo = array(
		'Deal' => array(
			'className' => 'Deal',
			'foreignKey' => 'deals_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
            
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
            
            
		)
    );

}