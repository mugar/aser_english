<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
     	
		
	});
</script>
<div id='view'>
<div class="document">
<h3 id="stock" stock="<?php if(!empty($stockInfo)) echo $stockInfo['Stock']['id'];?>">Mouvements des Produits <?php if(!empty($stockInfo)) echo ' - Stock : '.strtoupper($stockInfo['Stock']['name']);?></h3>
<br />
<?php
	if(isset($date1)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).')</h4>';
		}
?>
<br />	
<br />
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr class="border">
			<th rowspan="2">Produits</th>
			<th rowspan="2">Stock Initiale</th>
			<th colspan="4">Mouvements</th>
			<th rowspan="2">Stock Finale</th>
			<th rowspan="2">Valeur (PV)</th>
		
	</tr>
	<tr class="border">
			<th>Entrée</th>
			<th>Vente</th>
			<th>Sortie</th>
			<th>Perte</th>
	</tr>
		<?php
		$i=0;
	foreach ($produits as $historique):
		$i++;
	?>
	<tr>
		<td>
			<?php echo $this->Html->link($historique[$model]['name'], array('controller' => 'produits', 'action' => 'view', $historique[$model]['id'],$stockId)); ?>
		</td>
			<td><?php echo  $historique['report']; ?></td>
			<td><?php if(isset($historique['Entree'])) echo $historique['Entree']; ?></td>
			<td><?php if(isset($historique['Vente'])) echo $historique['Vente']; ?></td>
			<td><?php if(isset($historique['Sorti'])) echo  $historique['Sorti']; ?></td>
			<td id="perte<?php echo $i;?>" name="perte"><?php if(isset($historique['Perte'])) echo  $this->Html->link($historique['Perte'],
				 array('controller' => 'pertes','action' => 'index', $historique['Produit']['id'],$date1,$date2),array('target'=>'_blank')); ?></td>
			<td><?php echo  $this->Form->input('reel',array('onchange'=>'perte(this)',
																'numero'=>$i,
																'label'=>'',
																'nom'=>'reel',
																'style'=>'width:50px;',
																'old_value'=>$historique['solde'],
																'value'=>$historique['solde'],
																'id'=>$historique['Produit']['id'],
																)); 
			?></td>
			<td name="pv" pv="<?php echo  $historique['Produit']['PV']; ?>"><?php echo  $historique['total_pv']; ?></td>
	</tr>
<?php endforeach; ?>
<tr class="strong">
		<td >TOTAL</td>
			<td><?php echo  $report; ?></td>
			<td><?php echo  $debit; ?></td>
			<td><?php echo  $out['Vente']; ?></td>
			<td><?php echo  $out['Sorti']; ?></td>
			<td id="total_perte"><?php echo  $out['Perte']; ?></td>
			<td id="total_sf"><?php echo  $solde; ?></td>
			<td id="total_pv"><?php echo  $pv; ?></td>
	</tr>
</table>
<br />
<br />
<div class="bas_page">
	<div class="left">
		<?php  
		echo 'Controleur';
	?>
	</div>
	
	<div class="middle">
		<?php  
		echo 'DAF';
	?>
	</div>
	
	<div class="right"><?php  
		echo 'Barman';
	?>
	</div>
	<div style="clear:both"></div>
</div>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link('Liste des Produits', array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link('Liste des Pertes', array('controller'=>'pertes','action' => 'index')); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Produit',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('stock_id',array('selected'=>0,'id'=>'stockId'));
			echo $this->element('combobox',array('n°'=>1));
			echo $this->Form->input('produit_id',array('options'=>$list,'selected'=>0,'id'=>'produits'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('date1',array('label'=>'Choisissez une date début'));
			echo $this->Form->input('date2',array('label'=>'et une date fin pour le rapport','type'=>'text'));
			echo $this->Form->input('export',array('label'=>'Exporter vers excel','type'=>'checkbox'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>

<!-- form for perte creation -->
<div id="perte_boxe" style="display:none" title="Création d'une perte">
<?php echo $this->element('../pertes/edit',array('action'=>'add'));?>
</div>
