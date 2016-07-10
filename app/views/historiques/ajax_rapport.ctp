<?php
	foreach ($historiques as $historique):
		
	?>
	<tr>
			<td><?php echo  $historique['Tier']['name']; ?></td>
			<td><?php echo  $historique['Facture']['numero']; ?></td>
			<td><?php echo  $historique['Facture']['etat']; ?></td>
			<td><?php echo  $historique['Bon']['numero']; ?></td>
			<td><?php echo  $historique['Produit']['name']; ?></td>
			<td><?php echo  $historique['Historique']['quantite']; ?></td>
			<td><?php echo  $historique['Unite']['name']; ?></td>
			<td><?php echo  $historique['Historique']['montant']; ?></td>
			<td><?php echo  $historique['Historique']['monnaie']; ?></td>
			<td><?php echo  $historique['Historique']['echange']; ?></td>
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