<h3><?php __('Rapport des Subscriptions de la periode entre le '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).' ');?></h3>
<br>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Caisses</th>
			<th>Tier</th>
			<th>Products vendus</th>
			<th>Element</th>
			<th>quantite</th>
			<th>Amount</th>
			<th>Transport</th>
			<th>Total</th>
			<th>Paiement</th>
			<th>Vidange</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($groupSubscriptions as $groupSubscription):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $groupSubscription['Caiss']['name']; ?></td>
			<td><?php echo  $groupSubscription['Tier']['name']; ?></td>
			<td><?php echo  $groupSubscription['Produit']['name']; ?></td>
			<td><?php echo  $groupSubscription['Subscription']['element']; ?></td>
			<td><?php echo  $groupSubscription['Subscription']['quantite']; ?></td>
			<td><?php echo  $groupSubscription['Subscription']['montant']; ?></td>
			<td><?php echo  $groupSubscription['Subscription']['transport']; ?></td>
			<td><?php echo  $groupSubscription['Subscription']['total']; ?></td>
			<td><?php echo  $groupSubscription['Subscription']['paiement']; ?></td>
			<td><?php echo  $groupSubscription['Subscription']['vidange']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo $sumSubscriptions[0]['Subscription']['montant']+0; ?></td>
		<td><?php echo $sumSubscriptions[0]['Subscription']['transport']+0; ?></td>
		<td><?php echo $sumSubscriptions[0]['Subscription']['total']+0; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
