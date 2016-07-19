<div class="dialog">
<?php echo $this->Form->create('Historique',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('date',array('label'=>'Date d\'Opération','type'=>'text','id'=>'DateOpEdit'));
			echo $this->Form->input('quantite',array('label'=>'Qty'));
			echo $this->Form->input('Produit.unite_id',array('label'=>'Measuring Unit'));
			echo $this->Form->input('Produit.id',array('type'=>'hidden'));
			echo $this->Form->input('produit_id',array('label'=>'Product'));
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
			echo $this->Form->input('stock_id');
			echo $this->Form->input('libelle',array('options'=>$inventory_operation_types));
			if (Configure::read('aser.shifts'))
				echo $this->Form->input('shift',array('options'=>$shifts));
			echo $this->Form->input('personnel_id',array('type'=>'hidden'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
