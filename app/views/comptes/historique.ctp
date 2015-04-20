<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
   //decide what to show or hide based on payment selection
   jQuery('#choix option[value="marchandises"]').attr('selected','selected');
	jQuery('#choix').change(function(){
		var choix=jQuery('#choix option:selected').val();
		jQuery('select[id*="Cpte_"]').attr('disabled','disabled');
		if(jQuery.inArray(choix,['marchandises','capital','tva'])==-1){
 			jQuery('select[id="Cpte_'+choix+'"]').removeAttr('disabled');
 		}
 	})
 	jQuery('a[name="lien"]').each(function(){
 		var href=jQuery(this).attr('href');
 		jQuery(this).attr('href',getBase()+''+href);
 	})
	
	});
</script>
<?php 
	$lien='';
	function lien($match){
		$tmp=explode('N°',$match[0]);
		$factureId=$tmp[1];
		$lien='<a name="lien" href="factures/view/'.$factureId.'">'.$match[0].'</a>';
		return $lien;
	}
?>

<div id='view'>
<div class="document">
<h3>Historique <?php if(!is_null($compte)) echo 'du compte : '.$compte;?></h3>
<?php
	if(isset($date1)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).')</h4>';
		}
?>
	

<table cellpadding="0" cellspacing="0" id="recherche">
	<tr>
			<th>Numéro</th>
			<th>Date</th>
			<th>Libéllé</th>
			<th>Débit</th>
			<th>Crédit</th>
			<th>Personnel</th>
			<th>Heure Création</th>
		
	</tr>
		<?php
	foreach ($records as $record):
		
	?>
	<tr>
			<td><?php echo  $record['Compte']['numero']; ?></td>
			<td><?php echo  $record['Compte']['date_operation']; ?></td>
			<td><?php echo  preg_replace_callback("#N°(\d)+#","lien", $record['Compte']['libelle']); ?></td>
			<td><?php echo  $record['Compte']['debit']; ?></td>
			<td><?php echo  $record['Compte']['credit']; ?></td>
			<td>
			<?php echo $this->Html->link($record['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $record['Personnel']['id'])); ?>
			</td>
			<td><?php echo  $record['Compte']['created']; ?></td>
	</tr>
<?php endforeach; ?>
	<?php if($solde!=0) :?>
	<tr class="strong">
			<td></td>
			<td></td>
			<td>SOLDE <?php if($debit<$credit) echo  'CREDITEUR'; else echo 'DEBITEUR'; ?></td>
			<td><?php if($debit<$credit) echo  $solde; ?></td>
			<td><?php if($debit>$credit) echo  $solde; ?></td>
			<td></td>
			<td></td>
	</tr>
	<?php endif;?>
	<tr>
			<td></td>
			<td></td>
			<td>TOTAL</td>
			<td><?php if($debit>=$credit) echo $debit ; else echo $credit; ?></td>
			<td><?php if($debit<=$credit) echo $credit ; else echo $debit;  ?></td>
			<td></td>
			<td></td>
	</tr>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link(sprintf(__('Liste des comptes', true), __('Compte', true)), array('action' => 'index')); ?></li>
		<?php if(!is_null($controller)):?>
			<li><?php echo $this->Html->link('Liste des '.$controller, array('controller'=>$controller,'action' => 'index')); ?></li>
		<?php endif;?>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Compte',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('choix',array('id'=>'choix','options'=>array(
																				'marchandises'=>'Marchandises',
																				'capital'=>'capital',
																				'clients'=>'Dettes Clients',
																				'fournisseurs'=>'Dettes fournisseur',
																				'dettes_m_l'=>'Dettes à M/L terme',
																				'immobs'=>'Immobilisation',
																				'caisses'=>'Trésorerie',
																				'charges'=>'Charges',
																				'charges_services'=>'charges_services',
																				'produits'=>'Produits',
																				'produits_services'=>'produits_services',
																				'tva'=>'Tva à décaisser'
																				),
												'label'=>'Choix du compte'
						));
			echo $this->Form->input('tier_id',array('disabled'=>'disabled','id'=>'Cpte_clients','options'=>$clients,'label'=>'Créances Clients'));
			echo $this->Form->input('tier_id',array('disabled'=>'disabled','id'=>'Cpte_fournisseurs','options'=>$fournisseurs,'label'=>'Dettes fournisseurs'));
			echo $this->Form->input('type_id',array('disabled'=>'disabled','id'=>'Cpte_charges','options'=>$charges,'label'=>'Charges'));
			echo $this->Form->input('type_service_id',array('disabled'=>'disabled','id'=>'Cpte_charges_services','options'=>$charges_services,'label'=>'Charges de Services'));
			echo $this->Form->input('date1',array('label'=>'Choisissez une date début'));									
		?>
	</span>
	<span class="right">
		<?php
			
			echo $this->Form->input('tier_id',array('disabled'=>'disabled','id'=>'Cpte_dettes_m_l','options'=>$fournisseurs,'label'=>'Dettes à M/L terme'));
			echo $this->Form->input('type_immobilisation_id',array('disabled'=>'disabled','id'=>'Cpte_immobs','options'=>$immobs,'label'=>'Immobilisations'));
			echo $this->Form->input('caiss_id',array('disabled'=>'disabled','id'=>'Cpte_caisses','options'=>$caisses,'label'=>'Trésorerie'));
			echo $this->Form->input('type_id',array('disabled'=>'disabled','id'=>'Cpte_produits','options'=>$produits,'label'=>'Produits'));
			echo $this->Form->input('type_service_id',array('disabled'=>'disabled','id'=>'Cpte_produits_services','options'=>$produits_services,'label'=>'Produits de Services'));
			echo $this->Form->input('date2',array('label'=>'et une date fin pour le rapport','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>