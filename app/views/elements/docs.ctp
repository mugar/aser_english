
<?php if($type=='links'): ?>
	<?php if(in_array('bons',$actions)): ?>
		<li class="link" onclick = "documents('checkbox','bon')" >Créer Bon </li>
		<li class="link" onclick = "remove_docs('checkbox','bon')" >Delete Bon </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Bons', true)), array('controller' => 'bons', 'action' => 'index')); ?> </li>
	<?php endif; ?>
	
	<?php if(in_array('factures',$actions)): ?>
		<li class="link" onclick = "documents('checkbox','facture')" >Créer Facture </li>
		<li class="link" onclick = "remove_docs('checkbox','facture')" >Annuler Facture </li>		
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Invoices', true)), array('controller' => 'factures', 'action' => 'index')); ?> </li>
	<?php endif; ?>
	
	<?php if(in_array('commandes',$actions)): ?>	
		<li class="link" onclick = "documents('checkbox','commande')" >Créer Commande </li>
		<li class="link" onclick = "remove_docs('checkbox','commande')" >Delete Commande </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Commandes', true)), array('controller' => 'commandes', 'action' => 'index')); ?> </li>
	<?php endif; ?>
<?php else: ?>
	<?php if(in_array('commandes',$actions)): ?>
	<div id="commande" style="display:none" title="Enregistrement d'une commande">
		<div class="dialog">
			<div id="message"></div>
		<?php echo $this->Form->create('Commande',array('id'=>'commande_form','action'=>'create_commande'));?>
			<span id="left">
			<?php
			//	echo $this->Form->input('Commande.numero',array('label'=>'Numéro du commande'));
				echo $this->Form->input('Document.action',array('type'=>'hidden','value'=>'commande'));
				echo $this->Form->input('Document.model',array('type'=>'hidden','value'=>$model));
			?>
			</span>
			<span class="right">
				<?php echo $this->Form->input('Commande.date',array('type'=>'text'));?>
			</span>
		</div>
		</form>
     </div>
	<?php endif; ?>
	<?php if(in_array('bons',$actions)): ?>
	<div id="bon" style="display:none" title="Enregistrement d'un Bon">
		<div class="dialog">
			<div id="message"></div>
		<?php echo $this->Form->create('Facture',array('id'=>'bon_form','action'=>'create_bon'));?>
			<span class="left">
			<?php
				echo $this->Form->input('Bon.transporteur');
				echo $this->Form->input('Bon.expediteur',array('label'=>'Expéditeur'));
				echo $this->Form->input('Document.action',array('type'=>'hidden','value'=>'bon'));
				echo $this->Form->input('Document.model',array('type'=>'hidden','value'=>$model));
			?>
			</span>
			<span class="right">
				<?php echo $this->Form->input('Bon.date',array('type'=>'text'));?>
			</span>
		</div>
		</form>
    </div>
	<?php endif; ?>
	<?php if(in_array('factures',$actions)): ?>
		<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
   
   //decide what to show or hide based on payment selection
	jQuery('#select_paiement').change(function(){
		var etat=jQuery('#select_paiement option:selected').html();
 		if(etat=='paid'){
 			jQuery('input[id*="Paiement"],select[id*="Paiement"]').removeAttr('disabled');
 			jQuery('#PaiementMontant').attr('disabled','disabled');
 		}
 		else if(etat=='half_paid'){
 			jQuery('input[id*="Paiement"],select[id*="Paiement"]').removeAttr('disabled');
 		}
 		else {
 			jQuery('input[id*="Paiement"],select[id*="Paiement"]').attr('disabled','disabled');
 		}
 	})
 	// montant equivalent field stuff
 	jQuery('#PaiementEqui').change(function(){
		var equi=jQuery(this).val();
 		if(equi!=''){
 			jQuery('#monnaie').removeAttr('disabled');
 		}
 		else {
 			jQuery('#monnaie').attr('disabled','disabled');
 		}
 	})
	
	});
</script>
	<div id="facture" style="display:none" title="Invoice Creation">
		<div class="dialog">
			<div id="message"></div>
		<?php echo $this->Form->create('Facture',array('id'=>'facture_form','action'=>'create_facture'));?>
		<?php if($model=='Proforma'): ?>
			<span class="left">
				<?php
				//	echo $this->Form->input('Facture.numero',array('label'=>'Numéro de la facture'));
					echo $this->Form->input('Facture.date',array('type'=>'text'));
					//	echo $this->Form->input('Facture.echeance',array('id'=>'DateEcheance','type'=>'text','label'=>'Date limite de paiement'));
					
					?>
			</span>
			<span class="right">
				<?php	
					$config=Configure::read('aser');
					if($config['tva'])
						echo $this->Form->input('Facture.inclure_tva',array('label'=>'Include VAT','type'=>'checkbox','checked'=>'checked'));
					echo $this->Form->input('Document.action',array('type'=>'hidden','value'=>'facture'));
					echo $this->Form->input('Document.model',array('type'=>'hidden','value'=>$model));
				?>	
			</span>
		<?php else : ?>
			<span class="left">
				<?php
					echo $this->Form->input('Facture.date',array('type'=>'text'));
					echo $this->Form->input('Facture.etat',array('label'=>'state','options'=>array(
																				'credit'=>'credit',
																				'paid'=>'paid',
																				'half_paid'=>'half_paid',
																				),
																			'id'=>'select_paiement'
																		));
					$config=Configure::read('aser');
					echo $this->Form->input('Paiement.montant',array('label'=>'amount','disabled'=>'disabled'));
					
					?>
			</span>
			<span class="right">
				<?php	
					echo $this->Form->input('Paiement.montant_equivalent',array('label'=>'Equivalent Amount','id'=>'PaiementEqui'));
					echo $this->Form->input('Paiement.monnaie',array('id'=>'monnaie','label'=>'Currency','disabled'=>'disabled'));																	
					echo $this->Form->input('Paiement.mode_paiement',array('label'=>'Payment Mode'));
					echo $this->Form->input('Paiement.reference');
					echo $this->Form->input('Document.action',array('type'=>'hidden','value'=>'facture'));
					echo $this->Form->input('Document.model',array('type'=>'hidden','value'=>$model));
				?>	
			</span>
		<?php endif; ?>
	</form>
<div style="clear:both"></div>
</div>
</div>
	<?php endif; ?>
<?php endif; ?>