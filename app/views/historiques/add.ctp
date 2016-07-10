<tr <?php if(isset($alert)&&($alert)) echo 'class="active"';?>>
		<td>
			<?php echo $this->Form->input('Id.'.$historique['Historique']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$historique['Historique']['id'])); ?>
		</td>
		<td><?php echo $this->MugTime->toFrench($historique['Historique']['date']); ?>&nbsp;</td>
		<td><?php echo $types[$historique['Historique']['libelle']]; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['quantite'].' ';
				if(isset($unites[$historique['Produit']['unite_id']])) echo $unites[$historique['Produit']['unite_id']];?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($historique['Produit']['name'], array('controller' => 'produits', 'action' => 'view', $historique['Produit']['id'],$historique['Historique']['stock_id'])); ?>
		</td>
		<td><?php echo $number->format($historique['Historique']['PU'],$formatting); ?>&nbsp;</td>
		<td><?php echo $number->format($historique['Historique']['montant'],$formatting); ?>&nbsp;</td>
		<?php if(Configure::read('aser.pharmacie')):?>
			<td><?php echo $historique['Historique']['batch']; ?>&nbsp;</td>
			<td><?php echo $this->MugTime->toFrench($historique['Historique']['date_expiration']); ?>&nbsp;</td>
		<?php endif;?>
		
		<td><?php echo $historique['Stock']['name']; ?>&nbsp;</td>
		<?php if (Configure::read('aser.shifts')):?>
			<td><?php echo $shifts[$historique['Historique']['shift']]; ?>&nbsp;</td>
		<?php endif;?>
		<td>
			<?php echo ucfirst($historique['Personnel']['name']); ?>
		</td>
	</tr>