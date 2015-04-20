<?php

App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php'));
        App::import('Vendor','PHPExcelWriter',array('file' => 'excel/PHPExcel/Writer/Excel2007.php'));
        $workbook = new PHPExcel;
        $sheet =    $workbook->getActiveSheet();

        $headers=array('Libellé','Quantité','PU','Montant');
        foreach($headers as $j=>$header){
            $sheet->setCellValueByColumnAndRow($j, 1, $header);     
        }

    
        /*
            foreach($data as $i=>$row){
                foreach($headers as $j=>$header){
                    $sheet->setCellValueByColumnAndRow($j, $i+2, $row[$header]);        
                }
            }
        //*/
            $writer = new PHPExcel_Writer_Excel2007($workbook);
            // $writer->save('php://output');
           // $filename='factures.xlsx';
           // $path=WWW_ROOT .'/files/facture.xlsx';
           // chmod($path, 0777);
            //return $filename;
