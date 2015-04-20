<div id='view'>
<div class="document">
<h3><?php echo 'ETAT D\'OCCUPATION ';
		
			echo '<h4>( Pour la journée du '.$this->MugTime->toFrench($date).' à '.date('H:i:s').' )</h4>';
	?>
</h3>
<br />
<br />
<?php if($mode!='tiny'):?>
<table cellpadding="0" cellspacing="0" id="journal_resume">
	<tr>
			<th align="center" colspan="2">RESUME</th>
	</tr>
	
	<tr>
		<td>CHAMBRES VACANTES</td>
		<td><?php echo  $vacante+0; ?></td>
	</tr>
	<tr>
		<td>CHAMBRES OCCUPEES</td>
		<td><?php echo  $occupee+0; ?></td>
	</tr>
	<tr>
		<td>CHAMBRES RESERVEES</td>
		<td><?php echo  $reservee+0; ?></td>
	</tr>
	<tr>
		<td>ARRIVEES DES CLIENTS</td>
		<td><?php echo  $arrivals+0; 
				if($arrivals>0)
					echo ' : ('.$arrivalsList.')';
		
		?></td>
	</tr>
	<tr>
		<td>DEPARTS DES CLIENTS</td>
		<td><?php echo  $departures+0;
			if($departures>0)
					echo ' : ('.$departuresList.')';
		?></td>
	</tr>
	<?php if($mode=='full'):?>
	<tr>
		<td>CHIFFRE D'AFFAIRE DE CE JOUR</td>
		<td><?php echo  $number->format($usd+0,$formatting).' USD, '.$number->format($bif+0,$formatting).' BIF'; ?></td>
	</tr>
	<tr>
		<td>PAIEMENTS DE CE JOUR</td>
		<td><?php echo  $number->format($total['USD']+0,$formatting).' USD, '.$number->format($total['BIF']+0,$formatting).' BIF'.', '.$number->format($total['EUR']+0,$formatting).' EUR'; ?></td>
	</tr>
	<? endif;?>
</table>

<br />
<br />
<?php if($mode=='full'):?>
<?php if(($total['USD']+$total['BIF']+$total['EUR'])>0):?>
	<h3>DETAIL DES PAIEMENTS DE CE JOUR</h3>
<table cellpadding="0" cellspacing="0" id="journal_resume">
	<tr>
			<th align="center">Monnaie</th>
			<th align="center">Cash</th>
			<th align="center">Chéque</th>
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
	
	<h3>LISTE DES DEPARTS</h3>
<table cellpadding="0" cellspacing="0" id="journal_resume" style="width:900px">
	<tr>
			<th align="center">Chambre</th>
			<th align="center">Client</th>
			<th align="center">Compagnie</th>
			<?php if($mode=='full'):?>
				<th align="center">Facture</th>
				<th align="center">Etat de la facture</th>
			<?php endif;?>
			<th align="center">Heure de départ</th>
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
			<th>Chambre</th>
			<th>Client</th>
			<th>Nationalité</th>
			<th>Pax</th>
			<th>Compagnie</th>
			<th>Arrivee</th>
			<th>Depart</th>
			<?php if($mode!='tiny'):?>
				<th>Nuitée</th>
				<? if($mode=='full'):?>
					<th>Prix/Nuitée</th>
					<th>Réduction</th>
				<?php endif;?>
				<th>Etat</th>
				<th>N° Facture</th>
				<th>Mode de Paiement</th>
			<?php endif;?>
	</tr>
		<?php
	$i = 0;
	$persTotal=0;
	foreach ($chambres as $chambre):
		$class = null;
		if (isset($chambre['Reservation']['arrivee'])&&($chambre['Reservation']['arrivee']==$date)) {
			$class = 'active';
		}
	?>
	<?php if(($mode!='tiny')||
			(($mode=='tiny')&&
			  isset($chambre['Reservation']['etat'])&&
			  !in_array($chambre['Reservation']['etat'],array('en_attente','partie'))
			)):
		if($mode=='tiny'){
			$persTotal+=$chambre['Reservation']['pax'];
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
			<td><?php if(isset($chambre['Reservation']['arrivee'])) echo  $this->MugTime->toFrench($chambre['Reservation']['arrivee']); ?></td>
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
		<td colspan="8"></td>
		<td><?php echo $usd.'_USD, '.$bif.'_BIF'; ?></td>
		<td colspan="5"></td>
	</tr>
<?php elseif($mode=='tiny'):?>
	<tr class="strong">
		<td colspan="3">TOTAL des personnes</td>
		<td><?php echo $persTotal; ?></td>
		<td colspan="3"></td>
	</tr>
<?php endif;?>
</table>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<div id="legend" style="display:none;">
	<table cellpadding="0" cellspacing="0" id="legend">
		<tr class="active"><td>ARRIVEE DE CLIENT</td></tr>
	</table>
	</div>
	<ul>
		<li class="link"  onclick = "jQuery('#legend').slideToggle();" >Afficher/Masquer la Légende</li>
		<li class="link" onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link('Gestion des Réservations', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
		<? if($mode=='full'):?>
		<li><?php echo $this->Html->link(__('Version Simplifiée',true), array('controller' => 'reservations', 'action' => 'etat_occupation/simple/'.$date)); ?> </li>
		<li><?php echo $this->Html->link(__('Version Très Simplifiée',true), array('controller' => 'reservations', 'action' => 'etat_occupation/tiny/'.$date)); ?> </li>
		<? else :?>
		<li><?php echo $this->Html->link(__('Version Détaillée',true), array('controller' => 'reservations', 'action' => 'etat_occupation/full/'.$date)); ?> </li>
		<? endif;?>
	</ul>
</div>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date',array('label'=>'Choisissez une date','type'=>'text'));
			echo $this->Form->input('mode',array('type'=>'hidden','value'=>$mode));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>