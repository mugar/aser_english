<div class="ajax">	
<?php echo $this->Form->create('Historique',array('name'=>'produit_quantites_form','id'=>'Historique_quantites'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Stock</th>
			<th>Quantité</th>
		</tr>
	<?php
	foreach ($quantites as $quantite):
	?>
	<tr>
		<td><?php echo $quantite['Stock']['name']; ?>&nbsp;</td>
		<td><?php echo $quantite['Historique']['debit']-$quantite['Historique']['credit']; ?>&nbsp;</td>
	</tr>
<?php  endforeach; ?>
	</table>
</form>
</div>
