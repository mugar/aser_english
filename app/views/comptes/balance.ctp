
<div id='view'>
<div class="document">
<h3>BALANCE</h3>

<table cellpadding="0" cellspacing="0" id="recherche">
	<tr>
			<th>Numéro</th>
			<th>Compte</th>
			<th>Débit</th>
			<th>Crédit</th>
			<th>Solde débiteur</th>
			<th>Solde créditeur</th>
	</tr>
		<?php
	foreach ($sums as $sum):
		
	?>
	<tr>
			<td><?php echo  $sum['numero']; ?></td>
			<td><?php echo  $sum['name']; ?></td>
			<td><?php echo  $sum['debit']+0; ?></td>
			<td><?php echo  $sum['credit']+0; ?></td>
			<td><?php echo  $sum['debiteur']+0; ?></td>
			<td><?php echo  $sum['crediteur']+0; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
			<td></td>
			<td></td>
			<td><?php echo  $total['debit']+0; ?></td>
			<td><?php echo  $total['credit']+0; ?></td>
			<td><?php echo  $total['debiteur']+0; ?></td>
			<td><?php echo  $total['crediteur']+0; ?></td>
	</tr>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Print</li>
	</ul>
</div>
