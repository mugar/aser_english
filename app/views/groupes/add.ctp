<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$groupe['Groupe']['id'],array('label'=>'','type'=>'checkbox','value'=>$groupe['Groupe']['id'])); ?>
		</td>
		<td>
			<?php echo $groupe['Groupe']['id']; ?>
		</td>
		<td>
			<?php echo $groupe['Section']['name']; ?>
		</td>
		<td><?php echo $groupe['Groupe']['name']; ?>&nbsp;</td>
		<td><?php echo $groupe['Groupe']['afficher']; ?>&nbsp;</td>
		<?php if(!Configure::read('aser.magasin')&&Configure::read('aser.advanced_stock')):?>
			<td><?php echo $groupe['Groupe']['accompagnement']; ?>&nbsp;</td>
		<?php endif;?>
		<td><?php echo $groupe['Groupe']['actif']; ?>&nbsp;</td>
	</tr>