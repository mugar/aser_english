<script>
	jQuery(document).ready(function(){
		jQuery( "#ReservationDate" ).datepicker( "option", "minDate", new Date() );
	});
</script>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('label'=>__('Date de Début',true),'type'=>'text'));
			echo $this->Form->input('date2',array('label'=>__('Date de Fin',true),'type'=>'text'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('Tier.compagnie',array('label'=>'Compagnie du client','type'=>'text'));			
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<h3><?php 
	echo 'LISTE DES PROCHAINS ARRIVAGES';
		if(isset($date1)&&isset($date1)){
			echo '<h4>(Pour la période du '.$this->MugTime->toFrench($date1).' au '.$this->MugTime->toFrench($date2).' )</h4>';
		}
	?>
</h3>
<br>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>N°</th>
			<th>Client</th>
			<th>Compagnie</th>
			<th>Chambre</th>
			<th>Arrivée</th>
			<th>Depart</th>
			<th>PU</th>
			<th>Hébergement</th>
			<th>Etat</th>
	</tr>
		<?php
	$i=0;
	foreach ($reservations as $reservation):
		$i++;
	?>
	<tr>
			<td>
			<?php echo $i; ?>
			</td>
			<td>
			<?php echo $reservation['Tier']['name']; ?>
			</td>
			<td><?php echo  $reservation['Tier']['compagnie']; ?></td>
			<td><?php echo  $reservation['Chambre']['name']; ?></td>
			<td><?php echo  $this->MugTime->toFrench($reservation['Reservation']['arrivee']); ?></td>
			<td><?php echo  $this->MugTime->toFrench($reservation['Reservation']['depart']); ?></td>
			<td><?php echo  $number->format($reservation['Reservation']['PU'],$formatting); ?></td>
			<td><?php echo  $number->format($reservation['Reservation']['montant'],$formatting).' '.$reservation['Reservation']['monnaie']; ?></td>
			<td><?php echo  $reservation['Reservation']['etat']; ?></td>
	</tr>
<?php 
endforeach; ?>
<?php if( $total['USD']!=0):?>
	<tr class="strong">
		<td><?php echo  $i; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo  $number->format($total['USD'],$formatting).' USD'; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<tr>
<?php endif; ?>
<?php if( $total['BIF']!=0):?>
	<tr class="strong">
		<td><?php echo  $i; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo  $number->format($total['BIF'],$formatting).' BIF'; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<tr>
<?php endif; ?>
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
