<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$tier['Tier']['id'],array('label'=>'','type'=>'checkbox','value'=>$tier['Tier']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($tier['Tier']['id'], array('controller' => 'tiers', 'action' => 'view', $tier['Tier']['id'])); ?>
		</td>
		<td name="nom"><?php echo $tier['Tier']['name']; ?>&nbsp;</td>
		<td><?php echo $tier['Tier']['compagnie']; ?>&nbsp;</td>
		<td><?php echo $tier['Tier']['telephone']; ?>&nbsp;</td>
		<td><?php echo $tier['Tier']['email']; ?>&nbsp;</td>
		<?php if(Configure::read('aser.hotel')):?>
			<td><?php echo $tier['Tier']['nationalite']; ?>&nbsp;</td>
			<td><?php echo $tier['Tier']['passport']; ?>&nbsp;</td>
		<?php endif;?>
		<?php if(Configure::read('aser.POS')):?>
			<td><?php echo $tier['Tier']['reduction']; ?>&nbsp;</td>
		<?php endif;?>
		<td><?php echo $tier['Tier']['max_dette']; ?>&nbsp;</td>
		<td><?php echo $tier['Tier']['pers_contact']; ?>&nbsp;</td>
		<td name="actif"><?php echo $tier['Tier']['actif']; ?>&nbsp;</td>
	</tr>