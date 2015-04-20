<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('numero',array('value'=>'','label'=>'N° de la facture'));
			echo $this->Form->input('tier_id',array('label'=>'Client','multiple'=>true,'options'=>$tiers1));
			echo $this->Form->input('Facture.etat',array('options'=>array('toutes'=>'toutes',
																					'payee'=>'payee',
																					'credit'=>'credit',
																					'bonus'=>'bonus',
																					'avance'=>'avance',
																					'annulee'=>'annulee'
																					),
																'multiple'=>true,
																'selected'=>'toutes',
																'label'=>'Etat de la facture'
																	));
			
			echo $this->Form->input('operation',array('label'=>'Type de Facture','options'=>$models));
			if(!Configure::read('aser.magasin')&&(Configure::read('aser.POS')))
				echo $this->Form->input('Facture.personnel_id',array('selected'=>0,'options'=>$serveurs));
		?>
	</span>
	<span class="right">
		<?php
		
			echo $this->Form->input('Tier.compagnie',array('value'=>''));
		echo $this->Form->input('monnaie',array('options'=>$monnaies));
		echo $this->Form->input('date1',array('label'=>'Choisissez une date début','type'=>'text'));				
		echo $this->Form->input('date2',array('label'=>'et une date fin pour la recherche','type'=>'text'));
		//echo $this->Form->input('export',array('label'=>'Répartition par Personnel','type'=>'checkbox'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<h3>Rapport des Factures<?php if($monnaie) echo ' ('.$monnaie.')';?></h3>
<br />
	<?php
		if(isset($date1)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).', '.count($factures).' factures au total)</h4>';
		}
	?>

<br />
<br />
<?php echo $this->Form->create('Paiement',array('name'=>'checkbox','action'=>'mass_payment'));?>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th width="200">Tier</th>
			<th width="100">Facture</th>
			<th>Etat</th>
			<th width="200">Montant</th>
			<th width="300">Reste A Payer</th>
			<th width="300">Deposit</th>
			<?php if(!Configure::read('aser.magasin')&&(Configure::read('aser.POS'))):?>
				<th>Serveur</th>
			<?php endif;?>
			<th>Date</th>
		
	</tr>
		<?php
	foreach ($factures as $facture):
		
	?>
	<tr>
			<td>
				<?php echo $this->Form->input('Id.'.$facture['Facture']['id'],array('label'=>'','type'=>'checkbox','value'=>$facture['Facture']['id'])); ?>
			</td>
			<td >
				<?php echo $this->Html->link($facture['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $facture['Tier']['id'])); ?>
			</td>
			<td >
				<?php echo $this->Html->link($facture['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $facture['Facture']['id'])); ?>
			</td>
			<td name="etat"><?php echo  $facture['Facture']['etat']; ?></td>
			<td><?php echo  $number->format($facture['Facture']['montant'],$formatting).' '.$facture['Facture']['monnaie']; ?></td>
			<td name="reste" montant="<?php echo $facture['Facture']['reste'];?>"><?php echo  $number->format($facture['Facture']['reste'],$formatting).' '.$facture['Facture']['monnaie']; ?></td>
			<td><?php echo  $number->format($facture['Facture']['deposit'],$formatting).' '.$facture['Facture']['monnaie']; ?></td>
			<?php if(!Configure::read('aser.magasin')&&(Configure::read('aser.POS'))):?>
				<td><?php echo  $facture['Personnel']['name']; ?></td>
			<?php endif;?>
			<td><?php echo  $this->MugTime->tofrench($facture['Facture']['date']); ?></td>
	</tr>
<?php endforeach; ?>
<?php foreach(array('BIF','USD') as $monnaie):?>
	<tr class="strong" id="total" >
		<td width="200" colspan="2">TOTAL EN (<?php echo $monnaie;?>)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo  $number->format($sum['montant_'.$monnaie]+0,$formatting); ?></td>
		<td id="reste" montant="<?php echo $sum['reste_'.$monnaie]; ?>"><?php echo  $number->format($sum['reste_'.$monnaie]+0,$formatting); ?></td>
		<td><?php echo  $number->format($sum['deposit_'.$monnaie]+0,$formatting); ?></td>
		<?php if(!Configure::read('aser.magasin')&&(Configure::read('aser.POS'))):?>
			<td>&nbsp;</td>
		<?php endif;?>
		<td>&nbsp;</td>
	</tr>
<?php endforeach; ?>
</table>
</form>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li class="link"  onclick = "mass_pyt('off')" >Paiement en masse</li>
		<li><?php echo $this->Html->link('Liste des Factures', array('controller' => 'factures', 'action' => 'index')); ?> </li>
	</ul>
</div>
	
<!-- form for paiement creation -->
<?php echo $this->element('../paiements/edit',array('reste'=>0,'action'=>'mass_payment'));?>
