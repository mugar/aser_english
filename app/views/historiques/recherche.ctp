
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Historique',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->element('combobox',array('n°'=>0));
			echo $this->Form->input('produit_id',array('selected'=>0,'id'=>'produits','options'=>$produits1));
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