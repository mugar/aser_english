<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
   
	
	var key_press=true;
	
	jQuery('input,select,textarea').focus(function(){
		 key_press=false;
	});
	jQuery('input,select,textarea').blur(function(){
		 key_press=true;
	});
	
	jQuery(document).bind('keypress',function(e) {
		
		if (((e.keyCode || e.which || e.charCode) ==82)||((e.keyCode || e.which || e.charCode) ==114)){
			 if(key_press){
  				// tabella_search();
  			}
		 }
		 	
	});
	/*
	jQuery(document).bind('keypress',function(e) {
		
		if (((e.keyCode || e.which || e.charCode) ==67)||((e.keyCode || e.which || e.charCode) ==99)){
			 if(key_press)
  				 tier();
		 }	
	});
	*/
	 jQuery(window).load(function () {
    	jQuery('#DateChanger').blur();
	});
	//stuff regarding PU
	jQuery('#disc').change(function(){
		var equi=jQuery(this).val();
 		if(equi!==''){
 			jQuery('#disc_mon').removeAttr('disabled');
 		}
 		else {
 			jQuery('#disc_mon').attr('disabled','disabled');
 		}
 	});
 	//stuff regarding PU
	jQuery('#disc1').change(function(){
		var equi=jQuery(this).val();
 		if(equi!==''){
 			jQuery('#disc_mon1').removeAttr('disabled');
 		}
 		else {
 			jQuery('#disc_mon1').attr('disabled','disabled');
 		}
 	});
		//state select
     	jQuery('#stateSelect').change(function(){
     		if(jQuery(this).val()=='partie'){
     			jQuery('select[id*="departureTime"]').removeAttr('disabled');
     		}
     		else
     			jQuery('select[id*="departureTime"]').attr('disabled','disabled');
     	});
		//filter list of client
	/*	
	jQuery('#principal').selectFilter({
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
    	'width': 200
  	});
  	//*/
  	//logic for filtering clients and showing the client creation form only if the customer has not been found
  	//jQuery("#input_dataReservationtier_id").bind("focus",function(){
  	/*
  	jQuery("select#principal").keypress(function(){
		jQuery("#disc").val(jQuery("select#principal option:not(:disabled)").length);
  	})
  	//*/


  	//fetching the details of the last reservation of the guest.
  	last_reservation(jQuery("#principal option:selected").val());
  	jQuery('#principal').change(function(){
  		last_reservation(jQuery(this).val());
  	});

});
</script>
<?php 
/*
 * This file handle all the beautiful tasks related to the graphical display of reservations
 * Quiet interesting stuff; really craving for that :)
 */
?>
<?php
/*
  * @$class : to use
  * @$current_position to increment
  * @$i counter variable
  * @limit variale for stopping the loop
  */
 
 
 function show($class,&$current_position,$i,$limit,$options=null){
 	if(is_null($class)){
 		for($i; $i<$limit;$i++){ 
			echo '<td onmouseover="mouseover(this)"  onmousedown="mousedown(this)" position="'.$current_position.'" numero="'.$current_position.'" class="" style="color:#ccc;">'.($current_position+1).'</td>';
			$current_position++;
		}
	}
	else {
		if($i<$limit){
			echo '<td  facture="'.$options['facture_id'].'" reservation="'.$options['reservation_id'].'" tier="'.$options['tier_id'].'" colspan="'.$limit.'" position="'.$current_position.'" class="'.$class.'"  "numero="'.$current_position.'" >'.$options['tier_name'].'</td>';
			//$current_position++; //updating current position
			$current_position=$current_position+$limit;
		}
	}
 	
 }	
?>
<div class="tabella" id="tabella" type="reservations">
<div class="reservations_paging">
	<?php echo $this->Html->link($this->Html->image('back.png', array('alt'=> 'précédent', 'title'=>'Aller au mois précédent','border' => '0')), array('controller' => 'reservations', 'action' => 'tabella', $prev_month.'/'.$prev_year),array('target' => '_self', 'escape' => false)); ?>
	<h3 id="title"  days="<?php echo $days ?>" month="<?php echo $cur_month?>"  year="<?php echo $cur_year ?>"><?php echo '&nbsp; Reservations pour le mois de '.$this->MugTime->giveMonth($cur_month).' '.$cur_year.' &nbsp;'; ?>
	</h3>
	<?php echo $this->Html->link($this->Html->image('next.png', array('alt'=> 'suivant', 'title'=>'Aller au mois suivant','border' => '0')), array('controller' => 'reservations', 'action' => 'tabella', $next_month.'/'.$next_year),array('target' => '_self', 'escape' => false)); ?>
</div>
<h4 style="width:500px; margin:10px auto; text-align: center;">( Le tableau ci-dessous montre les nuitées )</h4>


<table cellpadding="0" cellspacing="0" class="reservations">
<thead>
<tr name="other">
	<th>Type de Chambre</th>
	<th>Etage</th>
	<th>Chambre</th>
	<?php for($i=1; $i<=$days;$i++): ?>
		<th><?php echo $i; ?></th>
	<?php endfor; ?>
</tr>
</thead>
<tbody>
<?php 
	foreach($roomsDetails as $room=>$details):?>
	<?php $parts=explode('_',$room); ?>
	<tr name="<?php echo $parts[0]; ?>" type="<?php echo $parts[1]; ?>">
		<td><?php echo $parts[1]; ?></td>
		<td><?php echo $parts[2]; ?></td>
		<td numero="-1">
		<?php echo $parts[0]; ?>
		</td>
		<?php 
		$current_position=0;//initialization of the position tracker
		$month_left_days=$days; //initialization of remaining days
		foreach($details as $reservatio) {//reservation level for the current room
		// class stuff
			$class=$reservatio['etat'];
		//parameters for the show function
			$options['reservation_id']=$reservatio['reservation_id'];
			$options['tier_id']=$reservatio['tier_id'];
			$options['tier_name']=$reservatio['tier_name'];
			$options['facture_id']=$reservatio['facture_id'];
			
			if($month_first_day<=$reservatio['arrivee']) { 
				$diff=$this->MugTime->diff($month_first_day,$reservatio['arrivee']); //the $diff will serve like a temp variable 
			//	$diff++;
				if($diff<=$days) { //days contain the number of days for current month
					$diff=$diff-$current_position;
					$month_left_days=$month_left_days-$diff; //determing how many days are left for the current month after the reservation arrivee
					$limit=$diff; //limit for the $i counter variable in which to use normal td css second 
					$i=0;//determine where to start creating td cells for the current reservation
					show(null,$current_position,$i,$limit);//display of the first part of td table cells before the reservation arrivee
					$diff=$this->MugTime->diff($reservatio['arrivee'],$reservatio['depart']);
					$diff++;
					if($diff<=$month_left_days) {
						$limit=$diff;
						$i=0;
						//display of the second part of td table cells after the reservation arrivee
						show($class,$current_position,$i,$limit,$options);
						$month_left_days=$month_left_days-$diff;//contains now left days after the reservation depart
					}
					else {
						$limit=$month_left_days;
						$i=0;
						//display of the second part of td table cells after the reservation arrivee
						show($class,$current_position,$i,$limit,$options);
						$month_left_days=0;//contains now left days after the reservation depart
					}	
				}
				else {
					$limit=$month_left_days;
					$i=0;
					//display all the td with default style
					show(null,$current_position,$i,$limit);
					$month_left_days=0;//O because we have reached the end of the month
				} 
			}
			elseif($month_first_day<=$reservatio['depart']){
				$diff=$this->MugTime->diff($month_first_day,$reservatio['depart']);
				$diff++; //one offset to adjust especially when $month_first_day==$reservation day
				if($diff<=$month_left_days) {
					$limit=$diff; //limit for the $i counter variable in which to use special td css 
					$i=$current_position;//determine where to start creating td cells for the current reservation
					//display of the first part of td table cells before the reservation depart
					show($class,$current_position,$i,$limit,$options);
					$month_left_days=$month_left_days-$diff; //determing how many days are left for the current month after the reservation depart
				}
				else {
					$limit=$month_left_days; //limit for the $i counter variable in which to use special td css 
					$i=$current_position;//determine where to start creating td cells for the current reservation
					//display of the first part of td table cells before the reservation depart
					show($class,$current_position,$i,$limit,$options);
					$month_left_days=0; //0 cuz we reached the end !
				}
			}
		}
	
		$limit=$month_left_days; //contains now left days after all reservations for the current room
		$i=0;
		//display of the last part of td table cells after all reservations
		show(null,$current_position,$i,$limit);
	?>		
	</tr>
<?php endforeach; ?>

<tr name="other">
	<td style ="text-align: center;" colspan="<?php echo $days+3; ?>"> 
		<div class="bouttons" onclick="stats(<?php echo $days.','.$cur_month.','.$cur_year; ?>)">Afficher/Masquer les Statitistiques</div></td>
</tr>

<tbody id="occupation" style="display:none;">
<tr name="other" class="stats">
	<td colspan="3" name="occupation">Personnes actuellement hébergées</td>
	<?php foreach($occupation['in'] as $in): ?>
		<td><?php echo $in; ?></td>
	<?php endforeach; ?>
</tr>
<tr name="other" class="stats">
	<td colspan="3"  name="occupation">Total des personnes actuellement hébergées</td>
	<td colspan="<?php echo $days; ?>"><?php echo $occupation['in-total'];?></td>
</tr>
<tr name="other" class="stats">
	<td colspan="3" name="occupation">Personnes hébergées</td>
	<?php foreach($occupation['hosted'] as $hosted): ?>
		<td><?php echo $hosted; ?></td>
	<?php endforeach; ?>
</tr>
<tr name="other" class="stats">
	<td colspan="3"  name="occupation">Total des personnes hébergées</td>
	<td colspan="<?php echo $days; ?>"><?php echo $occupation['hosted-total'];;?></td>
</tr>
<tr name="other" class="stats">
	<td colspan="3" name="occupation">Taux d'occupation journalière (%)</td>
	<?php foreach($occupation['journalier'] as $pourcentage): ?>
		<td><?php echo $number->precision($pourcentage,0); ?></td>
	<?php endforeach; ?>
</tr>
<tr name="other" class="stats">
	<td colspan="3"  name="occupation">Taux d'occupation mensuelle (%)</td>
	<td colspan="<?php echo $days; ?>"><?php echo $number->precision($occupation['mensuelle'],0);?></td>
</tr>
</tbody>
</tbody>
</table>
<!--menu contextuel-->
<ul id="myMenu" class="contextMenu" style="display:none">
	<li class="igikorwa"><a href="#state">Changer l'etat</a></li>
	<?php 
		$config['annulee']=Configure::read('aser.annulee');
		if(empty($config['annulee'])||in_array($session->read('Auth.Personnel.id'),$config['annulee'])) :?>
		<li class="igikorwa"><a href="#annulee">Annulée la Réservation</a></li>
	<?php endif;?>
	<li class="igikorwa"><a href="#facture">Créer la Facture</a></li>
	<?php if(Configure::read('aser.PU_reservation')||in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
		<li class="igikorwa"><a href="#PU">Changer Le Prix/Nuitée</a></li>
	<?php endif;?>
	<li class="igikorwa"><a href="#global">Facture Globale</a></li>
	<li class="igikorwa"><a href="#client">Détails Du Client</a></li>
	<li class="igikorwa"><a href="#departure">Changer Les Dates</a></li>
	<li class="igikorwa"><a href="#change">Changer La Chambre</a></li>
	<li class="igikorwa"><a href="#services">Facturation Service</a></li>
	<li class="igikorwa"><a href="#demi">Demi journée</a></li>
<!--<li class="igikorwa"><a href="#rappels">Gestion des Rappels</a></li>-->
	<li class="igikorwa"><a href="#confirmation">N° de confirmation</a></li>
	<li class="igikorwa"><a href="#trace">Historique</a></li>
</ul>
<!--ajax_add form -->

<div id="booking_boxe" style="display:none" title='Reservation pour la Chambre : <span id="room_number"></span> <br><strong>Période du : <span id="arrivee"></span> au : <span id="depart"></span>'>

<div class="dialog">
<fieldset><legend>Détails Client</legend>
	<div id="message_tier"></div>
	<div id="customer_dialog_boxe">
	<form></form> <!--IF YOU REMOVE THIS FORM TAG VALIDATION FOR TIER FORM WON'T WORK !! -->
	<?php echo $this->element('../tiers/edit',array('action'=>'add'))?>
	</div>
</fieldset>
<input type="submit" value="Créer le client" name="client" onclick="tier()" />
<div style="clear:both"></div>
</div>
<div class="dialog" id="bookingAdd">
<fieldset><legend>Détails Réservation</legend>
	<div id="message_res"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'resAdd','action'=>'add'));?>
	<span class='left'>
		<?php
			echo $this->Form->input('tier_id',array('id'=>'principal','label'=>'Client','style'=>'width:200px;'));			
			if(Configure::read('aser.PU_reservation')||in_array($session->read('Auth.Personnel.fonction_id'),array(4,3,5))){
				echo $this->Form->input('PU',array('id'=>'disc','label'=>'Autre Prix'));
				echo $this->Form->input('monnaie',array('id'=>'disc_mon','disabled'=>'disabled','options'=>$facturationMonnaies));
				echo $this->Form->input('text',array('label'=>'Dernière Réservation','type'=>'textarea','id'=>'last_reservation'));
			}
			?>
	</span>
	<span class="right">
		<span id="single">
		<?php	
			echo $this->Form->input('autre_depart',array('label'=>'Autre Date de départ','type'=>'text','id'=>'DateAutre'));
		?>
		</span>
		<?php
			echo $this->Form->input('etat',array('options'=>array('en_attente'=>'en_attente',
																'confirmee'=>'confirmee',
																'arrivee'=>'arrivee',
																)));
			echo $this->Form->input('mode_paiement',array('label'=>'Mode de Paiement prévu'));
			echo $this->Form->input('pax',array('label'=>'Nombre de Personnes','options'=>$pax));
		?>
	</span>
	</form>
</fieldset>
<input type="submit" value="Créer la réservation" style="width:130px !important;" name="reservation" onclick="resAdd()" />
<div style="clear:both"></div>
</div>
<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
   
   //decide what to show or hide based on payment selection
	jQuery('#select_paiement_fact').change(function(){
		var etat=jQuery('#select_paiement_fact option:selected').html();
 		if(etat=='payee'){
 			jQuery('input[class*="pyt"],select[class*="pyt"]').removeAttr('disabled');
 			jQuery('#PaiementMontant_fact').attr('disabled','disabled');
 		}
 		else if(etat=='avance'){
 			jQuery('input[class*="pyt"],select[class*="pyt"]').removeAttr('disabled');
 			jQuery('#PaiementMontant_fact').removeAttr('disabled');
 		}
 		else {
 			jQuery('input[class*="pyt"],select[class*="pyt"]').attr('disabled','disabled');
 		}
 	})
 	// montant equivalent field stuff
 	jQuery('#PaiementEqui_fact').change(function(){
		var equi=jQuery(this).val();
 		if(equi!=''){
 			jQuery('#monnaie_fact').removeAttr('disabled');
 		}
 		else {
 			jQuery('#monnaie_fact').attr('disabled','disabled');
 		}
 	})
	
	});
</script>
		<div class="dialog" style="display:none;" id="factureDiv">
	<fieldset ><legend>Détails Facture</legend>
			<div id="message"></div>
		<?php echo $this->Form->create('Facture',array('id'=>'facture_form_fact','action'=>'create_facture'));?>
			<span class='left'>
				<?php
					echo $this->Form->input('Facture.date',array('type'=>'text','id'=>'DateFact'));
					echo $this->Form->input('Facture.etat',array('options'=>array('credit'=>'credit',
																				'avance'=>'avance',
																				'payee'=>'payee',
																				),
																			'id'=>'select_paiement_fact'
																		));
					echo $this->Form->input('Paiement.montant',array('disabled'=>'disabled','id'=>'PaiementMontant_fact'));
					
					?>
			</span>
			<span class="right">
				<?php	
					echo $this->Form->input('Paiement.montant_equivalent',array('id'=>'PaiementEqui_fact','class'=>'pyt'));
					echo $this->Form->input('Paiement.monnaie',array('id'=>'monnaie_fact','disabled'=>'disabled'));																	
					echo $this->Form->input('Paiement.mode_paiement',array('class'=>'pyt'));
					echo $this->Form->input('Paiement.reference',array('class'=>'pyt'));
					echo $this->Form->input('Document.action',array('type'=>'hidden','value'=>'facture'));
					echo $this->Form->input('Document.model',array('type'=>'hidden','value'=>'Reservation'));
				?>	
			</span>
	</form>
</fieldset>
<input type="submit" value="Créer la facture" style="width:100px !important;" name="reservation" onclick="facture_booking()" />
<div style="clear:both"></div>
</div>
</div>

<!--change departure  form -->
<div id="depart_boxe" style="display:none" title=' Choisissez les nouvelles dates'>
<div class="dialog" id="departure">
	<?php echo $this->Form->create('Reservation',array('id'=>'departure_form'));?>
	<div id="message_depart"></div>
	<span class='left'>
		<?php
			echo $this->Form->input('arrival',array('id'=>'DateOfArrival','type'=>'text','label'=>'Nouvelle date d\'arrivée'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('departure',array('id'=>'DateOfDeparture','type'=>'text','label'=>'Nouvelle date de départ'));
		?>
	</form>
<div style="clear:both"></div>
</div>
</div>
<!--goTo  form -->
<div id="goto_boxe" style="display:none" title=' Choisissez le mois à afficher '>
<div class="dialog" id="goto">
	<span class='left'>
		<?php
			echo $this->Form->input('mois',array('id'=>'ukwezi','type'=>'date','dateFormat'=>'M'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('annee',array('id'=>'umwaka','label'=>'Année','type'=>'date','dateFormat'=>'Y'));
		?>
	</span>
<div style="clear:both"></div>
</div>
</div>
<!--change PU form -->
<div id="PU_boxe" style="display:none" title=' Choisissez le Prix par Nuitée'>
<div class="dialog" id="PU">
	<?php echo $this->Form->create('Reservation',array('id'=>'PU_form'));?>
	<div id="message_PU"></div>
	<span class='left'>
		<?php
			echo $this->Form->input('pu',array('id'=>'pu','label'=>'Le nouveau prix par nuitée'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('monnaie',array('id'=>'currency','selected'=>'USD','options'=>$facturationMonnaies));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<!-- availability  form -->
<div id="availability_boxe" style="display:none" title=' Vérifier la disponibilité'>
<div class="dialog" id="availabilityAdd">
	<div id="message_availability"></div>
	<div id="response"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'dispo','action'=>'availability'));?>
	<span class='left'>
		<?php
			echo $this->Form->input('type_chambre_id',array('id'=>'categorie','options'=>$typeChambres1,'selected'=>0));
			echo $this->Form->input('etage',array('id'=>'etage'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('arrivee',array('id'=>'DateArrivee2','type'=>'text'));
			echo $this->Form->input('depart',array('id'=>'DateDepart2','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>

<!--change room-->
<div id="room_boxe" style="display:none" title='Changer la chambre'>
<div class="dialog" >
	<div id="response"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'availability','action'=>'availability'));?>
	<span class='left'>
		<?php
			echo $this->Form->input('rooms',array('id'=>'rooms','label'=>'Chambres Disponibles','options'=>array()));
			echo $this->Form->input('arrivee',array('id'=>'DateCheckIn',
													'type'=>'text',
													'label'=>'Date de Changement',
													'value'=>date('Y-m-d'),
													));
			if(in_array($session->read('Auth.Personnel.fonction_id'),array(3,5)))
				echo $this->Form->input('PU',array('id'=>'autre_prix',
													'type'=>'text',
													'label'=>'Autre Prix',
													));
		?>
	</span>
	<span class='right'>
		<?php
			
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>


<!--services stuff-->
<div id="services_boxe" style="display:none" title='Facturation des Services'>
	<?php echo $this->element('../services/facturation',array());?>
</div>
<!-- boxe for changing the booking state-->
<div id="state_boxe" style="display:none" title="Changer l'etat de la réservation">
<div class="dialog" >
	<?php echo $this->Form->create('Reservation');?>
	<span class='left'>
		<?php
			echo $this->Form->input('etat',array('id'=>'stateSelect','options'=>$etats));
			echo $this->Form->input('heure_depart',array('id'=>'departureTime','label'=>'Heure de départ','disabled'=>'disabled'));
		?>
	</span>
	</form>	
<div style="clear:both"></div>
</div>
</div>

<!-- boxe for changing the booking state-->
<div id="demi_boxe" style="display:none" title="Mettre une demi journée">
<div class="dialog" >
	<?php echo $this->Form->create('Reservation');?>
	<span class='left'>
		<?php
			$options=Configure::read('demis');
			$options=(!empty($options))?$options:array(50=>'50 %');
			echo $this->Form->input('taux_demi_journee',array('id'=>'tauxDemi','options'=>$options));
		?>
	</span>
	</form>	
<div style="clear:both"></div>
</div>
</div>

<div id="not_flipped" class="details" style="display:none"></div>
<div id="flipped" class="details" style="display:none"></div>
</div>
<div id="separator" class="next" title="Afficher Le Menu" onclick="hider()"></div>
<div class="actions" style="display:none">
	<h3><?php __('Actions'); ?></h3>
	<?php echo $this->element('../reservations/legend',array('model'=>'Réservation'));?>
	<ul>
		<li class="link"  onclick = "jQuery('#legend').slideToggle();" >Afficher/Masquer la Légende</li>
		<!--<li class="link"  onclick = "single_add()" >Créer une réservation</li>-->
		<li class="link" onclick = "availability()" >Vérifier la disponibilité</li>
		<li><?php echo $this->Html->link('Rapport Mensuelle', array('controller' => 'reservations', 'action' => 'monthly')); ?>  
		<li><?php echo $this->Html->link("Etat d'occupation", array('controller' => 'reservations', 'action' => 'etat_occupation')); ?>
		<li class="link" onclick = "goTo()" >Afficher un mois donnée</li>  
		<li class="link" onclick = "tabella_search()" >Option de recherche</li>  
	</ul>
	
</div>

<?php echo $this->element('docs',array('actions'=>array('factures'),'model'=>'Reservation','type'=>'divs')); ?>

<!--another tier creation  form -->
<div id="customer_boxe" style="display:none" title='Tier Creation'>
<div class="dialog" id="customer_creation_boxe">
<div style="clear:both"></div>
</div>
</div>
