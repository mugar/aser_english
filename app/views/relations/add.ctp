<?php exit('test');?>
<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$relation['Relation']['id'],array('label'=>'','type'=>'checkbox','value'=>$relation['Relation']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($relation['Stock']['name'], array('controller' => 'stocks', 'action' => 'view', $relation['Stock']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($relation['PremierProduct']['name'], array('controller' => 'produits', 'action' => 'view', $relation['PremierProduct']['id'])); ?>
		</td>
		<td><?php echo $relation['Relation']['relation']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($relation['DeuxiemeProduct']['name'], array('controller' => 'produits', 'action' => 'view', $relation['DeuxiemeProduct']['id'])); ?>
		</td>
		<td><?php echo $relation['Relation']['quantite']; ?>&nbsp;</td><td>
			<?php echo $this->Html->link($relation['Unite']['name'], array('controller' => 'unites', 'action' => 'view', $relation['Unite']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($relation['Personnel']['name'], array('controller' => 'produits', 'action' => 'view', $relation['Personnel']['id'])); ?>
		</td>
	</tr>