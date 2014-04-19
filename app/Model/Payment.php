<?php
App::uses('AppModel', 'Model');
/**
 * Deal Model
 *
 * @property DealCategory $DealCategory
 * @property Company $Company
 */
class Payment extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
    
    
    public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
            
            
		)
    );

}