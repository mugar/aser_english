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
<?php echo $this->Form->create('Mouvement',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('date',array('type'=>'text','id'=>'DateEdit'));
		echo $this->Form->input('quantite',array('label'=>'Quantité'));
		echo $this->Form->input('Produit.id',array('type'=>'hidden'));
		echo $this->Form->input('Produit.unite_id',array('label'=>'Measuring Unit'));
		echo $this->Form->input('produit_id',array('label'=>'Product','id'=>'produit_edit','class'=>'produit_filtered'));
		?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('stock_sortant_id',array('options'=>$stocks));
		echo $this->Form->input('stock_entrant_id',array('options'=>$stocks));
		if (Configure::read('aser.shifts'))
				echo $this->Form->input('shift',array('options'=>$shifts));
		//needing those for stock management
		echo $this->Form->input('historique1',array('type'=>'hidden'));
		echo $this->Form->input('historique2',array('type'=>'hidden'));
		
		echo $this->Form->input('personnel_id',array('type'=>'hidden'));
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>