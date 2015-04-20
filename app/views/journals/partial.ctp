<?php 
		if($action=='edit')
			echo $this->Form->input('id');
		else 
			echo $this->Form->input('id',array('type'=>'text'));
		echo $this->Form->input('numero');
		echo $this->Form->input('date',array('type'=>'text'));
		echo $this->Form->input('personnel_id');
		echo $this->Form->input('closed');
?>