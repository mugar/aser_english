<script>
	jQuery(document).ready(function(){
		var date_ask=jQuery('#date_ask').val()
		if(date_ask=='automatique'){
			jQuery('#Date_given').attr('disabled','disabled')
		}
		
		jQuery('#date_ask').change(function(){
		 var date_ask=jQuery(this).val();
		 	if(date_ask=='automatique'){
				jQuery('#Date_given').attr('disabled','disabled')
			}
			else {
				jQuery('#Date_given').removeAttr('disabled').focus()
			}
		});

	})
</script>
<h3><?php __('Configuration des paramètres du logiciel ');  ?></h3>
<?php echo $this->Form->create('Config',array('type'=>'file'));?>
<fieldset>
	<fieldset class="ingredient"><legend>Détail de l'entreprise</legend>
	<?php
		echo $this->Form->input('address1',array('label'=>'Adresse 1','type'=>'text'));
		echo $this->Form->input('address2',array('label'=>'Adresse 2','type'=>'text'));
		echo $this->Form->input('tel',array('label'=>'Tel','type'=>'text'));
		echo $this->Form->input('nif',array('label'=>'NIF','type'=>'text'));
		echo $this->Form->input('compte_BIF',array('label'=>'BIF Account','type'=>'text'));
		echo $this->Form->input('compte_USD',array('label'=>'USD Account','type'=>'text'));
		echo $this->Form->input('compte_EUR',array('label'=>'EUR Account','type'=>'text'));
		echo $this->Form->input('email',array('label'=>'E-mail','type'=>'text'));
		echo $this->Form->input('web',array('label'=>'Web Site','type'=>'text'));
		echo $this->Form->input('bp',array('label'=>'PO BOX','type'=>'text'));
		echo $this->Form->input('signature',array('label'=>'Signature Message','type'=>'textarea'));
		echo $this->Form->input('taux_usd',array('label'=>'exchange rate for DOLLAR -> BIF'));
	?>
	</fieldset>
	<?php
		echo $this->Form->input('date_ask',array('id'=>'date_ask','label'=>'Date des factures','options'=>array('automatique'=>'automatique','manuel'=>'manuel')));
		echo $this->Form->input('date_given',array('label'=>'Date choisie' ,'id'=>'Date_given'));
		echo $this->Form->input('warning',array('label'=>'Message d\' avertissement','type'=>'textarea'));
		echo $this->Form->input('tva',array('label'=>'taux de la TVA'));
		if(Configure::read('aser.gouvernance')){
			echo $this->Form->input('recouche',array('label'=>'Nombre de nuitée avant la recouche à blanc'));
		}
		echo $this->Form->input('command',array('label'=>'Chemin d\'accès pour mysqldump'));
		
	?>
	<?php if(Configure::read('aser.POS')):?>
			
	<fieldset class="ingredient"><legend>Paramètres pour le Point de Vente</legend>
	<?php
		echo $this->Form->input('thermal',array('options'=>array('oui'=>'imprimante thermal','non'=>'standard avec image','standard_sans_image'=>'standard sans image'),'label'=>'Format de l\'impression'));
		echo $this->Form->input('header',array('type'=>'textarea','label'=>'Texte d\'Entête'));
		echo $this->Form->input('footer',array('type'=>'textarea','label'=>'Texte de Pied de Page'));
		echo $this->Form->input('change',array('options'=>array('oui'=>'oui','non'=>'non'),'label'=>'Calcul du change'));
		if($config['multi_resto']){			
			foreach(Configure::read('bars') as $name=>$tables){
				echo $this->Form->input($name,array('label'=>'Nom de la Place : '.Inflector::humanize($name)));
			}
		}
		?>
	<?php endif; ?>
</fieldset>
		<?php echo $this->Form->end(__('Enregistrer la configuration', true));
		 ?>
