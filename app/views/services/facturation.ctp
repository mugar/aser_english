
<div class="dialog" >
	<div id="response"></div>
	<?php echo $this->Form->create('Service',array('id'=>'services_form','action'=>'facturation'));?>
	<span class='left'>
		<?php
			if(isset($modification)){
				echo $this->Form->input('tier_id',array('type'=>'hidden'));
			}
			echo $this->Form->input('type_service_id',array('options'=>$typeServices, 'label'=>'Service Type'));
			echo $this->Form->input('description',array('id'=>'descService'));
			if(in_array($session->read('Auth.Personnel.fonction_id'),array(3,5)))
				echo $this->Form->input('date',array('id'=>'DateService',
													'type'=>'text',
													'value'=>date('Y-m-d')
													));
			else 
				echo $this->Form->input('date',array('type'=>'hidden',
													'value'=>date('Y-m-d')
													));
			
		?>
	</span>
	<span class='right'>
		<?php
			echo $this->Form->input('montant', array('label'=>'Amount'));
			echo $this->Form->input('monnaie',array('label'=>'Currency','selected'=>'USD','options'=>$facturationCurrencys));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>