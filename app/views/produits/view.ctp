
<div id='view'>
<div class="document">
<?php 
//die(debug($produits));
$formatting=array('places'=>1,'before'=>'','escape'=>false,'decimal'=>'.','thousands'=>' ');
 foreach($produits as $id=>$produit):?>
<h3>
<?php
	if(!empty($produit['info'])){
		echo $produit['info']['name'].' Inventory History' ;
		echo '<br/>';
		echo  ' <small style="color:blue;">(Purchase Price: '.$produit['info']['PA'].', Sale Price: '.$produit['info']['PV'].')</small>';
		echo '<br/> <br/>';
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
			echo '<h4>(From  '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).')';
	}
?>
<br/>
<br/><br/>
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr class="border">
			<th rowspan="2">Date</th>
			<th rowspan="2">Initial Qty</th>
			<th rowspan="2">Description</th>
			<th colspan="2">Movements</th>
			<th rowspan="2">Final Qty</th>
		
	</tr>
	<tr class="border">
			<th>In</th>
			<th>Out</th>
	</tr>
	<?php if(!empty($produit['ant'])):?>
	<tr>
			<td>Avant le <?php echo $this->MugTime->toFrench($date1); ?></td>
			<td><?php echo  $number->format($produit['SI'],$formatting); ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
	</tr>
	<?php endif;?>

	<?php if(!empty($produit['op'])):?>

	<?php foreach ($produit['op'] as $operation): ?>
	<tr>
			<td><?php echo  $this->MugTime->toFrench($operation['Historique']['date']); 
					if($operation['Historique']['date_expiration']){
						$text=($operation['Historique']['date_expiration']<=date('Y-m-d'))?'a expiré':'va expiré';
						echo ' ('.$text.' le '.$this->MugTime->toFrench($operation['Historique']['date_expiration']).')';
					}
				?>
			</td>
			<td></td>
			<td><?php 
					$inventory_operation_types = $inventory_operation_types + array('Mouvement'=>'Transfer');
					echo  $inventory_operation_types[$operation['Historique']['libelle']].', ';
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
<?php endif;?>	
</table>
<br />
<br />
<?php endforeach;?>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Products Management', array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link('Go back', $referer); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
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
			echo $this->Form->input('Historique.date1',array('label'=>'Start Date'));
			echo $this->Form->input('Historique.date2',array('label'=>'End Date','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
