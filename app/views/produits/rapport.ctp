<div id='view'>
<div class="document">
<h3>Inventory Closing Report <?php if(!empty($stock)) echo '(Stock : '.ucfirst($stock['Stock']['name']).')';?></h3>
<br />
<h4><?php echo '(For '.date('d/m/Y').' at '.date('H:i');
		 echo '. '.count($datas).' products in total';
		echo ')';
?></h4>
<br/>
<br/>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Product Name</th>
			<th>Group</th>
			<th>Quantity</th>
			<th>Purchase Price</th>
			<th>Total</th>
	</tr>
		<?php
	foreach ($datas as $num=>$data):
		
	?>
	<tr>
			<td><?php echo  $data['Produit']; ?></td>
			<td><?php echo  $data['Groupe']; ?></td>
			<td><?php echo  $number->format($data['Quantité'],$formatting).' '.$data['Unité']; ?></td>
			<td><?php echo  $number->format($data['PA'],$formatting); ?></td>
			<td><?php echo  $number->format($data['Total'],$formatting); ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo $number->format($pvs,$formatting); ?></td>
	<tr>
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
<?php echo $this->element('../produits/recherche',array('action'=>'rapport'));?>
