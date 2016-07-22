<?php
 /*
 * ProductComponent: Contains function for handling all product related operations
 * @author: Mugabo Armand
 * @website: soon...
 * @license: proprietary 
 * @version: 0.1
 * */
class ProductComponent extends Object {
	
	var $components = array('Conf','Session','RequestHandler','Auth');
	var $helpers = array('Session');
	
	function cellsToMergeByColsRow($start = -1, $end = -1, $row = -1){
		App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php'));
	    $merge = 'A1:A1';
	    if($start>=0 && $end>=0 && $row>=0){
	        $start = PHPExcel_Cell::stringFromColumnIndex($start);
	        $end = PHPExcel_Cell::stringFromColumnIndex($end);
	        $merge = "$start{$row}:$end{$row}";
	    }
    	return $merge;
	}
	function bill2xls($data){
		App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php'));
		App::import('Vendor','PHPExcelWriter',array('file' => 'excel/PHPExcel/Writer/Excel2007.php'));
		App::import('Vendor','PHPExcel_Worksheet_MemoryDrawing',array('file' => 'excel/PHPExcel/Worksheet/MemoryDrawing.php'));
		$workbook = new PHPExcel;
		$sheet =	$workbook->getActiveSheet();
		//putting the company details
		$company_info=$this->company_info();
		$gdImage = imagecreatefromjpeg(WWW_ROOT .'/img/'.$company_info['logo']);
		// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
		$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	//	$objDrawing->setName('Sample image');
	//	$objDrawing->setDescription('Sample image');
		$objDrawing->setImageResource($gdImage);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setWidthAndHeight($company_info['width'],$company_info['height']);
		$objDrawing->setResizeProportional(true);
		//$objDrawing->setHeight(150);
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorksheet($workbook->getActiveSheet());

		$row=7;
		
		if(!empty($company_info['tel'])) {$sheet->setCellValueByColumnAndRow(0, $row, 'Tél : '.$company_info['tel']); $row++; }	
		if(!empty($company_info['email'])) {$sheet->setCellValueByColumnAndRow(0, $row, 'Email : '.$company_info['email']);$row++; }		
		if(!empty($company_info['compte_RWF'])) {$sheet->setCellValueByColumnAndRow(0, $row, 'Compte Bancaire : '.$company_info['compte_RWF']);$row++; }
		if(!empty($company_info['compte_RWF'])) {$sheet->setCellValueByColumnAndRow(0, $row, 'NIF : '.$company_info['nif']);$row++; }	

		
		$parallelRow=1;
		//putting the facture date
		$sheet->setCellValueByColumnAndRow(3, $parallelRow, 'Date : '.$this->formatDate($data['Facture']['date']));

		//putting client details
		$parallelRow+=4;
		if(!empty($data['Tier']['name'])) {$sheet->setCellValueByColumnAndRow(3, $parallelRow, $data['Tier']['name']); $parallelRow++; }	
		if(!empty($data['Tier']['compagnie'])) {$sheet->setCellValueByColumnAndRow(3, $parallelRow, $data['Tier']['compagnie']); $parallelRow++; }
		if(!empty($data['Tier']['email'])) {$sheet->setCellValueByColumnAndRow(3, $parallelRow, 'Email : '.$data['Tier']['email']); $parallelRow++; }	
		if(!empty($data['Tier']['telephone'])) {$sheet->setCellValueByColumnAndRow(3, $parallelRow, 'Tél : '.$data['Tier']['telephone']); $parallelRow++; }	
		$row+=1;

		//putting the bill number
		$sheet->setCellValueByColumnAndRow(0, $row, 'Facture '.$data['nature'].' N° '.$data['Facture']['numero']);	
		$sheet->mergeCells($this->cellsToMergeByColsRow(0,3,$row));
		$style = array(
			'font' => array(
        		'bold' => true,
        		'size'=>16
    		),
        	'alignment' => array(
            	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        	)
    	);
    	$sheet->getStyle($this->cellsToMergeByColsRow(0,3,$row))->applyFromArray($style);
    	$sheet->getRowDimension($row)->setRowHeight(20);

    	$fontStyle=array('bold'=>true);
    	$borderStyle=array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN));
		//putting the table headers
		$row+=2;
		$headers=array('Libellé','Quantité','PU','Montant');
		foreach($headers as $j=>$header){
			$sheet->setCellValueByColumnAndRow($j, $row, $header);		
		}
		$sheet->getStyle($this->cellsToMergeByColsRow(0,3,$row))->applyFromArray(array('font'=>$fontStyle,'borders'=>$borderStyle));
		
		//adding the locationsextras to the excel bill
		$row++;
		if($data['model']=='Location'){
			foreach ($data['modelInfos'] as $location){
				if((!is_null($location['LocationExtra']['heure']))&&($location['LocationExtra']['extra']=='no')){
					$value=$location['LocationExtra']['name'];
					if(!empty($location['LocationExtra']['heure'])) $value.=' à '.$location['LocationExtra']['heure']; 
				}
				else {
					$value=$location['LocationExtra']['name'];
				}
				$sheet->setCellValueByColumnAndRow(0, $row, $value);
				$sheet->setCellValueByColumnAndRow(1, $row, $location['LocationExtra']['quantite']);
				$sheet->setCellValueByColumnAndRow(2, $row,$location['LocationExtra']['PU']);
				$sheet->setCellValueByColumnAndRow(3, $row,$location['LocationExtra']['montant']);
				$sheet->getStyle($this->cellsToMergeByColsRow(0,3,$row))->applyFromArray(array('borders'=>$borderStyle));
				$row++;
			}
			//adding eventual ventes in case of a global bill.
			foreach ($data['ventes'] as $vente){
				$sheet->setCellValueByColumnAndRow(0, $row, $vente['Produit']['name']); 
				$sheet->setCellValueByColumnAndRow(1, $row, $vente['Vente']['quantite']); 
				$sheet->setCellValueByColumnAndRow(2, $row, $vente['Vente']['PU']);
				$sheet->setCellValueByColumnAndRow(3, $row, $vente['Vente']['montant']);
				$sheet->getStyle($this->cellsToMergeByColsRow(0,3,$row))->applyFromArray(array('borders'=>$borderStyle));
				$row++;
			}
			//adding eventual ventes in case of a global bill.
			foreach ($data['services'] as $service){
				$sheet->setCellValueByColumnAndRow(0, $row, $service['Service']['description']); 
				$sheet->setCellValueByColumnAndRow(1, $row, 1); 
				$sheet->setCellValueByColumnAndRow(2, $row, $service['Service']['montant']);
				$sheet->setCellValueByColumnAndRow(3, $row, $service['Service']['montant']);
				$sheet->getStyle($this->cellsToMergeByColsRow(0,3,$row))->applyFromArray(array('borders'=>$borderStyle));
				$row++;
			}
		}
		else if($data['model']=='Vente'){
				//adding eventual ventes in case of a global bill.
			foreach ($data['modelInfos'] as $vente){
				$sheet->setCellValueByColumnAndRow(0, $row, $vente['Produit']['name']); 
				$sheet->setCellValueByColumnAndRow(1, $row, $vente['Vente']['quantite']); 
				$sheet->setCellValueByColumnAndRow(2, $row, $vente['Vente']['PU']);
				$sheet->setCellValueByColumnAndRow(3, $row, $vente['Vente']['montant']);
				$sheet->getStyle($this->cellsToMergeByColsRow(0,3,$row))->applyFromArray(array('borders'=>$borderStyle));
				$row++;
			}
		}
		else if($data['model']=='Reservation'){
				//adding eventual ventes in case of a global bill.
			foreach ($data['modelInfos'] as $reservation){
				$sheet->setCellValueByColumnAndRow(0, $row, 'Chambre N° '.$reservation['Chambre']['name']); 
				$sheet->setCellValueByColumnAndRow(1, $row, ($this->diff($reservation['Reservation']['checked_in'],$reservation['Reservation']['depart'])+1).' nuitée(s)'); 
				$sheet->setCellValueByColumnAndRow(2, $row, $reservation['Reservation']['PU']);
				$sheet->setCellValueByColumnAndRow(3, $row, $reservation['Reservation']['montant']);
				$sheet->getStyle($this->cellsToMergeByColsRow(0,3,$row))->applyFromArray(array('borders'=>$borderStyle));
				$row++;
			}
		
		}

		if($data['Facture']['tva']!=0) {
			$sheet->setCellValueByColumnAndRow(0, $row, 'HTVA');
			$sheet->setCellValueByColumnAndRow(3, $row, $data['Facture']['montant']-$data['Facture']['tva']);
			$sheet->getStyle($this->cellsToMergeByColsRow(0,3,$row))->applyFromArray(array('font'=>$fontStyle,'borders'=>$borderStyle));
			$row++;
			
			$sheet->setCellValueByColumnAndRow(0, $row, 'TVA');
			$sheet->setCellValueByColumnAndRow(3, $row, $data['Facture']['tva']);
			$sheet->getStyle($this->cellsToMergeByColsRow(0,3,$row))->applyFromArray(array('font'=>$fontStyle,'borders'=>$borderStyle));
			$row++;
		}
		$sheet->setCellValueByColumnAndRow(0, $row, 'TOTAL');
		$sheet->setCellValueByColumnAndRow(3, $row, $data['Facture']['montant'].' '.$data['Facture']['monnaie']);
			$sheet->getStyle($this->cellsToMergeByColsRow(0,3,$row))->applyFromArray(array('font'=>$fontStyle,'borders'=>$borderStyle));

		//showing some extras if any
			if(!empty($data['extras'])){
				//putting the extras title
				$row+=2;
				$sheet->setCellValueByColumnAndRow(0, $row, 'EXTRAS');	
				$sheet->mergeCells($this->cellsToMergeByColsRow(0,3,$row));
				$style = array(
					'font' => array(
		        		'bold' => true,
		        		'size'=>16
		    		),
		        	'alignment' => array(
		            	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        	)
		    );
		    $sheet->getStyle($this->cellsToMergeByColsRow(0,3,$row))->applyFromArray($style);
		    $sheet->getRowDimension($row)->setRowHeight(20);

		    //display the list of extras
		    $row+=2;
		    $headers=array('Date','Numéro','Montant','Monnaie');
				foreach($headers as $j=>$header){
					$sheet->setCellValueByColumnAndRow($j, $row, $header);		
				}
				$sheet->getStyle($this->cellsToMergeByColsRow(0,3,$row))->applyFromArray(array('font'=>$fontStyle,'borders'=>$borderStyle));
				//listing the extras
				$row++;
				foreach ($data['extras'] as $extra_facture){
					$sheet->setCellValueByColumnAndRow(0, $row, $this->toFrench($extra_facture['Facture']['date'])); 
					$sheet->setCellValueByColumnAndRow(1, $row, $extra_facture['Facture']['numero']); 
					$sheet->setCellValueByColumnAndRow(2, $row, $extra_facture['Facture']['reste']);
					$sheet->setCellValueByColumnAndRow(3, $row, $extra_facture['Facture']['monnaie']);
					$sheet->getStyle($this->cellsToMergeByColsRow(0,3,$row))->applyFromArray(array('borders'=>$borderStyle));
					$row++;
				}
			}
		//signature
		$row+=4;
		foreach(explode(',',$data['signature']) as $line){
			$sheet->setCellValueByColumnAndRow(3, $row, $line);
			$row++;
		}
		
		$styleArray = array(
		    'font' => array(
		        'size' => 12,
		    ),
		);
		$sheet->getDefaultStyle()->applyFromArray($styleArray);
		$sheet->getColumnDimension('A')->setWidth(20);
		$sheet->getColumnDimension('B')->setAutoSize(15);
		$sheet->getColumnDimension('C')->setWidth(15);
		$sheet->getColumnDimension('D')->setWidth(20);
    	$sheet->getStyle('D1:D256')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    	$sheet->getDefaultRowDimension()->setRowHeight(18);
		$writer = new PHPExcel_Writer_Excel2007($workbook);
		$filename='facture_'.$data['Facture']['date'].'_'.$data['Facture']['numero'].'_'.$data['Facture']['operation'].'.xlsx';
		$path=WWW_ROOT .'/files/'.$filename;
		$writer->save($path);
		chmod($path, 0777);
		return $filename;
	}

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
				$filename='rapport_'.$name.'_du_'.date('d-m-Y_H:i:s').'.xlsx';
				$path=WWW_ROOT .'/files/rapport_'.$name.'_du_'.date('d-m-Y_H:i:s').'.xlsx';
				$writer->save($path);
				chmod($path, 0777);
				return $filename;
		}
	/**
	 * this function returns the caisses to which the current user 
	 * has access to 
	 */
	function caisses_permises(){
		$personnelId=$this->Auth->user('id');
		$cond = array();
		$cond['CaisseInterdite.personnel_id']=$personnelId;
		if(($personnelId!=11)&&(Configure::read('aser.caisse_interdite'))){
			$this->CaisseInterdite=ClassRegistry::init('CaisseInterdite');
			$caisses_permises = $this->CaisseInterdite->find('list',array('fields'=>array('CaisseInterdite.caiss_id','CaisseInterdite.caiss_id'),
																	'conditions'=>$cond
																	)); 
		}
		else {
			$this->Caiss=ClassRegistry::init('Caiss');
			$caisses_permises = $this->Caiss->find('list',array('fields'=>array('Caiss.id','Caiss.id'),
																		)); 
		}
		return $caisses_permises;
	}
	/**
	 * handling caisses operations add
	 */
	 
	 function add_caisse_op($data,$linkToJournal=true) {
	 	$this->data=$data;
	 	$this->Operation=ClassRegistry::init('Operation'); 
			$this->Operation->create();
			

			if(($this->data['Operation']['model1']==$this->data['Operation']['model2'])
				&&
				($this->data['Operation']['element1']==$this->data['Operation']['element2'])
			)
			{
				exit('failure_Erreur! La source égale la destination.');
			}
			if(($this->model($this->data['Operation']['model1'])==$this->model($this->data['Operation']['model2']))
				&&
				($this->model($this->data['Operation']['model1'])=='Type')
			)
			{
				exit('failure_Erreur! Opération incorrecte.');
			}
			//exit(debug($this->data));
			if($this->data['Operation']['model1']=='caisses'){

				if(($this->Operation->soldeCaisse($this->data['Operation']['element1'])-$this->data['Operation']['montant'])<0){
					exit('failure_Erreur! La caisse source n\'a pas assez d\'argent!');
				}
			}
			//adding ...
				$userInfo=$this->Auth->user();
				$caissier=$this->Conf->find('caissiers');
				//journal stuff
				if($linkToJournal&&($userInfo['Personnel']['fonction_id']==$caissier)){
					$journal=$this->journal();
					$this->data['Operation']['journal_id']=$journal['id'];
					$this->data['Operation']['date']=$journal['date'];
				}
				else {
					$this->data['Operation']['journal_id']=null;
				}
			//op_num
			$this->data['Operation']['op_num']=$this->caisse_op_num('Operation');
			
			if(false && $this->data['Operation']['mode']=='report'){
				//for search
				$this->data['Operation']['common']=$this->data['Operation']['element1']
													.'_'.$this->model($this->data['Operation']['model1']);
													
				$this->data['Operation']['element_id']=$this->data['Operation']['element1'];
				
				$this->data['Operation'][$this->model($this->data['Operation']['model1'],'where')]=$this->data['Operation']['montant'];
			
				$this->data['Operation']['model']=$this->model($this->data['Operation']['model1']); //model to use
				$this->data['Operation']['libelle']='Report';
				$this->Operation->save($this->data);
				$ids[]=$this->Operation->id;
				
			}
			else {
					//for search 
				$this->data['Operation']['common']=$this->data['Operation']['element1']
													.'_'.$this->model($this->data['Operation']['model1'])
													.'_'.$this->data['Operation']['element2']
													.'_'.$this->model($this->data['Operation']['model2']);
				//ignore stuff
				//*
				if(($this->model($this->data['Operation']['model1'])=='Type')&&(in_array($this->data['Operation']['element1'],Configure::read('ventes')))){
					$this->data['Operation']['ignore']=1;
				}
				//*/
													
				//operation creditage
				$this->data['Operation']['element_id']=$this->data['Operation']['element1'];
				$this->data['Operation']['credit']=$this->data['Operation']['montant'];
				$this->data['Operation']['debit']=null;
				$this->data['Operation']['model']=$this->model($this->data['Operation']['model1']); //model to use
				
				//*/
				$this->data['Operation']['id']=$this->data['Operation']['id1'];
													
				$this->Operation->save($this->data);
				//	exit(debug($this->data));
				$ids[]=$this->Operation->id;
				unset($this->Operation->id);
			
				//operation debitage
				$this->data['Operation']['element_id']=$this->data['Operation']['element2'];
				$this->data['Operation']['debit']=$this->data['Operation']['montant'];
				$this->data['Operation']['credit']=null;
			
				$this->data['Operation']['model']=$this->model($this->data['Operation']['model2']); //model to use
				
				$this->data['Operation']['id']=$this->data['Operation']['id2'];
				
				$this->Operation->save($this->data);
				$ids[]=$this->Operation->id;
			}

			
			return $ids;
	}
	/**
	 * model for caisse operation
	 */
	 function model($choix,$return='model'){
		$choix=strtolower($choix);
		switch($choix){
			case 'clients':
				$model='Tier';
				$type='debit';
				break;
			case 'fournisseurs':
				$model='Tier';
				$type='credit';
				break;
			case 'depenses':	
				$model='Type';
				$type='debit';
				break;
			case 'ventes':	
				$model='Type';
				$type='credit';
				break;
			case 'caisses':	
				$model='Caiss';
				$type='debit';
				break;
		}
		if($return=='model'){
			return $model;
		}
		else {
			return $type;
		}
	}
	/**
	 * caisse op num 
	 */
	
	function caisse_op_num(){
		$last=$this->Operation->find('first',array('order'=>array('Operation.op_num desc'),
													'recursive'=>-1,
													'fields'=>array('Operation.op_num')
													)
										);
		if(empty($last)){
			return 1;
		}
		else {
			return $last['Operation']['op_num']+1;
		}
	}
	
	function toFrench($mysql_format) {
			if(!empty($mysql_format)){
		 		$mysql_format=explode('-',$mysql_format);
				$french_format=$mysql_format[2].'/'.$mysql_format[1].'/'.$mysql_format[0];
				return $french_format;
			 }
		}
	
	function startup(&$controller, $settings=array()) {
		
		$this->Produit=ClassRegistry::init('Produit'); //create an instance of "Produit model" for future use.
		$this->Relation=ClassRegistry::init('Relation'); 
		$this->Controller=& $controller;
		$this->Caiss=ClassRegistry::init('Caiss');
		$this->Facture=ClassRegistry::init('Facture');
	} 
	
	function company_info(){
		$company['logo']=Configure::read('logo.name');
		$company['width']=Configure::read('logo.width');
		$company['height']=Configure::read('logo.height');
		$company['address1']=$this->Conf->find('address1');	
		$company['address2']=$this->Conf->find('address2');	
		$company['tel']=$this->Conf->find('tel');	
		$company['compte_RWF']=$this->Conf->find('compte_RWF');		
		$company['compte_USD']=$this->Conf->find('compte_USD');	
		$company['compte_EUR']=$this->Conf->find('compte_EUR');
		$company['nif']=$this->Conf->find('nif');	
		$company['email']=$this->Conf->find('email');	
		$company['bp']=$this->Conf->find('bp');	
		$config=Configure::read('aser');
		$enable_info=$config['company_info'];
		$this->Controller->set(compact('company','enable_info'));	
		return $company;	
	}
	
	
	
	/**
	 *  This function returns the conversion number between two units of measure
	 * for a given product
	 * 
	 * @params $first="unit" $second="unit"
	 * @return "the conversion number or ratio"
	*/
	
	function conversion($first,$second){ //unit of measure
	//first case recursive relation
		if($first==$second){
			return 1;
		}
		else {
			$conversion=$this->Conversion->find('first',array('fields'=>array('Conversion.*',
																	),
															'conditions'=>array('OR'=>array(array('Conversion.premier_unite_id'=>$first,
																									'Conversion.deuxieme_unite_id'=>$second
																							),
																							array('Conversion.deuxieme_unite_id'=>$first,
																									'Conversion.premier_unite_id'=>$second
																									)
																							)
																				)
																)
												);
			if(empty($conversion)){
				return 1; //if not defined
			}
			elseif($conversion['Conversion']['premier_unite_id']==$first){ // we have "--->"
				return $conversion['Conversion']['conversion'];
			}
			else {
				return 1/$conversion['Conversion']['conversion']; //we have "<---" donc on inverse !
			}
		}
	}
	/** old function for managing restaurant consumptions 
	 * 
	function resto_nicer(&$ventes,$action=null){
		$k=0;
		$v=0;
		$Cons['elements']=array(); //retourne les consommations soit produits,plats, ingredients
		$Cons['total']=0;
		foreach($ventes as $vente) {
			if(!empty($vente['Vente']['boissons'])){
				$rows=explode(',',$vente['Vente']['boissons']);
				$j=0;
				foreach($rows as $row) {
					$boissons[$j]=explode(':',$row);
					$boissons[$j][1]=explode('=>',$boissons[$j][1]);
					$j++;
				}
				$i=0;
				foreach($boissons as $boisson){
					$produit=$this->Produit->find('first',array('fields'=>array('Produit.id','Produit.name'),
														'conditions'=>array('Produit.id'=>$boisson[0])
														)
											);
					$boissons[$i][0]=$produit['Produit']['name'];
					if($action=='boissons'){
						$Cons['elements'][$v]['tier']=$vente['Tier']['name'];
						$Cons['elements'][$v]['produit']=$produit['Produit']['name'];
						$Cons['elements'][$v]['quantite']=$boisson[1][0];
						$Cons['elements'][$v]['montant']=$boisson[1][1];
						$Cons['total']+=$boisson[1][1];
					}
					$i++;
					$v++;
				}
			
				foreach($boissons as $row){
					$info='(quantite='.$row[1][0].',total='.$row[1][1].')';
					$row[0]='<strong>'.inflector::Camelize($row[0]).'</strong>';
					$row[1]=$info;
					$lines[]=implode(': ',$row);
				}
				$ventes[$k]['Vente']['boissons']=implode(', ',$lines);
			}
			//pour les plats
			if(!empty($vente['Vente']['plats'])){
				$lines=$cells=array();
				$rows=explode(',',$vente['Vente']['plats']);
				$j=0;
				foreach($rows as $row) {
					$plats[$j]=explode(':',$row);
					$plats[$j]['Plat']=explode('-',$plats[$j][0]);
					unset($plats[$j][1]);
					$j++;
				}
				$i=0;
				$c=0;
				foreach($plats as $plat){
					$platInfo=$this->Plat->find('first',array('fields'=>array('Plat.id','Plat.name'),
														'conditions'=>array('Plat.id'=>$plat['Plat'][0])
													)
										);
					$plats[$i]['Plat'][0]=$platInfo['Plat']['name'];
					if($action=='plats'){
						$Cons['elements'][$k]['tier']=$vente['Tier']['name'];
						$Cons['elements'][$k]['plat']=$platInfo['Plat']['name'];
						$Cons['elements'][$k]['quantite']=$plat['Plat'][1];
						$Cons['elements'][$k]['montant']=$plat['Plat'][2];
						$Cons['total']+=$plat['Plat'][2];
					}
					if($action=='ingredients'){
						$ingredients = $this->Plat->Ingredient->find('all',array('fields'=>array('Unite.name','Ingredient.*','Produit.name'),
																				'conditions'=>array('Ingredient.plat_id'=>$plat['Plat'][0])
																				)
																	);
						foreach($ingredients as $ingredient){
							$Cons['elements'][$c]['tier']=$vente['Tier']['name'];
							$Cons['elements'][$c]['ingredient']=$ingredient['Produit']['name'];
							$Cons['elements'][$c]['quantite']=$ingredient['Ingredient']['quantite']*$plat['Plat'][1];
							$Cons['elements'][$c]['montant']=$ingredient['Ingredient']['montant']*$plat['Plat'][1];
							$Cons['elements'][$c]['unite']=$ingredient['Unite']['name'];
							$Cons['total']+=$Cons['elements'][$c]['montant'];
							$c++;
						}
					}
					$i++;
				}
			
				foreach($plats as $row){
					$info='(quantite='.$row['Plat'][1].',total='.$row['Plat'][2].')';
					$row['Plat'][0]='<strong>'.inflector::Camelize($row['Plat'][0]).'</strong>';
					$lines[]=implode(': ',array($row['Plat'][0],$info));
				}
				$ventes[$k]['Vente']['plats']=implode(', ',$lines);
			}
			$k++;
			//unset variables for renitialisation for the next iteration
			$lines=$cells=$plats=$boissons=array();
		}
		if(!is_null($action)) return $Cons;
	}
	 */
	 
	/**
	 * function for parsing special text
	 */
	function parser($data,$mode='explode'){
	//handling expiration dates for some quantities of the current product
		if(!empty($data)){
			if($mode=='explode'){
				$data=str_replace(' ','',$data);
				$rows=explode(';',$data);
				foreach($rows as $row) {
					$cells[]=explode(':',$row);
				}
				return $cells;
			}
			else {
				foreach($data as $row){
					$lines[]=implode(':',$row);
				}
				$text=implode('; ',$lines);
				return $text;
			}
		}
		else return false;
	}
	/**
	 * gèrer les produits de type composer
	 * c-à-d composer par d'autres produits de type stockable
	 * 
	 * @param recoit en parametre un array contenant les infos nécessaire.
	 * @return void
	 */
	 function composer_par($params){
	 	$relations=$this->Relation->find('all',array('fields'=>array('Relation.*',
																	),
													'conditions'=>array('Relation.premier_produit_id'=>$params['id'],
																		)
													)
										);
		$this->Historique=ClassRegistry::init('Historique');
		foreach($relations as $composant){
			$qty=$params['quantite']*$composant['Relation']['quantite'];
			$where=($params['action']=='increase')?'debit':'credit';
			$this->Historique->save(array('Historique'=>array('produit_id'=>$composant['Relation']['deuxieme_produit_id'],
															'stock_id'=>$params['stock_id'],
															$where=>$quanAdd,
															'libelle'=>$params['model'],
															'date'=>$params['date']
															),
												));
		}
	}

	/**
	 * this function identifies the available quantity of a bundle product type paquet_I
	 * based on its components.
	 * 
	 * @params $itemId
	 * @return void it just update the product's quantity field
	 */
	function bundle_updater($composantId){
		$bundleInfo=$this->Relation->find('first',array('fields'=>array(
																	'PremierProduit.id',
																	'PremierProduit.quantite',
																	'PremierProduit.PV',
																	'PremierProduit.marge',
																	'PremierProduit.relations'
																	),
														'conditions'=>array('Relation.deuxieme_produit_id'=>$composantId,
																			'Relation.relation'=>'composer_par'
																			)
														)
										);
		$relations=explode(',',$bundleInfo['PremierProduit']['relations']);
		$components=$this->Relation->find('all',array('fields'=>array('Relation.*',
																	'DeuxiemeProduit.id',
																	'DeuxiemeProduit.quantite',
																	'DeuxiemeProduit.unite_id',
																	'DeuxiemeProduit.PAMP',
																	),
														'conditions'=>array('Relation.premier_produit_id'=>$bundleInfo['PremierProduit']['id'],
																			'Relation.relation'=>'composer_par'
																			)
														)
										);
		$pamp=$pvmp=$bundleQuantity=0;
		if((in_array('paquet_I',$relations))||(in_array('paquet_II',$relations))){
			foreach($components as $key=>$component){
				$conversion=$this->Conversion($component['Relation']['unite_id'],$component['DeuxiemeProduit']['unite_id']);
				$pamp+=$component['DeuxiemeProduit']['PAMP']*$component['Relation']['quantite']*$conversion;
			}
			$pvmp=round($pamp+($pamp*$bundleInfo['PremierProduit']['marge']/100),0);
			$this->Produit->save(array('Produit'=>array('id'=>$bundleInfo['PremierProduit']['id'],'PAMP'=>$pamp,'PVMP'=>$pvmp)));
		}
		
		if(in_array('paquet_I',$relations)){
			$available=true; //means that we have enough items to make a bundle the item
			$bundleQuantity=0;
			while($available){
				foreach($components as $key=>$component){
					$conversion=$this->Conversion($component['Relation']['unite_id'],$component['DeuxiemeProduit']['unite_id']);
					$components[$key]['DeuxiemeProduit']['quantite']-=$component['Relation']['quantite']*$conversion;
					if($components[$key]['DeuxiemeProduit']['quantite']<0){
						$available=false;
						break;
					}				
				}
				if($available){
					$bundleQuantity++;
				}
			}
			$update['Produit']['id']=$bundleInfo['PremierProduit']['id'];
			$update['Produit']['quantite']=$bundleQuantity;
			$update['Produit']['total']=$bundleQuantity*$pamp;
			$this->Produit->save($update);
		}
		return array('id'=>$bundleInfo['PremierProduit']['id'],
					'PAMP'=>$pamp,
					'PVMP'=>$pvmp,
					'quantite'=>$bundleQuantity,
					'total'=>($bundleQuantity*$pamp)
					);
	}
	
	/**
	 * This function treats the exchange relation
	 * for now I have never seen an item in an exchange 
	 * relation with more than one item
	 * so I will stick to one-to-one exchange relation.
	 * That's why I use find('first').
	 * 
	 * @param id,action(increase,decrease),quantite all in the params array()
	 * @return boolean
	 */
	 function echanger_contre($params){
	 	$composant=$this->Relation->find('first',array('fields'=>array('Relation.*',
																	'DeuxiemeProduit.*',
																	),
													'conditions'=>array('Relation.premier_produit_id'=>$params['id'],
																		'Relation.relation'=>'echanger_contre'
																		)
													)
										);
		if($params['action']=='decrease'){
			$conversion=$this->Conversion($composant['Relation']['unite_id'],$composant['DeuxiemeProduit']['unite_id']);
			$update['Produit']['quantite']=$composant['DeuxiemeProduit']['quantite']
											+($params['quantite']
											*$composant['Relation']['quantite']
											*$conversion
											);
			$update['Produit']['total']=$update['Produit']['quantite']*$composant['DeuxiemeProduit']['PV'];
			$update['Produit']['id']=$composant['DeuxiemeProduit']['id'];
			$this->Produit->save($update);
				
			//if this product is a bundle
			$relations=explode(',',$composant['DeuxiemeProduit']['relations']);
			if(in_array('paquet_I',$relations)){
				$params['id']=$composant['DeuxiemeProduit']['id'];
				$params['action']='increase';
				$this->composer_par($params);
			}								
		}
		else {
			$conversion=$this->Conversion($composant['Relation']['unite_id'],$composant['DeuxiemeProduit']['unite_id']);
			$quantite=$composant['DeuxiemeProduit']['quantite']
					-($params['quantite']
					*$composant['Relation']['quantite']
					*$conversion
					);
			if(($quantite<0)&&($params['page']!='edit')){
				if($this->RequestHandler->isAjax()){
						die(json_encode(array('success'=>false,'msg'=>'Quantite non disponible')));
					}
					else {
						$this->Session->setFlash('la quantité n\'est pas disponible <br> pour le produit '.$composant['DeuxiemeProduit']['name'].' !');
						$this->Controller->redirect(array('action' =>$params['page']));
					}
			}
			$update['Produit']['quantite']=$quantite;
			$update['Produit']['total']=$update['Produit']['quantite']*$composant['DeuxiemeProduit']['PV'];
			$update['Produit']['id']=$composant['DeuxiemeProduit']['id'];
			$this->Produit->save($update);
				
			//if this product is a bundle
			$relations=explode(',',$composant['DeuxiemeProduit']['relations']);
			if(in_array('paquet_I',$relations)){
				$params['id']=$composant['DeuxiemeProduit']['id'];
				$params['action']='decrease';
				$this->composer_par($params);
			}
		}
	 	
	 }
	/**
	 * This function create an item and its related items
	 * in a given stock
	 * 
	 * @params an array containing the necessary infos
	 * @return void 
	 */
	
	function relation($params){
		//finding which relations is the product is involved into
		$relations=$this->Relation->find('all',array('fields'=>array('Relation.*',
																	'PremierProduit.*',
																	'DeuxiemeProduit.*',
																	),
													'conditions'=>array('OR'=>array('Relation.premier_produit_id'=>$params['id'],
																					'Relation.deuxieme_produit_id'=>$params['id']
																					),
																		'Relation.stock_id'=>$params['produit_stock_id']
																		)
													)
										);
		//wherever $params['copy'] is defined it means that we want to copy all the items bonds in another stock
		
			$produit=$this->Produit->find('first',array('fields'=>array('Produit.*'),
															'recursive'=>0,
															'conditions'=>array('Produit.id'=>$params['id'])
															)
												);
			$produitSimilaire=$this->Produit->find('first',array('recursive'=>0,
																'conditions'=>array(
																	'Produit.name'=>$produit['Produit']['name'],
																	'Produit.stock_id'=>$params['stock_id']
																				)
															)
												);
			if(empty($produitSimilaire)) {
					$produit['Produit']['stock_id']=$params['stock_id'];
					$produit['Produit']['quantite']=0;
					$produit['Produit']['total']=0;
					$produit['Produit']['id']=null;
					$produit['Produit']['code']=null;
					$this->Produit->save($produit);
					$ids['principal_id']=$this->Produit->id;
			}
			else {
					$ids['principal_id']=$produitSimilaire['Produit']['id'];
			}
		
		foreach($relations as $relation){
			if($relation['Relation']['relation']=='composer_par'){
			//for a bundled item
				if($relation['Relation']['premier_produit_id']==$params['id']){
						$produit['Produit']=$relation['DeuxiemeProduit'];
						$produitSimilaire=$this->Produit->find('first',array('recursive'=>0,
																'conditions'=>array(
																'Produit.name'=>$produit['Produit']['name'],
																'Produit.stock_id'=>$params['stock_id']
																				)
															)
												);
						if(empty($produitSimilaire)) {
							$produit['Produit']['stock_id']=$params['stock_id'];
							$produit['Produit']['quantite']=0;
							$produit['Produit']['total']=0;
							$produit['Produit']['id']=null;
							$produit['Produit']['code']=null;
							$this->Produit->save($produit);
							$ids['partenaire_id']=$this->Produit->id;
						}
						else {
							$ids['partenaire_id']=$produitSimilaire['Produit']['id'];
						}
						//creation de la relation
						$test_relation=$this->Relation->find('first',array('fields'=>array('Relation.*'),
																			'conditions'=>array('Relation.stock_id'=>$params['stock_id'],
																								'Relation.premier_produit_id'=>$ids['principal_id'],
																								'Relation.deuxieme_produit_id'=>$ids['partenaire_id'],
																								'Relation.relation'=>$relation['Relation']['relation'],
																								'Relation.quantite'=>$relation['Relation']['quantite'],
																								'Relation.unite_id'=>$relation['Relation']['unite_id']
																								),
																			'recursive'=>-1
																			)
															);
						if(empty($test_relation)){																		
							$newRelation['Relation']['id']=null;
							$newRelation['Relation']['stock_id']=$params['stock_id'];
							$newRelation['Relation']['premier_produit_id']=$ids['principal_id'];
							$newRelation['Relation']['relation']=$relation['Relation']['relation'];
							$newRelation['Relation']['deuxieme_produit_id']=$ids['partenaire_id'];
							$newRelation['Relation']['quantite']=$relation['Relation']['quantite'];
							$newRelation['Relation']['unite_id']=$relation['Relation']['unite_id'];
							$this->Relation->save($newRelation);
						}
				}
				//for an item belonging to one or many bundles
				else {
						$produit['Produit']=$relation['PremierProduit'];
						$produitSimilaire=$this->Produit->find('first',array('recursive'=>0,
																'conditions'=>array(
																'Produit.name'=>$produit['Produit']['name'],
																'Produit.stock_id'=>$params['stock_id']
																				)
															)
												);
						if(empty($produitSimilaire)) {
							$produit['Produit']['stock_id']=$params['stock_id'];
							$produit['Produit']['quantite']=0;
							$produit['Produit']['total']=0;
							$produit['Produit']['id']=null;
							$produit['Produit']['code']=null;
							$this->Produit->save($produit);
							$ids['partenaire_id']=$this->Produit->id;
						}
						else {
							$ids['partenaire_id']=$produitSimilaire['Produit']['id'];
						}
						//creation de la relation
						$test_relation=$this->Relation->find('first',array('fields'=>array('Relation.*'),
																			'conditions'=>array('Relation.stock_id'=>$params['stock_id'],
																								'Relation.premier_produit_id'=>$ids['partenaire_id'],
																								'Relation.deuxieme_produit_id'=>$ids['principal_id'],
																								'Relation.relation'=>$relation['Relation']['relation'],
																								'Relation.quantite'=>$relation['Relation']['quantite']
																								),
																			'recursive'=>-1
																			)
															);
						if(empty($test_relation)){					
							$newRelation['Relation']['id']=null;
							$newRelation['Relation']['stock_id']=$params['stock_id'];
							$newRelation['Relation']['premier_produit_id']=$ids['partenaire_id'];
							$newRelation['Relation']['relation']=$relation['Relation']['relation'];
							$newRelation['Relation']['deuxieme_produit_id']=$ids['principal_id'];
							$newRelation['Relation']['quantite']=$relation['Relation']['quantite'];
							$this->Relation->save($newRelation);
						}
				}
			}
			// for an exchange relation
			else {
				if($params['echange']){
						$params['id']=($relation['Relation']['premier_produit_id']==$params['id'])?
										($relation['Relation']['deuxieme_produit_id']):
										($relation['Relation']['premier_produit_id']);
						$params['echange']=false; //sinon ca tourne en rond et ça ne finirait jamais
						$this->relation($params);	
				}
			}
		}
	}
	
  	function finder($name,$stockId) {
		if (!empty($name)) {
			//determination de l'id du produit
			if(preg_match('#\w#',$name)){ //alpha numeric means it's a name
				$conditions['Produit.name']=$name;
			}
			else {
				$conditions['Produit.code']=$name; // numeric only means it's a code bar
			}
			$conditions['Produit.stock_id']=$stockId;
			$conditions['Produit.actif']='yes';
				
   			$produitId=$this->Produit->find('first', array('conditions' =>$conditions,
 	   														'fields' => array('Produit.id'),
 	   														'recursive'=>-1
 	   										));
 	   		if(!empty($produitId['Produit']['id'])) return $produitId['Produit']['id'];
 	   	}
 	}
	
	
	
	/**
	 *stock management function
	 */
    function stock(&$modelInfo,$where,$produitInfo=array(),$silent=false) {
    	$historiqueIds = [];
    	$historiqueIds1 = [];
    	$historiqueIds2 = [];
    	//setting useful variable
    	$failureMsg1='Erreur dans l\'enregistrement de l\'historique du stock!';

    	//retrieving the model from the array
    	$keys=array_keys($modelInfo);
		$model=$keys[0];
		$modelInfo[$model]['shift']=(isset($modelInfo[$model]['shift']))?$modelInfo[$model]['shift']:1;
		//loading the needed Models
    	$this->Model=ClassRegistry::init($model);
		$this->Historique=ClassRegistry::init('Historique');
		
		//getting product info
		if(empty($produitInfo)){
			$produitInfo=$this->Model->Produit->find('first',array('fields'=>array('Produit.type'),
																	'conditions'=>array('id'=>$modelInfo[$model]['produit_id']),
																	'recursive'=>-1
																	));	
		}
		if($produitInfo['Produit']['type']=='storable'){		
			//determining the historique id to use if it not credit
			$ignoreIds=array();
			$historiqueId=null;
			if($where!='credit'){
				if($model!='Mouvement'){
					$historiqueId=(empty($modelInfo[$model]['historique_id']))?null:$modelInfo[$model]['historique_id'];
					if($historiqueId!=null)
						$ignoreIds[]=$historiqueId;
				}
				else {
					if($where=='credit'){
						$historiqueId=(empty($modelInfo[$model]['historique1']))?null:$modelInfo[$model]['historique1'];
					}
					else { 
						$historiqueId=(empty($modelInfo[$model]['historique2']))?null:$modelInfo[$model]['historique2'];
					}
				
					if(!empty($modelInfo[$model]['historique1']))
						$ignoreIds[]=$modelInfo[$model]['historique1'];
					
					if(!empty($modelInfo[$model]['historique2']))
						$ignoreIds[]=$modelInfo[$model]['historique2'];
				}
			}
			else if(!empty($modelInfo[$model]['historique_id'])){
				//update that same historique with the id stored in $modelInfo[$model]['historique_id']
				$historiqueId=$modelInfo[$model]['historique_id'];
				$ignoreIds[]=$historiqueId; // when updating the same historique don't count while evaluating the remain stock.
			
				//for now not sure it is a good idea to delete the stock record if is supplied. instead update it.
				/*if(!$this->productHistoryDelete($modelInfo[$model]['historique_id'],'Historique')){
					$return['success']=false;
					$return['msg']='Erreur dans l\'effacement de l\'historique du stock!';
					return $return;
				}*/
			}
			
			//getting the stock id
			$stockId=($model!='Mouvement')?$modelInfo[$model]['stock_id']:$modelInfo[$model]['stock_sortant_id'];
	
			//getting the date to use
			$date=($model!='Vente')?$modelInfo[$model]['date']:$modelInfo['Facture']['date'];
			
			//getting the date of expiration if it set
			$date_expiration=(!empty($modelInfo[$model]['date_expiration']))
							?$modelInfo[$model]['date_expiration']:null;
	    
			//determining where to put null :
			$null=($where=='debit')?'credit':'debit';
		
	   		$historyData=array('produit_id'=>$modelInfo[$model]['produit_id'],
							'stock_id'=>$stockId,
							$where=>$modelInfo[$model]['quantite'],
							$null=>null,
							'date'=>$date,
							'libelle'=>$model,
							'shift'=>$modelInfo[$model]['shift'],
							'date_expiration'=>$date_expiration,
							'id'=>$historiqueId
							);
				
	    	//checking if there is enough quantity		
			if($where=='credit'){
				
				$qtys=$this->productQty($modelInfo[$model]['produit_id'],$stockId,$ignoreIds,$date,'array');
				if(($qtys['qty']-$modelInfo[$model]['quantite'])>=0){
					
					$qtyToRmv=$modelInfo[$model]['quantite'];
					
					//removing quantity according to the expiration date FIFO
					foreach($qtys['array'] as $historique){
						if($historique['qty']>=$qtyToRmv){
							$historyData['credit']=$qtyToRmv;
							$qtyToRmv=0;
						}
						else {
							$historyData['credit']=$historique['qty'];
							$qtyToRmv=$qtyToRmv-$historique['qty'];
						}
						//saving the credit of any model including the credit part of Mouvement
						$historyData['debit']=null;
						$historyData['stock_id']=$stockId;
					
						$historyData['date_expiration']=$historique['Historique']['date_expiration'];
						
						$this->Historique->save(array('Historique'=>$historyData));
					
						$historiqueIds[]=$this->Historique->id;
						//saving the debit card of mouvement
						if($model=='Mouvement'){
							$historyData['debit']=$historyData['credit'];
							$historyData['credit']=null;
							$historyData['stock_id']=$modelInfo[$model]['stock_entrant_id'];
							if(!$this->Historique->save(array('Historique'=>$historyData))){
								return array('success'=>false,'msg'=>$failureMsg1);
							}
							else {
								$historiqueIds2[]=$this->Historique->id;
							}
						}		
						if($qtyToRmv<=0)
							break;
					}
				}
				elseif($silent){
					//force saving the decrease even if there is no qty
					$historyData['credit']=$modelInfo[$model]['quantite'];
					$historyData['debit']=null;
					$historyData['stock_id']=$stockId;
					$historyData['date_expiration']=null;
					
					if(!$this->Historique->save(array('Historique'=>$historyData))){
						return array('success'=>false,'msg'=>$failureMsg1);
					}
					else {
						$historiqueIds[]=$this->Historique->id;	
					}
				}
				else {
					//return a failing status
					$return['success']=false;
					$return['msg']='Quantité non disponible!';
					return $return;
				} 
			}
			else {
				if(!$this->Historique->save(array('Historique'=>$historyData)))
					return array('success'=>false,'msg'=>$failureMsg1);
				else 	
					$historiqueIds[]=$this->Historique->id;
			}
			//determining in which field to save the reference
			if($model!='Mouvement'){
			//	exit(debug($historiqueIds));
				$modelInfo[$model]['historique_id']=implode(',', $historiqueIds);
			}
			else {
					$modelInfo[$model]['historique1']=implode(',', $historiqueIds);
					$modelInfo[$model]['historique2']=implode(',', $historiqueIds2);
			}
			
		}
		return array('success'=>true);
    }
	
	function productHistoryDelete($id,$model='Historique'){
		$this->Historique=ClassRegistry::init('Historique');
		if($model!='Historique'){
			$this->Model=ClassRegistry::init($model);
			$search=$this->Model->find('first',array('fields'=>array($model.'.historique_id'),
													'conditions'=>array($model.'.id'=>$id),
													'recursive'=>-1
													));
			$historyId=$search[$model]['historique_id'];
		}
		else {
			$historyId=$id;
		}
		
		foreach(explode(',',$historyId) as $id_to_delete){
			$this->Historique->delete($id_to_delete);
		}
		return true;
	}
	/**
	 *  this function handles the operation of increase a 
	 * product quantity by taking care of the different 
	 * purchase prices
	 */
	function add($params){
		$total=0;
		$this->ProduitDetail=ClassRegistry::init('ProduitDetail');
		$this->Detail=ClassRegistry::init('Detail');
	//	exit(debug($params));
		if(!isset($params['details'])){
			$id=$params['id'];
			$details[0]['Detail']['quantite']=$params['quantite'];
			$details[0]['Detail']['PA']=$params['pu'];
			$details[0]['Detail']['date']=$params['date'];
			$details[0]['Detail']['batch']=$params['batch'];
		}
		else {
			$details=$params['details'];
		}
		foreach($details as $detail){
			$detail['Detail']['batch']=($detail['Detail']['batch']=='')?null:$detail['Detail']['batch'];
			$search=$this->ProduitDetail->find('first',array('conditions'=>array('ProduitDetail.produit_id'=>$params['id'],
																				'ProduitDetail.PA'=>$detail['Detail']['PA'],
																				'ProduitDetail.date'=>$detail['Detail']['date'],
																				'ProduitDetail.batch'=>$detail['Detail']['batch']
																				),
															'recursive'=>-1
															)
												);
			
			if(!empty($search)){
				$search['ProduitDetail']['quantite']+=$detail['Detail']['quantite'];
			}
			else {
				$search['ProduitDetail']['produit_id']=$params['id'];
				$search['ProduitDetail']['quantite']=$detail['Detail']['quantite'];
				$search['ProduitDetail']['PA']=$detail['Detail']['PA'];
				$search['ProduitDetail']['date']=$detail['Detail']['date'];
				$search['ProduitDetail']['batch']=$detail['Detail']['batch'];
			}
			$total+=$detail['Detail']['quantite']*$detail['Detail']['PA'];
			$this->ProduitDetail->save($search);
			unset($this->ProduitDetail->id);
		}
		//updating
		
		$info=$this->pamp($params['id'],$params['marge']);
	
		return array('total'=>$total,'pamp'=>$info);
	}
	
	function pamp($id,$marge=0,$update=false){
		$this->ProduitDetail=ClassRegistry::init('ProduitDetail');
		if($marge==0){
			$produit=$this->ProduitDetail->Produit->find('first',array('conditions'=>array('Produit.id'=>$id),
																	'fields'=>array('Produit.marge'),
														'recursive'=>-1
														)
											);
			$marge=$produit['Produit']['marge'];
		}
		$details=$this->ProduitDetail->find('all',array('conditions'=>array('ProduitDetail.produit_id'=>$id,
																			),
														'recursive'=>-1
														)
											);
		
		if(!empty($details)){
			$cas=0; // cout d'achat de stock
			$sumQuantity=0;
			foreach($details as $detail){
				$cas+=$detail['ProduitDetail']['quantite']*$detail['ProduitDetail']['PA'];
				$sumQuantity+=$detail['ProduitDetail']['quantite'];
			}
			
			$pamp=($sumQuantity!=0)?(round($cas/$sumQuantity,0)):0; // prix d'achat moyen ponderé
		}
		else {
			$pamp=$cas=$sumQuantity=0;
		}
		$pvmp=round(($pamp*($marge/100))+$pamp,0);
		//new stuff here
	//	$sumQuantity=$this->product_solde($id);
	//	$cas=$pamp*$sumQuantity;
		
		$config=Configure::read('aser');
		$info=array('id'=>$id,
					'PAMP'=>$pamp,
					'PVMP'=>$pvmp,
					);
		if($config['pv']){
			$info['PV']=$pvmp;
		}
		if($update) {
			$info['total']=$cas;
			$info['quantite']=$sumQuantity;
		}
		$this->ProduitDetail->Produit->save($info);
		unset($this->ProduitDetail->Produit->id);
		return $info;
		
	}

	

    
	/**
	 * function dedicated to remove stuff from the stock either by 
	 * fifo style or according to specific instructions
	 * it returns the history and or the cout d'achat total du stock 
	 * removed
	 */
	function remove($params,$fifo,$erreur=true){
		$total=0; //cout d'achat total du stock sortie 
		$this->ProduitDetail=ClassRegistry::init('ProduitDetail');
		if(!$fifo){
			if(!isset($params['details'])){
				$details[0]['Detail']['quantite']=$params['quantite'];
				$details[0]['Detail']['PA']=$params['pu'];
				$details[0]['Detail']['date']=$params['date'];
				$details[0]['Detail']['batch']=$params['batch'];
			}
			else {
				$details=$params['details'];
			}
			//first loop for checking 
			foreach($details as $detail){
				$search=$this->ProduitDetail->find('first',array('conditions'=>array('ProduitDetail.produit_id'=>$params['id'],
																				'ProduitDetail.PA'=>$detail['Detail']['PA'],
																				'ProduitDetail.date'=>$detail['Detail']['date'],
																				'ProduitDetail.batch'=>$detail['Detail']['batch']
																				),
																'recursive'=>-1
															));
				
			//	if($erreur&&(empty($search))||($search['ProduitDetail']['quantite']<$detail['Detail']['quantite'])){
				if(false){
					if($this->RequestHandler->isAjax()){
						exit(json_encode(array('success'=>false,'msg'=>'Quantite spécifié non disponible !')));
					}
					else {
						$this->Session->setFlash('Cette approvisionemnt ne peut pas être éffacé ! car ça déjà été consommé.');	
						$this->Controller->redirect(array('controller'=>Inflector::tableize($params['model']),'action'=>'index'));
					}
				}
			}
			
			foreach($details as $detail){
				$search=$this->ProduitDetail->find('first',array('conditions'=>array('ProduitDetail.produit_id'=>$params['id'],
																				'ProduitDetail.PA'=>$detail['Detail']['PA'],
																				'ProduitDetail.date'=>$detail['Detail']['date'],
																				'ProduitDetail.batch'=>$detail['Detail']['batch']
																				
																				),
																'recursive'=>-1
															));
				$search['ProduitDetail']['quantite']-=$detail['Detail']['quantite'];
				if($search['ProduitDetail']['quantite']==0){
					$this->ProduitDetail->delete($search['ProduitDetail']['id']);
				}
				else {
					$this->ProduitDetail->save($search);
				}
				$total+=$detail['Detail']['quantite']*$detail['Detail']['PA'];
			}
		}
		else {
			$this->Detail=ClassRegistry::init('Detail');
			$details=$this->ProduitDetail->find('all',array('conditions'=>array('ProduitDetail.produit_id'=>$params['id']),
															'recursive'=>-1,
															'order'=>'ProduitDetail.date asc'
														));	
			
			foreach($details as $detail){
				if($detail['ProduitDetail']['quantite']<$params['quantite']){
					$params['quantite']-=$detail['ProduitDetail']['quantite'];
					//deleting the record for it is no longer needed
					$this->ProduitDetail->delete($detail['ProduitDetail']['id']);
					//recording in a database table called detail
					if(in_array($params['model'],array('Sorti','Dotation','Vente','Mouvement','PretOperation'))
					&&
					($params['id']==$params['model_produit_id'])
					){
						$detailRow['Detail']['model']=$params['model'];
						$detailRow['Detail']['model_id']=$params['model_id'];
						$detailRow['Detail']['produit_id']=$params['id'];
						$detailRow['Detail']['quantite']=$detail['ProduitDetail']['quantite'];
						$detailRow['Detail']['PA']=$detail['ProduitDetail']['PA'];
						$detailRow['Detail']['date']=$detail['ProduitDetail']['date'];
						$detailRow['Detail']['batch']=$detail['ProduitDetail']['batch'];
						$this->Detail->save($detailRow);
						unset($this->Detail->id);
					}
					
					$total+=$detail['ProduitDetail']['quantite']*$detail['ProduitDetail']['PA'];
				}
				else {
					$detail['ProduitDetail']['quantite']-=$params['quantite'];
					
					if($detail['ProduitDetail']['quantite']!=0){
						//saving the remaing quantity
						$this->ProduitDetail->save($detail);
					}
					else {
						//deleting the record for it is no longer needed
						$this->ProduitDetail->delete($detail['ProduitDetail']['id']);
					}
					//recording in a database table called detail
					if(in_array($params['model'],array('Sorti','Dotation','Vente','Mouvement','PretOperation'))
					&&
					($params['id']==$params['model_produit_id'])
					){
						$detailRow['Detail']['model']=$params['model'];
						$detailRow['Detail']['model_id']=$params['model_id'];
						$detailRow['Detail']['produit_id']=$params['id'];
						$detailRow['Detail']['quantite']=$params['quantite'];
						$detailRow['Detail']['PA']=$detail['ProduitDetail']['PA'];
						$detailRow['Detail']['date']=$detail['ProduitDetail']['date'];
						$detailRow['Detail']['batch']=$detail['ProduitDetail']['batch'];
						$this->Detail->save($detailRow);
						unset($this->Detail->id);
					}		
					$total+=$params['quantite']*$detail['ProduitDetail']['PA'];
					break;
				}
			}
		}
		//updating prix achat pondéré, quantite totale et le cout d'achat du stock
		$info=$this->pamp($params['id'],$params['marge']);
		return array('total'=>$total,'pamp'=>$info);
	}
	
	//OLD DECREASE 
	/*
	function decrease(&$modelInfo,$produitInfo,$model,$action='add') {
    	$relations=explode(',',$produitInfo['Produit']['relations']);
	if(!in_array('figuratif',$relations)){
    	if(empty($modelInfo[$model]['unite_id'])){
    		$conversion=1;
	 	}
		else {
    		$conversion=$this->conversion($modelInfo[$model]['unite_id'],$produitInfo['Produit']['unite_id']);
		}
    	$quantityRemoved=$modelInfo[$model]['quantite']*$conversion;
		$update['Produit']['quantite']=$produitInfo['Produit']['quantite']-$quantityRemoved;
		$relations=explode(',',$produitInfo['Produit']['relations']);
								
		if(($update['Produit']['quantite']<0)&&($action!='edit')&&(!in_array('paquet_II',$relations))) {
			if($this->RequestHandler->isAjax()){
				die(json_encode(array('success'=>false,'message'=>'Quantite non disponible')));
			}
			else {
				$this->Session->setFlash('la quantité n\'est pas disponible <br> pour le produit '.$produitInfo['Produit']['name'].' !');
				$this->Controller->redirect(array('action' =>$action));
			}
		}
		
		//composer par relations
		if(in_array('paquet_I',$relations)||in_array('paquet_II',$relations)){
			$params['id']=$produitInfo['Produit']['id'];
			$params['quantite']=$quantityRemoved;
			$params['action']='decrease';
			$params['page']=$action;
			$this->composer_par($params);
		}
	
		//echanger contre relations
		$echange=(!empty($modelInfo[$model]['echange'])&&($modelInfo[$model]['echange']=='yes'))?(true):(false);
    	if(in_array('echange',$relations)&&$echange){
			$params['id']=$produitInfo['Produit']['id'];
			$params['quantite']=$quantityRemoved;
			$params['action']='decrease';
			$params['page']=$action;
			$this->echanger_contre($params);
		}
		
			//expiration details management
		$cells=$this->parser($produitInfo['Produit']['expiration_details']);
		if(!empty($modelInfo[$model]['expiration_details'])){
			$expiration_details=$this->parser($modelInfo[$model]['expiration_details']);
			foreach($expiration_details as $expiration_detail){
				if($cells!=false){
					$found=false;
					$i=0;
					foreach($cells as $cell) {
						if($cell[0]==$expiration_detail[0]){
							$found=true;
							$cells[$i][1]-=$expiration_detail[1];
							break;
						}
						$i++;
					}
					if((!$found)||($cells==false)){
						$update['Produit']['expiration_details']=$produitInfo['Produit']['expiration_details']
																.'; '.$expiration_detail[0]
																.':'.-1*$expiration_detail[1];
					}
				}
			}
		}
		elseif($cells!=false) {
			sort($cells); //In this case we remove things in FIFO style
			$expiration_details=array();
			$i=0;
			foreach($cells as $cell) {
				if($cell[1]<$quantityRemoved){
					$cells[$i][1]=0;
					$quantityRemoved=$quantityRemoved-$cell[1];
					$expiration_details[$i]=$cell;
				}
				else {
					$cells[$i][1]=$cell[1]-$quantityRemoved;
					$expiration_details[$i][0]=$cell[0];
					$expiration_details[$i][1]=$quantityRemoved;
					break;
				}
				$i++;
			}
			$modelInfo[$model]['expiration_details']=$this->parser($expiration_details,'implode');
		}
		$update['Produit']['expiration_details']=$this->parser($cells,'implode');
		
		//update quantite & leur valeur total en f(x) du PV
		if(!in_array('paquet_II',$relations)){
			$update['Produit']['total']=$update['Produit']['quantite']*$produitInfo['Produit']['PV'];
			$update['Produit']['id']=$produitInfo['Produit']['id'];
			$this->Produit->save($update);
		}
		
		//Quand on traite un produit de type composant_I cad composant d'un paquet_I
		if(in_array('composant_I',$relations)){
			$produitId=$produitInfo['Produit']['id'];
			$this->bundle_updater($produitId);
		}
	}
	}
	//*/
	
	function creator(&$data,$PU='PV',$model=''){
		//fetching produit stuff
		$key=($model=='')?array_keys($data):array(0=>$model);
		$this->Model=ClassRegistry::init($key[0]);
		$produitInfo=$this->Model->Produit->find('first',array('fields'=>array('*'),'conditions'=>array('id'=>$data[$key[0]]['produit_id']),'recursive'=>-1));
		
		//determination du montant 
		$data[$key[0]]['PV']=(empty($data[$key[0]]['PV']))?($produitInfo['Produit']['PV']):($data[$key[0]]['PV']);
		$data[$key[0]]['montant']=$data[$key[0]]['PV']*$data[$key[0]]['quantite'];
		$this->Model->save($data);
		
		//needed by later logic
		$data[$key[0]]['id']=$this->Model->id;
		$data['Produit']=$produitInfo['Produit'];
	}

	
	
	function type($model){
		$parts=explode(' ',$model);
		if(isset($parts[1])){
			return $parts[1];
		}
		switch($model){
			case 'Entree':
				return 'recu';
				break;
			case 'Sorti':
				return 'rendu';
				break;
			case 'Location':
				return 'rendu';
				break;
			case 'Proforma':
				return 'rendu';
				break;
			case 'Dotation':
				return 'rendu';
				break;
			case 'Perte':
				return 'rendu';
				break;
			case 'Reservation':
				return 'rendu';
				break;
			case 'Vente':
				return 'rendu';
				break;
			case 'EntretienChambre':
				return 'recu';
				break;
			default:
				return 'unknown';
				break;
		}
	}

	function remove_facture($factureId,$model,$obs=''){
		$this->autoRender=false;
		$this->Model=ClassRegistry::init($model);
		$this->Model->Facture->save(array('Facture'=>array('id'=>$factureId,'etat'=>'canceled','classee'=>1,'observation'=>$obs)));
		
		if($model=='Proforma'){
			$proformas=$this->Model->find('all',array('fields'=>array('Proforma.id'),
											'conditions'=>array('Proforma.facture_id'=>$factureId),
											'recursive'=>-1,
											)
								);
			foreach($proformas as $proforma){
				$proforma['Proforma']['facture_id']=null;
				$this->Model->save($proforma);
			}
		}
		 
			
		if(in_array($model,array('Reservation','Location'))){
			$records=$this->Model->find('all',array('fields'=>array($model.'.id'),
											'conditions'=>array($model.'.facture_id'=>$factureId),
											'recursive'=>-1,
											)
								);
			foreach($records as $record){
				$record[$model]['etat']='canceled';
				$this->Model->save($record);
			}
		}
		if(($model=='Vente')&&Configure::read('aser.connexion')){
			$ventes=$this->Model->find('all',array('fields'=>array('Vente.historique_id'),
													'conditions'=>array('Vente.facture_id'=>$factureId)
													)
												);
			//product stuff
			foreach($ventes as $vente){
				$this->productHistoryDelete($vente['Vente']['historique_id'],'Historique');
			}
		}

		//trace stuff
		$trace['Trace']['model_id']=$factureId;
		$trace['Trace']['model']='Facture';
		$trace['Trace']['operation']='Annulation de la Facture. Motif : "'.$obs.'".';
		$trace['Trace']['id']=null;
		$this->Model->Facture->Trace->save($trace);
		exit(json_encode(array('success'=>true,'msg'=>'Facture annulée')));
	}
	

	function journal($id=null,$searchDate=null){
		$id=(is_null($id))?$this->Auth->user('id'):$id;
		
		$date_ask=$this->Conf->find('date_ask');
	    $date_given=$this->Conf->find('date_given');
		
		if($searchDate){
			$cond['Journal.date']=$searchDate;
			$date=$searchDate;
		}
		else {
			$searchDate=date('Y-m-d');
			$date=($date_ask=='automatique')?($searchDate):($date_given);
		}
		$cond['Journal.personnel_id']=$id;
		$cond['Journal.closed']=0;
		
		$this->Journal=ClassRegistry::init('Journal');
		$journal=$this->Journal->find('first',array('conditions'=>$cond,
													'fields'=>array('Journal.*','Personnel.fonction_id'),
													'order'=>array('Journal.date desc','Journal.numero desc')
													)
											);
		$go=true;
		if(!empty($journal)){
			if(((Configure::read('aser.cloturer')&&($date_ask=='automatique'))||($journal['Personnel']['fonction_id']==4))&&($journal['Journal']['date']!=date('Y-m-d'))){
				$this->Journal->save(
						array('Journal'=>
							array('id'=>$journal['Journal']['id'],
								'closed'=>1
								)
							));
				
				$go=true;
			}
			else{
				$journalId=$journal['Journal']['id'];
				$date=$journal['Journal']['date'];
				$go=false;
			}
		}
		
		if($go){
			$prev_journal=$this->Journal->find('first',array('conditions'=>array('Journal.closed'=>1,
																				'Journal.personnel_id'=>$id,
																				'Journal.date'=>$date,
																				),
																	'fields'=>array('Journal.*'),
																	'order'=>array('Journal.date desc','Journal.numero desc')
																	
															)
												);
			$numero=(empty($prev_journal))?(1):($prev_journal['Journal']['numero']+1);
			$this->Journal->save(array('Journal'=>array('date'=>$date,'numero'=>$numero,'personnel_id'=>$id,'id'=>null)));
			$journalId=$this->Journal->id;
		}
		return array('date'=>$date,'id'=>$journalId,'personnel_id'=>$id);
	}

	function facture_number($id,$model,$date='',$db='default'){
		$no=$id;
		if(Configure::read('aser.facturation_cyclique')){
			$this->Facture=ClassRegistry::init('Facture');
			$cond['Facture.operation']=$model;
			$cond['Facture.id !=']=$id;
			if($date!=''){
				$date_parts=explode('-',$date);
				$year=$date_parts[0];
			}
			else {
				$year=date('Y');
			}
			$cond['year(Facture.date)']=$year;
			//setting the database
			$this->Facture->setDataSource($db);

			$last=$this->Facture->find('first',array('order'=>array('Facture.numero desc'),
													'recursive'=>-1,
													'fields'=>array('Facture.numero'),
													'conditions'=>$cond
												));
			if(empty($last)){
				$no=1;
			}
			else {
				$no=$last['Facture']['numero']+1;
			}
		}
		$update['Facture']['numero']=$no;
		$update['Facture']['id']=$id;
		$this->Facture->save($update);
		unset($this->Facture->id);
		
		return $no;
	}
	
	function diff($date1,$date2) {
			$first=explode('-',$date1);
			$second=explode('-',$date2);
			$epocOne = mktime(0,0,0,$first[1],$first[2],$first[0]);
			$epoctwo = mktime(0,0,0,$second[1],$second[2],$second[0]);
			$second = $epoctwo-$epocOne;
			return $days =floor($second/86400);
	}
	
	function update_facture($id,$montant,$old_state,$monnaie=null,$tva=true,$date=null,$montantOfToday=null){
		$this->Facture=ClassRegistry::init('Facture');
		//get the total of the pyts
		$pytCond['Paiement.facture_id']=$id;
		$date=($date==null)?date('Y-m-d'):$date;
		if($date!=null){
			$pytCond['Paiement.date <=']=$date;
		}
		$pyts=$this->Facture->Paiement->find('all',array('conditions'=>$pytCond,
														'fields'=>array('Paiement.montant','Paiement.date')
														)
										);
		$pytTotal=0;
		$pytOfToday=0;
		foreach($pyts as $pyt){
				if($pyt['Paiement']['date']==$date){
					$pytOfToday+=$pyt['Paiement']['montant'];
				}
				$pytTotal+=$pyt['Paiement']['montant'];
		}
		
		//facture details
		$facture['Facture']['id']=$id;
		$facture['Facture']['montant']=$montant;
		//pour determiner l'etat de la facture en fonction de tous les paiements jusqu'a ce jour
		$facture['Facture']['reste']=$facture['Facture']['montant']-$pytTotal;
		if($facture['Facture']['reste']==0){
			$facture['Facture']['etat']='paid';	
		}
		else if($facture['Facture']['reste']==$facture['Facture']['montant']){
			$facture['Facture']['etat']='credit';
		}
		else if(($facture['Facture']['reste']>0)&&($facture['Facture']['reste']<$facture['Facture']['montant'])){
			$facture['Facture']['etat']='half_paid';
		}
		else if($facture['Facture']['reste']<0){
			$facture['Facture']['etat']='excedent';
			if($old_state=='return_state')
				$facture['Facture']['reste']=0;
		}
		else if($facture['Facture']['reste']>$facture['Facture']['montant']){
			$facture['Facture']['etat']='credit';
			$facture['Facture']['reste']=$facture['Facture']['montant'];
		}
		//pour determiner le consumed & le deposit en fonction des paiements du jour seulement
		if($old_state=='return_state'){
			$facture['Facture']['deposit']=$facture['Facture']['consumed']=0;
			$montantConso=$facture['Facture']['montant']-$montantOfToday;
			$reste1=$pytOfToday-$montantOfToday;
			if($reste1>0){
				$reste2=$reste1-$montantConso;
				$facture['Facture']['consumed']=($reste2>0)?$montantConso:$reste1;
				if($reste2>0){
					$facture['Facture']['deposit']=$reste2;
					$facture['Facture']['reste']=0;
				}
			}
		}
		
		if($old_state=='return_state'){
			return $facture['Facture'];
		}
		else { 
			//update the monnaie dans le cas du changement du PU coté reservation
			if(!is_null($monnaie)){
				$facture['Facture']['monnaie']=$monnaie;
			}
			//tva stuff
			if($tva){
				$facture['Facture']['tva']=$this->tva($facture['Facture']['montant']);		
			}
			$this->Facture->save($facture);
		
			//trace stuff
		
			if($old_state!=$facture['Facture']['etat']){
				$trace['Trace']['model_id']=$id;
				$trace['Trace']['model']='Facture';
				$trace['Trace']['operation']='Changement de l\'etat de "'.$old_state.'" à "'.$facture['Facture']['etat'].'"';
				$trace['Trace']['id']=null;
				$this->Facture->Trace->save($trace);
			}
			return $facture['Facture'];
		}
	}

	function create_facture($data){
		$model=$data['Document']['model'];
		$this->Model=ClassRegistry::init($model);
		$montantTotal=$montantDette=$montantCaisse=0;
		$failedMsg = 'Product facture create: Failed To create the Bill';
		//facture date equals paiement date;
		$data['Paiement']['date']=$data['Facture']['date'];
		
		foreach($data['Id'] as $value){
			if($value!=0) {
				$modelInfo=$this->Model->find('first',array('fields'=>array($model.'.*'),
															'conditions'=>array($model.'.id'=>$value),
															'recursive'=>-1
															)
														);
				if(empty($modelInfo)){
					exit(json_encode(array('success'=>false,'msg'=>'Aucun élément sélectionné!')));
				}
				//calcul du montant total
				$montantTotal+=$modelInfo[$model]['montant'];
				$modelInfos[]=$modelInfo;
			}
		}
		$data['Facture']['tier_id']=$modelInfo[$model]['tier_id'];
		if($model!='Proforma'){
			$montantPayee=(!empty($data['Paiement']['montant']))?($data['Paiement']['montant']):(0);
			//payment  stuff
			if($data['Facture']['etat']=='paid'){
				$montantCaisse=$montantTotal;
			}
			elseif($data['Facture']['etat']=='half_paid'){
				$montantCaisse=$montantPayee;
			}
			else {
				$montantCaisse=0;
			}
			
			//pyt needs the facture id 
			if($this->Model->Facture->save($data)){
				$factureId=$this->Model->Facture->id;
				//dette stuff
				if(!is_null($modelInfo[$model]['tier_id'])){
					//caisse stuff & pyt stuff
					if($montantCaisse>0){
						//caisse stuff
						$data['Paiement']['montant']=$montantCaisse;
						$data['Paiement']['facture_id']=$factureId;
						$this->Model->Facture->Paiement->save($data);
					}
				}	
			}
			else {
				exit(json_encode(array('success'=>false,'msg'=>$failedMsg)));
			}
		}
		else {
			//the facture id 
			if($this->Model->Facture->save($data['Facture'])){
				$factureId=$this->Model->Facture->id;
			}
			else {
					exit(json_encode(array('success'=>false,'msg'=>$failedMsg)));
			}
			
			$montantCaisse=$montantTotal;
			$data['Facture']['etat']='proforma';
			$echeance=null;
		}
		
		$data['Facture']['tva']=$this->tva($montantTotal);
		//update facture	
		$data['Facture']['tier_id']=$modelInfo[$model]['tier_id'];
		$data['Facture']['montant']=$montantTotal;
		$data['Facture']['reste']=$montantTotal-$montantCaisse;
		$data['Facture']['monnaie']=$modelInfo[$model]['monnaie'];
		$data['Facture']['operation']=$model;
		$this->facture_number($factureId,$model,$data['Facture']['date']);
		$data['Facture']['id']=$factureId;

		if(!$this->Model->Facture->save($data)) exit(json_encode(array('success'=>false,'msg'=>$failedMsg)));
		
		//updating the model info 
		foreach($modelInfos as $modelInfo){
			$update[$model]['id']=$modelInfo[$model]['id'];
			$update[$model]['facture_id']=$factureId;
			$this->Model->save($update);
		}
		
		//trace stuff
		$trace['Trace']['model_id']=$factureId;
		$trace['Trace']['model']='Facture';
		$trace['Trace']['operation']='Création de la Facture avec l\'etat "'.$data['Facture']['etat'].'".';
		$trace['Trace']['id']=null;
		$this->Model->Facture->Trace->save($trace);
		
		//update the reservation bill
		if($model=='Reservation'){
			$factures[0]['Reservation']['facture_id']=$factureId;
			$factures[0]['Facture']['etat']=$data['Facture']['etat'];
			$this->factureMontantRes($factures);
		}
		
		exit(json_encode(array('success'=>true,
							'msg'=>'Facture enregistré !',
							'client_id'=>$modelInfo[$model]['tier_id'],
							'facture_id'=>$factureId,
							)
						)
			);
	}

	function create_commande($data){
		$model=$data['Document']['model'];
		$this->Model=ClassRegistry::init($model);
		$type=$this->type($model);
		$this->Model->Commande->save($data['Commande']);
					$commandeId=$this->Model->Commande->id;
					//because numero is not set we fill it with the id for easy display
					if(empty($data['Commande']['numero'])){
						$update['Commande']['numero']=$commandeId;
						$update['Commande']['id']=$commandeId;
						$this->Model->Commande->save($update);
					}
					foreach($data['Id'] as $value){
						if($value!=0) {
							$update[$model]['id']=$value;
							$update[$model]['commande_id']=$commandeId;
							$this->Model->save($update);
						}
					}
					exit(json_encode(array('success'=>true,'msg'=>'Commande enregistrée !')));
					break;
	}
			
	function license_checker() {
		if($this->License->mac_checker()&&$this->License->ip_checker()&&$this->License->server_name_checker()){
			//$this->Session->write('license',true);
		}
		else {
			$this->cakeError('licenseError'); 
		}
	}
	
	function updateGroupe($n°,$advanced=null,$data) {
		//let me know if it comes from an advanced form
		$this->Controller->set(compact('n°','advanced')); 
		$this->autoRender=true;
    	$sectionId = $data['Produit']['section_id'];
    	if ((!empty( $sectionId ))&&($sectionId!=0)) {
      		$groupes =$this->Produit->Groupe->find('list',array('fields'=>array('Groupe.id','Groupe.name'),
      															'conditions'=>array('Groupe.section_id'=>$sectionId,
																					'Groupe.actif'=>'yes'
																					)));
    	}
    	else { 
    		$groupes =$this->Produit->Groupe->find('list',array('fields'=>array('Groupe.id','Groupe.name'),
																'conditions'=>array('Groupe.actif'=>'yes')
																));
		}
    	$groupes[0]='---';
		$this->Controller->set('groupes',$groupes);
  	}
	
	
	
	
	
   
 	function autoComplete($data,$filter='') {
 		Configure::write('debug',0);
  		$stockId=$this->Session->read('stockId');
		if(isset($data['Produit']['name'])){
			$name=$data['Produit']['name'];
		}
		else if(isset($data['PremierProduit']['name'])) {
			$name=$data['PremierProduit']['name'];
		}
		else {
			$name=$data['DeuxiemeProduit']['name'];
		}
		$cond['Produit.name like']=$name.'%';
		if($filter=='appro'){
			$cond['Produit.type like']='%stockable%';
			$cond['Produit.actif']='yes';
		}
		else if($filter=='') {
			$cond['Produit.actif']='yes';
		}
  		$this->Controller->set('produits', $this->Produit->find('all', array(
			 'conditions' => $cond,
 		   'fields' => array('Produit.name','Produit.id'),
 		   'recursive'=>-1
 		   )));
 		$this->layout = 'ajax';
  	}
  
	
	function tva($montant,$incluse=1){
		if(Configure::read('aser.tva')){
			$taux=$this->Conf->find('tva');
			$tva=($incluse)?round($montant*$taux/(100+$taux)):($montant*$taux/100);
		}
		else {
			$tva=0;
		}
		return $tva;
	}
	
	

	/**
	 *  increase a given date according to the given parameters :
	 * days, months, and years
	 */
	function increase_date($givendate,$day=1,$mth=0,$yr=0) {
     	$cd = strtotime($givendate);
     	$newdate = date('Y-m-d', mktime(date('h',$cd),date('i',$cd), date('s',$cd), date('m',$cd)+$mth,date('d',$cd)+$day, date('Y',$cd)+$yr));
      	return $newdate;
	}
	
	function formatDate($date,$type='french'){
		if(empty($date))
			return '';
		else if($type=='french'){
			$parts=explode('-',$date);
			return $parts[1].'/'.$parts[2].'/'.$parts[0];
		}
		else {
			$parts=explode('/',$date);
			return $parts[0].'-'.$parts[1].'-'.$parts[2];
		}
	}
	/**
	 * Retourne le prix du produit
	 * 
	 */
	function productPrice($id,$PV=0,$pos=''){
		if(Configure::read('aser.multi_pv')){
			$this->Tarif=ClassRegistry::init('Tarif');
			
			if($pos==''){
				$pos=$this->Session->read('pos');
			}
			$tarif=$this->Tarif->find('first',array('fields'=>array('Tarif.PV'),
																'conditions'=>array('Tarif.produit_id'=>$id,
																					'Tarif.name'=>$pos
																					)
																));
			$PV=(!empty($tarif))?$tarif['Tarif']['PV']:$PV;
		}
		else if($PV==0){
			$this->Produit=ClassRegistry::init('Produit');
			$produit=$this->Produit->find('first',array('fields'=>array('Produit.PV'),
																'conditions'=>array('Produit.id'=>$id)
																));
			$PV=$produit['Produit']['PV'];
		}
		return $PV;
	}
	/*
	 * retourne la quantité d'un produit donné dans un stock donné
	 */
	function productQty($id=null,$stockId=null,$ignoreIds=array(),$date=null,$return='qty'){
		if($stockId==null){
			$stockId=$this->Session->read('resto_stock');
		}
		$this->Historique=ClassRegistry::init('Historique');
		if($id){
			$cond['Historique.produit_id']=$id;
		}
		if($stockId){
			$cond['Historique.stock_id']=$stockId;
		}
		$cond['NOT']=array('Historique.id'=>$ignoreIds);
		if($date){
			$cond['Historique.date <=']=$date;
		}
		$ants=$this->Historique->find('all',array('fields'=>array(
																'sum(Historique.debit) as debit',
																'sum(Historique.credit) as credit',
																'Historique.date_expiration',
																'Historique.produit_id',
																'Historique.stock_id',
																'Stock.name',
																'Produit.name'
						                        				),
						                        'conditions'=>$cond,
						                        'group'=>array('Stock.name','Produit.name','Historique.date_expiration'),
						                        'order'=>array('Historique.date_expiration','Historique.date')
												));
		$qty=0;
		foreach($ants as $key=>$ant){
			$qtyLot=$ant['Historique']['debit']-$ant['Historique']['credit'];
			if($qtyLot<=0)
				unset($ants[$key]);
			else if($id){
				if(!in_array($ant['Historique']['date_expiration'],array(null,'0000-00-00'))&&
					($ant['Historique']['date_expiration']<=date('Y-m-d'))
				){
					$this->savePerte($ant['Historique'],$qtyLot);
					unset($ants[$key]);
				}
				else {
					$qty+=$ants[$key]['qty']=$qtyLot;
				}
			}
			else {
				//this conditions keeps only the qty lot that will expire in 2 months.
				if(!(!in_array($ant['Historique']['date_expiration'],array(null,'0000-00-00'))&&
					($ant['Historique']['date_expiration']<=date('Y-m-d',strtotime("+ 2 months")))
					)
				){
					unset($ants[$key]);
				}
			}
		}
		if($return=='qty')
			return $qty;
		else 
			return array('array'=>$ants,'qty'=>$qty);
	}

	function savePerte($data,$qty){
		$data['date']=date('Y-m-d');
		$historique['Historique']=$data;
		$historique['Historique']['libelle']='Perte';	
		$historique['Historique']['debit']=null;	
		$historique['Historique']['credit']=$qty;	
		$historique['Historique']['id']=null;
		$this->Historique=ClassRegistry::init('Historique');
		$this->Historique->save($historique);
		
		$perte['Perte']=$data;
		$perte['Perte']['historique_id']=$this->Historique->id;
		$perte['Perte']['PU']=$this->productPrice($data['produit_id']);
		$perte['Perte']['quantite']=$qty;
		$perte['Perte']['montant']=$perte['Perte']['quantite']*$perte['Perte']['PU'];
		$perte['Perte']['nature']='expiration';
		$this->Perte=ClassRegistry::init('Perte');
		$this->Perte->save($perte);
	}
	
	function solde($model,$id,$model1='',$date=''){
		$this->Model=ClassRegistry::init($model);
		if($model=='Operation'){
			$cond['Operation.compte_id']=$id;
			$cond['Operation.model']=$model;
			if($date!=''){
				$cond['Operation.date <']=$date;
			}
			$ants=$this->Model->find('all',array('fields'=>array('sum(Operation.debit) as debit',
																				'sum(Operation.credit) as credit',
						                        								),
						                        				'conditions'=>array('Operation.element_id'=>$id,
						                        									'Operation.model'=>$model1,
																					)
																	));
			$solde=$ants[0]['Operation']['debit']-$ants[0]['Operation']['credit'];
		}
		else {
			$cond['CompteOperation.compte_id']=$id;
			if($date!=''){
				$cond['CompteOperation.date <']=$date;
			}
			$ants=$this->Model->find('all',array('fields'=>array('sum(CompteOperation.debit) as debit',
																				'sum(CompteOperation.credit) as credit',
						                        								),
						                        				'conditions'=>$cond
																	));
			$solde=$ants[0]['CompteOperation']['debit']-$ants[0]['CompteOperation']['credit'];
		}
		return $solde;
	}
	function op_num($model){
		$this->Model=ClassRegistry::init($model);
		$last=$this->Model->find('first',array('order'=>array($model.'.id desc'),
													'recursive'=>-1,
													'fields'=>array($model.'.op_num')
													)
										);
		if(empty($last)){
			return 1;
		}
		else {
			return $last[$model]['op_num']+1;
		}
	}
	function name($str){
		$table = array(
       	 '  '=>' ', 'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj', 'Ž'=>'Z', 'ž'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
       	 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
        'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
        'ÿ'=>'y', 'R'=>'R', 'r'=>'r', "'"=>'-', '"'=>'-', '%'=>''
    	);
		return  strtoupper(strtr($str, $table));
	}

	function cash($persCond,$pytCond,$factCond,$date){
		//loading needed models
		$this->Facture=ClassRegistry::init('Facture');
		$this->Personnel=ClassRegistry::init('Personnel');
		$datas=array();
		$rubriques=array('ca','credit','bonus');
		
		$default_currency = Configure::read('aser.default_currency'); //RWF in general.
		$in_progress=0;

		//initialisation du tableau des paiements
		foreach($this->Controller->modePaiements as $mode=>$modeName){
			foreach($this->Controller->monnaies as $monnaie){
				$total[$mode.'_'.$monnaie]=0;
				$total['pyt_'.$mode.'_'.$monnaie]=0;
			}
		}
		//pour les totaux des factures
		foreach($this->Controller->facturationMonnaies as $monnaie){
			foreach($rubriques as $rubrique){
				$total[$rubrique.'_'.$monnaie]=0;
			}
		}
		
		$old_credit['RWF']=$old_credit['USD']=0;
		
		//Details factures bif
		$vente1['RWF_RWF']=$vente1['RWF_USD']=$vente1['RWF_EUR']=0;
		$vente2['RWF_RWF']=$vente2['RWF_USD']=$vente2['RWF_EUR']=0;
		//Details factures usd
		$vente1['USD_RWF']=$vente1['USD_USD']=$vente1['USD_EUR']=0;
		$vente2['USD_RWF']=$vente2['USD_USD']=$vente2['USD_EUR']=0;
		
		//Details pyts factures bif
		$pyt1['RWF_RWF']=$pyt1['RWF_USD']=$pyt1['RWF_EUR']=0;
		$pyt2['RWF_RWF']=$pyt2['RWF_USD']=$pyt2['RWF_EUR']=0;
		//Details pyts factures usd
		$pyt1['USD_RWF']=$pyt1['USD_USD']=$pyt1['USD_EUR']=0;
		$pyt2['USD_RWF']=$pyt2['USD_USD']=$pyt2['USD_EUR']=0;
		
		$old_pyt['USD']=$old_pyt['RWF']=0;
		$paid['USD']=$paid['RWF']=0;
		
		$remb['RWF']=$remb['USD']=0;
		
		$ca['ca_USD']=$ca['ca_RWF']=$ca['credit_RWF']=$ca['credit_USD']=$ca['deposit_USD']=$ca['deposit_RWF']=0;
		$ca['consumed_RWF']=$ca['consumed_USD']=0;
		$list=array();
		$in_progress_ids=  array();
		$factures=$this->Facture->find('all',array('fields'=>array('Facture.montant',
																	'Facture.reste',
																	'Facture.monnaie',
																	'Facture.etat',
																	'Facture.operation',
																	'Facture.date'
																	),
																	'conditions'=>$factCond,
																	));
	//	exit(debug($factures));	
			foreach($factures as $key=>$facture){
				//getting the total des factures en cours et cloturer
				if(($facture['Facture']['monnaie']==$default_currency)
					&&in_array($facture['Facture']['etat'], array('in_progress','printed'))
					){

					$in_progress+=$facture['Facture']['montant'];
					$in_progress_ids[]=$facture['Facture']['id'].' '.$facture['Facture']['montant'].' '.$facture['Facture']['date'].' '.$facture['Facture']['etat'];
					continue;
				}

				$facture['Facture']['deposit']=$facture['Facture']['consumed']=0;
				if($facture['Facture']['operation']=='Reservation'){
					$this->extract_amount($facture,$date,$date);
					if($facture['Facture']['montant']>0){
						$factures[$key]=$facture;
					}
					else {
						unset($factures[$key]);
						continue;
					}
				}
				
				$ca['ca_'.$facture['Facture']['monnaie']]+=$facture['Facture']['montant'];
				$ca['credit_'.$facture['Facture']['monnaie']]+=$facture['Facture']['reste'];
				$ca['deposit_'.$facture['Facture']['monnaie']]+=$facture['Facture']['deposit'];
				$ca['consumed_'.$facture['Facture']['monnaie']]+=$facture['Facture']['consumed'];
				if($facture['Facture']['date']!=$date){
					$paid[$facture['Facture']['monnaie']]+=$facture['Facture']['montant']
																-$facture['Facture']['reste']
																+$facture['Facture']['deposit'];
					$list[]=$facture['Facture']['id'];
				}
				$factures[$key]=$facture;
			}
			
		$personnels=$this->Personnel->find('all',array('fields'=>array('Personnel.id','Personnel.name'),
													'order'=>array('Personnel.name'),
													'recursive'=>-1,
													'conditions'=>$persCond
													));
		foreach($personnels as $i=>$personnel){
			//initialisation du tableau des paiements
			foreach($this->Controller->modePaiements as $mode=>$modeName){
				foreach($this->Controller->monnaies as $monnaie){
					$datas[$i][$mode.'_'.$monnaie]=0;
					$datas[$i]['pyt_'.$mode.'_'.$monnaie]=0;
				}
			}
			//pour les totaux des factures
			foreach($this->Controller->facturationMonnaies as $monnaie){
				foreach($rubriques as $rubrique){
					$datas[$i][$rubrique.'_'.$monnaie]=0;
				}
			}
			
			$datas[$i]['name']=$personnel['Personnel']['name'];
			$datas[$i]['id']=$personnel['Personnel']['id'];
			$datas[$i]['date']=$date;
			
			$pytCond['Paiement.personnel_id']=$personnel['Personnel']['id'];
			$pyts=$this->Facture->Paiement->find('all',array('fields'=>array('Paiement.montant',
																		'Paiement.monnaie',
																		'Paiement.montant_equivalent',
																		'Paiement.mode_paiement',
																		'Facture.monnaie',
																		'Facture.date',
																		'Facture.id',
																		'Paiement.date' 
																	),
																	'conditions'=>$pytCond,
																	));
			foreach($pyts as $pyt){
				if(in_array($pyt['Facture']['id'],$list)){
					$old_pyt[$pyt['Facture']['monnaie']]+=$pyt['Paiement']['montant'];
					$pyt['Facture']['date']=$date;
				}	

				if(($pyt['Paiement']['mode_paiement']=='cheque')&&($pyt['Paiement']['monnaie']=='EUR')){
					continue;
				}
				if($pyt['Paiement']['mode_paiement']=='remboursement'){
					$remb[$pyt['Facture']['monnaie']]+=$pyt['Paiement']['montant'];
				}
				else if(!empty($pyt['Paiement']['montant_equivalent'])){
					if($pyt['Paiement']['date']==$pyt['Facture']['date']){
						$datas[$i][$pyt['Paiement']['mode_paiement'].'_'.$pyt['Paiement']['monnaie']]+=$pyt['Paiement']['montant_equivalent'];
						$old_credit[$pyt['Facture']['monnaie']]+=$pyt['Paiement']['montant'];
						
						$vente1[$pyt['Facture']['monnaie'].'_'.$pyt['Paiement']['monnaie']]+=$pyt['Paiement']['montant'];
						$vente2[$pyt['Facture']['monnaie'].'_'.$pyt['Paiement']['monnaie']]+=$pyt['Paiement']['montant_equivalent'];
					}
					else {
						$datas[$i]['pyt_'.$pyt['Paiement']['mode_paiement'].'_'.$pyt['Paiement']['monnaie']]+=$pyt['Paiement']['montant_equivalent'];
						
						$pyt1[$pyt['Facture']['monnaie'].'_'.$pyt['Paiement']['monnaie']]+=$pyt['Paiement']['montant'];
						$pyt2[$pyt['Facture']['monnaie'].'_'.$pyt['Paiement']['monnaie']]+=$pyt['Paiement']['montant_equivalent'];	
					}
				}
				else {
					if($pyt['Paiement']['date']==$pyt['Facture']['date']){
						$datas[$i][$pyt['Paiement']['mode_paiement'].'_'.$pyt['Facture']['monnaie']]+=$pyt['Paiement']['montant'];
						$old_credit[$pyt['Facture']['monnaie']]+=$pyt['Paiement']['montant'];
						
						$vente1[$pyt['Facture']['monnaie'].'_'.$pyt['Facture']['monnaie']]+=$pyt['Paiement']['montant'];
						$vente2[$pyt['Facture']['monnaie'].'_'.$pyt['Facture']['monnaie']]+=$pyt['Paiement']['montant'];
					}
					else {
						$datas[$i]['pyt_'.$pyt['Paiement']['mode_paiement'].'_'.$pyt['Facture']['monnaie']]+=$pyt['Paiement']['montant'];
						
						$pyt1[$pyt['Facture']['monnaie'].'_'.$pyt['Facture']['monnaie']]+=$pyt['Paiement']['montant'];
						$pyt2[$pyt['Facture']['monnaie'].'_'.$pyt['Facture']['monnaie']]+=$pyt['Paiement']['montant'];
					}
				}
			}
			
		
			$total['name']='TOTAL';
			//initialisation du tableau des paiements
			foreach($this->Controller->modePaiements as $mode=>$modeName){
				foreach($this->Controller->monnaies as $monnaie){
					$total[$mode.'_'.$monnaie]+=$datas[$i][$mode.'_'.$monnaie];
					$total['pyt_'.$mode.'_'.$monnaie]+=$datas[$i]['pyt_'.$mode.'_'.$monnaie];
				}
			}
			//pour les totaux des factures
			foreach($this->Controller->facturationMonnaies as $monnaie){
				foreach($rubriques as $rubrique){
					$total[$rubrique.'_'.$monnaie]+=$datas[$i][$rubrique.'_'.$monnaie];
				}
			}
			
			if(empty($pyts)) {
				unset($datas[$i]);
			}
		}
	//	exit(debug($datas));
		
	//	debug($old_credit);
	//	exit(debug($ca));	
		if($old_credit['USD']<=$ca['ca_USD']){
			$consumed['USD']=$ca['consumed_USD'];
			$montantPayee['USD']=$old_credit['USD']-$ca['deposit_USD']-$consumed['USD'];
			$credit['USD']=$ca['ca_USD']-$montantPayee['USD'];
			$ca['deposit_USD']=($ca['deposit_USD']>$old_credit['USD'])?0:$ca['deposit_USD'];
			
		}
		else {
			$consumed['USD']=$old_pyt['USD']-$paid['USD'];
			$montantPayee['USD']=$old_credit['USD']-$ca['deposit_USD']-$consumed['USD'];
			$montantPayee['USD']=($montantPayee['USD']<0)?0:$montantPayee['USD'];
			$credit['USD']=$ca['ca_USD']-$montantPayee['USD'];
		}
		
		if($old_credit['RWF']<=$ca['ca_RWF']){
			$montantPayee['RWF']=$old_credit['RWF'];
			$credit['RWF']=$ca['ca_RWF']-$montantPayee['RWF'];
			$ca['deposit_RWF']=($ca['deposit_RWF']>$old_credit['RWF'])?0:$ca['deposit_RWF'];
			$consumed['RWF']=0;
		}
		else {
			$consumed['RWF']=$old_pyt['RWF']-$paid['RWF'];
			$montantPayee['RWF']=$old_credit['RWF']-$ca['deposit_RWF']-$consumed['RWF'];
			$montantPayee['RWF']=($montantPayee['RWF']<0)?0:$montantPayee['RWF'];
			$credit['RWF']=$ca['ca_RWF']-$montantPayee['RWF'];
		}
		$this->Controller->set(compact(
									'consumed',
									'credit',
									'montantPayee',
									'vente1',
									'vente2',
									'pyt1',
									'pyt2',
									'ca',
									'old_credit',
									'month',
									'datas',
									'total',
									'date',
									'remb',
									'in_progress'
								));	
	}
	
	function bill_total($factureId,$reduction,$save=true,$old_state=''){
		$this->Vente=ClassRegistry::init('Vente');
		$update['Facture']['id']=$factureId;
		$original=$avance=0;
		$sums=$this->Vente->find('all',array('fields'=>array('Vente.montant','Vente.pourcentage'),
										'conditions'=>array('Vente.facture_id'=>$factureId)
										)
							);
		foreach($sums as $sum){
			$original+=$sum['Vente']['montant'];
			$avance+=($sum['Vente']['montant']*$sum['Vente']['pourcentage']/100);
		}
		$update['Facture']['original']=$original;
		$update['Facture']['reduction']=$reduction;
		//reste == montant because the bill has not been closed yet
		$update['Facture']['montant']=round($original-(($original*$reduction)/100));
		$update['Facture']['reste']=$update['Facture']['montant'];
		$update['Facture']['avance_beneficiaire']=$avance;
		if($save)
			$this->Vente->Facture->save($update);
		
		if($old_state!=''){
			$this->update_facture($factureId, $update['Facture']['montant'], $old_state);
		}
		return array('montant'=>$update['Facture']['montant'],
					'reste'=>$update['Facture']['reste'],
					'avance_beneficiaire'=>$avance,
					'original'=>$original,
					);
	}

	function factureMontantRes($factures,$monnaie=null){
		$this->Reservation=ClassRegistry::init('Reservation');
		foreach($factures as $facture){
			$reservations=$this->Reservation->find('all',array('fields'=>array('Reservation.checked_in',
																			'Reservation.depart',
																			'Reservation.PU',
																			'Reservation.demi',
																			'Reservation.tauxDemi'
																			),
													'conditions'=>array('Reservation.facture_id'=>$facture['Reservation']['facture_id'],
																		),
													));
			$montantFact=0;
			foreach($reservations as $reservation){
				$depart=($reservation['Reservation']['depart']>date('Y-m-d'))?date('Y-m-d'):$reservation['Reservation']['depart'];
				$montantRes=($this->diff($reservation['Reservation']['checked_in'],$depart)+1)*$reservation['Reservation']['PU'];
				if(($reservation['Reservation']['depart']<date('Y-m-d'))&&($reservation['Reservation']['demi']>0)){
					$montantRes+=$reservation['Reservation']['PU']*($reservation['Reservation']['tauxDemi']/100);
				}
				$montantFact+=$montantRes;
			}
			$this->update_facture($facture['Reservation']['facture_id'],$montantFact,$facture['Facture']['etat'],$monnaie);
		}
	}
	
	function extract_amount(&$facture,$date1,$date2){
		$this->Reservation=ClassRegistry::init('Reservation');
		$reservations=$this->Reservation->find('all',array('fields'=>array('Reservation.checked_in',
																			'Reservation.depart',
																			'Reservation.PU',
																			'Reservation.demi',
																			'Reservation.tauxDemi'
																			),
													'conditions'=>array('Reservation.facture_id'=>$facture['Facture']['id'],
																		),
													));
		$montantFact=$montantFactTest=0;
		foreach($reservations as $reservation){
			$depart=$reservation['Reservation']['depart'];
			$originalArrival=$reservation['Reservation']['checked_in'];
			$skip=false;
			$montantRes=$montantResTest=0;
			//1st case : periode incluse dans la reservation
			if(($reservation['Reservation']['checked_in']>=$date1)&&($reservation['Reservation']['depart']<=$date2)){
				//use the same arrival & departure dates	
			}
			//2nd case : //reservations qui s'etende au dela de la periode de deux cotes'
			else if(($reservation['Reservation']['checked_in']<$date1)&&($reservation['Reservation']['depart']>$date2)){
				$reservation['Reservation']['checked_in']=$date1;
				$reservation['Reservation']['depart']=$date2;
			}
			//3rd case : //reservations dont l'checked_in e avant la période mais qui finit quand meme dans cette periode'
			else if(($reservation['Reservation']['checked_in']<$date1)&&($reservation['Reservation']['depart']<=$date2)&&($reservation['Reservation']['depart']>=$date1)){
				$reservation['Reservation']['checked_in']=$date1;
			}
			//4th case : // reservation qui commence dans cette periode e fini ailleur
			else if(($reservation['Reservation']['checked_in']>=$date1)&&($reservation['Reservation']['checked_in']<=$date2)&&($reservation['Reservation']['depart']>$date2)){
				$reservation['Reservation']['depart']=$date2;
			}
			else {
				$skip=true;
			}
			if(!$skip){
				$montantRes=($this->diff($reservation['Reservation']['checked_in'],$reservation['Reservation']['depart'])+1)*$reservation['Reservation']['PU'];
				$montantResTest=($this->diff($originalArrival,$reservation['Reservation']['depart'])+1)*$reservation['Reservation']['PU'];
				if((($reservation['Reservation']['depart']==$depart)&&($depart<date('Y-m-d')))&&($reservation['Reservation']['demi']>0)){
					$montantRes+=round($reservation['Reservation']['PU']*($reservation['Reservation']['tauxDemi']/100));
					$montantResTest+=round($reservation['Reservation']['PU']*($reservation['Reservation']['tauxDemi']/100));
				}
				
			}
			$montantFact+=$montantRes;
			$montantFactTest+=$montantResTest;
		}
		$result=$this->update_facture($facture['Facture']['id'],$montantFactTest,'return_state',null,false,$date2,$montantFact);
		
		$facture['Facture']['montant']=$montantFact;
		$facture['Facture']['reste']=$result['reste'];
		$facture['Facture']['etat']=$result['etat'];
		$facture['Facture']['deposit']=$result['deposit'];
		$facture['Facture']['consumed']=$result['consumed'];
		$facture['Facture']['reste']=($facture['Facture']['reste']>$facture['Facture']['montant'])?
									$facture['Facture']['montant']:
									$facture['Facture']['reste'];
		
	}
	
	function factures($date1,$date2){
		$factures=$this->Facture->Reservation->find('list',array('fields'=>array('Reservation.facture_id',
																				'Reservation.facture_id',
																	),
													'conditions'=>array('Reservation.facture_id !='=>null,
																		'Reservation.etat !='=>'canceled',
																		'OR'=>array(array('Reservation.checked_in >='=>$date1,
																						'Reservation.depart <='=>$date2),
																					array('Reservation.checked_in <'=>$date1,
																						'Reservation.depart >'=>$date2),
																					array('Reservation.checked_in <'=>$date1,
																						'Reservation.depart <='=>$date2,
																						'Reservation.depart >='=>$date1
																						),
																					array('Reservation.checked_in >='=>$date1,
																						'Reservation.checked_in <='=>$date2,
																						'Reservation.depart >'=>$date2
																						),
																					),
																		
																		),
													'group'=>array('Reservation.facture_id')
													));
		return $factures;
	}
	
	function giveMonth($number) {
		switch($number) {
				case 1:
					$month='Janvier';
					break;
				case 2:
					$month='Février';
					break;
				case 3:
					$month='Mars';
					break;
				case 4:
					$month='Avril';
					break;
				case 5:
					$month='Mai';
					break;
				case 6:
					$month='Juin';
					break;
				case 7:
					$month='Juillet';
					break;
				case 8:
					$month='Août';
					break;
				case 9:
					$month='Septembre';
					break;
				case 10:
					$month='Octobre';
					break;
				case 11:
					$month='Novembre';
					break;
				case 12:
					$month='Décembre';
					break;
				default:
					$month='Mois inconnue';
					break;
			}
			return $month;
	}

	function gpeCptable($factures){
		$facturesIds=array();
		foreach($factures as $facture){
			$facturesIds[]=$facture['Facture']['id'];	
		}
		$this->Vente=ClassRegistry::init('Vente');
		$this->Service=ClassRegistry::init('Service');
		$gpeCptables=$this->Vente->Produit->GroupeComptable->find('all',array('fields'=>array('GroupeComptable.name',
																							'GroupeComptable.id'																							
																						)));
		//create the placeholder all currencies
	//	exit(debug($this->Controller->facturationMonnaies));
		foreach($this->Controller->facturationMonnaies as $monnaie){
				$total['montant'][$monnaie]=0;
		}			
		foreach($gpeCptables as $key=>$gpeCptable){
			$ventes=$this->Vente->find('all',array('fields'=>array('sum(Vente.montant) as montant',
																'Produit.groupe_comptable_id',
																'Facture.reduction',
																'Facture.monnaie',
																),
												'conditions'=>array('Vente.facture_id'=>$facturesIds,
																	'Produit.groupe_comptable_id'=>$gpeCptable['GroupeComptable']['id'],
																	),
												'group'=>array('Vente.facture_id','Facture.monnaie')
												));
			//	exit(debug($ventes));
			//create the placeholder all currencies
			foreach($this->Controller->facturationMonnaies as $monnaie){
					$gpeCptables[$key]['montant'][$monnaie]=0;
			}	
			foreach($ventes as $vente){
				$gpeCptables[$key]['montant'][$vente['Facture']['monnaie']]+=($vente['Facture']['reduction']>0)?
											($vente['Vente']['montant']-round($vente['Vente']['montant']*$vente['Facture']['reduction']/100)):
											$vente['Vente']['montant'];
			}
			
		
			$services=$this->Service->find('all',array('fields'=>array('sum(Service.montant) as montant',
															'TypeService.groupe_comptable_id',
															'Facture.reduction',
															'Facture.monnaie',
															),
											'conditions'=>array('Service.facture_id'=>$facturesIds,
																'TypeService.groupe_comptable_id'=>$gpeCptable['GroupeComptable']['id']
																),
											'group'=>array('Service.facture_id','Facture.monnaie')
												));
			foreach($services as $service){
				if(isset($gpeCptables[$key]['montant'][$service['Facture']['monnaie']]))
					$gpeCptables[$key]['montant'][$service['Facture']['monnaie']]+=($service['Facture']['reduction']>0)?
											($vente['Service']['montant']-round($service['Service']['montant']*$service['Facture']['reduction']/100)):
											$service['Service']['montant'];
			}
			$gpeCptables[$key]['gpeShow']=0; // helps to prevent the display of an empty gpe
			foreach($this->Controller->facturationMonnaies as $monnaie){
				$total['montant'][$monnaie]+=$gpeCptables[$key]['montant'][$monnaie];
				$gpeCptables[$key]['gpeShow']=($gpeCptables[$key]['montant'][$monnaie]>0)?$gpeCptables[$key]['montant'][$monnaie]:$gpeCptables[$key]['gpeShow'];
			}	
		}
		//tva stuff
		$total['tvaShow']=0;
		foreach($this->Controller->facturationMonnaies as $monnaie){
			$total['tva'][$monnaie]=$this->tva($total['montant'][$monnaie]);
			$total['tvaShow']=($total['tva'][$monnaie]>0)?$total['tva'][$monnaie]:$total['tvaShow'];
			$total['htva'][$monnaie]=$total['montant'][$monnaie]-$total['tva'][$monnaie];
		}	
		
		$total['detail']=$gpeCptables;
		return $total;
		
	}
		
	function synthese_pyts($pyts){
		$this->Controller->modePaiements =$this->Controller->modePaiements+array('remboursement'=>'remboursement');
		foreach($this->Controller->monnaies as $monnaie){
			$total[$monnaie]=0;
			foreach($this->Controller->modePaiements as $mode=>$modePaiement)
				$detailPyts[$monnaie.'_'.$mode]=0;
		}
		foreach($pyts as $pyt){
			if(!empty($pyt['Paiement']['montant_equivalent'])){
				$total[$pyt['Paiement']['monnaie']]+=$pyt['Paiement']['montant_equivalent'];
				$detailPyts[$pyt['Paiement']['monnaie'].'_'.$pyt['Paiement']['mode_paiement']]+=$pyt['Paiement']['montant_equivalent'];
			}
			else {
				$total[$pyt['Facture']['monnaie']]+=$pyt['Paiement']['montant'];
				$detailPyts[$pyt['Facture']['monnaie'].'_'.$pyt['Paiement']['mode_paiement']]+=$pyt['Paiement']['montant'];
			}
		}
		return array('total'=>$total,'detail'=>$detailPyts);
	}
	
	function chambre($chambre) {
		$this->Reservation=ClassRegistry::init('Reservation');
		$tierid=$this->Reservation->find('first',array('fields'=>array('Reservation.tier_id'),
													'conditions'=>array('Chambre.name' =>$chambre,
																		'Reservation.checked_in <='=>date('Y-m-d'),
																		'Reservation.depart >='=>$this->increase_date(date('Y-m-d'),-1),
																		'Reservation.etat'=>'checked_in'
																		),
														)
											);
		return (!empty($tierid['Reservation']['tier_id']))?($tierid['Reservation']['tier_id']):0;
		
  	}
}