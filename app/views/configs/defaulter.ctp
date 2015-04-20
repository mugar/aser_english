
<?php echo $this->Form->create('Config');?>
   <div id="defaulter"><h4>Paramétrage des valeurs par défaut</h4>
<fieldset><legend>A</legend>
<?php
		echo $this->Form->input('stock_id',array('selected'=>0));
		echo $this->element('combobox',array('n°'=>1,'selected'=>false));
		echo $this->Form->input('monnaie');
		echo $this->Form->input('unite_id');
		 
?>
</fieldset>
<fieldset><legend>B</legend>
<?php
		echo $this->Form->input('caiss_id');
		echo $this->Form->input('tier_id');
		echo $this->Form->input('type_id');
		echo $this->Form->input('mois',array('options'=>array('janvier'=>'janvier','fevrier'=>'fevrier','mars'=>'mars','avril'=>'
		avril','mai'=>'mai','juin'=>'juin','juillet'=>'juillet','aout'=>'aout',
		'septembre'=>'septembre','octobre'=>'octobre','novembre'=>'novembre','decembre'=>'decembre')));
		echo $this->Form->input('date',array('type'=>'date'));?>
</fieldset>
<fieldset><legend>C</legend>
<?php	echo $this->Form->input('paiement',array('label'=>'','options'=>array('cash'=>'cash',
																'credit'=>'credit',
																'interne'=>'interne',
																'gratuit'=>'gratuit',
																'promotion'=>'promotion'
																)));
		echo $this->Form->input('livrer',array('options'=>array('oui'=>'oui','non'=>'non')));
		echo $this->Form->input('echange',array('options'=>array('oui'=>'oui','non'=>'non')));
		echo $this->Form->input('nature',array('options'=>array('casses'=>'casses','impropres'=>'impropres','vols'=>'vols')));
		
?>
</fieldset>
<div style="clear:both"></div>
   </div>
		<?php echo $this->Form->end(__('Envoyer', true)); ?>