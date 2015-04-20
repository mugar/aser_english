<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche','action'=>'credit/'.$id));?>
	<span class="left">
		<?php
			echo $this->Form->input('numero',array('label'=>'N° de la facture'));
			if(is_null($id)){
				echo $this->Form->input('tier_id',array('label'=>'Client','selected'=>$id,'options'=>$tiers1));
				echo $this->Form->input('Tier.compagnie');
			}
		?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('date1',array('label'=>'Choisissez une date début','type'=>'text'));				
		echo $this->Form->input('date2',array('label'=>'et une date fin pour la recherche','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<?php if(is_null($id)):?>
	<h3>LISTE DES DEBITEURS</h3>
<?php else:?>
	<h3>LISTE DES FACTURES DU CLIENT : <?php echo $tierInfo['Tier']['name'];?></h3>
<?php endif;?>
<br />
	<?php
		if(isset($date1)&&isset($date2)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).')</h4>';
		}
	?>

<br />
<br />
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>N°</th>
			<th>Compagnie</th>
			<th width="100">Montant (BIF)</th>
			<th width="100">Montant (USD)</th>
			<th>Date</th>
			<th>N° Facture</th>
			<th>Etat de la facture</th>
			<th>Client</th>
			<th>Téléphone</th>
			<th width="150">Observation</th>
	</tr>
		<?php
		$BIF=$USD=0;
	foreach ($factures as $key=>$facture):
		
	?>
	<tr>
			<td><?php echo $key+1; ?></td>
			<td><?php echo $facture['Tier']['compagnie']; ?></td>
			<td><?php if($facture['Facture']['monnaie']=='BIF') echo  $number->format($facture['Facture']['reste'],$formatting);?></td>
			<td><?php if($facture['Facture']['monnaie']=='USD') echo  $number->format($facture['Facture']['reste'],$formatting);?></td>
			<td><?php echo  $this->MugTime->tofrench($facture['Facture']['date']); ?></td>
			<td >
				<?php echo $this->Html->link($facture['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $facture['Facture']['id']),array('target'=>'blank')); ?>
			</td>
			<td><?php echo $facture['Facture']['etat']; ?></td>
			<td><?php echo $facture['Tier']['name']; ?></td>
			<td><?php echo $facture['Tier']['telephone']; ?></td>
			<td><?php echo $facture['Facture']['observation']; ?></td>
	</tr>
<?php 
	if($facture['Facture']['monnaie']=='USD')
		$USD+=$facture['Facture']['reste'];
	else 
		$BIF+=$facture['Facture']['reste'];
	endforeach; 
?>
	<tr class="strong">
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td><?php echo  $number->format($BIF+0,$formatting).' BIF'; ?></td>
		<td><?php echo  $number->format($USD+0,$formatting).' USD'; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
</form>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link('Liste des Factures', array('controller' => 'factures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link('Retour En arrière', $referer); ?> </li>
	</ul>
</div>
	
<!-- form for paiement creation -->
<?php echo $this->element('../paiements/edit',array('reste'=>0,'action'=>'mass_payment'));?>
