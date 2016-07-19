	
<div class="dialog" id="bookingAdd">
	<span id="loading" style="display:none;">Enregistrement...</span>
	<?php echo $this->Form->create('Reservation',array('id'=>'resAdd','action'=>'add'));?>
	<span class="left">
		<?php			
			echo $this->Form->input('checked_in',array('value'=>0));
			echo $this->Form->input('depart',array('value'=>0));
			echo $this->Form->input('checked_in');
			echo $this->Form->input('option',array('type'=>'checkbox','label'=>'cochez pour utilisez une autre date départ'));
			echo $this->Form->input('autre_depart',array('label'=>'Autre Date de départ','type'=>'date'));
			echo $this->Form->input('commentaire');		
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('occupants',array('label'=>'Occupants',
													'type'=>'select',
													'multiple'=>true,
													'options'=>$tiers,
													'id'=>'occupants'
													)
												);
			echo $this->Form->input('contexte',array('label'=>'Contexte du voyage','options'=>array('Tourisme'=>'Tourisme',
																									'Conference'=>'Conference',
																									'Autre'=>'Autre'
																									)
																							));
			echo $this->Form->input('etat',array('options'=>array('pending'=>'pending','confirmed'=>'confirmed')));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
