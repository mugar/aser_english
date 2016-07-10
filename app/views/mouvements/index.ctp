<div class="mouvements index">
	<h2><?php __('Stocks Movements');?></h2>
	
	
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Mouvement',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('produit_id',array('label'=>'Product','selected'=>0,'options'=>$produits1));
			echo $this->Form->input('stock_sortant_id',array('label'=>'From','selected'=>0,'options'=>$stocks1));
			echo $this->Form->input('stock_entrant_id',array('label'=>'To','selected'=>0,'options'=>$stocks1));
		?>
	</span>
	<span class="right">
		<?php
		
			
		echo $this->Form->input('date1',array('label'=>'Start Date','type'=>'text'));				
		echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));	
		echo $this->Form->input('show',array('label'=>'Pagination',
												'options'=>array(20=>'20',
																50=>'50',
																100=>'100',
																200=>'200',
																'all'=>'all',
																)));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Date</th>
		<th>Quantity</th>		
		<th>Product</th>
		<th>From</th>
		<th>To</th>
		<?php if (Configure::read('aser.shifts')):?>
			<th>Shift</th>	
		<?php endif;?>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Mouvement',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('date',array('label'=>'','type'=>'text'));?></td>
		<td><?php echo $this->Form->input('quantite',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('produit_id',array('label'=>'','selected'=>0));?></td>
		<td><?php echo $this->Form->input('stock_sortant_id',array('options'=>$stocks,'label'=>''));?></td>
		<td><?php echo $this->Form->input('stock_entrant_id',array('options'=>$stocks,'label'=>''));?></td>
		<?php if (Configure::read('aser.shifts')):?>
			<td><?php echo $this->Form->input('shift',array('label'=>'','options'=>$shifts));?></td>	
		<?php endif;?>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>

	<?php echo $this->Form->create('Mouvement',array('name'=>'checkbox','id'=>'Mouvement_mouvements','action'=>'confirm'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('Qty','quantite');?></th>
			<th><?php echo $this->Paginator->sort('Product','produit_id');?></th>
			<th><?php echo $this->Paginator->sort('From','stock_sortant_id');?></th>
			<th><?php echo $this->Paginator->sort('To','stock_entrant_id');?></th>
			<?php if (Configure::read('aser.shifts')):?>
				<th><?php echo $this->Paginator->sort('shift');?></th>	
			<?php endif;?>
			<th><?php echo $this->Paginator->sort('Created By','personnel_id');?></th>
		</tr>
	<?php
	foreach ($mouvements as $mouvement){
		echo $this->element('../mouvements/add',array('mouvement'=>$mouvement));
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
	</ul>
</div>
