<div id='view'>
<div class="document">
<h3><?php echo 'OCCUPANCY REPORT ';
		
			echo '<h4>( of '.$this->MugTime->toFrench($date).' at '.date('H:i:s').' )</h4>';
	?>
</h3>
<br />
<br />
<?php if($mode!='tiny'):?>
<table cellpadding="0" cellspacing="0" id="journal_resume">
	<tr>
			<th align="center" colspan="2">SUMMARY</th>
	</tr>
	
	<tr>
		<td>AVAILABLE ROOMS</td>
		<td><?php echo  $vacante+0; ?></td>
	</tr>
	<tr>
		<td>OCCUPIED ROOMS</td>
		<td><?php echo  $occupee+0; ?></td>
	</tr>
	<tr>
		<td>BOOKED ROOMS</td>
		<td><?php echo  $reservee+0; ?></td>
	</tr>
	<tr>
		<td>CUSTOMER ARRIVALS</td>
		<td><?php echo  $arrivals+0; 
				if($arrivals>0)
					echo ' : ('.$arrivalsList.')';
		
		?></td>
	</tr>
	<tr>
		<td>CUSTOMER DEPARTURES</td>
		<td><?php echo  $departures+0;
			if($departures>0)
					echo ' : ('.$departuresList.')';
		?></td>
	</tr>
	<?php if($mode=='full'):?>
	<tr>
		<td>TODAY SALES</td>
		<td><?php echo  $number->format($usd+0,$formatting).' USD, '.$number->format($bif+0,$formatting).' RWF'; ?></td>
	</tr>
	<tr>
		<td>TODAY PAYMENTS</td>
		<td><?php echo  $number->format($total['USD']+0,$formatting).' USD, '.$number->format($total['RWF']+0,$formatting).' RWF'.', '.$number->format($total['EUR']+0,$formatting).' EUR'; ?></td>
	</tr>
	<? endif;?>
</table>

<br />
<br />
<?php if($mode=='full'):?>
<?php if(($total['USD']+$total['RWF']+$total['EUR'])>0):?>
	<h3>TODAY PAYMENTS DETAILS</h3>
<table cellpadding="0" cellspacing="0" id="journal_resume">
	<tr>
			<th align="center">Currency</th>
			<th align="center">Cash</th>
			<th align="center">Cheque</th>
			<th align="center">Visa</th>
	</tr>
	<?php foreach($monnaies as $monnaie):?>
		<tr>
			<td><?php echo $monnaie;?></td>
			<td><?php echo $detailPyts[$monnaie.'_cash'];?></td>
			<td><?php echo $detailPyts[$monnaie.'_cheque'];?></td>
			<td><?php echo $detailPyts[$monnaie.'_visa'];?></td>
		</tr>
	<?php endforeach;?>
</table>
<br />
<br />
<?php endif;?>
<?php endif;?>
<?php if(!empty($departuresDetails)):?>
	
	<h3>DEPARTURES LIST</h3>
<table cellpadding="0" cellspacing="0" id="journal_resume" style="width:900px">
	<tr>
			<th align="center">Room N°</th>
			<th align="center">Customer</th>
			<th align="center">Company</th>
			<?php if($mode=='full'):?>
				<th align="center">Invoice  N°</th>
				<th align="center">Invoice State</th>
			<?php endif;?>
			<th align="center">Departure Time</th>
	</tr>
	<?php 
	foreach($departuresDetails as $detail):?>
		<tr>
			<td><?php echo $detail['Chambre']['name'];?></td>
			<td><?php echo $detail['Tier']['name'];?></td>
			<td><?php echo $detail['Tier']['compagnie'];?></td>
			<?php if($mode=='full'):?>
				<td>
				<?php 
					if(!empty($detail['Facture']['id'])) echo $this->Html->link($detail['Facture']['numero'], array('controller' => 'Reservations', 'action' => 'facture_globale', $detail['Facture']['id']),array('target'=>'_blank'));
				?>
				</td>
				<td>
				<?php
					if($detail['Facture']['etat']=='payee'){
						if($detail['paiements']==0)
							echo 'Payée en avance';
						else if($detail['paiements']<$detail['Reservation']['montant'])
							echo 'Payée en tranche, dont une audjourd\'hui';
						else
							echo 'Payée en totalité aujourd\'hui';
					}
					else if($detail['Facture']['etat']=='credit'){
						echo 'Non payée! '.$detail['Reservation']['observation'];
					}
					else if($detail['Facture']['etat']=='avance'){
						echo 'Partiellement payée. '.$detail['Reservation']['observation'];
					}
					else if($detail['Facture']['etat']=='bonus'){
						echo 'Bonus. offert par l\'hôtel.';
					}
					;?>
				</td>
			<?php endif;?>
			<td><?php echo $detail['Reservation']['heure_depart'];?></td>
		</tr>
	<?php endforeach;?>
</table>
<?php endif;?>
<br />
<br />
<?php endif;?>

<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Room  N°</th>
			<th>Customer</th>
			<th>Nationality/th>
			<th>Pax</th>
			<th>Company</th>
			<th>Arrival</th>
			<th>Departure</th>
			<?php if($mode!='tiny'):?>
				<th>Rate</th>
				<? if($mode=='full'):?>
					<th>Rate</th>
					<th>Discount</th>
				<?php endif;?>
				<th>State</th>
				<th>Invoice N°</th>
				<th>Payment Mode</th>
			<?php endif;?>
	</tr>
		<?php
	$i = 0;
	$persTotal=0;
	foreach ($chambres as $chambre):
		$class = null;
		if (isset($chambre['Reservation']['checked_in'])&&($chambre['Reservation']['checked_in']==date('Y-m-d'))) {
			$class = 'active';
		}
		if(!empty($chambre['Reservation']['pax'])){
			$persTotal+=$chambre['Reservation']['pax'];
		}
	?>
	<?php if(($mode!='tiny')||
			(($mode=='tiny')&&
			  isset($chambre['Reservation']['etat'])&&
			  !in_array($chambre['Reservation']['etat'],array('pending','checked_out'))
			)):
		if($mode=='tiny'){
			//$persTotal+=$chambre['Reservation']['pax'];
		}
	?>
		<tr class="<?php echo $class;?>">
			<td><?php echo  $chambre['Chambre']['name']; ?></td>
			<td>
			<?php if(isset($chambre['Tier']['id'])) echo $chambre['Tier']['name']; ?>
			</td>
			<td><?php if(isset($chambre['Tier']['id'])) echo $chambre['Tier']['nationalite']; ?></td>
			<td><?php if(isset($chambre['Reservation'])) echo $chambre['Reservation']['pax']; ?></td>
			<td><?php if(isset($chambre['Tier']['compagnie'])) echo  $chambre['Tier']['compagnie']; ?></td>
			<td><?php if(isset($chambre['Reservation']['checked_in'])) echo  $this->MugTime->toFrench($chambre['Reservation']['checked_in']); ?></td>
			<td><?php if(isset($chambre['Reservation']['depart'])) echo  $this->MugTime->toFrench($chambre['Reservation']['depart']); ?></td>
			<?php if($mode!='tiny'):?>
				<td><?php if(isset($chambre['Reservation']['nuitee'])) echo  $chambre['Reservation']['nuitee']; ?></td>
				<? if($mode=='full'):?>
					<td><?php if(isset($chambre['Reservation']['PU'])) echo  $number->format($chambre['Reservation']['PU']+0,$formatting).' '.$chambre['Reservation']['monnaie']; ?></td>
					<td><?php if(!empty($chambre['Reservation']['PU_standard'])&&($chambre['Reservation']['PU_standard']>$chambre['Reservation']['PU'])) echo  round(($chambre['Reservation']['PU_standard']-$chambre['Reservation']['PU'])*100/$chambre['Reservation']['PU_standard'],2).' %' ; 
							else	echo '---'; 
					?></td>
				<?php endif;?>
				<td><?php if(isset($chambre['Reservation']['etat'])) echo  ucfirst($chambre['Reservation']['etat']); else echo 'Vacante'; ?></td>
				<td>
				<?php if(!empty($chambre['Facture']['id'])) echo $this->Html->link($chambre['Facture']['numero'], array('controller' => 'Reservations', 'action' => 'facture_globale', $chambre['Facture']['id']),array('target'=>'_blank')); ?>
				</td>
				<td><?php if(isset($chambre['Reservation']['mode_paiement'])) echo  ucfirst($chambre['Reservation']['mode_paiement']); else echo ''; ?></td>
			<?php endif;?>
		</tr>
	<?php endif;?>
<?php endforeach; ?>
<? if($mode=='full'):?>
	<tr class="strong">
		<td colspan="3">TOTAL</td>
		<td><?php echo $persTotal; ?></td>
		<td colspan="4"></td>
		<td><?php echo $usd.'_USD, '.$bif.'_RWF'; ?></td>
		<td colspan="5"></td>
	</tr>
<?php elseif($mode=='tiny'):?>
	<tr class="strong">
		<td colspan="3">TOTAL of customers</td>
		<td><?php echo $persTotal; ?></td>
		<td colspan="3"></td>
	</tr>
<?php elseif($mode=='simple'):?>
	<tr class="strong">
		<td colspan="3">TOTAL</td>
		<td><?php echo $persTotal; ?></td>
		<td colspan="9"></td>
	</tr>
<?php endif;?>
</table>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<div id="legend" style="display:none;">
	<table cellpadding="0" cellspacing="0" id="legend">
		<tr class="active"><td>ARRIVAL OF CUSTOMERS</td></tr>
	</table>
	</div>
	<ul>
		<li class="link"  onclick = "jQuery('#legend').slideToggle();" >Show/Hide la Légende</li>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Bookings Management', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
		<? if($mode=='full'):?>
			<li><?php echo $this->Html->link(__('Simplified Version',true), array('controller' => 'reservations', 'action' => 'etat_occupation/simple/'.$date)); ?> </li>
			<?php if(Configure::read('aser.kcc')):?>
				<li><?php echo $this->Html->link(__('Very Simplified Version',true), array('controller' => 'reservations', 'action' => 'etat_occupation/tiny/'.$date)); ?> </li>
			<? endif;?>
		<? else :?>
			<li><?php echo $this->Html->link(__('Full Version',true), array('controller' => 'reservations', 'action' => 'etat_occupation/full/'.$date)); ?> </li>
		<? endif;?>
	</ul>
</div>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date',array('label'=>'Choose a date','type'=>'text'));
			echo $this->Form->input('mode',array('type'=>'hidden','value'=>$mode));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>