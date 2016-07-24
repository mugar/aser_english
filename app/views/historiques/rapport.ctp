<div id='view'>
<div class="document">
<h3>Inventory Operations Report</h3>
<br />
<h4><?php echo $periode=(!is_null($date1)&&!is_null($date2))?
						('(From '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).' )'):
						('');?>
</h4>
<br />
<br />
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr>
		<th>Qty</th>
		<th>Product Name</th>
		<th>Unit Price</th>
		<th>Amount</th>
		<th>Operation Type</th>
		<th>Stock</th>
	</tr>
		<?php
	foreach ($historiques as $historique):
		
	?>
	<tr>
		<td><?php echo $historique['Historique']['quantite'].' ';
				if(isset($unites[$historique['Produit']['unite_id']])) echo $unites[$historique['Produit']['unite_id']];?>&nbsp;</td>
		<td><?php echo  $historique['Produit']['name']; ?></td>
		<td><?php echo  $historique['Historique']['PU']; ?></td>
		<td><?php echo  $number->format($historique['Historique']['montant'],$formatting); ?></td>
		<td><?php echo  $inventory_operation_types[$historique['Historique']['libelle']]; ?></td>
		<td><?php echo  $historique['Stock']['name']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr class="strong">
		<td><?php echo $number->format($qty+0,$formatting); ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo $number->format($total+0,$formatting); ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Inventory Operations', array('controller' => 'historiques', 'action' => 'index')); ?> </li>
	</ul>
</div>

<!--recherche form -->
<?php echo $this->element('../historiques/recherche',array('action'=>'rapport'));?>
