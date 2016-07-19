
<div id='view'>
<div class="document">

<h3> Rapport Des Ventes
	<?php if(!is_null($date)&&!is_null($date1)) :?>
	<h4><?php echo '<h4>(From '.$this->MugTime->toFrench($date).' to ';
			  echo 	$this->MugTime->toFrench($date1).')</h4>';
		 ?>
	 </h4>
	<?php endif;?>
</h3>
	
		<br>
		
<div>
	
</div>
<table cellpadding="0" cellspacing="0" id="journal_resume">
	<tr>
			<th align="center" colspan="2">RESUME</th>
	</tr>
	
	<tr>
		<td> VENTES GLOBAL</td>
		<td><?php echo  $number->format($total_factures['resto']+0,$formatting); ?></td>
	</tr>
	<tr>
		<td> VENTES CASH</td>
		<td><?php echo  $number->format($total_cash['resto']+0,$formatting); ?></td>
	</tr>
	<tr>
		<td> VENTES CREDITS</td>
		<td><?php echo  $number->format($total_credits['resto']+0,$formatting); ?></td>
	</tr>
	<?php if(Configure::read('aser.bonus')):?>
	<tr>
		<td> VENTES BONUS</td>
		<td><?php echo  $number->format($bonus+0,$formatting); ?></td>
	</tr>
	<?php endif;?>
	<tr>
		<td>PAIEMENTS</td>
		<td><?php echo  $number->format($total_pyts['resto']+0,$formatting); ?></td>
	</tr>
	<tr>
		<td> DEPENSES</td>
		<td><?php echo  $number->format($total_depenses+0,$formatting); ?></td>
	</tr>
	
	<tr>
		<td> AJOUTS</td>
		<td><?php echo  $number->format($total_ajouts+0,$formatting); ?></td>
	</tr>
	<tr>
		<td> VERSEMENT</td>
		<td><?php echo  $number->format($versement+0,$formatting); ?></td>
	</tr>
	<?php if($global=='yes'):?>
	<tr>
		<td>RESULTAT</td>
		<td><?php echo  $number->format($resultat+0,$formatting); ?></td>
	</tr>
	<?php endif;?>
</table>

<span class="titre" onclick="jQuery('#pytTab').slideToggle()" style='cursor:pointer;'>Paiements</span>
<br>
<table cellpadding="0" cellspacing="0" id="pytTab" style='display:none;'>
	<tr>	
			<th>Tier</th>
			<th>Facture</th>
			<th>Amount</th>
			<th>Montant Equivalent</th>
			<th>Currency</th>
			<th>Caisse</th>
			<th>Payment Mode</th>
			<th>Réference</th>
			<th>Paiement Par</th>
			<th>Date</th>
	</tr>
		<?php
	foreach ($pyts as $pyt):
	?>
	<tr>
			<td>
			<?php echo $this->Html->link($pyt['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $pyt['Tier']['id'])); ?>
		   </td>
			<td>
			<?php echo $this->Html->link($pyt['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $pyt['Facture']['id'])); ?>
		   </td>
			<td><?php echo  $number->format($pyt['Paiement']['montant']); ?></td>
			<td><?php echo  $number->format($pyt['Paiement']['montant_equivalent']); ?></td>
			<td><?php echo  $pyt['Paiement']['monnaie']; ?></td>
			<td><?php echo  $pyt['Caiss']['name']; ?></td>
			<td><?php echo  $pyt['Paiement']['mode_paiement']; ?></td>
			<td><?php echo  $pyt['Paiement']['reference']; ?></td>	
			<td><?php echo  $pyt['Paiement']['par']; ?></td>	
			<td><?php echo  $pyt['Paiement']['date']; ?></td>	
	</tr>
<?php endforeach; ?>
	
</table>
</br>

<span class="titre" onclick="jQuery('#depensesTab').slideToggle()" style='cursor:pointer;'>Dépenses</span>
<br>
<table cellpadding="0" cellspacing="0" id="depensesTab" style='display:none;'>
	<tr>
			<th>Libéllé</th>
			<th>Amount</th>
			<th>Description</th>
			<th>Date</th>
	</tr>
		<?php
	$i = 0;
	foreach ($retraits as $retrait):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $retrait[$model2]['name']; ?></td>
			<td><?php echo  $number->format($retrait[$model1]['credit']); ?></td>
			<td><?php echo  $retrait[$model1]['libelle']; ?></td>
			<td><?php echo  $retrait[$model1]['date']; ?></td>
	</tr>
<?php endforeach; ?>
</table>

<span class="titre" onclick="jQuery('#ajoutsTab').slideToggle()" style='cursor:pointer;'>Ajouts</span>
<br>
<table cellpadding="0" cellspacing="0" id="ajoutsTab" style='display:none;'>
	<tr>
			<th>Libellé</th>
			<th>Amount</th>
			<th>Description</th>
			<th>Date</th>
	</tr>
		<?php
	$i = 0;
	foreach ($ajouts as $ajout):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $ajout[$model2]['name']; ?></td>
			<td><?php echo  $number->format($ajout[$model1]['debit']); ?></td>
			<td><?php echo  $ajout[$model1]['libelle']; ?></td>
			<td><?php echo  $ajout[$model1]['date']; ?></td>
	</tr>
<?php endforeach; ?>
</table>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><a href="#"  onclick = "print_documents(jQuery('#etat_journal').attr('closed'))" >Print</a> </li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Lister Factures', array('controller' => 'factures', 'action' => 'index')); ?> </li>
		<li><?php
			$action=(Configure::read('aser.touchscreen'))?'touchscreen':'index';
			 echo $this->Html->link('Interface de Vente', array('controller' => 'ventes', 'action' => $action)); ?> </li>
	</ul>
</div>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Vente',array('id'=>'recherche','action'=>'rapport'));?>
	<span class="left">
		<?php
			echo $this->Form->input('Journal.date',array('label'=>'Start Date','type'=>'text','value'=>date('Y-m-d')));
		?>
	</span>
	<span class="right">
		<?php
			
			echo $this->Form->input('Journal.date1',array('label'=>'Et une date de fin','type'=>'text'));
			echo $this->Form->input('Journal.global',array('type'=>'hidden','value'=>'no'));
			if(Configure::read('aser.comptabilite'))
				echo $this->Form->input('Journal.compta',array('label'=>'Tirer les Dépenses de la comptabilité ?','type'=>'hidden','value'=>'no'));		
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>