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
<h3><?php echo 'Rapport des Consommations ';
		if($caissier) echo '(Caissier : '.ucfirst($caissier).')';
	?>
	<?php if(!is_null($date1)&&!is_null($date2)) :?>
	<h4><?php echo '<h4>(Période du '.$this->MugTime->toFrench($date1).' au ';
			  echo 	$this->MugTime->toFrench($date2).')</h4>';
			  echo 'Total : '.count($ventes);
		 ?>
	 </h4>
	<?php endif;?>
</h3>
<br />
<table cellpadding="0" cellspacing="0" class="aser_sort">
<thead>
	<tr>
			<th width="300" data-sort="string" >Produit</th>
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
<tfoot>
	<tr>
		<td>TOTAL AVANT REDUCTION</td>
		<td><?php echo $number->format($quantite+0,$formatting); ?></td>
		<td>&nbsp;</td>
		<td><?php echo $number->format($total+0,$formatting); ?></td>
		<?php if(Configure::read('aser.ingredient')):?>
			<td>&nbsp;</td>
			<td><?php echo $number->format($ben+0,$formatting); ?></td>
		<?php endif;?>
	</tr>
	<tr>
		<td>TOTAL APRES REDUCTION</td>
		<td></td>
		<td>&nbsp;</td>
		<td><?php echo $number->format($totalReduit+0,$formatting); ?></td>
		<?php if(Configure::read('aser.ingredient')):?>
			<td>&nbsp;</td>
			<td></td>
		<?php endif;?>
	</tr>
</tfoot>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents(0)" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php
			$action=(Configure::read('aser.touchscreen'))?'touchscreen':'index';
			 echo $this->Html->link('Interface de Vente', array('controller' => 'ventes', 'action' => $action)); 
		?> </li>
		<li><?php echo $this->Html->link('Liste des Produits', array('controller' => 'produits', 'action' => 'index')); ?> </li>
	</ul>
</div>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Vente',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->element('combobox',array('n°'=>0));
			echo $this->Form->input('produit_id',array('selected'=>0,'id'=>'produits','options'=>$produits1));
			echo $this->Form->input('stock_id',array('selected'=>0,'id'=>'stockId','options'=>$stocks1));
			if(Configure::read('aser.comptabilite'))
				echo $this->Form->input('Produit.groupe_comptable_id',array('selected'=>0,'multiple'=>true,'options'=>$groupeComptables1));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('personnel_id',array('selected'=>0,'label'=>'Caissier'));
			echo $this->Form->input('Facture.date1',array('label'=>'Date Début','type'=>'text'));									
			echo $this->Form->input('Facture.date2',array('label'=>'Date Fin','type'=>'text'));
			echo $this->Form->input('Facture.etat',array('label'=>'Etat de la facture','multiple'=>true,'options'=>$etats));
			echo $this->Form->input('xls',array('label'=>'Exporter vers xls','type'=>'checkbox'));
			?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>