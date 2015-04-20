<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Paiement',array('id'=>'recherche','action'=>'payment/'.$chambre));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('label'=>'Choisissez une date début','type'=>'text'));	
			
			echo $this->Form->input('date2',array('label'=>'et une date fin pour le rapport','type'=>'text'));
			echo $this->Form->input('mode_paiement',array('label'=>'Mode De Paiement',
														'options'=>array()+$modePaiements,
																));
		?>
	</span>
	<span class="right">
		<?php
			
			echo $this->Form->input('compagnie',array('label'=>'Compagnie du Client'));
			echo $this->Form->input('monnaie');
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<h3><?php 
$config=Configure::read('aser');
	echo 'Rapport des Paiements ('.$monnaie.')';
		if(isset($date1)){
			echo '<h4>( '.$this->MugTime->toFrench($date1).'-'.$this->MugTime->toFrench($date2).' )</h4>';
		}
	?>
</h3>
<br>
<?php 
echo $this->element('../paiements/payments_table',array('pyts'=>$pyts,'facture'=>true,'chambre'=>$chambre,'sums'=>$sumPyts));
?>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link('Gestion des Réservations', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
	</ul>
</div>
