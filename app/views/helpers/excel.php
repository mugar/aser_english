<?php 
App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php'));
App::import('Vendor','PHPExcelWriter',array('file' => 'excel/PHPExcel/Writer/Excel2007.php'));

class ExcelHelper extends AppHelper {
    function excelHelper() {
       	
    }
                 
    function generate($data, $headers) {
       	$workbook = new PHPExcel;
		$sheet =$workbook->getActiveSheet();
		foreach($headers as $j=>$header){
			$sheet->setCellValueByColumnAndRow($j, 1, $header);		
		}
	
		foreach($data as $i=>$row){
			$cols=array_keys($row);
			foreach($cols as $j=>$col){
				$sheet->setCellValueByColumnAndRow($j, $i+2, $row[$col]);		
			}	
		}	
		$writer = new PHPExcel_Writer_Excel2007($workbook);

 		header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 		header('Content-Disposition:inline;filename=Fichier.xlsx ');
 		$writer->save('php://output');
    }
    
}
?> 
