<div class="ajax">	
<?php echo $this->Form->create('Affectation',array('name'=>'affectation','id'=>'Affectation_affectations'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th>id</th>
			<th>reservation_id</th>
			<th>chambre_id</th>
			<th>Tier</th>
			<th>State</th>
			<th>Entrée</th>
			<th>Sortie</th>
			<th>Commentaire</th>
			<th>personnel_id</th>
			<th>created</th>
			<th>modified</th>
		</tr>
	<?php
	$i = 0;
	$j = 0;
	foreach ($affectations as $affectation):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Form->input('Id.'.$j.'',array('label'=>'','type'=>'checkbox','value'=>$affectation['Affectation']['id'])); ?>
		</td>
		<td><?php echo $affectation['Affectation']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($affectation['Reservation']['id'], array('controller' => 'reservations', 'action' => 'view', $affectation['Reservation']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($affectation['Chambre']['name'], array('controller' => 'chambres', 'action' => 'view', $affectation['Chambre']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($affectation['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $affectation['Tier']['id'])); ?>
		</td>
		<td><?php echo $affectation['Affectation']['etat']; ?>&nbsp;</td>
		<td><?php echo $affectation['Affectation']['entree']; ?>&nbsp;</td>
		<td><?php echo $affectation['Affectation']['sortie']; ?>&nbsp;</td>
		<td><?php echo $affectation['Affectation']['commentaire']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($affectation['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $affectation['Personnel']['id'])); ?>
		</td>
		<td><?php echo $affectation['Affectation']['created']; ?>&nbsp;</td>
		<td><?php echo $affectation['Affectation']['modified']; ?>&nbsp;</td>
	</tr>
<?php  $j++; endforeach; ?>
	</table>
</form>
</div>
