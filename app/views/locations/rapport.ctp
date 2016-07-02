<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Location',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('Facture.tier_id',array('selected'=>0,'options'=>$tiers1));
			echo $this->Form->input('Facture.etat',array('options'=>array('toutes'=>'toutes',
																					'payee'=>'payee',
																					'credit'=>'credit',
																					'bonus'=>'bonus',
																					'avance'=>'avance',
																					'proforma'=>'proforma'
																					),
																'multiple'=>true,
																'selected'=>'toutes'
																	));
			
		?>
	</span>
	<span class="right">
		<?php
		
		echo $this->Form->input('Facture.date1',array('label'=>'Start Date','type'=>'text'));				
		echo $this->Form->input('Facture.date2',array('label'=>'et une date fin pour la recherche','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<h3>Rapport de la location des salles</h3>
<br />
	<?php
		if(isset($date1)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).')</h4>';
		}
	?>

<br />
<br />
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Date</th>
			<th>Salle</th>
			<th>Nombre de jours</th>
			<th width="150">Customer</th>
			<th>Facture</th>
			<th>State</th>
			<th width="150">Montant</th>
			<th width="150">Reste A Payer</th>
	</tr>
		<?php
	foreach ($locations as $location):
		
	?>
	<tr>
			<td><?php echo  $this->MugTime->tofrench($location['Facture']['date']); ?></td>
			<td><?php echo $location['Salle']['name']; ?></td>
			<td><?php echo $location['Location']['jours']; ?></td>
			<td><?php echo $location['Tier']['name']; ?></td>
			<td >
				<?php 
				$proforma=($location['Facture']['etat']=='proforma')?'proforma':'';
				echo $this->Html->link($location['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $location['Facture']['id'],$proforma),array('target'=>'blank')); ?>
			</td>
			<td name="etat"><?php echo  $location['Facture']['etat']; ?></td>
			<td><?php echo  $number->format($location['Facture']['montant'],$formatting).' '.$location['Facture']['monnaie']; ?></td>
			<td><?php echo  $number->format($location['Facture']['reste'],$formatting).' '.$location['Facture']['monnaie']; ?></td>
	</tr>
<?php 
endforeach; ?>
	<tr class="strong" id="total" >
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo  $number->format($montant+0,$formatting); ?></td>
		<td><?php echo  $number->format($reste+0,$formatting); ?></td>
	</tr>
</table>
</form>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Gestion des Locations', array('controller' => 'locations', 'action' => 'tabella')); ?> </li>
		<li><?php echo $this->Html->link('Page d\'acceuil', '/'); ?> </li>
	</ul>
</div>
	
<!-- form for paiement creation -->
<?php echo $this->element('../paiements/edit',array('reste'=>0,'action'=>'mass_payment'));?>
