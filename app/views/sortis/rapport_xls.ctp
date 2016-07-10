<h3><?php __('Rapport des Sortis de la periode entre le '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).' ');?></h3>
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
	foreach ($groupSortis as $groupSorti):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $groupSorti['Caiss']['name']; ?></td>
			<td><?php echo  $groupSorti['Tier']['name']; ?></td>
			<td><?php echo  $groupSorti['Produit']['name']; ?></td>
			<td><?php echo  $groupSorti['Sorti']['element']; ?></td>
			<td><?php echo  $groupSorti['Sorti']['quantite']; ?></td>
			<td><?php echo  $groupSorti['Sorti']['montant']; ?></td>
			<td><?php echo  $groupSorti['Sorti']['transport']; ?></td>
			<td><?php echo  $groupSorti['Sorti']['total']; ?></td>
			<td><?php echo  $groupSorti['Sorti']['paiement']; ?></td>
			<td><?php echo  $groupSorti['Sorti']['vidange']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo $sumSortis[0]['Sorti']['montant']+0; ?></td>
		<td><?php echo $sumSortis[0]['Sorti']['transport']+0; ?></td>
		<td><?php echo $sumSortis[0]['Sorti']['total']+0; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
