<div class="ajax">	
<?php echo $this->Form->create('Detail',array('name'=>'produit_details_form','id'=>'Detail_details'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Date</th>
			<th>Batch N°</th>
			<th>Quantité</th>
			<th>PA</th>
			<th>Total (CSV)</th>
		</tr>
	<?php
	foreach ($details as $detail):
	?>
	<tr>
		<td><?php echo $detail['Detail']['date']; ?>&nbsp;</td>
		<td><?php echo $detail['Detail']['batch']; ?>&nbsp;</td>
		<td><?php echo $detail['Detail']['quantite']; ?>&nbsp;</td>
		<td><?php echo $detail['Detail']['PA']; ?>&nbsp;</td>
		<td><?php echo $detail['Detail']['total']; ?>&nbsp;</td>
	</tr>
<?php  endforeach; ?>
	<tr>
		<td><strong>TOTAL (CSV)</strong></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><strong><?php echo $total; ?></strong></td>
	</tr>
	</table>
</form>
</div>
