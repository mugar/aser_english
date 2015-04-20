<div class="ajax">	
<?php echo $this->Form->create('LocationExtra',array('name'=>'extras_form','id'=>'LocationExtra_locationExtras'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th></th>
			<th>Id</th>
			<th>Libellé</th>
			<th>Quantité</th>
			<th>PU</th>
			<th>Montant</th>
			<th>Monnaie</th>
			<th>Extra ?</th>
		</tr>
	<?php
	foreach ($locationExtras as $locationExtra):
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$locationExtra['LocationExtra']['id'],array('label'=>'','type'=>'checkbox','value'=>$locationExtra['LocationExtra']['id'])); ?>
		</td>
		<td><?php echo $locationExtra['LocationExtra']['id']; ?>&nbsp;</td>
		<td><?php echo $locationExtra['LocationExtra']['name']; ?>&nbsp;</td>
		<td><?php echo $locationExtra['LocationExtra']['quantite']; ?>&nbsp;</td>
		<td><?php echo $locationExtra['LocationExtra']['PU']; ?>&nbsp;</td>
		<td name="montant"><?php echo $locationExtra['LocationExtra']['montant']; ?>&nbsp;</td>
		<td><?php echo $locationExtra['LocationExtra']['monnaie']; ?>&nbsp;</td>
		<td><?php echo $locationExtra['LocationExtra']['extra']; ?>&nbsp;</td>
	</tr>
<?php  endforeach; ?>
	</table>
</form>
</div>
