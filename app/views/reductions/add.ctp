<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$reduction['Reduction']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$reduction['Reduction']['id'])); ?>
		</td>
		
		<td><?php echo $reduction['Tier']['name']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($reduction['Produit']['name'], array('controller' => 'produits', 'action' => 'view', $reduction['Produit']['id'],null)); ?>
		</td>
		<td><?php echo $reduction['Reduction']['PU']; ?></td>
		<td name="actif"><?php echo $reduction['Reduction']['actif']; ?>&nbsp;</td>
