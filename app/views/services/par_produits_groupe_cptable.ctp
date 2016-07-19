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
<h3><?php echo 'Rapport des Ventes Par Products et Par Groupes Comptable';
	?>
	<?php if(!is_null($date1)&&!is_null($date2)) :?>
	<h4><?php echo '<h4>(From '.$this->MugTime->toFrench($date1).' to ';
			  echo 	$this->MugTime->toFrench($date2).')</h4>';
		 ?>
	 </h4>
	<?php endif;?>
</h3>
<br />
<table cellpadding="0" cellspacing="0" class="aser_sort">
<thead>
	<tr>
			<th width="300" data-sort="string" >Product</th>
			<th data-sort="int">Qté</th>
			<th width="200" data-sort="int">PV</th>
			<th width="200" data-sort="int">PT</th>
			<?php if(Configure::read('aser.ingredient')):?>
				<th width="100" data-sort="int">PA</th>
				<th width="100" data-sort="int">BENEFICE</th>
			<?php endif;?>
	</tr>
</thead>
<tbody>
<?php  foreach ($groupeComptables as $key => $groupeComptable): ?>
	<tr class="strong">
		<td colspan="6" style="text-align: center;"><?php echo $groupeComptable['GroupeComptable']['name'];?></td>
	</tr>
	<?php if(!empty($groupeComptable['ventes'])):?>
		<?php foreach ($groupeComptable['ventes'] as $vente):?>
			<tr>	
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
		<tr class="strong">
			<td>TOTAL</td>
			<td><?php echo $number->format($groupeComptable['quantite']+0,$formatting); ?></td>
			<td>&nbsp;</td>
			<td><?php echo $number->format($groupeComptable['total']+0,$formatting); ?></td>
			<?php if(Configure::read('aser.ingredient')):?>
				<td>&nbsp;</td>
				<td><?php echo $number->format($groupeComptable['ben']+0,$formatting); ?></td>
			<?php endif;?>
		</tr>
	<?php endif;?>
<?php endforeach; ?>
</tbody>
<tfoot>
	<tr class="strong">
		<td>TOTAL</td>
		<td><?php echo $number->format($totals['quantite']+0,$formatting); ?></td>
		<td>&nbsp;</td>
		<td><?php echo $number->format($totals['total']+0,$formatting); ?></td>
		<?php if(Configure::read('aser.ingredient')):?>
			<td>&nbsp;</td>
			<td><?php echo $number->format($totals['ben']+0,$formatting); ?></td>
		<?php endif;?>
	</tr>
</tfoot>
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
			 echo $this->Html->link('Interface de Vente', array('controller' => 'ventes', 'action' => $action)); 
		?> </li>
		<li><?php echo $this->Html->link('Liste des Products', array('controller' => 'produits', 'action' => 'index')); ?> </li>
	</ul>
</div>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Vente',array('id'=>'recherche'));?>
	<span class="left">
		<?php
				echo $this->Form->input('groupe_comptable_id',array('selected'=>0,'multiple'=>true,'options'=>$groupeComptables1));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('Facture.date1',array('label'=>'Start Date','type'=>'text'));									
			echo $this->Form->input('Facture.date2',array('label'=>'End Date','type'=>'text'));
			?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>