
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('type_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('etat');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($chambres as $chambre):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $chambre['Chambre']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($chambre['Type']['name'], array('controller' => 'types', 'action' => 'view', $chambre['Type']['id'])); ?>
		</td>
		<td><?php echo $chambre['Chambre']['name']; ?>&nbsp;</td>
		<td><?php echo $chambre['Chambre']['etat']; ?>&nbsp;</td>
		<td><?php echo $chambre['Chambre']['date']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Afficher', true), array('action' => 'view', $chambre['Chambre']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $chambre['Chambre']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $chambre['Chambre']['id']), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $chambre['Chambre']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing  %current% records out of %count%, from %start%, to %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
