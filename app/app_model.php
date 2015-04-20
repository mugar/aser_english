<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
 
  App::import('Lib','MugSanitize');
  App::import('Lib','MugSession');
  App::import('Lib', 'LazyModel');
class AppModel extends Model {
	var $actsAs= array('containable');
	var $who=true; // save the Id of the person who did any action
//	public $recursive = -1;
	
	
	function beforeDelete(){
		return true;
	}
	function sessionRead($name){
		$MugSession=new MugSession;
		$sessionData=$MugSession->read($name);
		return $sessionData;
	}
	
	
	
	function beforeSave(){
		$skip=array('CaisseInterdite','Facture','Journal','Salaire','Paie','Abscence');
		//saves who made the save operation on the entire app
		$personnelId=$this->sessionRead('Auth.Personnel.id');
		if($this->who&&!empty($personnelId)&&!in_array($this->alias,$skip)){
			if( !(($this->alias=='Trace')&&!empty($this->data[$this->alias]['personnel_id'])) ){ //ne pas enregistrer automatique lq personne si le model est trace et que le personnel est deja fournie
				$this->data[$this->alias]['personnel_id']=$personnelId;
			}
		}
		return true;
	}
	function afterFind($results, $primary=false) {
		/* resolving problem of aliases 
		 * for example when we make a sql query like 
		 * select 'sum(articles.price) as price from articles ...
		 */
		if($primary == true) {
			if(Set::check($results, '0.0')) {
				$fields = array_keys( $results[0][0] );
				foreach($results as $key=>$value) {
					foreach( $fields as $fieldName ) {
						$results[$key][$this->alias][$fieldName] = $value[0][$fieldName];
					}
					unset($results[$key][0]);
				}
			}
		}
		/*Protecting against XSS (cross site scripting)
		 * We strip tags from fetched datas with xss method
		 * inspired from Sanitize::clean() method
		 */
	//	$results=MugSanitize::xss($results);
		return $results;
	}
	
	/**
 	* Wrapper find to cache sql queries
 	* @param array $conditions
 	* @param array $fields
 	* @param string $order
 	* @param string $recursive
 	* @return array
 	*/
	//*
	public function find($conditions = null, $fields = array(), $order = null, $recursive = null) {
		if (Configure::read('Cache.disable') === false && Configure::read('Cache.check') === true && isset($fields['cache']) && $fields['cache'] !== false) {
			$key = $fields['cache'];
			$expires = '+1 hour';
			
			if (is_array($fields['cache'])) {
				$key = $fields['cache'][0];
				
				if (isset($fields['cache'][1])) {
					$expires = $fields['cache'][1];
				}
			}
		
			// Set cache settings
			Cache::config('sql_cache', array(
				'prefix' 	=> strtolower($this->name) .'-',
				'duration'	=> $expires
			));
			
			// Load from cache
			$results = Cache::read($key, 'sql_cache');
			
			if (!is_array($results)) {
				$results = parent::find($conditions, $fields, $order, $recursive);
				Cache::write($key, $results, 'sql_cache');
			}
			
			return $results;
		}	
	
		// Not cacheing
		return parent::find($conditions, $fields, $order, $recursive);
	}
	//*/
}
