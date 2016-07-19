<div id='view'>
<div class="document">
<h3><?php echo 'Rapport des Réservations';
		if(isset($date1)){
			echo 'de la période entre le '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2);
		}
	?>
</h3>
<br>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Tier</th>
			<th>Facture</th>
			<th>State de Paiement</th>
			<th>Type Chambre</th>
			<th>Nombre</th>
			<th>Adultes</th>
			<th>Enfants</th>
			<th>Arrivee</th>
			<th>Departure</th>
			<th>Unit Price</th>
			<th>Amount</th>
			<th>Currency</th>
			<th>State Réservation</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($groupReservations as $groupReservation):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $groupReservation['Tier']['name']; ?></td>
			<td name="facture" valeur="<?php echo $groupReservation['Facture']['id']; ?>">
				<?php echo $this->Html->link($groupReservation['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $groupReservation['Facture']['id'])); ?>
			</td>
			<td><?php echo  $groupReservation['Facture']['etat']; ?></td>
			<td><?php echo  $groupReservation['TypeChambre']['name']; ?></td>
			<td><?php echo  $groupReservation['Reservation']['nombre']; ?></td>
			<td><?php echo  $groupReservation['Reservation']['adultes']; ?></td>
			<td><?php echo  $groupReservation['Reservation']['enfants']; ?></td>
			<td><?php echo  $groupReservation['Reservation']['checked_in']; ?></td>
			<td><?php echo  $groupReservation['Reservation']['depart']; ?></td>
			<td><?php echo  $groupReservation['Reservation']['PU']; ?></td>
			<td><?php echo  $groupReservation['Reservation']['montant']; ?></td>
			<td><?php echo  $groupReservation['Reservation']['monnaie']; ?></td>
			<td><?php echo  $groupReservation['Reservation']['etat']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo $totaux['montant']+0; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<tr>
</table>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Liste des Reservations', array('controller' => 'reservations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link('Bookings Management', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
	</ul>
</div>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('Tier.name',array('value'=>'toutes','label'=>'Nom du client'));
			echo $this->Form->input('type_chambre_id',array('selected'=>0,'label'=>'Catégorie de la chambre'));
			echo $this->Form->input('etat',array('label'=>'Choisir l\'etat',
												'options'=>array('toutes'=>'toutes',
																'confirmed'=>'confirmed',
																'pending'=>'pending',
																'checked_out'=>'checked_out',
																'checked_in'=>'checked_in',
																'canceled'=>'canceled'
																)
												)
									);
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('date1',array('label'=>'Start Date','type'=>'text'));									
			echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));
  			$options=array('1'=>'Répartition par tier',
   						  '2'=>'Comparaison de deux années'
   						  );
   			$attributes=array('legend'=>false,'value'=>false);
    		echo $form->radio('export',$options,$attributes);
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>