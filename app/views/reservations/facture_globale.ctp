<?php 
 $config = Configure::read('aser');
?>
<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
	indicator();
	});
</script>

<div id='view'>
<div class="document">
		
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options Pour Les extras">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'recherche','action'=>'/facture_globale/'.$factureId,$payee,$detailed));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('label'=>'Choisissez une date','type'=>'text'));
			echo $this->Form->input('date2',array('label'=>'Choisissez une date','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
	<span id="facture_num" facture="<?php echo $reservation['Facture']['id'];?>" num="<?php echo $reservation['Facture']['numero'];?>" aserb_num="<?php echo $reservation['Facture']['aserb_num'];?>" reste="<?php echo $reservation['Facture']['reste'];?>"></span>

<div id="entete">
	<div class="left">
		<?php echo $this->element('company',array('monnaie'=>$reservation['Facture']['monnaie'])); ?>
	</div>
	<div id="stamp"></div>
	<div id="facture_details" style="margin-left:-40px;">
			<?php 
				$etat=$reservation['Facture']['etat'];
				echo 'Payment State:  <span id="etat">'.$etat.'</span>';
			?>
			<?php if(!empty($reservation['Facture']['observation']))
					echo 'Reason : '.$reservation['Facture']['observation'];
					echo '<br/>';
			?>
			<?php if(!empty($reservation['Facture']['aserb_num']))
					echo 'Linked Number: '.$reservation['Facture']['aserb_num'];
					echo '<br/>';
			?>
			
			
		</div>
	<div class="right">
		<?php  
			echo ' Creation Date : <span id="dateId" depart="'.$depart.'">'.$this->MugTime->toFrench($reservation['Facture']['date']).'</span><br/>';
			if(!in_array($reservation['Facture']['date_emission'],array('',null,'0000-00-00'))) {
			 	echo 'Emission Date : <span id="dateId">'.$this->MugTime->toFrench($reservation['Facture']['date_emission']).'</span><br/>';
			}
			echo '<br/><br/><br/><br/><br/><br/>';
		?>	
		<div>
			<?php 
				echo $this->element('../tiers/details',array('client'=>$reservation['Tier']));
				if(!empty($reservation['Facture']['bon_commande'])) echo '<br/>Bon de commande : '.$reservation['Facture']['bon_commande'].'<br/>';
			?>
		</div>
		<?php
			echo 'Check In Date : '.$this->MugTime->toFrench($arrivee);
			echo '<br/>';
			echo 'Check Out Date : '.$this->MugTime->toFrench($depart);
			echo '<br/>';
			echo 'N° of Room(s) : '.$chambres;
	 ?>
	</div>
	<div style="clear:both"></div>
</div>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<div id="accomodation">
<span class="titre"><? echo _('Accommodation Invoice ');
					$display=((Configure::read('aser.aserb')&&(in_array($session->read('Auth.Personnel.fonction_id'),array(3))))
							||!Configure::read('aser.aserb')
							)?
							'inline':'none';
					?>
				<span id="displayed_num" style=" display:<?php echo $display;?>"  xls_copy="<?php echo Configure::read('aser.xls_copy')*1 ?>">
					<?php echo 'n° '.$reservation['Facture']['numero'];?>
					</span>
</span>
<br/>
<br/>
<table cellpadding="0" cellspacing="0">
	<?php if($detailed):?>
	<tr>
			<th>Date</th>
			<th>Room N°</th>
			<th>Room Type</th>
			<th>Rate (<?php echo $reservation['Facture']['monnaie'];?>)</th>
	</tr>
	<?php
	$totalReservation=0;
	foreach ($modelInfos as $book):

	?>
	<?php 
		$nuitee=$this->MugTime->diff( $book['Reservation']['arrivee'], $book['Reservation']['depart'])+1;
		for($i=0;$i<$nuitee;$i++):
			$date=$this->MugTime->increase_date($book['Reservation']['arrivee'],$i);
			$class=($date>date('Y-m-d'))?'active':'';
			$totalReservation+=$book['Reservation']['PU'];
	?>
			<tr class="<?php echo $class;?>">
				<td><?php echo  $this->MugTime->toFrench($date); ?></td>
				<td><?php echo  $book['Chambre']['name']; ?></td>
				<td><?php echo  $typeChambres[$book['Chambre']['type_chambre_id']]; ?></td>
				<td><?php echo  $number->format($book['Reservation']['PU'],$formatting); ?></td>
			</tr>
			
	<?php endfor;?>
	<?php if($book['Reservation']['demi']):
		$totalReservation+=round($book['Reservation']['PU']*($book['Reservation']['tauxDemi']/100),0);
	?>
		<tr>
			<td>Late Check Out of <?php echo  $this->MugTime->toFrench($this->MugTime->increase_date($book['Reservation']['depart'],1)); ?></td>
			<td><?php echo  $book['Chambre']['name']; ?></td>
			<td><?php echo  $typeChambres[$book['Chambre']['type_chambre_id']]; ?></td>
			<td><?php echo  $number->format(round($book['Reservation']['PU']*($book['Reservation']['tauxDemi']/100)),$formatting); ?></td>
		</tr>
	<?php endif;?>
<?php endforeach; ?>
<? else : ?>
<tr>
			<th><? echo __('Service Type');?></th>
			<th><? echo __('Qty');?></th>
			<th><? echo __('PU');?></th>
			<th><? echo __('Total Price');?></th>
	</tr>
	<?php
	$totalReservation=0;
	foreach ($modelInfos as $book):
		$totalReservation+=$book['Reservation']['montant'];
	?>
	<tr>
		<td><?php echo __( 'Room N° ').$book['Chambre']['name']; ?></td>
		<td><?php echo  $nuitee=$this->MugTime->diff( $book['Reservation']['arrivee'], $book['Reservation']['depart'])+1;
				echo _(' bed night(s)');		
			?>
		</td>
		<td><?php echo  $number->format($book['Reservation']['PU'],$formatting); ?></td>
		<td><?php echo  $number->format($book['Reservation']['montant'],$formatting); ?></td>
	</tr>
	<?php if($book['Reservation']['demi']):
		$totalReservation+=round($book['Reservation']['PU']*($book['Reservation']['tauxDemi']/100),0);
	?>
		<tr>
			<td><?php echo  $book['Chambre']['name']; ?></td>
			<td>Late Check Out</td>
			<td><?php echo  $number->format(round($book['Reservation']['PU']*($book['Reservation']['tauxDemi']/100)),$formatting); ?></td>
			<td><?php echo  $number->format(round($book['Reservation']['PU']*($book['Reservation']['tauxDemi']/100)),$formatting); ?></td>
		</tr>
	<?php endif;?>
<?php endforeach; ?>
<?php endif;?>
<?php if($reservation['Facture']['tva']!=0):?>
	<tr class="strong">
		<td><? echo __('T.P WITHOUT TVA');?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><span id="a_payer"><?php echo ''.$number->format(($reservation['Facture']['montant']-$reservation['Facture']['tva'])+0,$formatting); ?></span></td>
	</tr>
	<tr class="strong">
		<td>TVA</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><span id="a_payer"><?php echo ''.$number->format($reservation['Facture']['tva']+0,$formatting); ?></span></td>
	</tr>
<?php endif;?>

<tr class="strong">
		<td><? echo __('T.P'); if($reservation['Facture']['tva']!=0) echo __('.TVAC');?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo ''.$number->format($totalReservation,$formatting); ?></span></td>
</tr>
	<? if($detailed):?>
		<tr class="strong">
			<td><? echo __('CONSUMMED BED NIGHTS '); if($reservation['Facture']['tva']!=0) echo '(TVAC)';?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><span id="a_payer"><?php echo ''.$number->format($reservation['Facture']['montant']+0,$formatting); ?></span></td>
		</tr>
	<? endif;?>
	<tr class="strong">
		<td><? echo __('MONTANT PAYE');?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><span id="a_payer"><?php echo ''.$number->format($reservation['Facture']['montant']-$reservation['Facture']['reste']+0,$formatting); ?></span></td>
	</tr>
	<tr class="strong">
		<td>LEFT TO PAY (en <?php echo $reservation['Facture']['monnaie']?>)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td id="facture_reste"><?php echo $number->format($totalReservation-$reservation['Facture']['montant']+$reservation['Facture']['reste']+0,$formatting); ?></td>
	</tr>
<?php echo $this->element('../reservations/reduction',array('ress'=>$modelInfos))?>	

</table>
</div>
<div id="extras_liste">
<?php if(!empty($extras_factures)) : ?>
<span class="titre">Extras</span>
<br/>
<?php echo $this->Form->create('Paiement',array('name'=>'checkbox','action'=>'mass_payment'));?>
<table cellpadding="0" cellspacing="0">
	
	<tr>
			<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th>Invoice N°</th>
			<th>Invoice Type</th>
			<th>Amount</th>
			<th>Left to Pay</th>
			<th>Currency</th>
			<th>Payment state</th>
			<th>Date</th>
		
	</tr>
		<?php
	foreach ($extras_factures as $extras_facture):
		
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$extras_facture['Facture']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$extras_facture['Facture']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($extras_facture['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $extras_facture['Facture']['id'])); ?>
		</td>
		<td><?php switch($extras_facture['Facture']['operation']){
					case 'Vente' : echo 'Restaurant'; break;
					case 'Service': 
						if(isset($extras_facture['Service'][0])&&isset($typeServices[$extras_facture['Service'][0]['type_service_id']])) 
							echo $typeServices[$extras_facture['Service'][0]['type_service_id']];
						break; 
				}
			?>
		</td>
		<td><?php echo $number->format($extras_facture['Facture']['montant'],$formatting); ?>&nbsp;</td>
		<td name="reste"><?php echo $number->format($extras_facture['Facture']['reste'],$formatting); ?>&nbsp;</td>
		<td><?php echo $extras_facture['Facture']['monnaie']; ?>&nbsp;</td>		
		<td><?php echo $extras_facture['Facture']['etat']; ?>&nbsp;</td>
		<td><?php echo $this->MugTime->toFrench($extras_facture['Facture']['date']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
<?php foreach($sums as $sum):?>
<?php if(($sum['Facture']['tva']!=0)&&($reservation['Facture']['monnaie']!='BIF')):?>
	<tr class="strong">
		<td>WITHOUT TVA</td>
		<td colspan="2">&nbsp;</td>
		<td><span ><?php echo ''.$number->format(($sum['Facture']['montant']-$sum['Facture']['tva'])+0,$formatting); ?></span></td>
		<td>&nbsp;</td>
		<td><?php echo $sum['Facture']['monnaie']; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="strong">
		<td>TVA</td>
		<td colspan="2">&nbsp;</td>
		<td><span><?php echo ''.$number->format($sum['Facture']['tva']+0,$formatting); ?></span></td>
		<td>&nbsp;</td>
		<td><?php echo $sum['Facture']['monnaie']; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<?php elseif(($sum['Facture']['tva']!=0)&&($reservation['Facture']['monnaie']=='BIF')):?>
	<tr class="strong">
		<td>WITHOUT TVA</td>
		<td colspan="2">&nbsp;</td>
		<td><span ><?php echo ''.$number->format(($sum['Facture']['montant']-$sum['Facture']['tva'])+0,$formatting); ?></span></td>
		<td>&nbsp;</td>
		<td><?php echo $sum['Facture']['monnaie']; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="strong">
		<td>TVA</td>
		<td colspan="2">&nbsp;</td>
		<td>&nbsp;</td>
		<td><span><?php echo ''.$number->format($sum['Facture']['tva']+0,$formatting); ?></span></td>
		<td><?php echo $sum['Facture']['monnaie']; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<?php endif;?>
	<tr class="strong">
		<td>TOTAL <?php if(Configure::read('aser.tva')==1) echo '(TTC)';?></td>
		<td colspan="2">&nbsp;</td>
		<td><?php echo ''.$number->format($sum['Facture']['montant']+0,$formatting); ?></td>
		<td>&nbsp;</td>
		<td><?php echo $sum['Facture']['monnaie']; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="strong">
		<td>PAID AMOUNT</td>
		<td colspan="2">&nbsp;</td>
		<td><?php echo ''.$number->format($sum['Facture']['montant']-$sum['Facture']['reste']+0,$formatting); ?></td>
		<td>&nbsp;</td>
		<td><?php echo $sum['Facture']['monnaie']; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="strong">
		<td>LEFT TO PAY (en <?php echo $sum['Facture']['monnaie']; ?>)</td>
		<td colspan="2">&nbsp;</td>
		<td><span id="a_payer"><?php echo ''.$number->format($sum['Facture']['reste']+0,$formatting); ?></span></td>
		<td>&nbsp;</td>
		<td><?php echo $sum['Facture']['monnaie']; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<?php endforeach;?>
<?php if($reservation['Facture']['monnaie']=='USD'):?>
	<tr class="strong">
		<td> LEF TO PAY IN DOLLARS</td>
		<td colspan="2">&nbsp;</td>
		<td><?php echo $number->format($total_usd+0,$formatting); ?></span></td>
		<td>&nbsp;</td>
		<td>USD</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<?php endif;?>
</table>
</form>
<?php endif; ?>
</div>

<br />
<br />
<!-- extras vue cptable list -->
<div id="extras_vue_cptable" style="display:none;">
<?php echo $this->element('../factures/vue_cptable',array('ventes'=>$ventes,'no'=>$reservation['Facture']['numero']));?>
</div>
<!-- paiements list -->
<div id="pyts" style="display:none;">
<?php echo $this->element('../paiements/payments_table',array('pyts'=>$pyts,'facture'=>true,'checkbox'=>true,'sumPyts'=>$sumPyts));?>
<br />
<br />
</div>

<!-- synthese paiements -->
<div id="synthese_pyts" style="display:none;">
<?php echo $this->element('../paiements/synthese_pyts',array('synthesePyts'=>$synthesePyts));?>
</div>
 <br />
 <br />
<?php if(Configure::read('aser.aserb')){
		$displayCash='display:block';
		$displayCredit='display:none';
	}
else {
	$displayCash='display:none';
		$displayCredit='display:block';
}
?>
<div id="signature_cash" class="bas_page" style="<?php echo $displayCash;?>">
	<div class="left">
		<div class="text">
		
		</div>
	</div>
	<div class="right">
		<?php $personnel=$session->read('Auth.Personnel');
			echo __('Signature réceptioniste').' : <br/>'.ucfirst($personnel['name']);	
		?>
	</div>
	<div style="clear:both"></div>
</div>

<div id="signature_credit" class="bas_page" style="<?php echo $displayCredit;?>">
	<div class="left">
		<div class="text">
			<?php $personnel=$session->read('Auth.Personnel');
			echo __('Receptionist Signature').' : <br/>'.ucfirst($personnel['name']);	
		?>
		</div>
	</div>
	<div class="right">
		<?php
			echo __('Customer Signature').' <br/>';	
		?>
	</div>
	<div style="clear:both"></div>
</div>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<div id="legend" style="display:none;">
	<table cellpadding="0" cellspacing="0" id="legend">
		<tr class="active"><td>Unconsummed Nights</td></tr>
	</table>
	</div>
	<ul>
		<?php if(Configure::read('aser.aserb')):?>
				<li class="link" onclick="impressionB()" >Print</li>
		<? else:?>
			<li class="link" onclick="print_documents()" >Print</li>
		<? endif;?>
		<?php if(Configure::read('aser.xls_copy')):?>
			<li class="link" onclick = "custom_printing('<?php echo $factureId ?>','<?php echo 'reservations/facture_globale/'.$factureId.'/'.$payee.'/1/2'?>')" >Print with Details</li>
		<?php endif;?>
		<? if((in_array($session->read('Auth.Personnel.fonction_id'),array(3,5,8))&&empty($config['annulee']))
					||in_array($session->read('Auth.Personnel.id'),$config['annulee'])) :?>
				<li class="link" onclick = "annuler_facture('<?php echo 'Reservation_'.$reservation['Facture']['id'];?>')" >Cancel the Invoice</li>
			<?php endif;?>
		<li class="link" onclick="jQuery('#accomodation').slideToggle()" title="Afficher ou masquer l'Hébergement" >Show/Hide Accommodation</li>
		<li class="link"  onclick = "jQuery('#extras_liste').slideToggle()" title="Afficher ou masquer les extras">Show/Hide Extras</li>
		<?php if(Configure::read('aser.comptabilite')):?>
		<li class="link"  onclick = "jQuery('#extras_vue_cptable').slideToggle()" title="Afficher ou masquer les extras">Recap of Extras</li>
		<?php endif;?>
		<?php if(in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))) :?>
			<li class="link" onclick = "edit_facture()" >Edit the Invoice</li>
		<?php endif;?>
		<li class="link"  onclick ="mass_pyt('on')">Create a Payment</li>
		<li class="link"  onclick ="pyt(undefined,'remboursement')">Create un Reimboursement</li>
		<li class="link" onclick = "jQuery('#pyts').slideToggle();jQuery('#pyts_links').slideToggle();" >Show/Hide Payments</li>
		<li class="link"  onclick = "jQuery('#synthese_pyts').slideToggle();jQuery('#signature_client').toggle()" title="Afficher ou masquer la synthese des paiements">Recap of Payments</li>
		<span id="pyts_links" style="display:none;">
			<li class="link" onclick = "remove_pyt('on')" >Delete a Payment</li>
		</span>
		<?php if($payee=='no'):?>
			<li><?php echo $this->Html->link('Show Paid Extras', array('controller' => 'reservations', 'action' => 'facture_globale',$factureId,'yes')); ?> </li>
		<?php else :?>
			<li><?php echo $this->Html->link('Hide Paid Extras', array('controller' => 'reservations', 'action' => 'facture_globale',$factureId,'no')); ?> </li>
		<?php endif;?>
		
		<?php if($detailed==0):?>
			<li><?php echo $this->Html->link('Full Version', array('controller' => 'reservations', 'action' => 'facture_globale',$factureId,$payee,1)); ?> </li>
		<?php else :?>
			<li><?php echo $this->Html->link('Simplified Version', array('controller' => 'reservations', 'action' => 'facture_globale',$factureId,$payee,0)); ?> </li>
		<?php endif;?>
		<li><?php echo $this->Html->link('Booking Management', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
		<li><?php echo $this->Html->link('Show Logs', array('controller' => 'traces', 'action' => 'index',$factureId,'Facture')); ?> </li>
		<?php if(in_array(Configure::read('aser.name'),array('aserb','belair'))||Configure::read('aser.chg_num')):?>
			<li class="link" onclick = "num()" >Chang the number</li>
		<?php endif;?>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<?php if(Configure::read('aser.export_bills')):?>
				<li><?php echo $this->Html->link('Export to excel', array('controller' => 'reservations', 'action' => 'facture_globale/'.$factureId.'/'.$payee.'/1/1')); ?> </li>
			<?php endif;?>
	</ul>
</div>

<!--paiement box-->
<?php echo $this->element('../paiements/edit',array('reste'=>0,'action'=>'mass_payment'));?>
<!--pyt refund box-->
<?php echo $this->element('../paiements/edit',array('reste'=>0,'action'=>'add','remboursement'=>true));?>

<!--edit facture box -->
<?php echo $this->element('../factures/edit',array('facture'=>$reservation['Facture']));?>

<div id="print_boxe" style="display:none" title="Payment Mode Envisage">
<div class="dialog">
	<span class="left">
		<?php
			echo $this->Form->input('mode',array('options'=>array(''=>'',
																		'CASH'=>'CASH',
																		'AUTRE'=>'AUTRE',
																		)));
		?>
	</span>
	<span class="right">
		
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>