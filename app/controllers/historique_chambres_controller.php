<?php
class HistoriqueChambresController extends AppController {

	var $name = 'HistoriqueChambres';

	function index() {
		$this->set('historiqueChambres', $this->paginate());
	}
}
?>