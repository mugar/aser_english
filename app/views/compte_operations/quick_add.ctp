<?php
	
	foreach ($compteOperations as $compteOperation):
		
	?>
	<tr ondblclick="quick_edit(this)" id="<?php echo $compteOperation['CompteOperation']['id'];?>">
		<td>
			<?php echo $this->Form->input('Id.'.$compteOperation['CompteOperation']['id'],array('label'=>'','type'=>'checkbox','value'=>$compteOperation['CompteOperation']['id'])); ?>
		</td>
		<td><?php echo $compteOperation['CompteOperation']['date']; ?>&nbsp;</td>
		<td><?php echo $compteOperation['CompteOperation']['op_num']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($compteOperation['Compte']['name'], array('controller' => 'comptes', 'action' => 'view', $compteOperation['Compte']['id'])); ?>
		</td>
		<td><?php echo $compteOperation['CompteOperation']['piece']; ?>&nbsp;</td>
		<td><?php echo $compteOperation['CompteOperation']['libelle']; ?>&nbsp;</td>
		<td><?php echo $compteOperation['CompteOperation']['debit']; ?>&nbsp;</td>
		<td><?php echo $compteOperation['CompteOperation']['credit']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($compteOperation['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $compteOperation['Personnel']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>