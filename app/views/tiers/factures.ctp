
<br>
<h4>Factures</h4>
<br>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Numero</th>
			<th>Opération</th>
			<th>Amount</th>
			<th>Reste</th>
			<th>Currency</th>
			<th>State Paiement</th>
			<th>Date</th>
			<th>Echéance</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($factures as $facture):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($facture['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $facture['Facture']['id'])); ?>
		</td>
		<td><?php echo $facture['Facture']['operation']; ?>&nbsp;</td>
		<td><?php echo $facture['Facture']['montant']; ?>&nbsp;</td>
		<td><?php echo $facture['Facture']['reste']; ?>&nbsp;</td>
		<td><?php echo $facture['Facture']['monnaie']; ?>&nbsp;</td>		
		<td><?php echo $facture['Facture']['etat']; ?>&nbsp;</td>
		<td><?php echo $facture['Facture']['date']; ?>&nbsp;</td>
		<td><?php echo $facture['Facture']['echeance']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
</table>
