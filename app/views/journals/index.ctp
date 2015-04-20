<div class="journals index">
	<h2><?php __('Journals');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('numero');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
			<th><?php echo $this->Paginator->sort('closed');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($journals as $journal):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($journal['Journal']['id'], array('controller' => 'ventes', 'action' => 'journal', $journal['Journal']['id'])); ?>
		</td>
		<td><?php echo $journal['Journal']['numero']; ?>&nbsp;</td>
		<td><?php echo $journal['Journal']['date']; ?>&nbsp;</td>
		<td>
			<?php echo $journal['Personnel']['name']; ?>
		</td>
		<td><?php echo $journal['Journal']['closed']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $journal['Journal']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Journal', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Personnels', true), array('controller' => 'personnels', 'action' => 'index')); ?> </li>
	</ul>
</div>