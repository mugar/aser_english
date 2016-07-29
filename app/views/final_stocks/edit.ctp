<script>
 jQuery.noConflict();
 jQuery(document).ready(function(){
 	
		jQuery('#produit_edit').selectFilter({
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
<div class="dialog">
<?php echo $this->Form->create('FinalStock',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('date',array('label'=>'Date d\'Opération','type'=>'text','id'=>'DateOpEdit'));
			echo $this->Form->input('stock_id',array('options'=>$stocks,'label'=>'Store'));
			echo $this->Form->input('stock_manager_id',array('options'=>$personnels,'label'=>'Store Manager'));
		?>
	</span>
	<span class="right">
		<?php
		
			echo $this->Form->input('produit_id',array('id'=>'produit_edit','class'=>'produit_filtered','label'=>'Product'));
			echo $this->Form->input('quantite',array('label'=>'Quantity'));
			echo $this->Form->input('controler_id',array('type'=>'hidden'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
