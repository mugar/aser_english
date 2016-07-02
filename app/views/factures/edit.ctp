<div id="edit_facture_boxe" style="display:none" title="Edit la facture">
<div class="dialog">
	<?php echo $this->Form->create('Facture',array('id'=>'edit_facture_form','action'=>'edit'));?>
	<span class="left">
		<?php
			echo $this->Form->input('id',array('type'=>'hidden','value'=>$facture['id']));
			echo $this->Form->input('tier_id',array('label'=>'Nom du Customer','selected'=>$facture['tier_id']));
			if(Configure::read('aser.beneficiaires'))
				echo $this->Form->input('beneficiaire',array('label'=>'Nom du Béneficiaire'));
			if(Configure::read('aser.detailed_ben'))
				echo $this->Form->input('matricule',array('label'=>'N° de Matricule'));
			echo $this->Form->input('bon_commande',array('label'=>'Bon de commande'));
			echo $this->Form->input('observation',array('id'=>'FactObs'));
			
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('date_emission',array('type'=>'text','label'=>'Date d\'émission','value'=>$facture['date_emission']));
			echo $this->Form->input('date',array('type'=>'text','label'=>'Date de Création','value'=>$facture['date']));
			if(Configure::read('aser.detailed_ben')){
				echo $this->Form->input('liasse',array('label'=>'N° de liasse'));
				echo $this->Form->input('employeur',array('label'=>'Nom de l\'employeur'));
			}
			if(Configure::read('aser.choix_tva')&&Configure::read('aser.tva')){
				$options=($facture['tva_incluse'])?
						array('type'=>'checkbox','checked'=>'checked'):
						array('type'=>'checkbox');
				echo $this->Form->input('tva_incluse',$options);
			}
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>