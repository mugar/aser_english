<script>
 jQuery.noConflict();
 jQuery(document).ready(function(){
	 
		jQuery('#produit').selectFilter({
  		'clearInputOnEscape': true,
    	'disableRegex': true,
    	// The class to apply to the filter bar.
    	'filterClass': 'filter-select',
    	'inputPlaceholder': 'Type to filter',
    	'minimumCharacters': 1,
    	'minimumSelectElementSize': 3,
    	'inputLocation': 'above',
    	// Amount of time to delay filtering (in ms) after a key is pressed.
    	'searchDelay':0,
    	'searchFromBeginning':false,
    	'width': -1
    	// The width for the select element and its input filter box.
    	// If -1, both the select element and its filter box have their size set to the width of
    	// the select element before any filtering occurs.
  	});
});
</script>
<div class="final_stocks index">
	<h2>Final Stocks Management</h2>
	
<!--recherche form -->
<?php echo $this->element('../final_stocks/recherche',array('action'=>'index'));?>
		<br>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Date</th>
		<th>Store</th>	
		<th>Store Manager</th>
		<th>Product</th>
		<th>Final Quantity</th>	
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('FinalStock',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('date',array('label'=>'','type'=>'text'));?></td>
		<td><?php echo $this->Form->input('stock_id',array('id'=>$i.'StockId','label'=>'','options'=>$stocks));?></td>
		<td><?php echo $this->Form->input('stock_manager_id',array('label'=>'','options'=>$waiters,'selected'=>0));?></td>
		<td><?php echo $this->Form->input('produit_id',array('id'=>'produit','class'=>'produit_filtered','label'=>'','options'=>$produits));?></td>
		<td><?php echo $this->Form->input('quantite',array('id'=>'quantite','label'=>''));?></td>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('FinalStock',array('name'=>'checkbox','id'=>'FinalStock_final_stocks'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('Store','stock_id');?></th>
			<th><?php echo $this->Paginator->sort('Store Manager','stock_manager_id');?></th>
			<th><?php echo $this->Paginator->sort('Product','produit_id');?></th>
			<th><?php echo $this->Paginator->sort('Final Quantity','quantite');?></th>
			<th><?php echo $this->Paginator->sort('Exit Quantity','exit_quantite');?></th>
			<?php foreach($exits as $exit):?>
				<th><?php echo $exit;?></th>
			<?php endforeach;?>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
		</tr>
	<?php
	foreach ($final_stocks as $final_stock){
		echo $this->element('../final_stocks/add',array('final_stock'=>$final_stock));
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
		<li class= "link" onclick="edit()" >Edit</li>
		<li class="link" onclick="mass_delete()" >Delete</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<!-- <li><?php echo $this->Html->link('Edition De Rapport', array('action' => 'rapport')); ?></li> -->
	</ul>
</div>
