
<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
    resto_date();
	jQuery('fieldset#form_vente').bind('keypress', function(e) {
		if ((e.keyCode || e.which) == 13){
			var etat_facture=jQuery('table#list_factures tr[id="'+factureId+'"] td[id="etat"]').text();
			var classement=jQuery('table#list_factures tr[id="'+factureId+'"]').attr('name');
			var printed=jQuery('table#list_factures tr[id="'+factureId+'"]').attr('printed');
			 if((factureId!=0)&&(etat_facture!='annulee')&&(classement!='1')&&(printed!='1'))
  				 resto_create(factureId);
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
			if((jQuery('#pos').attr('sama')==1)&&(jQuery('#pos').attr('mode')=='serveur')){
				var print=false;
			}
			else {
				var print=true;
			}
			 if(print&&key_press&&(factureId!=0)&&(jQuery('table#list_factures tr[id="'+factureId+'"] td[id="etat"]').text()!='annulee')){
  				//	 print_facture(factureId);
  			}
		 }	
	});
	
	//paiement annulation confirmation
	jQuery('input#code').bind('keypress', function(e) {
		var action = jQuery('div#annulation').attr('action');
		var dirt=jQuery('input#code').val();
		var code = dirt.replace(/[^a-z0-9\s]/gi, '-');
		var commentaire ='';
		if(consoId!=0){
			commentaire = jQuery('#VenteQuantite').val()+' '+jQuery('tr[id="'+consoId+'"]').children('td[name="produit"]').text();
		}
		if (((e.keyCode || e.which) == 13)&&(code!='')){
    			jQuery.ajax({
					global:true,
					type:'GET',
					dataType:'json',
					url:getBase()+'personnels/annulation/'+code+'/'+action+'/'+factureId+'/'+commentaire,
				    success:function(response){
						if(response.success){
							jQuery('div#annulation').dialog('close');
							
							switch(action){
								case 'effacer':
									facture_removal(factureId,'facture',true);
									break;

								case 'effacer_conso':
									facture_removal(factureId,consoId,true);
									break;
								case 'direct_reduction':
									direct_reduction(factureId,true);
									break;
								case 'unlock':
									unlock(factureId,true);
									break;
								case 'paiement':
									paiement_touch(factureId,true);
									break;
								default:
									print_facture(factureId,undefined,undefined,undefined,true);
									break;
							}
							
							jQuery('div#annulation').attr('action','effacer')
						}
						jQuery('input#code').val('');
    				},
    				error:function(jqXHR, textStatus, errorThrown){
    				      jQuery('body').html(errorThrown);
    				}
    							          
    			});
		 }	
	});
	
	jQuery('input#avance').bind('keypress', function(e) {
		if ((e.keyCode || e.which) == 13){
			
			var montant=jQuery('table#list_factures tr[id="'+factureId+'"] td[id="montant"]').text();
			if(montant!=''){
				var change=parseInt(jQuery('input#avance').val())-parseInt(montant);
				jQuery('input#change').val(change);
				setTimeout(function(){
					paiement_touch(factureId);	
				},2000)
				
			}
		 }	
	});
	jQuery('fieldset#groupes_select span').show();
	jQuery('fieldset#groupes_select span:not(fieldset#groupes_select span[section="2"])').hide();

	jQuery('span#payee').attr('class','boutton_selected');
	
	window.onload=function(){ 
    	if(jQuery('#pos').attr('stock')==''){
       		parameters();		
       	}
    }
    if(jQuery('#pos').attr('serveur_id')!=''){
    	serveurId=jQuery('#pos').attr('serveur_id');
    	serveur=jQuery('#pos').attr('serveur_name');
    }
    
    //input filtering
    jQuery('#filter').keyup(function(){
    	input_filtering( jQuery('#filter').val());
    })
    
    //for getting client ari muri chambre or list of guests in conference rooms
	jQuery('#chambre').bind('keypress', function(e) {
		if ((e.keyCode || e.which) == 13){
				var content=jQuery('#chambre').val();
				if(jQuery('#chambre').val().match(/^c/i)){
					conference();
				}
				else {
  				 	chambre();
  				}
		 }	
	});
});
	
</script>



<?php $config=Configure::read('aser');
?>
<div id="flashMessage" class="message" style="display:none; margin-bottom:-90px; cursor:pointer" onclick="jQuery(this).hide();" title="Cliquer pour fermer le message"></div>
<div id="tables" style="display:block">
	<?php if($this->Session->read('resto_stock') && $this->Session->read('pos')):?>
	<h3 style="text-align: center;"> Caissier : <?php echo $this->Session->read('Auth.Personnel.name');?> | Stock : <?php echo $stocks[$this->Session->read('resto_stock')].' | Place : '.$bars[$this->Session->read('pos')];?></h3>
	<?php endif;?>
	<?php if(Configure::read('aser.magasin')){
		$display='display:block;';
		
	}
	else { 
		foreach($tables as $num=>$details){
			echo '<div class="'.$details['class'].'" onclick="table(this)" id="'.$num.'">'.$num;
			if(Configure::read('aser.table_show_waiter'))
				echo '<span class="serveur_table">'.$details['serveur'].'</span>';
			echo '</div>';
		}
		$display='display:none;';
	}
	?>
</div>

<?php if(!$config['caissier_serveur']): ?>
	<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
     	setInterval(function(){
     		update_tables();
     	},
     	5000
     	)
     });
     </script>
<?php endif;?>

<?php if($config['sama']&&($mode=='serveur')): ?>
	<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
			jQuery('div#resto_layout_touch  span#second').css({'width':300,'margin-right':20});
			jQuery('div#resto_layout_touch table').css({'width':300});
			jQuery('div#resto_layout_touch  span#third').css({'width':600});
			jQuery('div#resto_layout_touch  span.bouttons').css({'width':600});
			jQuery('div#resto_layout_touch  fieldset#actions').css({'width':300});
			jQuery('span.groupe').css({'width':80,'padding-right':5,'height':60});
				});
</script>
<?php endif; ?>
<div style="clear:both;"></div>
<div id="commandes" style="<?php echo $display;?>">
<div id="pos" 
	class="vente"
	sama="<?php echo $config['sama'];?>" 
	mode="<?php echo $mode;?>"  
	magasin="<?php echo $config['magasin'];?>"
	beneficiaires="<?php echo $config['beneficiaires'];?>"
	printonce="<?php echo $config['one_time_printing'];?>"
	thermal="<?php echo $thermal;?>"
	touch="on"
	multi_serveur="<?php echo (isset($config['multi_serveur']))?$config['multi_serveur']:1;?>"
	stock="<?php echo $session->read('resto_stock');?>"
	serveur_id="<?php if($config['caissier_serveur']||($session->read('Auth.Personnel.fonction_id')==1)) echo $session->read('Auth.Personnel.id');?>"
	serveur_name="<?php if($config['caissier_serveur']||($session->read('Auth.Personnel.fonction_id')==1)) echo $session->read('Auth.Personnel.name');?>"
	fonction_id="<?php echo $session->read('Auth.Personnel.fonction_id');?>"
	>
<div id="resto_layout_touch">
	<span id="second">
		<fieldset id="list_factures"><legend>Liste des Factures </legend>
			<table cellpadding="0" cellspacing="0" id="list_factures">
				<tr>
					<th>Fact N°</th>
					<?php if(!$config['magasin']): ?>
						<th>Table</th>
					<?php endif; ?>
					<th>Sous Total</th>
					<?php if(!($config['sama']&&($mode=='serveur'))): ?>
					<th>Redu (%)</th>
					<th>Total</th>
					<th>Reste</th>
					<?php endif; ?>
					<th>Etat</th>
				<?php if(!(($config['sama']&&($mode=='serveur'))||$config['magasin'])): ?>
					<th>Serveur</th>
				<?php endif; ?>
					<th><?php echo $this->Form->input('date_resto',array('label'=>'','value'=>$date,'id'=>'DateResto','type'=>'text'));?></th>
				</tr>
				<?php echo $this->element('../ventes/list_factures',array('factures'=>$factures));?>
			</table>
		</fieldset>
		<fieldset id="list_produits"><legend>Liste des Produits</legend>
			<table cellpadding="0" cellspacing="0" id="list_produits">
				<tr>
				
				<?php if(!($config['sama']&&($mode=='serveur'))): ?>
					<th>&nbsp;</th>
				
				<?php endif; ?>
				<?php if($config['beneficiaires']): ?>
					<th>Date</th>
					<th>Béneficiaire</th>
				<?php endif; ?>
					<th>Produit</th>
					<th>Quantité</th>
					<th>PU</th>
					<th>PT</th>
				</tr>
			</table>
		</fieldset>
		<fieldset id="actions"><legend>Actions</legend>
			<?php 
					$pId=$session->read('Auth.Personnel.id'); //personnel id
					if(($mode!='serveur')&&empty($config['annulee'])
					||in_array($pId,$config['annulee'])): 
			?>
				<span id="remove_facture" name="annuler" class="boutton"  title="Annuler la facture">Annuler</span>
			<?php endif;?> 	
				<span id="remove_conso" name="disable" class="boutton"  title="Supprimer la consommation de la facture sélectionnée ">Effacer</span>
			<?php if(!$config['magasin']): ?>
			<span class="boutton" onclick="show_tables()" title="Configuration des tables">Tables</span>
			<?php endif;?> 	
			<?php if($session->read('Auth.Personnel.fonction_id')!=1): ?>
				<span id="paiement_facture_touch" name="classer" class="boutton" title="Clôturer la facture en marquant son état de paiement">Classer</span>
				<?php if(false&&!$config['magasin']): ?>
					<span  id="serveur" name="disable" class="boutton" title="Changer Serveur">Serveur</span>
				<?php endif;?> 
			<?php endif;?>
			<?php if(($session->read('Auth.Personnel.fonction_id')!=1)||(isset($config['impression_par_serveur'])&&$config['impression_par_serveur'])): ?> 
				<span class="boutton" onclick="print_facture(factureId)" title="Imprimer la facture">Imprimer</span>
			<?php endif;?>
			<?php if($config['multi_resto']): ?>
					<span class="boutton" onclick="parameters()" title="Configurer les paramètres">Paramètres</span>
				<?php endif;?> 
			<?php if($config['sama']&&($mode!='serveur')||$config['bon']): ?>
				<span class="boutton" onclick="ask(factureId)" title="Imprimer les bons pour les boissons et la cuisine pour la facture sélectionnée">Bon</span>
			<?php endif;?> 
			<?php if(false&&($config['sama']&&($mode=='serveur'))): ?>
				<span class="boutton" onclick="confirm_order(factureId)" title="Confirmer la commande">OK</span>
			<?php endif;?> 
			<?php if($session->read('Auth.Personnel.fonction_id')!=1): ?>
			<span class="boutton" onclick="document.location.href=getBase()+'ventes/journal'" title="Journal">Rapport</span>
			<?php endif;?> 
			<span class="boutton" onclick="separator(factureId)" title="Splitter">Separateur</span>
			<?php if($config['sama']&&($mode!='serveur')): ?>
				<span class="boutton" onclick="bill_cleaner(factureId)" title="Cleaner">Nettoyeur</span>
			<?php endif;?>
			<?php if(!$config['magasin']): ?>
			<span class="boutton" onclick="table_changer(factureId)" title="Changer la table">Changer la Table</span>
			<?php endif;?>
			<span id="direct_reduction" name="disable" class="boutton"  title="Réduire le montant de la facture directement ">Réduction</span>
			<?php If(empty($config['annulee'])||in_array($pId,$config['annulee'])):?>
			<span id="unlock" name="unlock" class="boutton"  title="Débloquer la facture" onclick="unlock(factureId)">Débloquer</span>
			<?php endif;?>
		</fieldset>
	</span>
	<span id="third">
		<span id='paiement_form' class="bouttons" style="display:none;">
			<fieldset><legend>Paiement Info</legend>
				<?php
					if(Configure::read('aser.hotel'))
						echo $this->Form->input('chambre',array('id'=>'chambre','label'=>'Chambre / Conférence','title'=>'Taper le numero de la chambre pour afficher son client,  ou la lettre C afficher les clients en conférences'));
					echo $this->Form->input('client',array('options'=>$tiers,'label'=>'Client','id'=>'tierId','selected'=>0));
					echo $this->Form->input('avance',array('id'=>'avance','label'=>'Cash'));
					echo $this->Form->input('change',array('id'=>'change','disabled'=>'disabled','value'=>0));
					echo '<span name="payment" value="1" class="boutton_selected" onclick="switcher(this)" id="payee">PAYEE</span>';	
					echo '<span name="payment" value="2" class="boutton" onclick="switcher(this)">CREDIT</span>';	
					echo '<span name="payment" value="3" class="boutton" onclick="switcher(this)">BONUS</span>';	
					echo '<span name="payment" value="4" class="boutton" onclick="switcher(this)">AVANCE</span>';	
				?>
				<span name="payment" class="boutton" onclick="jQuery('#paiement_form').hide(),displayed=0;">MASQUER</span>
			</fieldset>
		</span>
		<div style="margin-bottom:0px; width:*00px;">
		<?php echo $this->Form->input('vente',array('id'=>'VenteQuantite',
													'label'=>'',
													'value'=>1,
													'style'=>'width:50px !important; margin-top:0px !important; float:left;'
													));
				?>
		<input type="text" id="filter" style="margin-left:5px !important; width:300px" placeholder="Recherche ..."/>
		<?php if(Configure::read('aser.PU')):?>
		<input type="text" id="autrePU" style="margin-left:5px !important; width:300px;"  placeholder="Autre Prix ..."/>
		<?php endif;?>
		</div>
		<span id='serveurs' class="bouttons">
			
			<?php if(!$config['magasin']&&!$config['caissier_serveur']&&($session->read('Auth.Personnel.fonction_id')!=1)): ?>
				<fieldset id="serveurs_select"><legend>Serveurs</legend>
				<?php 
					foreach($serveurs as $id=>$name){
						echo '<span id="'.$id.'" class="boutton" onclick="serveur_touch(this)">'.$name.'</span>';	
					}
				?>
				</fieldset>
			<?php endif;?>
		</span>
		<span id='groupes' class="bouttons">
			
			<fieldset id="groupes_select"><legend>Filtrage Groupes</legend>
			<?php
				echo '<div id="2" name="section" class="boutton" onclick="s_filtering(this)" style="display:none;">BAR</div>';
				echo '<div id="1" name="section" class="boutton" onclick="s_filtering(this)"">CUISINE</div>';
				
				foreach($groupes as $groupe){
					if($groupe['Groupe']['afficher']=='oui'){	
						echo '<span id="'.$groupe['Groupe']['id'].'" section="'.$groupe['Groupe']['section_id'].'" class="groupe" onclick="g_filtering(this)"';	
						echo 'style="background:url(../img/groupes/'.$groupe['Groupe']['id'].'.jpg) 0 0  no-repeat;">';	
						echo '<div class="text">'.ucwords($groupe['Groupe']['name']).'</div>';
						//	echo $this->Html->image('groupes/'.$groupe['Groupe']['id'], array('border' => '0'));
						echo '</span>';
					}
				}
			?>
			</fieldset>
		</span>
		<span id='sous_groupes' class="bouttons" style="display:none;">
			<fieldset id="sous_groupes_select"><legend>Filtrage Sous Groupes</legend>
			<?php 
				echo '<div id="2" name="section" class="boutton" onclick="s_filtering(this)">BAR</div>';
				echo '<div id="1" name="section" class="boutton" onclick="s_filtering(this)">CUISINE</div>';
				echo '<div id="list_groupes"  class="boutton" onclick="groupes_show()">Groupes</div>';
				
			?>
			</fieldset>
		</span>
		<fieldset id="produit_select"><legend>Produits</legend>
			<?php 
				foreach($produits as $produit){
					echo '<div name="'.strtolower($produit['Produit']['name']).'" id="'.$produit['Produit']['id'].'" type="'.$produit['Produit']['acc'].'" section="'.$produit['Groupe']['section_id'].'" groupe="'.$produit['Groupe']['id'].'"  class="produit" onclick="resto_touch_create(this)" >';
				//	echo 'style="background:url(../img/produits/'.$produit['Produit']['id'].') 0 0  no-repeat; background-position:center;">';	
				//	echo $this->Html->image('logo.jpg', array('border' => '0','width'=>108,'height'=>50));
					echo ucwords($produit['Produit']['name']);
						echo '<span class="prix">'.$number->format($produit['Produit']['PV'],$formatting).'</span>';
					echo '</div>';
				}
			?>
		</fieldset>
	</span>
</div>
</div>

<?php if(Configure::read('aser.multi_resto')){
	echo $this->element('../ventes/parametres',array('bars'=>$bars,'stocks'=>$stocks,'action'=>'touchscreen'));
}
?>
<?php echo $this->element('../ventes/commande');?>
<div id="annulation" style="display:none" title='Authorisation' action="effacer"
<div class="dialog">
	<span class="left">
		<?php
			echo $this->Form->input('Personnel.code',array('id'=>'code','type'=>'password'));
		?>
	</span>
<div style="clear:both"></div>
</div>
</div>
</div>