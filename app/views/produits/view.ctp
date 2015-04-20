
<div id='view'>
<div class="document">
<?php 
//die(debug($produits));
 foreach($produits as $produit):?>
<h3>
<?php
	if(!empty($produit)){
		echo 'Mouvements du produit : '.$produit['Produit']['name'];
		echo  ' <small style="color:blue;">(PA: '.$produit['Produit']['PA'].', PV: '.$produit['Produit']['PV'].')</small>';
		echo '<br/>';
		echo 'Stock';
		echo (count($stocks)>0)?'s':'';
		echo ' : ';
		
		foreach($stockNames as $stockName){
			$words[]=ucfirst(strtolower($stockName['Stock']['name']));
		}
		echo implode(', ',$words);
	}
?>
</h3>
<br/>
<?php
	if(isset($date1)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).')';
	}
?>
<br/>
<br/><br/>
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr class="border">
			<th rowspan="2">Date</th>
			<th rowspan="2">Stock Précédent</th>
			<th rowspan="2">Libellé</th>
			<th colspan="2">Mouvements</th>
			<th rowspan="2">Stock Restant</th>
		
	</tr>
	<tr class="border">
			<th>Entrée</th>
			<th>Sortie</th>
	</tr>
	<?php if(!empty($produit['ants'][0])):?>
	<tr>
			<td>Avant le <?php echo $this->MugTime->toFrench($date1); ?></td>
			<td><?php echo  $number->format($produit['ants'][0]['Historique']['solde'],$formatting); ?></td>
			<td></td>
			<td></td>
			<td></td>
	</tr>
	<?php endif;?>
		<?php
	foreach ($produit['op'] as $operation):
		
	?>
	<tr>
			<td><?php echo  $this->MugTime->toFrench($operation['Historique']['date']); 
					if($operation['Historique']['date_expiration']){
						$text=($operation['Historique']['date_expiration']<=date('Y-m-d'))?'a expiré':'va expiré';
						echo ' ('.$text.' le '.$this->MugTime->toFrench($operation['Historique']['date_expiration']).')';
					}
				?>
			</td>
			<td></td>
			<td><?php echo  $operation['Historique']['libelle'].', ';
						echo $shifts[$operation['Historique']['shift']]; 
				?>
			</td>
			<td><?php echo  $number->format($operation['Historique']['debit'],$formatting); ?></td>
			<td><?php echo  $number->format($operation['Historique']['credit'],$formatting); ?></td>
			<td><?php echo  $number->format($operation['Historique']['solde'],$formatting); ?></td>
	</tr>
<?php endforeach; ?>
	<tr class="strong">
			<td></td>
			<td></td>
			<td></td>
			<td><?php  echo   $number->format($produit['debit'],$formatting); ?></td>
			<td><?php  echo   $number->format($produit['credit'],$formatting); ?></td>
			<td><?php echo  $number->format($produit['solde'],$formatting); ?></td>
	</tr>
	
</table>
<br />
<br />
<?php endforeach;?>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link('Liste des Produits', array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link('Retour En arrière', $referer); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Produit',array('id'=>'recherche','action'=>'view/'.$id));?>
	<span class="left">
		<?php
			echo $this->Form->input('Historique.stock_id',array('label'=>'Stock'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('Historique.date1',array('label'=>'Choisissez une date début'));
			echo $this->Form->input('Historique.date2',array('label'=>'et une date fin pour le rapport','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
