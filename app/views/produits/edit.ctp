<?php echo $this->element('../produits/nullable');?>
<div class="dialog">
<?php echo $this->Form->create('Produit',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name',array('label'=>'Product Name','id'=>'nom'));
			echo $this->Form->input('PA',array('label'=>'Purchase price','id'=>'pa'));
			if(!Configure::read('aser.multi_pv'))
				echo $this->Form->input('PV',array('label'=>'Sale Price','id'=>'pv'));
			echo $this->element('combobox',array('selected'=>false,'n°'=>3));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('type',array('label'=>'Product Type',
												'options'=>$typeDeProduits,
												'id'=>'type'
												));
			echo $this->Form->input('unite_id',array('label'=>'Measuring Unit'));
			
			if(Configure::read('aser.pharmacie'))
				echo $this->Form->input('expiration',array('label'=>'Product Expiration'));
			
			if(Configure::read('aser.advanced_stock'))
				echo $this->Form->input('acc',array('label'=>'Garnish',
												'options'=>$garnishOptions,
												));
			if(Configure::read('aser.comptabilite'))
				echo $this->Form->input('groupe_comptable_id');
			echo $this->Form->input('min',array('label'=>'Stock Alert'));
			echo $this->Form->input('description',array('type'=>'text'));
			echo $this->Form->input('actif',array('options'=>array('yes'=>'yes','no'=>'no'),'id'=>'actif'));
			echo $this->Form->input('old_name',array('type'=>'hidden'));
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>