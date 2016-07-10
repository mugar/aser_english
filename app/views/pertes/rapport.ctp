<div id='view'>
<div class="document">
<h3>Rapport des Pertes</h3>
<br />
<h4><?php echo $periode=(!is_null($date1)&&!is_null($date2))?
						('( From '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).' )'):
						('');?>
</h4>
<br />
<br />
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr>
			<th>Quantité</th>
			<th>Product</th>
			<th>Unit Price</th>
			<th>Amount</th>
			<th>Stock</th>
			<th>Nature</th>
	</tr>
		<?php
	foreach ($pertes as $perte):
		
	?>
	<tr>
			<td><?php echo  $perte['Perte']['quantite'];
					if(isset($unites[$perte['Produit']['unite_id']])) echo ' '.$unites[$perte['Produit']['unite_id']]; 
			?></td>
			<td><?php echo  $perte['Produit']['name']; ?></td>
			<td><?php echo  $number->format($perte['Perte']['PU'],$formatting); ?></td>
			<td><?php echo  $number->format($perte['Perte']['montant'],$formatting); ?></td>
			<td><?php echo  $perte['Stock']['name']; ?></td>
			<td><?php echo  $perte['Perte']['nature']; ?></td>
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
		<li><?php echo $this->Html->link('Lister Pertes', array('controller' => 'pertes', 'action' => 'index')); ?> </li>
	</ul>
</div>

<!--recherche form -->
<?php echo $this->element('../pertes/recherche',array('action'=>'rapport'));?>