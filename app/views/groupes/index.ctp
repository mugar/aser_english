<div class="groupes index">
	<h2><?php __('Groups Management');?></h2>
	<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	
		<th>Section Name</th>			
		<th>Group Name</th>
		<th>Show on POS interface</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Groupe',array('action'=>'add'));?>
		
		<td><?php echo $this->Form->input('section_id',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('name',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('afficher',array('label'=>'','options'=>array('yes'=>'yes','no'=>'no')));?></td>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Groupe',array('name'=>'checkbox','id'=>'Groupe_groupes'));?>	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Section Name','section_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('Show on POS','afficher');?></th>
			<th><?php echo $this->Paginator->sort('actif');?></th>
		</tr>
	<?php

	foreach ($groupes as $groupe){
		echo $this->element('../groupes/add',array('groupe'=>$groupe));
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
		<?php if(Configure::read('aser.touchscreen')):?>
			<li class="link"  onclick = "upload()" >Import a picture</li>
		<?php endif;?>
	</ul>
</div>

<!-- form for image upload-->
<div id="upload_boxe" style="display:none" title="Import a picture">
<div class="dialog">
	<div id="message_upload"></div>
	<?php echo $this->Form->create('Groupe',array('id'=>'upload','action'=>'upload_img','type'=>'file'));?>
	<span class="left">
		<?php	
			echo $this->Form->input('Groupe.image',array('type'=>'file','id'=>'file'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>