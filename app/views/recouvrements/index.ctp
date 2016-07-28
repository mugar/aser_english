
<div class="recouvrements index">
	<h2><?php __('Bills Collection');?></h2>	
	

<!--recherche form -->
<?php echo $this->element('../recouvrements/recherche',array('action'=>'index'));?>
		<br>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Date</th>
		<th>Customer</th>
		<th>Invoices</th>
		<th>Amount Collected</th>	
		<th>Comments</th>
		<th>Done By</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Recouvrement',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('date',array('label'=>'','type'=>'text'));?></td>
		<td><?php echo $this->Form->input('tier_id',array('label'=>'','selected'=>0,'options'=>$tiers1));?></td>
		<td><?php echo $this->Form->input('factures',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('montant',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('comments',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('done_by_id',array('label'=>'','selected'=>0,'options'=>$collectors));?></td>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Recouvrement',array('name'=>'checkbox','id'=>'Recouvrement_recouvrements'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('Customer','tier_id');?></th>
			<th><?php echo $this->Paginator->sort('Invoices','factures');?></th>
			<th><?php echo $this->Paginator->sort('Amount Collected','montant');?></th>
			<th><?php echo $this->Paginator->sort('comments');?></th>
			<th><?php echo $this->Paginator->sort('Done By','personnel_id');?></th>
			<th><?php echo $this->Paginator->sort('Created By','personnel_id');?></th>
		</tr>
	<?php
	$sumQty=0;
	foreach ($recouvrements as $recouvrement){
		echo $this->element('../recouvrements/add',array('recouvrement'=>$recouvrement));
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
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Edition De Rapport', array('action' => 'rapport')); ?></li>
	</ul>
</div>
