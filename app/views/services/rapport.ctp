`<div id='view'>
<div class="document">
<h3><?php echo 'Rapport des Services';
		if(isset($date1)){
			echo '<h4>(From  '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).')</h4>';
		}
	?>
</h3>
<br>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Tier</th>
			<th>Facture</th>
			<th>State de Paiement</th>
			<th>Type Service</th>
			<th>Amount</th>
			<th>RWF</th>
			<th>Date</th>
		
	</tr>
		<?php
	foreach ($groupServices as $groupService):
		
	?>
	<tr>
			<td><?php echo  $groupService['Tier']['name']; ?></td>
			<td name="facture" valeur="<?php echo $groupService['Facture']['id']; ?>">
				<?php echo $this->Html->link($groupService['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $groupService['Facture']['id'])); ?>
			</td>
			<td><?php echo  $groupService['Facture']['etat']; ?></td>
			<td><?php echo  $groupService['TypeService']['name']; ?></td>
			<td><?php echo  $number->format($groupService['Service']['montant']); ?></td>
			<td><?php echo  $groupService['Service']['monnaie']; ?></td>
			<td><?php echo  $groupService['Facture']['date']; ?></td>
	</tr>
<?php endforeach; ?>
<?php foreach($sum as $total):?>
	<tr>
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo $number->format($total['Service']['montant']+0); ?></td>
		<td><?php echo $total['Service']['monnaie']; ?></td>
		<td>&nbsp;</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Liste des Services', array('controller' => 'services', 'action' => 'index')); ?> </li>
	</ul>
</div>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Service',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('Service.tier_id',array('selected'=>0,'label'=>'Nom du client'));
			echo $this->Form->input('type_service_id',array('selected'=>0,'multiple'=>true));
			echo $this->Form->input('Facture.numero',array('value'=>'toutes','label'=>'N° facture'));
			echo $this->Form->input('Facture.monnaie',array('label'=>'Currency','options'=>$monnaies1));
			echo $this->element('paiement',array('toutes'=>true));
			
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('Facture.date1',array('label'=>'Start Date','type'=>'text'));									
			echo $this->Form->input('Facture.date2',array('label'=>'End Date','type'=>'text'));
			
  		
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>