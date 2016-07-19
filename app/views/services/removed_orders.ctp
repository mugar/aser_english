
<?php $config=Configure::read('aser'); ?>
<div id='view'>
<div class="document">
<h3><?php echo 'Report For Removed Orders';
	?>
	<?php if(!is_null($date1)&&!is_null($date2)) :?>
	<h4><?php echo '<h4>(From '.$this->MugTime->toFrench($date1).' to ';
			  echo 	$this->MugTime->toFrench($date2).')</h4>';
			  echo 'Records Total : '.count($vente_effaces);
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
			<th>Qty</th>
			<th>Unit Price</th>
			<th>Total Price</th>
			<th >Invoice N°</th>
			<th >Deleted by</th>
			<th >Comments</th>
	</tr>
</thead>
<tbody>
		<?php
	$i = 0;
	foreach ($vente_effaces as $vente_efface):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			
			<td><?php echo  $vente_efface['VenteEfface']['date']; ?></td>
			<td>
				<?php echo $vente_efface['Produit']['name']; ?>
			</td>
			<td><?php echo  $number->format($vente_efface['VenteEfface']['quantite'],$formatting); ?></td>
			<td><?php echo  $number->format($vente_efface['VenteEfface']['PU'],$formatting); ?></td>
			<td><?php echo  $number->format($vente_efface['VenteEfface']['montant'],$formatting); ?></td>
			<td>
				<?php echo $this->Html->link($vente_efface['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $vente_efface['Facture']['id'])); ?>
			</td>
			<td><?php echo  $vente_efface['Personnel']['name']; ?></td>
			<td><?php echo  $vente_efface['VenteEfface']['observation']; ?></td>
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