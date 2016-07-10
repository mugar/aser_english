<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
	indicator();
	});
</script>
<div id='view'>
<div class="document">
<br />
<h3>Liste des Factures</h3>
<h4><?php /*  echo $periode=(!is_null($date1)&&!is_null($date2))?
						('( '.$this->MugTime->toFrench($date1).'-'.$this->MugTime->toFrench($date2).' )'):
						(''); */?>
</h4>
<br />
<br />
<?php echo $this->Form->create('Paiement',array('name'=>'checkbox','action'=>'mass_payment'));?>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th>Numero</th>
			<th>Opération</th>
			<th>Amount</th>
			<th>Reste</th>
			<th>Currency</th>
			<th>State Paiement</th>
			<th>Date</th>
			<th>Echéance</th>
		
	</tr>
		<?php
	foreach ($factures as $facture):
		
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$facture['Facture']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$facture['Facture']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($facture['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $facture['Facture']['id'])); ?>
		</td>
		<td><?php echo $facture['Facture']['operation']; ?>&nbsp;</td>
		<td><?php echo $number->format($facture['Facture']['montant'],$formatting); ?>&nbsp;</td>
		<td name="reste"><?php echo $number->format($facture['Facture']['reste'],$formatting); ?>&nbsp;</td>
		<td><?php echo $facture['Facture']['monnaie']; ?>&nbsp;</td>		
		<td name="etat"><?php  echo $facture['Facture']['etat']; ?>&nbsp;</td>
		<td><?php echo $this->MugTime->toFrench($facture['Facture']['date']); ?>&nbsp;</td>
		<td><?php echo $this->MugTime->toFrench($facture['Facture']['echeance']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
</table>


</div>
</div>
<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link" onclick = "<?php echo 'facture_global('.$this->params['pass'][0].')';?>" >Facture Global</li>
		<li class="link" onclick = "remove_facture()" >Annuler la facture</li>
		<li class="link"  onclick = "mass_pyt('off')" >Payer en masse</a> </li>
		<li  class="link"  onclick = "recherche()" >Search Options</a> </li>
		<li><?php echo $this->Html->link('Lister Factures', array('controller' => 'factures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link('Tableau des Occupations', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
	</ul>
</div>

<!-- form for paiement creation -->
<div id="pyt_boxe" style="display:none" title="Création d'un Paiement">
<div class="dialog">
	<div id="message_pyt"></div>
	<?php echo $this->Form->create('Paiement',array('id'=>'mass','action'=>'mass_payment'));?>
	<span class="left">
		<?php
			echo $this->Form->input('caiss_id',array('id'=>'caisse'));
			echo $this->Form->input('mode_paiement',array('id'=>'mode'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('reference',array('id'=>'reference'));
			echo $this->Form->input('date',array('type'=>'text','id'=>'Date'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>


<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'recherche','action'=>'extras'));?>
	<span class="left">
		<?php
			echo $this->Form->input('arrivee',array('id'=>'DateArrivee','type'=>'text'));
			
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('depart',array('id'=>'DateDeparture','type'=>'text'));			
			echo $this->Form->input('tier',array('type'=>'hidden','value'=>$tierId));				
			echo $this->Form->input('facture',array('type'=>'hidden','value'=>$factureId));	
			?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>