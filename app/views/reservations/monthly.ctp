<script>
	jQuery(document).ready(function(){
		jQuery( "#ReservationDate2" ).datepicker( "option", "maxDate", new Date() );
		
		jQuery('#FactureChoix option[value="AUTRE"]').attr('selected','selected');
		jQuery('#FactureNumero').removeAttr('disabled')
		
		jQuery('#FactureChoix').change(function(){
			if(jQuery(this).val()=='CASH')
				jQuery('#FactureNumero').attr('disabled','disabled')
			else
				jQuery('#FactureNumero').removeAttr('disabled')
		})
	});
	
</script>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('label'=>'Start Date','type'=>'text'));	
			echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));
		?>
	</span>
	<span class="right">
		<?php
		/*
			echo $this->Form->input('booking',array('options'=>array('none'=>'',
																'encaissees'=>'Déjà hébergés',
																'attendues'=>'attendues',
																),
													'label'=>'Filtrage Réservations'
													));	
		//*/
			echo $this->Form->input('bills',array('options'=>array('none'=>'',
																'payee'=>'Paid',
																'recouvrement'=>'In collection',
																'en_cours'=>'Ongoing',
																),
													'label'=>'Invoice Filtering'
													));			
			
			echo $this->Form->input('Tier.compagnie',array('label'=>'Customer Company','type'=>'text'));			
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<h3><?php 
$config=Configure::read('aser');
	echo 'Rapport Mensuelle d\'Hébergement';
		if(isset($date1)){
			echo '<h4>( '.$this->MugTime->toFrench($date1).'-'.$this->MugTime->toFrench($date2).' )</h4>';
		}
	?>
</h3>
<br>
<?php echo $this->Form->create('Reservation',array('name'=>'checkbox','action'=>'documents','id'=>'Reservation_reservations'));?>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th>Customer</th>
			<th>Company</th>
			<th>Room N°</th>
			<th>Arrival</th>
			<th>Departure</th>
			<th>Unit Price</th>
			<th>Total</th>
			<?php if($config['extras']):?>
			<th>Extras</th>
			<th>Total</th>
			<th>Currency</th>
			<?php endif; ?>
			<th>State</th>
			<th>Invoice N°</th>
			<th>Payment State</th>
			<?php if(Configure::read('aser.aserb')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3))):?>
				<th>Payment Mode</th>
			<?php endif;?>
		
	</tr>
		<?php
	foreach ($reservations as $reservation):
	
	?>
	<tr>
			<td>
				<?php echo $this->Form->input('Id.'.$reservation['Reservation']['id'],array('label'=>'','type'=>'checkbox','value'=>$reservation['Reservation']['id'],'facture'=>$reservation['Facture']['id'])); ?>
			</td>
			<td>
			<?php echo $this->Html->link($reservation['Tier']['name'], array('controller' => 'Tiers', 'action' => 'view', $reservation['Tier']['id'])); ?>
			</td>
			<td><?php echo  $reservation['Tier']['compagnie']; ?></td>
			<td><?php echo  $reservation['Chambre']['name']; ?></td>
			<td><?php echo  $this->MugTime->toFrench($reservation['Reservation']['arrivee']); ?></td>
			<td><?php echo  $this->MugTime->toFrench($reservation['Reservation']['depart']); ?></td>
			<td><?php echo  $number->format($reservation['Reservation']['PU'],$formatting); ?></td>
			<?php if($config['extras']):?>
				<td><?php echo $number->format( $reservation['Reservation']['montant'],$formatting); ?></td>
				<td><?php echo $number->format( $reservation['extras'],$formatting); ?></td>
				<td><?php echo  $number->format($reservation['extras']+$reservation['Reservation']['montant']+0,$formatting); ?></td>
				<td><?php echo  $reservation['Reservation']['monnaie']; ?></td>
			<?php else:?>
				<td><?php echo  $number->format($reservation['Reservation']['montant'],$formatting).' '.$reservation['Reservation']['monnaie']; ?></td>
			<?php endif; ?>
			<td><?php echo  $reservation['Reservation']['etat']; ?></td>
			<td>
			<?php echo $this->Html->link($reservation['Facture']['numero'], array('controller' => 'reservations', 'action' => 'facture_globale',$reservation['Facture']['id'],true));
			if(Configure::read('aser.aserb')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3))){
				echo ' <span id="'.$reservation['Facture']['id'].'">';
				if($reservation['Facture']['aserb_num']>0) echo $reservation['Facture']['aserb_num'];
				echo '</span>';
			}
			 ?>
			</td>
			<td name="etat"><?php echo  $reservation['Facture']['etat']; ?></td>
			<?php if(Configure::read('aser.aserb')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3))):?>
				<td><?php echo  $reservation['Facture']['type']; ?></td>
			<?php endif;?>
	</tr>
<?php endforeach; ?>
<?php if( $total['USD']!=0):?>
	<tr class="strong">
		<td>TOTAL (USD)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo  $number->format($total['USD'],$formatting); ?></td>
		<?php if($config['extras']):?>
		<td><?php echo  $number->format($extras,$formatting); ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<?php endif; ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<?php if(Configure::read('aser.aserb')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3))):?>
			<td>&nbsp;</td>
		<?php endif;?>
	<tr>
<?php endif; ?>
<?php if( $total['BIF']!=0):?>
	<tr class="strong">
		<td>TOTAL (BIF)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo  $number->format($total['BIF'],$formatting); ?></td>
		<?php if($config['extras']):?>
		<td><?php echo  $number->format($extras,$formatting); ?></td>
		<td><?php echo  $number->format($extras+$total['BIF'],$formatting); ?></td>
		<td>BIF</td>
		<?php endif; ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<?php if(Configure::read('aser.aserb')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3))):?>
			<td>&nbsp;</td>
		<?php endif;?>
	<tr>
<?php endif; ?>
</table>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<?php if(Configure::read('aser.aserb')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3))):?>
			<li class="link"  onclick = "assign_b_num()" >Assigner/Enlever un numero</li>
		<?php endif;?>
		<li><?php echo $this->Html->link('Bookings Management', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
	</ul>
</div>
<div id="assign_boxe" style="display:none" title="Assigner ou enlever un numero dans B">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('choix',array('label'=>'Choix','options'=>array('AUTRE'=>'Assigner','CASH'=>'enlever')));	
			echo $this->Form->input('numero',array('label'=>'Numero de la facture en B','type'=>'text'));	
		?>
	</span>
	<span class="right">
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>

<!-- form for paiement creation -->
<?php echo $this->element('../paiements/edit',array('reste'=>0,'action'=>'mass_payment'));?>
