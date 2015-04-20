<?php
class GroupesController extends AppController {

	var $name = 'Groupes';
	var $paginate=array('order'=>'Groupe.id desc');

	function beforeFilter(){
		$sections = $this->Groupe->Section->find('list');
		$this->set(compact('sections'));
		parent::beforeFilter();
	}
	
	function _resizer($image,$new){
		
		$src_img = imagecreatefromjpeg($image);
		$srcsize = getimagesize($image);

		$dest_x = 60;
		$dest_y = ($dest_x / $srcsize[0]) * $srcsize[1];

		$dst_img = imagecreatetruecolor($dest_x, $dest_y);

		// Resize image
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dest_x, $dest_y, $srcsize[0], $srcsize[1]);
	
		if (file_exists($new)) {
            unlink($new);
        }
		imagejpeg($dst_img,$new,100);
		
		// Deletes images
		imagedestroy($src_img);
		imagedestroy($dst_img); 
	}
//*/
	function upload_img() {
		// setup dir names absolute and relative
		$folder='img/groupes';
		$folder_url = WWW_ROOT.$folder;
		$rel_url = $folder;
		
		// create the folder if it does not exist
		if(!is_dir($folder_url)) {
			mkdir($folder_url,0777);
		}
		// list of permitted file types, this is only images but documents can be added
		$permitted = array('image/jpeg','image/gif');
	
		// loop through and deal with the files
		 $file=$this->data['Groupe']['image'];
			// replace spaces with underscores
		//	$filename = str_replace(' ', '_', $file['name']); i wanna give logo.jpg for the filename
			$filename=$this->data['Groupe']['id'].'.jpg';
			// assume filetype is false
				$typeOK = false;
			// check filetype is ok
			foreach($permitted as $type) {
				if($type == $file['type']) {
					$typeOK = true;	
					break;
				}
			}
			
			// if file type ok upload the file
			if($typeOK) {
				// switch based on error code
				switch($file['error']) {
					case 0:
						// check filename already exists
							// create full filename
							$full_url = $folder_url.'/'.$filename;
							$url = $rel_url.'/'.$filename;
							// upload the file
							if(move_uploaded_file($file['tmp_name'], $url)){
								$this->_resizer($url, $url);
								exit(json_encode(array('success'=>true,'msg'=>'Success !')));
							}
							
						break;
					
					default:
						// an error occured
						exit(json_encode(array('success'=>false,'msg'=>'Erreur d\'importation !')));
						break;
				}
			
			} else {
				// unacceptable file type
				exit(json_encode(array('success'=>false,'msg'=>'Seule les images de type jpg/jpeg sont autorisées !')));
			}
		return $result;
	}
	
	function index() {
		$this->set('groupes', $this->paginate());
	}

	function _logic($data,$action){
		$this->Groupe->set($data);
		if(!$this->Groupe->validates()){
			$failureMsg='Le Nom est obligatoire!';
			if($action=='add')
				exit('failure_'.$failureMsg);
			else 
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
		}
	//	exit(debug($this->data));
		$this->Groupe->save($data);
	}
	
	function _show($id){
		$this->set('groupe',$this->Groupe->find('first',array('fields'=>array('Groupe.*','Section.name'),
    														'conditions'=>array('Groupe.id'=>$id)
															)
											));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->Groupe->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Groupe->find('first',array('fields'=>array('Groupe.*'),
																		'conditions'=>array('Groupe.id'=>$id),
																		'recursive'=>-1
																		));
			}
		}
		else {
			$this->_show($id);
		}
	}

	function delete($id = null) {
		$notDeleted=0;
		$deleted=array();
		foreach($this->data['Id'] as $id){
			if($id!=0) {
				$test1=$this->Groupe->Produit->find('first',array('conditions'=>array('Produit.groupe_id'=>$id),
																'recursive'=>-1
												));
				if (!empty($test1)){
					$notDeleted++;
				}
				else {
					$this->Groupe->delete($id);
					$deleted[]=$id;
				}
			}
		}
		$msg="Vérifié s'il n'y a pas des produits enregistrés sur ";
		$msg=($notDeleted>1)?$msg.'ces groupes.':$msg.'ce groupe.';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}
	
}
?>
