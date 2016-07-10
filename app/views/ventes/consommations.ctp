<script>
 jQuery.noConflict();
 jQuery(document).ready(function(){
 	 jQuery('th[data-sort]').each(function(){
      	jQuery(this).attr('title','Cliquer pour trier');
      });
 	var table=jQuery('.aser_sort').stupidtable();

      table.bind('aftertablesort', function (event, data) {
        var th = jQuery(this).find("th");
        th.find(".arrow").remove();
        var arrow = data.direction === "asc" ? "&uarr;" : "&darr;";
        th.eq(data.column).append('<span class="arrow">' + arrow +'</span>');
      });
     
 
});
</script>
<?php $config=Configure::read('aser'); ?>
<div id='view'>
<div class="document">
<h3><?php echo 'Sales Report By Product';
		if($caissier) echo '(Caissier : '.ucfirst($caissier).')';
	?>
	<?php if(!is_null($date1)&&!is_null($date2)) :?>
	<h4><?php echo '<h4>(From '.$this->MugTime->toFrench($date1).' to ';
			  echo 	$this->MugTime->toFrench($date2).')</h4>';
			  echo 'Records Total : '.count($ventes);
		 ?>
	 </h4>
	<?php endif;?>
</h3>
<br />
<table cellpadding="0" cellspacing="0" class="aser_sort">
<thead>
	<tr>
			<th width="300" data-sort="string" >Product Name</th>
			<th data-sort="int">Qty</th>
			<th width="200" data-sort="int">Sale Price</th>
			<th width="200" data-sort="int">Total Price</th>
			<?php if(Configure::read('aser.ingredient')):?>
				<th width="100" data-sort="int">Purchase Price</th>
				<th width="100" data-sort="int">Profit</th>
			<?php endif;?>
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
			
			<td>
				<?php echo $this->Html->link($vente['Produit']['name'], array('controller' => 'produits', 'action' => 'view', $vente['Produit']['id'])); ?>
			</td>
			<td data-sort-value="<?php echo $vente['Vente']['quantite']; ?>"><?php echo  $number->format($vente['Vente']['quantite'],$formatting); ?></td>
			<td data-sort-value="<?php echo $vente['Vente']['PU']; ?>"><?php echo  $number->format($vente['Vente']['PU'],$formatting); ?></td>
			<td data-sort-value="<?php echo $vente['Vente']['montant']; ?>"><?php echo  $number->format($vente['Vente']['montant'],$formatting); ?></td>
			<?php if(Configure::read('aser.ingredient')):?>
				<td data-sort-value="<?php echo $vente['Vente']['PA']; ?>"><?php echo  $number->format($vente['Vente']['PA'],$formatting); ?></td>
				<td data-sort-value="<?php echo $vente['Vente']['BEN']; ?>"><?php echo  $number->format($vente['Vente']['BEN'],$formatting); ?></td>
			<?php endif;?>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
<table>
	<tr>
			<th width="300" data-sort="string" >TOTALS</th>
			<th data-sort="int">Qty</th>
			<th width="200" data-sort="int">Sale Price</th>
			<th width="200" data-sort="int">Total Price</th>
			<?php if(Configure::read('aser.ingredient')):?>
				<th width="100" data-sort="int">Purchase Price</th>
				<th width="100" data-sort="int">Profit</th>
			<?php endif;?>
	</tr>
	<tr>
		<td>BEFORE DISCOUNT</td>
		<td><?php echo $number->format($quantite+0,$formatting); ?></td>
		<td>&nbsp;</td>
		<td><?php echo $number->format($total+0,$formatting); ?></td>
		<?php if(Configure::read('aser.ingredient')):?>
			<td><?php echo $number->format($pa+0,$formatting); ?></td>
			<td><?php echo $number->format($ben+0,$formatting); ?></td>
		<?php endif;?>
	</tr>
	<tr>
		<td>AFTER DISCOUNT</td>
		<td></td>
		<td>&nbsp;</td>
		<td><?php echo $number->format($totalReduit+0,$formatting); ?></td>
		<?php if(Configure::read('aser.ingredient')):?>
			<td>&nbsp;</td>
			<td></td>
		<?php endif;?>
	</tr>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents(0)" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php
			$action=(Configure::read('aser.touchscreen'))?'touchscreen':'index';
			 echo $this->Html->link('Point Of Sale', array('controller' => 'ventes', 'action' => $action)); 
		?> </li>
		<li><?php echo $this->Html->link('Products Management', array('controller' => 'produits', 'action' => 'index')); ?> </li>
	</ul>
</div>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Vente',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->element('combobox',array('n°'=>0));
			echo $this->Form->input('produit_id',array('selected'=>0,'id'=>'produits', 'label'=>'Product','options'=>$produits1));
			echo $this->Form->input('stock_id',array('selected'=>0,'id'=>'stockId', 'label'=>'Stock','options'=>$stocks1));
			if(Configure::read('aser.comptabilite'))
				echo $this->Form->input('Produit.groupe_comptable_id',array('selected'=>0,'multiple'=>true,'options'=>$groupeComptables1));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('personnel_id',array('selected'=>0,'label'=>'Cashier'));
			echo $this->Form->input('Facture.date1',array('label'=>'Start Date','type'=>'text'));									
			echo $this->Form->input('Facture.date2',array('label'=>'End Date','type'=>'text'));
			echo $this->Form->input('Facture.etat',array('label'=>'Invoice State','multiple'=>true,'options'=>$etats));
			echo $this->Form->input('xls',array('label'=>'Export to excel','type'=>'checkbox'));
			?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>