<div class="typeChambres index">
	<h2><?php __('Room Types Management');?></h2>
	
	<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Type Name</th>
		<th>Night Rate</th>
		<th>Currency</th>
		<th>Description</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('TypeChambre',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('name',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('montant',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('monnaie',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('description',array('label'=>''));?></td>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('TypeChambre',array('name'=>'checkbox','id'=>'TypeChambre_typeChambres'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Type Name','name');?></th>
			<th><?php echo $this->Paginator->sort('Rate','montant');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('Rooms total','chambres');?></th>
		</tr>
	<?php
	foreach ($typeChambres as $typeChambre){
		echo $this->element('../type_chambres/add',array('typeChambre'=>$typeChambre));
	}
	?>
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
		<li class= "link" onclick = "edit()" >Edit</li>
		<li class="link" onclick="mass_delete()" >Delete</li>
		<li><?php echo $this->Html->link('Rooms management', array('controller' => 'chambres', 'action' => 'index')); ?> </li>
	</ul>
</div>
