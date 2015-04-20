
<div class="dialog">
<?php echo $this->Form->create('Chambre',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Numéro de la chambre'));
		echo $this->Form->input('type_chambre_id',array('label'=>'Type de Chambre'));
		echo $this->Form->input('etage',array('label'=>'N°d\'étage'));
	?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('operationnelle',array('label'=>'Chambre Opérationnelle','options'=>$actifs));
		echo $this->Form->input('message');
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>