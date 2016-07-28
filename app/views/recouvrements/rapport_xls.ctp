<h3><?php __('Rapport des Recouvrements de la periode entre le '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).' ');?></h3>
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
	foreach ($groupRecouvrements as $groupRecouvrement):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $groupRecouvrement['Caiss']['name']; ?></td>
			<td><?php echo  $groupRecouvrement['Tier']['name']; ?></td>
			<td><?php echo  $groupRecouvrement['Produit']['name']; ?></td>
			<td><?php echo  $groupRecouvrement['Recouvrement']['element']; ?></td>
			<td><?php echo  $groupRecouvrement['Recouvrement']['quantite']; ?></td>
			<td><?php echo  $groupRecouvrement['Recouvrement']['montant']; ?></td>
			<td><?php echo  $groupRecouvrement['Recouvrement']['transport']; ?></td>
			<td><?php echo  $groupRecouvrement['Recouvrement']['total']; ?></td>
			<td><?php echo  $groupRecouvrement['Recouvrement']['paiement']; ?></td>
			<td><?php echo  $groupRecouvrement['Recouvrement']['vidange']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo $sumRecouvrements[0]['Recouvrement']['montant']+0; ?></td>
		<td><?php echo $sumRecouvrements[0]['Recouvrement']['transport']+0; ?></td>
		<td><?php echo $sumRecouvrements[0]['Recouvrement']['total']+0; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
