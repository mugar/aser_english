<script>
	jQuery(function(){
		jQuery('#fullName').removeAttr('disabled'); // by default that field should be enabled
		jQuery('#clientList').change(function(){
			if(jQuery(this).val()!=0){
				jQuery('#fullName').attr('disabled','disabled');
			}
			else {
				jQuery('#fullName').removeAttr('disabled');
			}
		})
	})
</script>
<?php 
	$action=(isset($action))?$action:'add';
	$id=($action=='add')?'tierAdd':'edit_form';
?>

<?php if($action=='edit'):?>
<div class="dialog">
<?php endif;?>
<?php if(isset($reservation)) echo '<fieldset><legend>'.__('Customer Information').'</legend>';?>
<?php echo $this->Form->create('Tier',array('id'=>$id,'action'=>$action,'class'=>'client_info'));?>
	<span class='left'>
		<?php
			if(Configure::read('aser.hotel')&&($action=='edit')&&empty($reservation[$model]['facture_id'])&&!isset($context)){
				echo '<button onclick="create_customer();return false;">Create a customer</button>';
				echo $this->Form->input('Reservation.new_tier_id',array('id'=>'clientList','options'=>$tiers1,'label'=>'Selectionner un autre client'));
			}
			if($action=='add'){
				echo $this->Form->input('Tier.nom',array('id'=>'clientNom', 'label'=>'First Name'));
				echo $this->Form->input('Tier.prenom',array('id'=>'prenom','label'=>'Last Name'));
			}
			else {
				echo $this->Form->input('Tier.id');
				echo $this->Form->input('Tier.name',array('id'=>'fullName','label'=>'Full Name'));
			}
			if($action=='edit'){
				// echo $this->Form->input('type',array('label'=>'','id'=>'op','options'=>array('client'=>'customer',
				// 																		'fournisseur'=>'supplier',
				// 																		)
				// 											)
				// 						);
			}
			else {
				echo $this->Form->input('type',array('label'=>'','type'=>'hidden','value'=>'client'));
			}
			echo '<label>Compagnie</label>';
			echo $ajax->autoComplete('Tier.compagnie','/tiers/autoComplete/compagnie');
			echo $this->Form->input('Tier.telephone');
			echo $this->Form->input('Tier.pers_contact',array('label'=>'Infos about the contact person','id'=>'pers_contact'));
			
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('Tier.email');
			if(Configure::read('aser.hotel')){
				echo $this->Form->input('Tier.passport');
				//setting params for the nationalite field
				$nationalite_params['options']=$countries;
				if(empty($this->data)) {
					$nationalite_params['selected']='BDI';
				}
				echo $this->Form->input('Tier.nationalite',$nationalite_params, array('label'=>'Nationality'));
			}
			if(Configure::read('aser.POS')){
				echo $this->Form->input('Tier.reduction',array('label'=>'Restaurant discount in %'));
				echo $this->Form->input('Tier.type_reduction',array('type'=>'hidden','value'=>'On the total'));
			}
			if(in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))){
				echo $this->Form->input('Tier.max_dette', array('label'=>'Max Debt'));
			}
			if($action=='edit'){
				echo $this->Form->input('Tier.actif',array('type'=>'checkbox'));
			}
		?>
	</span>
</form>
<?php if(isset($reservation)) echo "</fieldset>";?>	

	<?php if(Configure::read('aser.hotel')&&($action=='edit')&&isset($reservation)&&($model=='Reservation')):?>
		<?php echo $this->Form->create($model,array('id'=>'res_fields'));?>
		<fieldset><legend><?php __('Booking Information');?></legend>
		<span class='left'>
		<?php
			echo $this->Form->input($model.'.id',array('type'=>'hidden')); 
			$puOptions['label']='Rate';
			if(!in_array($reservation[$model]['etat'],array('pending','confirmed')))
				 $puOptions['disabled']='disabled';
			echo $this->Form->input($model.'.PU',$puOptions);
			echo $this->Form->input($model.'.pax',array('label'=>'Number of people','options'=>$pax));
		?>
		</span>
		<span class='right'>
		<?php
			echo $this->Form->input($model.'.mode_paiement',array('label'=>'Planned Payment Mode'));
		?>
		</span>
		</fieldset>
		</form>
	<?php endif;?>
	
<?php if($action=='edit'):?>
</div>
<?php endif;?>