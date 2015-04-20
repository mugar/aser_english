<?php
/**
 * Mug sanitize extends Cake core Sanitize
 */
 
App::import('Sanitize');

class MugSanitize extends Sanitize {

/**
 * remove html tags from given array for safe input
 * @param mixed $data Data to sanitize
 * @return mixed Sanitized data
 * @access public
 * @static
 */
	function xss($data ,$options = array()) {
		if (empty($data)) {
			return $data;
		}
		
		if (is_string($options)) {
			$options = array('connection' => $options);
		} else if (!is_array($options)) {
			$options = array();
		}

		$options = array_merge(array(
			'remove' => true,
			'connection' => 'default',
			'odd_spaces' => false,
			'dollar' => false,
			'carriage' => false,
			'unicode' => false,
			'escape' => false,
			'backslash' => false
		), $options);
		

		if (is_array($data)) {
			foreach ($data as $key => $val) {
				$data[$key] = MugSanitize::xss($val, $options);
			}
			return $data;
		} else {
			if ($options['remove']) {
				$data = strip_tags($data);
			}
			if ($options['odd_spaces']) {
				$data = str_replace(chr(0xCA), '', str_replace(' ', ' ', $data));
			}
			if ($options['dollar']) {
				$data = str_replace("\\\$", "$", $data);
			}
			if ($options['carriage']) {
				$data = str_replace("\r", "", $data);
			}

			$data = str_replace("'", "'", str_replace("!", "!", $data));

			if ($options['unicode']) {
				$data = preg_replace("/&amp;#([0-9]+);/s", "&#\\1;", $data);
			}
			if ($options['escape']) {
				$data = Sanitize::escape($data, $options['connection']);
			}
			if ($options['backslash']) {
				$data = preg_replace("/\\\(?!&amp;#|\?#)/", "\\", $data);
			}
			return $data;
		}
	}

}
?>