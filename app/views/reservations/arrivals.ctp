<script>
	jQuery(document).ready(function(){
		jQuery( "#ReservationDate" ).datepicker( "option", "minDate", new Date() );
	});
</script>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('label'=>__('Start Date',true),'type'=>'text'));
			echo $this->Form->input('date2',array('label'=>__('End Date',true),'type'=>'text'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('Tier.compagnie',array('label'=>'Customer Company','type'=>'text'));			
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<h3><?php 
	echo 'UPCOMING ARRIVALS LIST';
		if(isset($date1)&&isset($date1)){
			echo '<h4>(From '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).' )</h4>';
		}
	?>
</h3>
<br>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>N°</th>
			<th>Customer</th>
			<th>Company</th>
			<th>Room N°</th>
			<th>Arrival</th>
			<th>Departureure</th>
			<th>Unit Price</th>
			<th>Total</th>
			<th>State</th>
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
			<td><?php echo  $number->format($reservation['Reservation']['PU'],$formatting).' '.$reservation['Reservation']['monnaie']; ?></td>
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
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Bookings Management', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
	</ul>
</div>
