<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
	jQuery('#equi').change(function(){
		var equi=jQuery(this).val();
 		if(equi!=''){
 			jQuery('#monnaie').removeAttr('disabled');
 		}
 		else {
 			jQuery('#monnaie').attr('disabled','disabled');
 		}
 	})
 	jQuery('#taux').change(function(){
		var taux=jQuery(this).val();
 		if(taux!=''){
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
 		if(jQuery(this).val()=='transfer'){
 			jQuery('.transfer').removeAttr('disabled');
 			jQuery('#transfer_fields').show();
 		}
 		else {
 			jQuery('.transfer').attr('disabled','disabled');
 			jQuery('#transfer_fields').hide();
 		}
 	})
	});
</script>
<?php 
	if(isset($transfer)){
		$title='Transfer de paiement';
		$boxe="transfer_boxe";
		$form="transferAdd";
		$type='Transfer';
	}
	else if(isset($remboursement)){
		$title='Reimboursement';
		$boxe="remb_boxe";
		$form="rembAdd";
		$type='remboursement';
	}	
	else {
		$title='Payment';
		$boxe="pyt_boxe";
		$form="pytAdd";
		$type='Paiement';
	}
?>
<div id="<?php echo $boxe;?>" style="display:none" title="Creation of a <?php echo $title;?>">
<div class="dialog">
	<?php echo $this->Form->create('Paiement',array('id'=>$form,'name'=>$form,'action'=>$action));?>
	<span class="left">
		<?php
			if(isset($deposit)){
				echo $this->Form->input('tier_id',array('label'=>'Customer Name'));
			}
			if(!isset($hide_amount)){
				echo $this->Form->input('montant',array('id'=>$type.'Montant', 'label'=>'Amount','value'=>$reste));
			}
			if(!isset($deposit)){
				echo $this->Form->input('montant_equivalent',array('id'=>'equi', 'label'=>'Equivalent Amount',));	
			}
			if(!isset($remboursement)){
					$monnaie_options = array('id'=>'monnaie','label'=>'Currency');
				if(!isset($deposit)){
						$monnaie_options += array('disabled'=>'disabled');
				}
				echo $this->Form->input('monnaie',$monnaie_options);
			}
		?>
	</span>
	<span class="right">
		<?php
			if(!isset($remboursement)){
				
				echo $this->Form->input('mode_paiement',array('id'=>'mode','label'=>'Payment Mode'));
				//transfer part
				echo '<span id="transfer_fields" style="display:none;">';
				echo $this->Form->input('facture_transfer',array('label'=>'N° facture','type'=>'text','disabled'=>'disabled','class'=>'transfer'));
				echo $this->Form->input('date_facture',array('label'=>'Date de la facture','disabled'=>'disabled','class'=>'transfer'));
				echo '</span>';
				
				echo $this->Form->input('reference',array('label'=>'Reference'));
			}
			
			if(((Configure::read('aser.belair')==null)&&in_array($session->read('Auth.Personnel.fonction_id'),array(3,5,8)))
				||
				in_array($session->read('Auth.Personnel.fonction_id'),array(3))
				)				
				echo $this->Form->input('date',array('type'=>'text','label'=>'Payment Date','id'=>'Date'.$type));
			else
				echo $this->Form->input('date',array('type'=>'hidden','value'=>date('Y-m-d')));
		?>
	</span>
</form>
<div style="clear:both"></div>
</div>
</div>
