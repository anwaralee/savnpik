<?php 

App::uses('Helper', 'View');
App::import('Model', 'City');  

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class CityDBHelper extends Helper {
    
    
    public function getCityName($id){
        $city = new City();  
         return $city->find('first', array(
                                'conditions' => array('City.id' => $id)));
    }
}

?>