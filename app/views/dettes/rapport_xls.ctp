<h3><?php __('Rapport des Dettes de la periode entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).' ');?></h3>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Caisse</th>
			<th>Tier</th>
			<th>montant</th>
			<th>montant paye</th>
			<th>reste</th>
			<th>Echeance</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($groupDettes as $groupDette):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $groupDette['Caiss']['name']; ?></td>
			<td><?php echo  $groupDette['Tier']['name']; ?></td>
			<td><?php echo  $groupDette['Dette']['montant']; ?></td>
			<td><?php echo  $groupDette['Dette']['montant_paye']; ?></td>
			<td><?php echo  $groupDette['Dette']['reste']; ?></td>
			<td><?php echo  $groupDette['Dette']['echeance']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
			<td>TOTAL des Dettes</td>
			<td>&nbsp;</td>
			<td><?php echo  $sumDettes[0]['Dette']['montant']; ?></td>
			<td><?php echo  $sumDettes[0]['Dette']['montant_paye']; ?></td>
			<td><?php echo  $sumDettes[0]['Dette']['reste']; ?></td>
			<td>&nbsp;</td>
	</tr>
</table>
