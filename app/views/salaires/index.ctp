<div class="salaires index">
	<h2><?php __('Salaires');?></h2>
	<?php echo $this->Form->create('Salaire',array('name'=>'checkbox','id'=>'Salaire_salaires'));?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
			<th><?php echo $this->Paginator->sort('Salaire de Base','personnel_id');?></th>
			<th><?php echo __('Salaire Net');?></th>
			<th><?php echo $this->Paginator->sort('HS');?></th>
			<th><?php echo $this->Paginator->sort('PRIME');?></th>
			<th><?php echo $this->Paginator->sort('ALLOC');?></th>
			<th><?php echo $this->Paginator->sort('SM');?></th>
			<th><?php echo $this->Paginator->sort('ASSUR');?></th>
			<th><?php echo $this->Paginator->sort('AVANCE');?></th>
			<th><?php echo $this->Paginator->sort('COTIS');?></th>
			<th><?php echo $this->Paginator->sort('date_debut');?></th>
			<th><?php echo $this->Paginator->sort('date_fin');?></th>
		</tr>
	<?php
	
	foreach ($salaires as $salaire):
		
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$salaire['Salaire']['id'],array('label'=>'','type'=>'checkbox','value'=>$salaire['Salaire']['id'])); ?>
		</td>
		<td><?php echo $salaire['Salaire']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($salaire['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $salaire['Personnel']['id'])); ?>
		</td>
		<td><input  name="data[Salaire][SNET]" style="width:100px;" onchange="salaire_net(this);" type="text" value="<?php echo $salaire['Salaire']['montant']; ?>" id="<?php echo $salaire['Salaire']['id'];?>"/>&nbsp;</td>
		<td id="snet-<?php echo $salaire['Salaire']['id'];?>"><?php echo $salaire['Salaire']['SNET']; ?>&nbsp;</td>
		<td><?php echo $salaire['Salaire']['HS']; ?>&nbsp;</td>
		<td><?php echo $salaire['Salaire']['PRIME']; ?>&nbsp;</td>
		<td><?php echo $salaire['Salaire']['ALLOC']; ?>&nbsp;</td>
		<td><?php echo $salaire['Salaire']['SM']; ?>&nbsp;</td>
		<td><?php echo $salaire['Salaire']['ASSUR']; ?>&nbsp;</td>
		<td><?php echo $salaire['Salaire']['AVANCE']; ?>&nbsp;</td>
		<td><?php echo $salaire['Salaire']['COTIS']; ?>&nbsp;</td>
		<td><?php echo $salaire['Salaire']['date_debut']; ?>&nbsp;</td>
		<td><?php echo $salaire['Salaire']['date_fin']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
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
<div id="separator" class="back" title="Etendre" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Salaire', true)), array('action' => 'add')); ?></li>
		<li class="link" onclick="actions('checkbox','edit')" >Edit</li>
		<li class="link" onclick="actions('checkbox','delete')" >Delete</li>
		<li><?php echo $this->Html->link(__('Generer la liste des paies', true), array('controller' => 'salaires', 'action' => 'paie')); ?> </li>
	</ul>
</div>
