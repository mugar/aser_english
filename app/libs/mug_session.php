<?php
/**
 * Mug session extends Cake core cake_session.php
 */
 
  App::import('Core','CakeSession');

class MugSession extends CakeSession {

/**
 * just a modified read function for removing an error thrown by CAKEPHP 
 * stating that $_SESSION variable is not defined.
 * the error appears when trying to modified a stock item only.
 * I'm not sure if I'm doing right !
 * @param $name of the variable to search for in sessions
 * @return the read variable if it exist
 * @access public
 */
/**
 * Returns given session variable, or all of them, if no parameters given.
 *
 * @param mixed $name The name of the session variable (or a path as sent to Set.extract)
 * @return mixed The value of the session variable
 * @access public
 */
	function read($name = null) {
		if (is_null($name)) {
			return $this->__returnSessionVars();
		}
		if (empty($name)) {
			return false;
		}
		$result=null;
		if(isset($_SESSION)) {
			$result = Set::classicExtract($_SESSION, $name);
		}
		if (!is_null($result)) {
			return $result;
		}
		$this->__setError(2, "$name doesn't exist");
		return null;
	}
}
?>