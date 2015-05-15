
<?php $config=Configure::read('aser'); ?>
<div id='view'>
<div class="document">
<h3><?php echo 'Rapport Des Commandes Non envoyées ';
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
			<th>Date</th>
			<th>Produit</th>
			<th>Qté Facturé</th>
			<th>Qté Envoyé</th>
			<th>Qté Non Envoyé</th>
			<th >N° Facture</th>
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
		<li class="link" onclick = "print_documents(0)" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
	</ul>
</div>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Vente',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('label'=>'Date Début','type'=>'text'));		
		?>
	</span>
	<span class="right">
		<?php							
			echo $this->Form->input('date2',array('label'=>'Date Fin','type'=>'text'));
			?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>