<div class="journals form">
<?php echo $this->Form->create('Journal');?>
	<fieldset>
		<legend><?php __('Edit Journal'); ?></legend>
	<?php
		echo $this->element('../journals/partial',array('action'=>'edit'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Journals', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Personnels', true), array('controller' => 'personnels', 'action' => 'index')); ?> </li>
	</ul>
</div>