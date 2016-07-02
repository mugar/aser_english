<div class="caisseInterdites index">
	<h2><?php __('Caisse Interdites');?></h2>
	<?php echo $this->Form->create('CaisseInterdite',array('name'=>'checkbox','id'=>'CaisseInterdite_caisseInterdites'));?>	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
			<th><?php echo $this->Paginator->sort('caiss_id');?></th>
		</tr>
	<?php
	$i = 0;
	$j = 0;
	foreach ($caisseInterdites as $caisseInterdite):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Form->input('Id.'.$j.'',array('label'=>'','type'=>'checkbox','value'=>$caisseInterdite['CaisseInterdite']['id'])); ?>
		</td>
		<td><?php echo $caisseInterdite['CaisseInterdite']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($caisseInterdite['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $caisseInterdite['Personnel']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($caisseInterdite['Caiss']['name'], array('controller' => 'caisses', 'action' => 'view', $caisseInterdite['Caiss']['id'])); ?>
		</td>
	</tr>
<?php  $j++; endforeach; ?>
	</table>
</form>
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
</div>
<div id="separator" class="back" title="Hide the Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Caisse Interdite', true)), array('action' => 'add')); ?></li>
		<li class= "link" onclick = "actions('checkbox','edit')" >Edit</li>
		<li class="link"  onclick="actions('checkbox','view')" >Afficher</li>
		<li class="link" onclick="actions('checkbox','delete')" >Delete</li>
		
		 
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Caisses', true)), array('controller' => 'caisses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Caiss', true)), array('controller' => 'caisses', 'action' => 'add')); ?> </li>
	</ul>
</div>
