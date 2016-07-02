<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
   
	
	var key_press=true;
	
	jQuery('input,select,textarea').focus(function(){
		 key_press=false;
	})
	jQuery('input,select,textarea').blur(function(){
		 key_press=true;
	})
	
	jQuery(document).bind('keypress',function(e) {
		
		if (((e.keyCode || e.which || e.charCode) ==82)||((e.keyCode || e.which || e.charCode) ==114)){
			 if(key_press)
  				 single_add();
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
 		if(equi!=''){
 			jQuery('#disc_mon').removeAttr('disabled');
 		}
 		else {
 			jQuery('#disc_mon').attr('disabled','disabled');
 		}
 	})
 	//stuff regarding PU
	jQuery('#disc1').change(function(){
		var equi=jQuery(this).val();
 		if(equi!=''){
 			jQuery('#disc_mon1').removeAttr('disabled');
 		}
 		else {
 			jQuery('#disc_mon1').attr('disabled','disabled');
 		}
 	})
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
    	'searchFromBeginning':true,
    	// The width for the select element and its input filter box.
    	// If -1, both the select element and its filter box have their size set to the width of
    	// the select element before any filtering occurs.
    	'width': -1
  	});
  	//*/
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
			echo '<td onmouseover="mouseover(this)" onmousedown="mousedown(this)" position="'.$current_position.'" numero="'.$current_position.'" class="">&nbsp;</td>';
			$current_position++;
		}
	}
	else {
		if($i<$limit){
			echo '<td facture="'.$options['facture_id'].'" reservation="'.$options['location_id'].'" tier="'.$options['tier_id'].'" colspan="'.$limit.'" position="'.$current_position.'" class="'.$class.'"  "numero="'.$current_position.'" >'.$options['tier_name'].'</td>';
			//$current_position++; //updating current position
			$current_position=$current_position+$limit;
		}
	}
 	
 }	
?>
<div class="tabella" id="tabella" type="locations" qty="<?php echo Configure::read('aser.conference-manual');?>">
<div class="reservations_paging">
	<?php echo $this->Html->link($this->Html->image('back.png', array('alt'=> 'previous', 'title'=>'Aller au mois previous','border' => '0')), array('controller' => 'locations', 'action' => 'tabella', $prev_month.'/'.$prev_year),array('target' => '_self', 'escape' => false)); ?>
	<h3 id="title"  days="<?php echo $days ?>" month="<?php echo $cur_month?>"  year="<?php echo $cur_year ?>"><?php echo '&nbsp; Locations pour le mois de '.$this->MugTime->giveMonth($cur_month).' '.$cur_year.' &nbsp;'; ?></h3>
	<?php echo $this->Html->link($this->Html->image('next.png', array('alt'=> 'next', 'title'=>'Aller au mois next','border' => '0')), array('controller' => 'locations', 'action' => 'tabella', $next_month.'/'.$next_year),array('target' => '_self', 'escape' => false)); ?>
</div>
<br />
<br />
<table cellpadding="0" cellspacing="0" class="reservations">
<thead>
<tr name="other">
	<th>Salle</th>
	<?php for($i=1; $i<=$days;$i++): ?>
		<th><?php echo $i; ?></th>
	<?php endfor; ?>
</tr>
</thead>
<tbody>
<?php 
	foreach($roomsDetails as $room=>$details):?> 
	<?php $parts=explode('_',$room); ?>
	<tr name="<?php echo $parts[0]; ?>">
		<td numero="-1">
		<?php echo $parts[0]; ?>
		</td>
		<?php 
		$current_position=0;//initialization of the position tracker
		$month_left_days=$days; //initialization of remaining days
		foreach($details as $locatio) {//reservation level for the current room
		// class stuff
			$class=$locatio['etat'];
		//parameters for the show function
			$options['location_id']=$locatio['location_id'];
			$options['tier_id']=$locatio['tier_id'];
			$options['tier_name']=$locatio['tier_name'];
			$options['facture_id']=$locatio['facture_id'];
			
			if($month_first_day<=$locatio['arrivee']) { 
				$diff=$this->MugTime->diff($month_first_day,$locatio['arrivee']); //the $diff will serve like a temp variable 
			//	$diff++;
				if($diff<=$days) { //days contain the number of days for current month
					$diff=$diff-$current_position;
					$month_left_days=$month_left_days-$diff; //determing how many days are left for the current month after the reservation arrivee
					$limit=$diff; //limit for the $i counter variable in which to use normal td css second 
					$i=0;//determine where to start creating td cells for the current reservation
					show(null,$current_position,$i,$limit);//display of the first part of td table cells before the reservation arrivee
					$diff=$this->MugTime->diff($locatio['arrivee'],$locatio['depart']);
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
			elseif($month_first_day<=$locatio['depart']){
				$diff=$this->MugTime->diff($month_first_day,$locatio['depart']);
				$diff++; //one offset to adjust especially when $month_first_day==$location day
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
	<td> Jours du mois</td>
	<?php for($i=1; $i<=$days;$i++): ?>
		<td><?php echo $i; ?></td>
	<?php endfor; ?>
</tr>
</table>
<!--menu contextuel-->
<ul id="myMenu" class="contextMenu" style="display:none">
	<li class="igikorwa"><a href="#state">Changer l'etat</a></li>
	<li class="igikorwa"><a href="#annulee">Annulée la location</a></li>
	<li class="igikorwa"><a href="#client">Détails du Customer</a></li>
	<li class="igikorwa"><a href="#proforma">Facture Pro-forma</a></li>
	<li class="igikorwa"><a href="#fact_loca">Facture Location</a></li>
	<?php if(!Configure::read('aser.conference-resto-reception')):?>
		<li class="igikorwa"><a href="#global">Facture Globale</a></li>
	<?php else:?>
		<li class="igikorwa"><a href="#edit_location_bill">Edit la facture</a></li>
	<?php endif;?>
	<li class="igikorwa"><a href="#edit_location_proforma">Edit le pro-forma</a></li>
	<li class="igikorwa"><a href="#trace">Historique</a></li>
</ul>
<!--ajax_add form -->

<div id="location_boxe" style="display:none" title='Location pour la Salle : <span id="room_number"></span> <br><strong>Période du : <span id="arrivee"></span> au : <span id="depart"></span>'>

<div class="dialog">
<fieldset><legend>Détails Customer</legend>
	<div id="message_tier"></div>
	<form></form> <!--IF YOU REMOVE THIS FORM TAG VALIDATION FOR TIER FORM WON'T WORK !! -->
<?php echo $this->element('../tiers/edit',array('action'=>'add'))?>
</fieldset>
<input type="submit" value="Créer le client"  name="client" onclick="tier()" />
<div style="clear:both"></div>
</div>
<div id="dialog">
<fieldset class="dialog"><legend>Détails Location</legend>
<div class="dialog" id="locationAdd">
	<div id="message_res"></div>
	<?php echo $this->Form->create('Location',array('id'=>'locationAdd','action'=>'add'));?>
	<span class='left'>
		<?php
			echo $this->Form->input('tier_id',array('id'=>'principal','label'=>'Customer Principal','style'=>'width:300px;'));
			echo $this->Form->input('monnaie',array('label'=>'monnaie', 'options'=>$facturationCurrencys));
			?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('nombre',array('onchange'=>'proforma_qty(this)','label'=>'Nombre de personnes','id'=>'pers'));
			echo $this->Form->input('jours',array('label'=>'','disabled'=>'disabled','id'=>'jours','style'=>'display:none;'));
			echo $this->Form->input('Facture.tva_incluse',array('type'=>'checkbox','checked'=>'checked','label'=>'TVA_incluse'));
			echo $this->Form->input('type',array('type'=>'hidden','value'=>'proforma'));
		?>
	</span>
	<div style="clear:both"></div>
	<table>
		<tr>
			<th>Service Desiré</th>
			<th>Prix Unitaire</th>
			<?php if(Configure::read('aser.conference-manual')):?>
				<th>Qté total</th>
			<?php else : ?>
				<th>Heure Desiré</th>
			<?php endif;?>	
		</tr>
		<tr>
			<td>Eau (Avant Midi)</td>
			<td> <?php echo $this->Form->input('eau',array('onchange'=>'proforma_qty(this)','label'=>'','name'=>'data[services][Eau (Avant Midi)][prix]'));?></td>
			<?php if(Configure::read('aser.conference-manual')):?>
				<td> <?php echo $this->Form->input('eau',array('class'=>"qty",'label'=>'','name'=>'data[services][Eau (Avant Midi)][quantite]'));?></td>
			<?php else : ?>
				<td> <?php echo $this->Form->input('eau',array('label'=>'','name'=>'data[services][Eau (Avant Midi)][heure]'));?></td>
			<?php endif;?>	
			
		</tr>
		<tr>
			<td>Pause Café (Avant Midi)</td>
			<td> <?php echo $this->Form->input('pause1',array('onchange'=>'proforma_qty(this)','label'=>'','name'=>'data[services][Pause Café (Avant Midi)][prix]'));?></td>
			<?php if(Configure::read('aser.conference-manual')):?>
				<td> <?php echo $this->Form->input('pause1',array('class'=>"qty",'label'=>'','name'=>'data[services][Pause Café (Avant Midi)][quantite]'));?></td>
			<?php else : ?>
				<td> <?php echo $this->Form->input('pause1',array('label'=>'','name'=>'data[services][Pause Café (Avant Midi)][heure]'));?></td>
			<?php endif;?>	
		</tr>
		<tr>
			<td>Eau (Après Midi)</td>
			<td> <?php echo $this->Form->input('eau',array('onchange'=>'proforma_qty(this)','label'=>'','name'=>'data[services][Eau (Après Midi)][prix]'));?></td>
			<?php if(Configure::read('aser.conference-manual')):?>
				<td> <?php echo $this->Form->input('eau',array('class'=>"qty",'label'=>'','name'=>'data[services][Eau (Après Midi)][quantite]'));?></td>
			<?php else : ?>
				<td> <?php echo $this->Form->input('eau',array('label'=>'','name'=>'data[services][Eau (Après Midi)][heure]'));?></td>
			<?php endif;?>	
			
		</tr>
		<tr>
			<td>Pause Café (Après Midi)</td>
			<td> <?php echo $this->Form->input('pause2',array('onchange'=>'proforma_qty(this)','label'=>'','name'=>'data[services][Pause Café (Après Midi)][prix]'));?></td>
			<?php if(Configure::read('aser.conference-manual')):?>
				<td> <?php echo $this->Form->input('pause2',array('class'=>"qty",'label'=>'','name'=>'data[services][Pause Café (Après Midi)][quantite]'));?></td>
			<?php else : ?>
				<td> <?php echo $this->Form->input('pause2',array('label'=>'','name'=>'data[services][Pause Café (Après Midi)][heure]'));?></td>
			<?php endif;?>	
			
		</tr>
		<tr>
			<td>Déjeuner</td>
			<td> <?php echo $this->Form->input('dejeuner',array('onchange'=>'proforma_qty(this)','label'=>'','name'=>'data[services][Déjeuner][prix]'));?></td>
			<?php if(Configure::read('aser.conference-manual')):?>
				<td> <?php echo $this->Form->input('dejeuner',array('class'=>"qty",'label'=>'','name'=>'data[services][Déjeuner][quantite]'));?></td>
			<?php else : ?>
				<td> <?php echo $this->Form->input('dejeuner',array('label'=>'','name'=>'data[services][Déjeuner][heure]'));?></td>
			<?php endif;?>
			
		</tr>
		<tr>
			<td>Dîner</td>
			<td> <?php echo $this->Form->input('diner',array('onchange'=>'proforma_qty(this)','label'=>'','name'=>'data[services][Dîner][prix]'));?></td>
			<?php if(Configure::read('aser.conference-manual')):?>
				<td> <?php echo $this->Form->input('diner',array('class'=>"qty",'label'=>'','name'=>'data[services][Dîner][quantite]'));?></td>
			<?php else : ?>
				<td> <?php echo $this->Form->input('diner',array('label'=>'','name'=>'data[services][Dîner][heure]'));?></td>
			<?php endif;?>
		</tr>
		<tr>
			<td>Cocktail</td>
			<td> <?php echo $this->Form->input('cocktail',array('onchange'=>'proforma_qty(this)','label'=>'','name'=>'data[services][Cocktail][prix]'));?></td>
			<?php if(Configure::read('aser.conference-manual')):?>
				<td> <?php echo $this->Form->input('cocktail',array('class'=>"qty",'label'=>'','name'=>'data[services][Cocktail][quantite]'));?></td>
			<?php else : ?>
				<td> <?php echo $this->Form->input('cocktail',array('label'=>'','name'=>'data[services][Cocktail][heure]'));?></td>
			<?php endif;?>
		</tr>
	</table>
	</form>
</div>
<div class="dialog">
	<?php echo $this->Form->create('Location',array('id'=>'location-extras'));?>
	
<fieldset>
	<span class='left'>
		<?php
			echo $this->Form->input('PU',array('label'=>'Autre Prix'));
		?>
		<button onclick="extra_row();return false;">Ajouter/Enlever une ligne</button>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('autre_date_depart',array('id'=>'Date_autre_depart','type'=>'text','title'=>'Autre Date de départ'));
			echo $this->Form->input('date',array('type'=>'text','title'=>'Date de la facture','value'=>date('Y-m-d')));
			?>
	</span>
	<div style="clear:both"></div>
	
	<div style="clear:both"></div>
	<table id="extras_table" >
		<tr>
			<th></th>
			<th>Nom de l'Extra</th>
			<th>Quantité</th>
			<th>Prix Unitaire</th>
		</tr>
	</table>
</fieldset>
	<div style="clear:both"></div>
	</form>
	
<div style="clear:both"></div>
</div>
</fieldset>
<input type="submit" value="Créer la location" name="location" onclick="locationAdd()" />
</div>
</div>

<!-- boxe for changing the booking state-->
<div id="state_boxe" style="display:none" title="Changer l'etat de la réservation">
<div class="dialog" >
	<span class='left'>
		<?php
			echo $this->Form->input('etat',array('id'=>'stateSelect','options'=>$etats));
		?>
	</span>
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
			echo $this->Form->input('annee',array('id'=>'umwaka','label'=>'Year','type'=>'date','dateFormat'=>'Y'));
		?>
	</span>
<div style="clear:both"></div>
</div>
</div>
</div>
<div id="separator" class="next" title="Afficher Le Menu" onclick="hider()"></div>
<div class="actions" style="display:none">
	<h3><?php __('Actions'); ?></h3>
	<?php echo $this->element('../reservations/legend',array('model'=>'Location'));?>
	<ul>
		<li class="link"  onclick = "jQuery('#legend').slideToggle();" >Show/Hide la Légende</li>
		<li class="link" onclick = "goTo()" >Afficher un mois donnée</li>  
	</ul>
</div>



