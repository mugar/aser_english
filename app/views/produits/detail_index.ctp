<div class="ajax">	
<?php echo $this->Form->create('ProduitDetail',array('name'=>'produit_details_form','id'=>'ProduitDetail_produitDetails'));?>	
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
			<?php echo $this->Form->input('Id.'.$produitDetail['ProduitDetail']['id'],array('label'=>'','type'=>'checkbox','value'=>$produitDetail['ProduitDetail']['id'])); ?>
		</td>
		<td name="quantite"><?php echo $produitDetail['ProduitDetail']['quantite']; ?>&nbsp;</td>
		<td><?php echo $produitDetail['ProduitDetail']['PA']; ?>&nbsp;</td>
		<td><?php echo $produitDetail['ProduitDetail']['date']; ?>&nbsp;</td>
		<td><?php echo $produitDetail['ProduitDetail']['batch']; ?>&nbsp;</td>
	</tr>
<?php  endforeach; ?>
	</table>
</form>
</div>
