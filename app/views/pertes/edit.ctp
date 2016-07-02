<?php $action=(isset($action))?$action:'edit';?>
<div class="dialog">
<?php echo $this->Form->create('Perte',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
			if($action=='edit')
				echo $this->Form->input('id');
			echo $this->Form->input('date',array('label'=>'Date d\'Opération','type'=>'text','id'=>'DateEdit'));
			if($action=='edit')
				echo $this->Form->input('stock_id');
			echo $this->Form->input('quantite');
			if($action=='edit'){
				echo $this->Form->input('Product.id',array('type'=>'hidden'));
				echo $this->Form->input('Product.unite_id',array('label'=>'Unité de Mesure'));
			}
			if($action=='edit'){
				echo $this->Form->input('produit_id');
			}
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('nature');
			echo $this->Form->input('description',array('id'=>'description','type'=>'textarea'));
			if(Configure::read('aser.pharmacie')){
				echo $this->Form->input('batch',array('label'=>'N° De Lot'));
				echo $this->Form->input('date_expiration',array('label'=>'Date d\'expiration','type'=>'text','id'=>'DateExpEdit'));
			}
			if (Configure::read('aser.shifts'))
				echo $this->Form->input('shift',array('options'=>$shifts));
			if($action=='edit'){
				echo $this->Form->input('historique_id',array('type'=>'hidden'));
				echo $this->Form->input('personnel_id',array('type'=>'hidden'));
			}
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>