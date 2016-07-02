
<div id='view'>
<div class="document">
<?php if(!empty($produits)):?>	
	<h3>
<?php
		echo $choixs[$choix];
?>
</h3>
	
<?php
	if(isset($date)){
			echo '<h4>(Du  '.$this->MugTime->toFrench($date).')';
	}
?>
<br/>
<br/>
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr class="border">
		<th rowspan="2" width="100" >Product</th>
		<?php foreach($stockNames as $stockName):?>
			<th colspan="<?php echo count($shifts);?>" ><?php echo $stockName['Stock']['name'];?></th>
		<?php endforeach;?>
		<th rowspan="2" width="100" >Total</th>
	</tr>
	<tr class="border">
		<?php foreach($stockNames as $stockName):?>
			<?php foreach($shifts as $shift):?>
				<th><?php echo $shift;?></th>
			<?php endforeach;?>
		<?php endforeach;?>
	</tr>
	<?php foreach($produits as $produit):?>
		<tr>
			<td> <?php echo $this->Html->link($produit['Product']['name'], array('controller' => 'produits', 'action' => 'view', $produit['Product']['id'],0));?></td>
			<?php 
		//	exit(debug($produit['stocks']));
			foreach($produit['stocks'] as $stockQty){
				
				$solde=($choix=='mvt')?$stockQty['ants'][0]['Historique']['solde']:0;
				foreach($shifts as $shiftId=>$shiftName){
					$found=0;
					foreach($stockQty['op'] as $historique){
						if($historique['Historique']['shift']==$shiftId){
							$found=($choix=='mvt')?
								$historique['Historique']['solde']:
								$historique['Historique']['debit']+$historique['Historique']['credit'];
							break;
						}
					}
					$solde=($choix=='mvt')?(($found)?$found:$solde):$found;
					echo '<td>'.$solde.'</td>';	
				}
			}
			;?>
			<td><?php echo ($choix=='mvt')?$produit['total']:$produit['debits']+$produit['credits'];?></td>		
		</tr>
	<?php endforeach;?>
</table>
<?php endif;?>
<br />
<br />
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Liste des Products', array('action' => 'index')); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Product',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('Historique.choix',array('label'=>'Type de rapport','options'=>$choixs));
			echo $this->Form->input('Historique.stock_id',array('label'=>'Stock','options'=>$stocks1));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('Historique.date',array('label'=>'Choisissez la date','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>