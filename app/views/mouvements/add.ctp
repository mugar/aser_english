<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$mouvement['Mouvement']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$mouvement['Mouvement']['id'])); ?>
		</td>
		
		<td><?php echo $this->MugTime->toFrench($mouvement['Mouvement']['date']); ?>&nbsp;</td>
		<td><?php echo $mouvement['Mouvement']['quantite'].' ';
				if(isset($unites[$mouvement['Produit']['unite_id']])) echo $unites[$mouvement['Produit']['unite_id']]; 
		?>&nbsp;</td>
		<td><?php echo $mouvement['Produit']['name']; ?></td>
		<td>
			<?php echo $this->Html->link($mouvement['StockSortant']['name'], array('controller' => 'produits', 'action' => 'view', $mouvement['Produit']['id'],$mouvement['Mouvement']['stock_sortant_id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($mouvement['StockEntrant']['name'], array('controller' => 'produits', 'action' => 'view', $mouvement['Produit']['id'],$mouvement['Mouvement']['stock_entrant_id'])); ?>
		</td>
			<?php if (Configure::read('aser.shifts')):?>
			<td><?php echo $shifts[$mouvement['Mouvement']['shift']]; ?>&nbsp;</td>
		<?php endif;?>
		<td>
			<?php echo ucfirst($mouvement['Personnel']['name']); ?>
		</td>
	</tr>