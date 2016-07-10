<div id='view'>
<div class="document">
<h3>Rapport des Sorties</h3>
<br/>
<?php 
	$periode=(!is_null($date1)&&!is_null($date2))?('pour la période entre le '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).''):('');
	if($periode!='') echo '<h4>('.$periode.')</h4>';
	?>
<br/>
<br/>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Quantité</th>
			<th>Product</th>
			<th>Unit Price</th>
			<th>Amount</th>
			<th>Stock</th>
			<th>Observation</th>
	</tr>
		<?php
	foreach ($sortis as $sorti):
	
	?>
	<tr>
			<td><?php echo  $number->format($sorti['Sorti']['quantite'],$formatting).' '.$unites[$sorti['Produit']['unite_id']]; ?></td>
			<td><?php echo  $sorti['Produit']['name']; ?></td>
			<td><?php echo  $sorti['Sorti']['PU']; ?></td>
			<td><?php echo  $number->format($sorti['Sorti']['montant'],$formatting); ?></td>
			<td><?php echo  $sorti['Stock']['name']; ?></td>
			<td><?php echo  $sorti['Sorti']['observation']; ?></td>
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
		<li><?php echo $this->Html->link('Liste des Sorties', array('controller' => 'sortis', 'action' => 'index')); ?> </li>
	</ul>
</div>
<!--recherche form -->
<?php echo $this->element('../sortis/recherche',array('action'=>'rapport'));?>
