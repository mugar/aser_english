<?php
   /*
    * This file extends the time helper from cakephp core library
    * It contains some additional functions I've created 
    */
    App::import('View', 'Time', false);
   class MugTimeHelper extends TimeHelper {
   		//*
		function excel($data,$headers=array(),$name=''){
			App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php'));
			App::import('Vendor','PHPExcelWriter',array('file' => 'excel/PHPExcel/Writer/Excel2007.php'));
			$workbook = new PHPExcel;
			$sheet =	$workbook->getActiveSheet();
			$keys=array_keys($data);
			$headers=(empty($headers)&&!empty($keys))?array_keys($data[$keys[0]]):$headers;
			foreach($headers as $j=>$header){
				$sheet->setCellValueByColumnAndRow($j, 1, $header);		
			}
	
			foreach($data as $i=>$row){
				foreach($headers as $j=>$header){
					$sheet->setCellValueByColumnAndRow($j, $i+2, $row[$header]);		
				}
			}
			
			$writer = new PHPExcel_Writer_Excel2007($workbook);
			if($name==''){
				$filename='rapport_'.$name.'_du_'.date('d-m-Y_H:i:s').'.xlsx';
				$path=WWW_ROOT .'/files/rapport_'.$name.'_du_'.date('d-m-Y_H:i:s').'.xlsx';
				$writer->save($path);
				chmod($path, 0777);
				return $filename;
			}
			else {
				$filename='/var/www/rapport_'.$name.'_du_'.date('d-m-Y',strtotime('-1 day ')).'.xlsx';
				$writer->save($filename);
				chmod($filename, 0777);
				$this->redirect('/');
			}
		}
		//*/
		
		function toFrench($mysql_format) {
			if(!empty($mysql_format)){
		 		$mysql_format=explode('-',$mysql_format);
				$french_format=$mysql_format[2].'/'.$mysql_format[1].'/'.$mysql_format[0];
				return $french_format;
			 }
		}
		function increase_date($givendate,$day=1,$mth=0,$yr=0) {
     		$cd = strtotime($givendate);
     		$newdate = date('Y-m-d', mktime(date('h',$cd),date('i',$cd), date('s',$cd), date('m',$cd)+$mth,date('d',$cd)+$day, date('Y',$cd)+$yr));
      		return $newdate;
		}
		function giveMonth($number) {
			switch($number) {
				case 1:
					$month='January';
					break;
				case 2:
					$month='February';
					break;
				case 3:
					$month='March';
					break;
				case 4:
					$month='April';
					break;
				case 5:
					$month='May';
					break;
				case 6:
					$month='June';
					break;
				case 7:
					$month='July';
					break;
				case 8:
					$month='August';
					break;
				case 9:
					$month='September';
					break;
				case 10:
					$month='October';
					break;
				case 11:
					$month='November';
					break;
				case 12:
					$month='December';
					break;
				default:
					$month='Unkown';
					break;
			}
			return $month;
		}
		
		
		function diff($date1,$date2) {
			$first=explode('-',$date1);
			$second=explode('-',$date2);
			$epocOne = mktime(0,0,0,$first[1],$first[2],$first[0]);
			$epoctwo = mktime(0,0,0,$second[1],$second[2],$second[0]);
			$second = $epoctwo-$epocOne;
			return $days =floor($second/86400);
		}
   }
?>