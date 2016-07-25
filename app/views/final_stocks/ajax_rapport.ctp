<?php
	foreach ($final_stocks as $final_stock):
		
	?>
	<tr>
			<td><?php echo  $final_stock['Tier']['name']; ?></td>
			<td><?php echo  $final_stock['Facture']['numero']; ?></td>
			<td><?php echo  $final_stock['Facture']['etat']; ?></td>
			<td><?php echo  $final_stock['Bon']['numero']; ?></td>
			<td><?php echo  $final_stock['Produit']['name']; ?></td>
			<td><?php echo  $final_stock['FinalStock']['quantite']; ?></td>
			<td><?php echo  $final_stock['Unite']['name']; ?></td>
			<td><?php echo  $final_stock['FinalStock']['montant']; ?></td>
			<td><?php echo  $final_stock['FinalStock']['monnaie']; ?></td>
			<td><?php echo  $final_stock['FinalStock']['echange']; ?></td>
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