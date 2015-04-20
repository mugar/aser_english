<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('label'=>'Choisissez une date début','type'=>'text'));	
			
			echo $this->Form->input('date2',array('label'=>'et une date fin pour le rapport','type'=>'text'));
		?>
	</span>
	<span class="right">
		<?php
			
			echo $this->Form->input('compagnie',array('label'=>'Compagnie du Client'));
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
	echo 'Rapport des Paiements';
		if(isset($date1)){
			echo '<h4>( '.$this->MugTime->toFrench($date1).'-'.$this->MugTime->toFrench($date2).' )</h4>';
		}
	?>
</h3>
<br>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Date</th>
			<th>Client</th>
			<th>Compagnie</th>
			<th>Chambre</th>
			<th width="150">Montant</th>
			<th>Mode de Paiement</th>
			<th>Facture N°</th>
			<th>Récu N°</th>
			<th>Heure de Création</th>
	</tr>
		<?php
	foreach ($pyts as $pyt):
	
	?>
	<tr>
			
			<td><?php echo  $this->MugTime->toFrench($pyt['Paiement']['date']); ?></td>
			<td>
			<?php echo $pyt['client']['name']; ?>
			</td>
			<td><?php echo  $pyt['client']['compagnie']; ?></td>
			<td><?php echo  $pyt['chambres']; ?></td>
			<td><?php  echo  $number->format($pyt['Paiement']['montant'],$formatting).' '.$pyt['Facture']['monnaie']; ?></td>
			<td><?php echo  $pyt['Paiement']['mode_paiement']; ?></td>
			<td>
			<?php echo $this->Html->link($pyt['Facture']['numero'], array('controller' => 'reservations', 'action' => 'extras', $pyt['client']['id'],$pyt['Facture']['id'],true)); ?>
			</td>
			<td>
			<?php echo $this->Html->link($pyt['Paiement']['id'], array('controller' => 'paiements', 'action' => 'recu', $pyt['Paiement']['id'])); ?>
			</td>
			<td><?php echo  $pyt['Paiement']['created']; ?></td>
	</tr>
<?php endforeach; ?>
<?php foreach ($sums as $sum):?>
	<tr class="strong">
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo $number->format($sum['Paiement']['montant'],$formatting).' '.$sum['Facture']['monnaie'];?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<?php endforeach; ?>
</table>
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
