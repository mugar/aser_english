
<?php $config=Configure::read('aser'); ?>
<div id='view'>
<div class="document">
<h3><?php echo 'Report for Not Sent Orders';
	?>
	<?php if(!is_null($date1)&&!is_null($date2)) :?>
	<h4><?php echo '<h4>(From '.$this->MugTime->toFrench($date1).' to ';
			  echo 	$this->MugTime->toFrench($date2).')</h4>';
			  echo 'Records total : '.count($ventes);
		 ?>
	 </h4>
	<?php endif;?>
</h3>
<br />
<table cellpadding="0" cellspacing="0" class="aser_sort">
<thead>
	<tr>
			<th>Date</th>
			<th>Product</th>
			<th>Invoiced Qty</th>
			<th>Sent Qty</th>
			<th>Not Sent Qty</th>
			<th >Invoice N°</th>
	</tr>
</thead>
<tbody>
		<?php
	$i = 0;
	foreach ($ventes as $vente):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			
			<td><?php echo  $vente['Facture']['date']; ?></td>
			<td>
				<?php echo $vente['Produit']['name']; ?>
			</td>
			<td><?php echo  $number->format($vente['Vente']['quantite'],$formatting); ?></td>
			<td><?php echo  $number->format($vente['Vente']['printed'],$formatting); ?></td>
			<td><?php echo  $number->format($vente['Vente']['quantite']-$vente['Vente']['printed'],$formatting); ?></td>
			<td>
				<?php echo $this->Html->link($vente['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $vente['Facture']['id'])); ?>
			</td>
			
	</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents(0)" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
	</ul>
</div>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Vente',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('label'=>'Start Date','type'=>'text'));		
		?>
	</span>
	<span class="right">
		<?php							
			echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));
			?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>