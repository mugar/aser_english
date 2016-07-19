<span style="font-size:15px !important; color:#367889; cursor:pointer; " onclick="jQuery('#options').toggle();">Options de recherche</span>

<div id="options" style="display:none;">
<?php echo $this->Form->create('Reservation',array('id'=>'availability'));?>
	<?php
		echo $this->Form->input('type_chambre_id');
		echo $this->Form->input('checked_in');
		echo $this->Form->input('depart');
	?>
<?php echo $this->Form->end();?>
</div>
<br>
<br>
<span id="loading" style="display:none;">Recherche...</span>
<div id="response"></div>
