<ol id="defaulter" style="display:none">
<?php 
	$defaults=$this->Session->read('defaults');
	if(!empty($defaults)) {
		foreach($defaults['Config'] as $k=>$v) {
			echo '<li name="'.Inflector::camelize($k).'">'.$v.'</li>';
		}
	}
?>
</ol>
