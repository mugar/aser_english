<script>
 jQuery.noConflict();
 jQuery(document).ready(function(){
		jQuery('#produits').selectFilter({
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
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Historique',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->element('combobox',array('n°'=>0));
			echo $this->Form->input('produit_id',array('selected'=>0,'id'=>'produits', 'class'=>'produit_filtered','options'=>$produits1));
			echo $this->Form->input('stock_id',array('selected'=>0,'id'=>'stockId','options'=>$stocks1));
			echo $this->Form->input('supplier');	
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('invoice_no',array('label'=>'Invoice N°'));		
			echo $this->Form->input('libelle',array('options'=>$inventory_operation_types));
			echo $this->Form->input('date1',array('label'=>'Start Date','type'=>'text'));				
			echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));		
			if($action=='rapport')		
				echo $this->Form->input('xls',array('label'=>'Exporter to Excel','type'=>'checkbox'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>