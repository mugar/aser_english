<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$final_stock['FinalStock']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$final_stock['FinalStock']['id'])); ?>
		</td>
		<td><?php echo $this->MugTime->toFrench($final_stock['FinalStock']['date']); ?>&nbsp;</td>
		<td><?php echo $final_stock['Stock']['name']; ?>&nbsp;</td>
		<td><?php echo $final_stock['StockManager']['name']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($final_stock['Produit']['name'], array('controller' => 'produits', 'action' => 'view', $final_stock['Produit']['id'],$final_stock['FinalStock']['stock_id'])); ?>
		</td>
		<td><?php echo $final_stock['FinalStock']['quantite'].' ';
				if(isset($unites[$final_stock['Produit']['unite_id']])) echo $unites[$final_stock['Produit']['unite_id']];?>&nbsp;</td>
		<td><?php echo $final_stock['FinalStock']['exit_quantite'].' ';
				if(isset($unites[$final_stock['Produit']['unite_id']])) echo $unites[$final_stock['Produit']['unite_id']];?>&nbsp;</td>
		<?php 
			foreach($exits as $key=>$bexit):?>
				<td name="exit"><input style="width:80px;" onchange="create_consumption(this);" type="text" exit_type="<?php echo $key; ?>"  value="<?php echo $final_stock['FinalStock'][$key]; ?>" id="<?php echo $final_stock['FinalStock']['id'];?>" />&nbsp;</td>
			<?php endforeach;?>
		<td>
			<?php echo ucfirst($final_stock['Controler']['name']); ?>
		</td>
	</tr>