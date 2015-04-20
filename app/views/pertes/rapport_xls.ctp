<h3><?php __('Rapport des Pertes de la periode entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).' ');?></h3>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Produit</th>
			<th>Element</th>
			<th>nature</th>
			<th>quantite</th>
			<th>total</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($groupPertes as $groupPerte):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $groupPerte['Produit']['name']; ?></td>
			<td><?php echo  $groupPerte['Perte']['element']; ?></td>
			<td><?php echo  $groupPerte['Perte']['nature']; ?></td>
			<td><?php echo  $groupPerte['Perte']['quantite']; ?></td>
			<td><?php echo  $groupPerte['Perte']['total']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
			<td>TOTAL des Pertes</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><?php echo  $sumPertes[0]['Perte']['total']; ?></td>
	</tr>
</table>