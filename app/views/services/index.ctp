<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
    resto_date();
	indicator();
	jQuery('fieldset#form_service').bind('keypress', function(e) {
		if ((e.keyCode || e.which) == 13){
			var etat_facture=jQuery('table#list_factures tr[id="'+factureId+'"] td[id="etat"]').text();
			var classement=jQuery('table#list_factures tr[id="'+factureId+'"]').attr('name');
			var printed=jQuery('table#list_factures tr[id="'+factureId+'"]').attr('printed');
			 if((factureId!=0)&&(etat_facture!='canceled')&&(classement!='1')&&(printed!='1'))
  				 service_create(factureId);
		 }	
	});
	jQuery('input#cash').bind('keypress', function(e) {
		if ((e.keyCode || e.which) == 13){
			if(jQuery('span#montant').text()!=''){
				var change=parseInt(jQuery('input#cash').val())-parseInt(jQuery('span#montant').text());
				jQuery('input#change').val(change);
			}
		 }	
	});
	jQuery('fieldset#paiement').bind('keypress',function(e) {
		if ((e.keyCode || e.which) == 13){
			return false
		 }	
	});
	
	var key_press=true;
	
	jQuery('input,select,textarea').focus(function(){
		 key_press=false;
	})
	jQuery('input,select,textarea').blur(function(){
		 key_press=true;
	})
	//shortcut for printing
	jQuery(document).bind('keypress',function(e) {
		
		if (((e.keyCode || e.which || e.charCode) ==80)||((e.keyCode || e.which || e.charCode) ==112)){
			//sama stuff
			 if(print&&key_press&&(factureId!=0)&&(jQuery('table#list_factures tr[id="'+factureId+'"] td[id="etat"]').text()!='canceled')){
  				//	 print_facture(factureId);
  			}
		 }	
	});
	jQuery('#ServiceBeneficiaire').change(function(){
		if(jQuery(this).val()!=''){
			jQuery('.ben').removeAttr('disabled');
		}
		else {
			jQuery('.ben').attr('disabled','disabled');
		}
	})
	//for getting client ari muri chambre
	jQuery('#chambre').bind('keypress', function(e) {
		if ((e.keyCode || e.which) == 13){
  				 chambre();
		 }	
	});
	
	jQuery('#equi').change(function(){
		var equi=jQuery(this).val();
 		if(equi!=''){
 			jQuery('#monnaie').removeAttr('disabled');
 		}
 		else {
 			jQuery('#monnaie').attr('disabled','disabled');
 		}
 	})
 	jQuery('#mode').change(function(){
 		
 		if(jQuery(this).val()!='cash'){
 			jQuery('#monnaie option[value="EUR"]').hide();
 		}
 		else {
 			jQuery('#monnaie option[value="EUR"]').show();
 		}
 	})
 	/*	
 	if(jQuery('#pos').attr('longlist')=='1'){
 		//filter list of type_services
		jQuery('#type_services').selectFilter({
  		'clearInputOnEscape': true,
    	'disableRegex': true,
    	// The class to apply to the filter bar.
    	'filterClass': 'filter-select',
    	'inputPlaceholder': 'Taper pour filtrer',
    	'minimumCharacters': 1,
    	'minimumSelectElementSize': 3,
    	// Amount of time to delay filtering (in ms) after a key is pressed.
    	'searchDelay':0,
    	'searchFromBeginning':false,
    	// The width for the select element and its input filter box.
    	// If -1, both the select element and its filter box have their size set to the width of
    	// the select element before any filtering occurs.
    	'width': -1
  		});
  	}
  	//*/
 	window.onload=function(){ 
    	if(jQuery('#pos').attr('stock')==''){
       		parameters();		
       	}
       	if(jQuery('#pos').attr('search-detailed-names')=='1'){
       		detailed_products_names();
       	}
    }
    jQuery('#GroupeId option:first').attr('selected','selected') //making sure the first group is always selected at page load;
});
</script>
<?php
		$config=Configure::read('aser');
?>
<div id="pos" 
	class="vente"
	controller="services"
	controller="Service"
	beneficiaires="<?php echo $config['beneficiaires'];?>"
	thermal="<?php echo $thermal;?>"
	touch="off"
	fonction="<?php echo $session->read('Auth.Personnel.fonction_id');?>"
	printonce="<?php echo  $config['one_time_printing'];?>"
	>
<div id="resto_layout">
	<div id="message_tier"></div>
	<span id='first'>
		<?php echo $this->Form->create('Service',array('id'=>'vente_add','controller'=>'services','action'=>'add'));?>
		<fieldset id="form_service"><legend><?php __('Détails Service');?></legend>
		<?php
			echo '<span id="service_type_services">'.$this->Form->input('type_service_id',array('id'=>'produits','label'=>'Type of Service','options'=>$type_services)).'</span>';

			if(!$config['magasin']&&$config['bon']){
			//	echo $this->Form->input('garnish',array('options'=>$garnishList,'selected'=>0,'label'=>'Accompagnements'));
			}
			echo $this->Form->input('quantite',array('id'=>'VenteQuantite','value'=>1,'label'=>'Quantité'));
			if(Configure::read('aser.PU'))
				echo $this->Form->input('PU',array('id'=>'VentePU','label'=>'Autre Prix Unitaire'));
			 echo $this->Form->input('beneficiaire',array('id'=>'VenteBeneficiaire','label'=>'Beneficiary Name'));
		?>
		</fieldset>
		<fieldset id="form_client"><legend>Customer Info</legend>
		<?php
			if(Configure::read('aser.hotel'))
				echo $this->Form->input('chambre',array('id'=>'chambre', 'label'=>'Room N°'));
			echo $this->Form->input('tier_id',array('id'=>'tierId','selected'=>0,'options'=>$tiers1,'label'=>'Customer'));
		?>
		</fieldset>
		</form>
	</span>
	
	<span id="second">
		<h4>(Connected user : <?php echo ucfirst($session->read('Auth.Personnel.identifiant')); ?>)</h4>
		<fieldset id="list_factures"><legend>Invoices List</legend>
			<table cellpadding="0" cellspacing="0" id="list_factures">
				<tr>
					<th>Invoice N°</th>
					<th>Customer</th>
					<th>Sub Total</th>
					<th>Discount (%)</th>
					<th>Total</th>
					<th>Left To Pay</th>
					<th>State</th>
					<th>Cashier</th>
					<th><?php echo $this->Form->input('date_service',array('label'=>'','value'=>$date,'id'=>'DateResto','type'=>'text'));?></th>
				</tr>
				<?php echo $this->element('../services/list_factures',array('factures'=>$factures));?>
			</table>
		</fieldset>
		<fieldset id="list_type_services"><legend>Services List</legend>
			<table cellpadding="0" cellspacing="0" id="list_type_services">
				<tr>
					<th></th>
				<?php if($config['beneficiaires']): ?>
					<th>Beneficiary</th>
				<?php endif; ?>
					<th>Service</th>
					<th>Qty</th>
					<th>Unit Price</th>
					<th>Total Price</th>
					<th>Time</th>
				</tr>
			</table>
		</fieldset>
	</span>
	<span id='third'>
		<fieldset id="service_info"><legend>Invoice Details</legend>
			<span class="info">Invoice N° : <span id="facture"></span></span>
		</fieldset>
		<fieldset id="paiement"><legend>Réglement</legend>
			
			<span class="info">Total Amount : <span id="montant"></span></span>
			<span class="info">Left to Pay : <span id="reste"></span></span>
		<form>
		<?php
				echo '<span class="bouttons">';
				echo '<span name="payment" value="1" class="boutton_selected" onclick="switcher(this)">PAID</span>';	
				echo '<span name="payment" value="2" class="boutton" onclick="switcher(this)">CREDIT</span>';
				if(Configure::read('aser.bonus'))	
					echo '<span name="payment" value="3" class="boutton" onclick="switcher(this)">BONUS</span>';	
				echo '<span name="payment" value="4" class="boutton" onclick="switcher(this)">HALF PAID</span>';	
				echo '</span>';
			echo $this->Form->input('avance',array('value'=>0,'id'=>'avance'));
		if($change=='yes'){
			echo $this->Form->input('cash',array('value'=>0,'id'=>'cash'));
			echo $this->Form->input('change',array('value'=>0,'id'=>'change'));
		}
			echo $this->Form->input('observation',array('type'=>'textarea'));
		?>
			</form>
		</fieldset>
	</span>
	<fieldset id="actions"><legend>Actions</legend>
		<?php if(!in_array($fonction,array(3,5,8))): ?>
			<span class="boutton" onclick="resto_create('creation')" title="Créer la nouvelle facture">CREATE INVOICE</span>
		<?php endif;?> 
		<span id="add_facture" name="disable" class="boutton" title="ajouter la nouvelle consommation à la facture sélectionnée">ADD SERVICE</span>
		<span id="remove_facture" name="annuler" class="boutton"  title="Annuler la facture">CANCEL INVOICE</span>
		<span id="remove_conso" name="disable" class="boutton"  title="Supprimer la consommation de la facture sélectionnée ">DELETE SERVICE</span>
		<?php if(in_array($fonction,array(3,5,8))): ?>
			<span id="direct_reduction" name="disable" class="boutton"  title="Réduire directement le montant de la facture ">DISCOUNT</span>
			<span id="unlock" name="unlock" class="boutton"  title="Débloquer la facture" onclick="unlock(factureId)">UNLOCK</span>
		<?php endif;?> 
		<span id="paiement_facture" name="classer" class="boutton" title="Clôturer la facture en marquant son état de paiement">CLOSE INVOICE</span>
		<span class="boutton" onclick="print_facture(factureId)" title="Print la facture">Print</span>
		<?php if($config['client_auto_creation']): ?>
			<span class="boutton" onclick="service_tier()" title="Créer un nouveau client">Customer</span>
		<?php endif;?>
		<span class="boutton" onclick="document.location.href=getBase()+'services/journal'" title="Rapport Caisse">REPORT</span>
	</fieldset>
</div>
</div>
<div id="add_client" style="display:none" title='Create a new customer'</span>
<div class="dialog">
	<div id="message_client"></div>
	<?php echo $this->element('../tiers/edit',array('action'=>'add'));?>
<div style="clear:both"></div>
</div>
</div>

<!-- form for paiement creation -->
<div id="pyt_boxe" style="display:none" title="Détails du Paiement">
<div class="dialog">
	<div id="message_pyt"></div>
	<?php echo $this->Form->create('Paiement');?>
	<span class="left">
		<?php
			echo $this->Form->input('mode_paiement',array('id'=>'mode', 'label'=>'Mode Payment'));
			echo $this->Form->input('reference',array('id'=>'ref'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('montant_equivalent',array('id'=>'equi', 'label'=>'Equivalent Amount'));
			echo $this->Form->input('monnaie',array('id'=>'monnaie', 'label'=>'Currency', 'disabled'=>'disabled','selected'=>'USD'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<!--printing iframe -->
<iframe id="printPage" name="printPage" src='' style="position:absolute;top:0px; left:0px;width:0px; height:0px;border:0px;overfow:none; z-index:-1"></iframe>
