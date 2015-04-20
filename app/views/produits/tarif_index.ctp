<div class="ajax">	
<?php echo $this->Form->create('Tarif',array('name'=>'produit_tarifs_form','id'=>'Tarif_tarifs'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th></th>
			<th>Nom</th>
			<th>PV</th>
		</tr>
	<?php
	foreach ($tarifs as $tarif):
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$tarif['Tarif']['id'],array('label'=>'','type'=>'checkbox','value'=>$tarif['Tarif']['id'])); ?>
		</td>
		<td><?php echo $tarif['Tarif']['name']; ?>&nbsp;</td>
		<td><?php echo $tarif['Tarif']['PV']; ?>&nbsp;</td>
	</tr>
<?php  endforeach; ?>
	</table>
</form>
</div>
