<?php
/**
 * This class contains some functions related
 * to certain bizarre tasks 
 */
 class Tools {
 	/**
	 * database() function for all tasks related to tables 
	 * management
	 */
 	function database() {		
		$sql='show tables;';
		$tables=mysql_query($sql);
		$data=array();
		$i=0;
		while($table=mysql_fetch_array($tables)) {
			if(!in_array($table[0],array('acos','aros','aros_acos'))) {
				$data[$i]=$table[0];
				$sql='show fields from '.$table[0];
				$fields=mysql_query($sql) or die($table[0].' '.mysql_error());
				$j=0;
				$donnee=array();
				while($field=mysql_fetch_array($fields)) {
					$donnee[$j]=$field[0];
					$j++;
				}
				$data[$i]=array($data[$i]=>$donnee);
				$i++;
			}
		}
		return $data;
	}
	function alter($tables) {
		foreach($tables as $table) {
			foreach($table as $tableName=>$fields) {
				foreach($fields as $field) {
					if(in_array($field,array('personnel_id'))) {
						$sql='alter table '.$tableName.' change personnel_id personnel_id BIGINT( 20 ) NOT NULL ';
						mysql_query($sql) or die('Error :'.mysql_error());
						echo 'Executed '.$sql;
					}
				}
			}
		}
	}
	/*
	 function alter($tables) {
		foreach($tables as $table) {
			foreach($table as $tableName=>$fields) {
				foreach($fields as $field) {
					if(in_array($field,array('personnel_id','created','modified'))) {
						$sql='alter table '.$tableName.' drop '.$field;
						mysql_query($sql) or die('Error :'.mysql_error());
					}
				}
			}
		}
		foreach($tables as $table) {
			foreach($table as $tableName=>$fields) {
				$sql='alter table '.$tableName.' add personnel_id BIGINT NOT NULL';
				mysql_query($sql) or die('Error :'.mysql_error());
				
				$sql='alter table '.$tableName.' add created datetime NOT NULL';
				mysql_query($sql) or die('Error :'.mysql_error());
			
				$sql='alter table '.$tableName.' add modified datetime NOT NULL';
				mysql_query($sql) or die('Error :'.mysql_error());
			}
		}
	}
	*/
	function cool($year=null) {
		$this->autoRender=false;
		if(!$year) die('argument please !');
		$sortis=$this->Sorti->find('all',array('fields'=>array('*'),'recursive'=>-1));
		for($i=1; $i<=12;$i++) {
			$sorti['Sorti']['date']=''.$year.'-'.$i.'-01';
			$sorti['Sorti']['id']=$sortis[$i-1]['Sorti']['id'];
			$this->Sorti->save($sorti);
		}
		
		
		$sortis1=$this->Sorti->find('all',array('fields'=>array('*'),'recursive'=>-1,
	  'conditions'=>array('year(Sorti.date)'=>$year)));
		debug($sortis1);
	}
	
 }
?>
