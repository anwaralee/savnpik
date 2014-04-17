<?php 
class City extends AppModel {
	
  public $uses = array('City','Company');
	
  public $validate = array(
        'name' => array(
            'rule' => 'notEmpty'
        ),
        'status' => array(
            'rule' => 'notEmpty'
        )
    );
	
	/**
	 * hasMany Association
	 *
	 *@var array
	 */
	public $hasMany=array('Company'=>array('className'=>'Company',
                                 'foreignKey'=>'city_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                )
                );
}
?>
