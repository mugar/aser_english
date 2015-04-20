<?php 
/*
 * ConfComponent: DB based configuration
 * @author:Mugabo armand
 * @website:soon ...
 * @license: ??
 * @version: 0.1
 * */
class ConfComponent extends Object
{
    
    function startup(&$controller) {
		$this->Config=ClassRegistry::init('Config'); //create an instance of "Produit model" for future use.
    }
    
    
    function find($name) {
    	$this->Config=ClassRegistry::init('Config');
    	$details=array();
    	if($name=='all'){
    		$data=$this->Config->find('all',array('recursive'=>-1));
			if(!empty($data)){
				foreach($data as $row){
					$details['Config'][$row['Config']['key']]=$row['Config']['value'];
				}
			}
		}
		else {
			$data=$this->Config->find('first',array('conditions'=>array('Config.key'=>$name),
											'recursive'=>-1));
			if(!empty($data)){
				$details=$data['Config']['value'];
			}
		}
		return $details;
    }
	
    function save($data){
    	foreach($data['Config'] as $key=>$value){
			$config=array(); //initializing each time ...
    		$info=$this->Config->find('first',array('conditions'=>array('Config.key'=>$key),
											'recursive'=>-1));
			if(!empty($info)){
				$config=$info;
				$config['Config']['value']=$value;
				$this->Config->save($config);
			}
			else {
				$config['Config']['key']=$key;
				$config['Config']['value']=$value;
				$this->Config->save($config);
			}
			unset($this->Config->id);
		}
		return true;
    }
    
    
}
