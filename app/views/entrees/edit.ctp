<div class="dialog">
<?php echo $this->Form->create('Entree',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('date',array('label'=>'Date d\'Opération','type'=>'text','id'=>'DateOpEdit'));
			echo $this->Form->input('quantite');
			echo $this->Form->input('Produit.unite_id',array('label'=>'Unité de Mesure'));
			echo $this->Form->input('Produit.id',array('type'=>'hidden'));
			echo $this->Form->input('produit_id');
			echo $this->Form->input('PA',array('label'=>'Prix D\'Achat'));
			if(!Configure::read('aser.multi_pv')){
				echo $this->Form->input('Produit.PV',array('label'=>'Prix De Vente'));
			}
		?>
	</span>
	<span class="right">
		<?php
			if(Configure::read('aser.pharmacie')){
				echo $this->Form->input('batch',array('label'=>'N° De Lot'));
				echo $this->Form->input('date_expiration',array('label'=>'Date d\'expiration','type'=>'text','id'=>'DateExpEdit'));
			}
			echo $this->Form->input('tier_id',array('options'=>$tiers1));
			echo $this->Form->input('stock_id');
			echo $this->Form->input('type');
			if (Configure::read('aser.shifts'))
				echo $this->Form->input('shift',array('options'=>$shifts));
			echo $this->Form->input('personnel_id',array('type'=>'hidden'));
			echo $this->Form->input('historique_id',array('type'=>'hidden'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
