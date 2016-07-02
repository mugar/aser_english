<div class="rappels index">
	<h2><?php __('Gestion Des Rappels');?></h2>
		<br>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Action à faire</th>
		<th>Date</th>
		<th>Heure</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Rappel',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('action',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('date',array('label'=>'','type'=>'text'));?></td>
		<td><?php echo $this->Form->input('heure',array('label'=>'','class'=>'heure'));?></td>
		<?php echo $this->Form->input('reservation_id',array('label'=>'','type'=>'hidden','value'=>$reservationId));?>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Rappel',array('name'=>'checkbox','id'=>'Rappel_rappels'));?>	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('action');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('heure');?></th>
		</tr>
	<?php
	
	foreach ($rappels as $rappel){
		echo $this->element('../rappels/add',array('rappel'=>$rappel));
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
		<li class= "link" onclick = "mass_delete()" >Delete</li>
		<li><?php echo $this->Html->link('Gestion Des Réservations', array('controller' => 'reservations', 'action' => 'tabella')); ?>  
	</ul>
</div>
