<?php
	foreach ($entrees as $entree):
		
	?>
	<tr>
			<td><?php echo  $entree['Tier']['name']; ?></td>
			<td><?php echo  $entree['Facture']['numero']; ?></td>
			<td><?php echo  $entree['Facture']['etat']; ?></td>
			<td><?php echo  $entree['Bon']['numero']; ?></td>
			<td><?php echo  $entree['Product']['name']; ?></td>
			<td><?php echo  $entree['Entree']['quantite']; ?></td>
			<td><?php echo  $entree['Unite']['name']; ?></td>
			<td><?php echo  $entree['Entree']['montant']; ?></td>
			<td><?php echo  $entree['Entree']['monnaie']; ?></td>
			<td><?php echo  $entree['Entree']['echange']; ?></td>
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
		<td><?php echo $total+0; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>