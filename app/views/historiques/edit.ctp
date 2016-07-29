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
<?php echo $this->Form->create('Historique',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('date',array('label'=>'Date d\'Opération','type'=>'text','id'=>'DateOpEdit'));
			echo $this->Form->input('quantite',array('label'=>'Qty'));
			echo $this->Form->input('Produit.unite_id',array('label'=>'Measuring Unit'));
			echo $this->Form->input('Produit.id',array('type'=>'hidden'));
			echo $this->Form->input('produit_id',array('id'=>'produit_edit','class'=>'produit_filtered','label'=>'Product'));
			echo $this->Form->input('PU',array('label'=>'Unit Price'));
		?>
	</span>
	<span class="right">
		<?php

			if(!Configure::read('aser.multi_pv')){
				echo $this->Form->input('Produit.PV',array('label'=>'Product Sale Price'));
			}
				echo $this->Form->input('supplier');
				echo $this->Form->input('invoice_no',array('label'=>'Invoice N°'));
			if(Configure::read('aser.pharmacie')){
				echo $this->Form->input('batch',array('label'=>'Batch N°'));
				echo $this->Form->input('date_expiration',array('label'=>'Expiration Date','type'=>'text','id'=>'DateExpEdit'));
			}
			// echo $this->Form->input('tier_id',array('options'=>$tiers1));
			echo $this->Form->input('stock_id',array('label'=>'Store'));
			echo $this->Form->input('libelle',array('label'=>'Operation Type','options'=>$inventory_operation_types));
			echo $this->Form->input('comments',array('type'=>'text'));
			if (Configure::read('aser.shifts'))
				echo $this->Form->input('shift',array('options'=>$shifts));
			echo $this->Form->input('personnel_id',array('type'=>'hidden'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
