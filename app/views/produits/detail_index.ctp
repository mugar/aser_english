<div class="ajax">	
<?php echo $this->Form->create('ProductDetail',array('name'=>'produit_details_form','id'=>'ProductDetail_produitDetails'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th></th>
			<th>Quantité</th>
			<th>PA</th>
			<th>Date</th>
			<th>Batch N°</th>
		</tr>
	<?php
	foreach ($produitDetails as $produitDetail):
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$produitDetail['ProductDetail']['id'],array('label'=>'','type'=>'checkbox','value'=>$produitDetail['ProductDetail']['id'])); ?>
		</td>
		<td name="quantite"><?php echo $produitDetail['ProductDetail']['quantite']; ?>&nbsp;</td>
		<td><?php echo $produitDetail['ProductDetail']['PA']; ?>&nbsp;</td>
		<td><?php echo $produitDetail['ProductDetail']['date']; ?>&nbsp;</td>
		<td><?php echo $produitDetail['ProductDetail']['batch']; ?>&nbsp;</td>
	</tr>
<?php  endforeach; ?>
	</table>
</form>
</div>
