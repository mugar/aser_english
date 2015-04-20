<?php
class AppError extends ErrorHandler {
	
	function _outputMessage($error_page){
    	$this->controller->set('enabled',false);
		parent::_outputMessage($error_page);
	}
	function licenseError() {
		$this->_outputMessage('license_error');
	}
}	
?>