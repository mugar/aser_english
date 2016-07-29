<script>
 jQuery.noConflict();
 jQuery(document).ready(function(){
 	
 
 	jQuery('#produit').change(function(){
		jQuery.ajax({
			type:'GET',
			url:getBase()+'historiques/pa/'+jQuery(this).val(),
			dataType:'json',
			success:function(ans){
				jQuery('#PU').val(ans.PU);
			}
		})
	})
		//support only multiplication
	jQuery('#quantite').change(function(){
		var mul=1;
		jQuery.each(jQuery(this).val().split('*'),function(j,val1){
			if(parseFloat(val1)==val1){
				mul*=parseFloat(val1);
			}
		});
		jQuery('#quantite').val(mul);
	})
	
	//support only division
	jQuery('#PU').change(function(){
		if(/\d+\/\d+/.test(jQuery(this).val())){
			var PU=Math.round(parseFloat(jQuery(this).val().split('/')[0])/parseFloat(jQuery(this).val().split('/')[1]));
			jQuery('#PU').val(PU);
		}
	});

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
<div class="historiques index">
	<h2>Inventory Operations</h2>
	
<!--recherche form -->
<?php echo $this->element('../historiques/recherche',array('action'=>'index'));?>
		<br>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Operation Date </th>
		<th>Operation Type</th>
		<th>Supplier</th>
		<th>Invoice N°</th>
		<th>Product</th>
		<th>Quantity</th>
		<th>Unit Price</th>	
		<?php if(Configure::read('aser.pharmacie')):?>
			<th>Batch N°</th>
			<th>Expiration Date</th>
		<?php endif;?>		
		<th>Store</th>		
		<th>Comment</th>	
		<?php if (Configure::read('aser.shifts')):?>
			<th>Shift</th>	
		<?php endif;?>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Historique',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('date',array('label'=>'','type'=>'text'));?></td>
		<td><?php echo $this->Form->input('libelle',array('label'=>'','options'=>$inventory_operation_types));?></td>
		<td><?php echo $this->Form->input('supplier',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('invoice_no',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('produit_id',array('id'=>'produit','label'=>'','class'=>'produit_filtered','options'=>$produits));?></td>
		<?php echo $this->Form->input('bug_fixer',array('type'=>'hidden','label'=>''));?>
		<td><?php echo $this->Form->input('quantite',array('id'=>'quantite','label'=>''));?></td>
		<td><?php echo $this->Form->input('PU',array('label'=>'','value'=>$pa,'id'=>'PU'));?></td>
		<?php if(Configure::read('aser.pharmacie')):?>
			<td><?php echo $this->Form->input('batch',array('label'=>''));?></td>
			<td><?php echo $this->Form->input('date_expiration',array('label'=>'','type'=>'text'));?></td>
		<?php endif;?>
		<td><?php echo $this->Form->input('stock_id',array('id'=>$i.'StockId','label'=>'','options'=>$stocks));?></td>
		<td><?php echo $this->Form->input('comments',array('id'=>'comments','label'=>''));?></td>
		<?php if (Configure::read('aser.shifts')):?>
			<td><?php echo $this->Form->input('shift',array('label'=>'','options'=>$shifts));?></td>	
		<?php endif;?>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Historique',array('name'=>'checkbox','id'=>'Historique_historiques'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('Operation Date','date');?></th>
			<th><?php echo $this->Paginator->sort('Operation Type','libelle');?></th>
			<th><?php echo $this->Paginator->sort('supplier');?></th>
			<th><?php echo $this->Paginator->sort('invoice_no');?></th>
			<th><?php echo $this->Paginator->sort('Product','produit_id');?></th>
			<th><?php echo $this->Paginator->sort('Quantity','quantite');?></th>
			<th><?php echo $this->Paginator->sort('Unit Price','PU');?></th>
			<th><?php echo $this->Paginator->sort('Total Price','montant');?></th>
			<?php if(Configure::read('aser.pharmacie')):?>
				<th><?php echo $this->Paginator->sort('Batch N°','batch');?></th>
				<th><?php echo $this->Paginator->sort('Expiration Date','date_expiration');?></th>
			<?php endif;?>
			<th><?php echo $this->Paginator->sort('Store','stock_id');?></th>
				<th><?php echo $this->Paginator->sort('comments');?></th>
			<?php if (Configure::read('aser.shifts')):?>
				<th><?php echo $this->Paginator->sort('shift');?></th>	
			<?php endif;?>
			<th><?php echo $this->Paginator->sort('Created By','personnel_id');?></th>
		</tr>
	<?php
	foreach ($historiques as $historique){
		echo $this->element('../historiques/add',array('historique'=>$historique));
	}
		
	?>
	</table>
</form>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing  %current% records out of %count% in  total, from %start%, to %end%', true)
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
		<li><?php echo $this->Html->link('Generate Report', array('action' => 'rapport')); ?></li>
	</ul>
</div>
