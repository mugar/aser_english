<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
	jQuery('#fonction').change(function(){
		var fonction=jQuery(this).val();
 		if((fonction==1)&&(jQuery('#person').attr('touch')=='0')){
 			jQuery('.nullable').attr('disabled','disabled');
 		}
 		else {
 			jQuery('.nullable').removeAttr('disabled');
 		}
 	})
});
</script>
<div class="personnels index" id="person" touch="<?php echo Configure::read('aser.touchscreen');?>">
	<h2><?php __('Users Management');?></h2>
	<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Full Name</th>
		<?php if(Configure::read('aser.touchscreen')||Configure::read('aser.swipe')):?>
			<th>POS Code</th>
		<?php endif;?>
		<th>Role</th>
		<th>Username</th>
		<th>Password</th>
		<th>Password Confirmation</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Personnel',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('name',array('label'=>''));?></td>
		<?php if(Configure::read('aser.touchscreen')||Configure::read('aser.swipe')):?>
		<td><?php echo $this->Form->input('code',array('label'=>'','type'=>'password'));?></td>
		<?php endif;?>
		<td><?php echo $this->Form->input('fonction_id',array('label'=>'','id'=>'fonction'));?></td>
		<td><?php echo $this->Form->input('identifiant',array('label'=>'','class'=>'nullable'));?></td>
		<td><?php echo $this->Form->input('mot_passe',array('label'=>'','type'=>'password','id'=>'mot_passe','class'=>'nullable'));?></td>
		<td><?php echo $this->Form->input('confirmer',array('label'=>'','type'=>'password','class'=>'nullable'));?></td>
		<?php echo $this->Form->input('actif',array('label'=>'','type'=>'hidden','value'=>'yes'));?>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Personnel',array('name'=>'checkbox','id'=>'Personnel_personnels'));?>	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Full Name','name');?></th>
			<th><?php echo $this->Paginator->sort('Role','fonction_id');?></th>
			<th><?php echo $this->Paginator->sort('Username','identifiant');?></th>
			<th><?php echo $this->Paginator->sort('actif');?></th>
		</tr>
	<?php
	foreach ($personnels as $personnel)
		echo $this->element('../personnels/add',array('personnel'=>$personnel));
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
	</ul>
</div>
