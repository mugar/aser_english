<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
	jQuery('#cloturer').one('click',function(e){ 
		cloturer(jQuery('#journal_id').text(),jQuery('#personnel_id').text()); 
	})
});
</script>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Vente',array('id'=>'recherche','action'=>'journal'));?>
	<span class="left">
		<?php
			echo $this->Form->input('Journal.personnel_id',array('selected'=>0,'id'=>'perso'));
			echo $this->Form->input('Journal.numero',array('type'=>'text','value'=>1,'id'=>'num'));	
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('Journal.date',array('label'=>'Date','type'=>'text','value'=>date('Y-m-d')));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<h3>Cashier Report For <?php if(!empty($journalInfo)) echo ''.ucfirst($journalInfo['Personnel']['name']).'';?></h3>
<h4><?php if(!empty($journalInfo)) {
			echo '(';
			echo 'Of'.$this->MugTime->toFrench($journalInfo['Journal']['date']);
			echo ' at '.date('H:i:s').', ';
			echo 'N° : '.$journalInfo['Journal']['numero'];
			if($journalInfo['Journal']['closed']) 
				echo ' State : <span id="etat_journal" closed="1">closed</span>';
			else
				echo ' State : <span id="etat_journal" closed="0">Not closed</span>';
			echo '<span style="display:none" id="journal_id">'.$journalInfo['Journal']['id'].'</span>';
			echo '<span style="display:none" id="personnel_id">'.$journalInfo['Journal']['personnel_id'].'</span>';
			echo ')';
			if(Configure::read('aser.shifts'))
				echo $this->Form->input('shift',array('label'=>'','id'=>'shift','options'=>$shifts));
		
			}
			echo '<span id="journalData" style="display:none;">'.json_encode($journalData).'</span>';
			?>
			</h4>
		<br>
		
<div>
	
</div>
<br />
<table cellpadding="0" cellspacing="0" id="journal_resume">
	<tr>
			<th align="center" colspan="2">SUMMARY</th>
	</tr>
	<tr>
		<td>TOTAL OF SALES</td>
		<td><?php echo  $number->format($total_factures['resto']+0,$formatting); ?></td>
	</tr>
	<tr>
		<td>TOTAL OF CASH</td>
		<td><?php echo  $number->format($total_cash['resto']+0,$formatting); ?></td>
	</tr>
	<tr>
		<td>TOTAL OF CREDITS</td>
		<td><?php echo  $number->format($total_credits['resto']+0,$formatting); ?></td>
	</tr>
	<tr>
		<td>TOTAL OF BONUS</td>
		<td><?php echo  $number->format($bonus+0,$formatting); ?></td>
	</tr>
	<tr>
		<td>TOTAL OF PAIEMENTS</td>
		<td><?php echo  $number->format($total_pyts['resto']+0,$formatting); ?></td>
	</tr>
	<tr>
		<td>TOTAL OF EXPENSES</td>
		<td><?php echo  $number->format($total_depenses+0,$formatting); ?></td>
	</tr>
	
	<tr>
		<td>TOTAL OF DEPOSITS</td>
		<td><?php echo  $number->format($total_ajouts+0,$formatting); ?></td>
	</tr>
	<tr>
		<td>NET AMOUNT TO PAY</td>
		<td id="versement"  montant="<?php echo $versement; ?>"><?php echo  $number->format($versement+0,$formatting); ?></td>
	</tr>
	<tr>
		<?php if($journalInfo['Journal']['closed']==0):?>
		<td colspan="2"><?php echo  $this->Form->input('observation',array('id'=>'obs','type'=>'textarea')); ?></span></td>
		<?php else : ?>
			<td colspan="2"><?php echo  $this->Form->input('observation',array('id'=>'obs',
																'type'=>'textarea',
																'value'=>$journalInfo['Journal']['observation'],
																'disabled'=>'disabled'
																)); ?>
			</td>
		<?php endif; ?>
	</tr>
	<?php if(!empty($other_people_pyts['total'])):?>
		<tr>
			<td>PAYMENTS CREATED BY OTHERS</td>
			<td><?php echo  $number->format($other_people_pyts['total']+0,$formatting); ?></td>
		</tr>
	<?php endif; ?>
</table>


<div id="report_details">
<br />
<br />
<!-- synthese paiements -->
<?php if($total_factures['resto']>0):?>
<div id="synthese_pyts" class="journal_resume">
<?php echo $this->element('../paiements/synthese_pyts',array('synthesePyts'=>$synthesePyts,'hide_signature'=>true));?>
</div>
<?php endif;?>
<br>
<br>
	
<?php if(!$mensuelle) :?>
<span class="titre">Invoices</span>
<br>
<?php echo $this->Form->create('Vente',array('name'=>'checkbox','id'=>'Vente_ventes'));?>	
<table cellpadding="0" cellspacing="0">
	<tr>
			<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th>Customer</th>
			<th>Invoice N°</th>
			<th>State</th>
			<th>Original Amount</th>
			<th>Discount %</th>
			<th>Final Amount</th>
			<th>Left To Pay</th>
			<th>Currency</th>
			<?php if(!Configure::read('aser.magasin')):?>
				<th>Table N°</th>
				<th>Waiter</th>
			<?php endif;?>
			<th>Date</th>
			<th>Comments</th>
			<th>Operation Code</th>
		
	</tr>
		<?php
	$i = 0;
	$total_montants = 0;
	foreach ($factures as $facture):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php
				$options=array('label'=>'','type'=>'checkbox','value'=>$facture['Facture']['id']);
				if(false&&!in_array($facture['Facture']['etat'],array('en_cours','cloturer'))) 
					$options['disabled']='disabled';
				echo $this->Form->input('Id.'.$facture['Facture']['id'],$options); 
			?>
		
		</td>
		<td><?php echo  $facture['Tier']['name']; ?></td>
		<td>
			<?php echo $this->Html->link($facture['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $facture['Facture']['id'])); ?>
		</td>
			<td><?php echo  $facture['Facture']['etat']; ?></td>
			<td><?php echo  $number->format($facture['Facture']['original'],$formatting); ?></td>
			<td><?php echo  $number->format($facture['Facture']['reduction'],$formatting); ?></td>
			<td><?php echo  $number->format($facture['Facture']['montant'],$formatting); ?></td>
			<td><?php echo  $number->format($facture['Facture']['reste'],$formatting); ?></td>
			<td><?php echo  $facture['Facture']['monnaie']; ?></td>
			<?php if(!Configure::read('aser.magasin')):?>
				<td><?php echo  $facture['Facture']['table']; ?></td>
				<td><?php echo  $facture['Personnel']['name']; ?></td>
			<?php endif;?>
			<td name="date" value="<?php echo $facture['Facture']['date'];?>"><?php echo  $this->MugTime->toFrench($facture['Facture']['date']); ?></td>
			<td><?php echo  $facture['Facture']['observation']; ?></td>
			<td name="operation"><?php echo $facture['Facture']['operation']; ?></td>
	</tr>
<?php $total_montants+= $facture['Facture']['montant']; endforeach; ?>
<tr class="strong">
	<td colspan="6"></td>
	<td><?php echo $number->format($total_montants,$formatting); ?></td>
	<td colspan="7"></td>
</tr>
</table>
</form>
<span class="titre">Payments</span>
<br>
<table cellpadding="0" cellspacing="0" id="pytTab">
	<tr>	
			<th>Payment's Date</th>
			<th>Invoicing Date</th>
			<th>Invoice N°</th>
			<th>Invoice Type</th>
			<th>Amount</th>
			<th>Equivalent Amount</th>
			<th>Payment Mode</th>
			<th>Reference</th>
			<th>Created By</th>
	</tr>
		<?php
		foreach ($pyts as $pyt){
			echo $this->element('../paiements/add',array('paiement'=>$pyt,'facture'=>true));
		}
		
	 	?>
	
</table>
<?php if(!empty($other_people_pyts['pyts'])):?>
	<span class="titre">Payments Created by others</span>

	<table cellpadding="0" cellspacing="0" id="pytTab">
	<tr>	
			<th>Payment's Date</th>
			<th>Invoicing Date</th>
			<th>Invoice N°</th>
			<th>Invoice Type</th>
			<th>Amount</th>
			<th>Equivalent Amount</th>
			<th>Payment Mode</th>
			<th>Reference</th>
			<th>Created By</th>
	</tr>
		<?php
		foreach ($other_people_pyts['pyts'] as $pyt){
			echo $this->element('../paiements/add',array('paiement'=>$pyt,'facture'=>true));
		}
		
	 	?>
	
</table>
<?php endif; ?>
<span class="titre">Expenses</span>
<br>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Type of Expense</th>
			<th>Amount</th>
			<th>Description</th>
			<th>Date</th>
	</tr>
		<?php
	$i = 0;
	foreach ($retraits as $retrait):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $retrait['Caiss']['name']; ?></td>
			<td><?php echo  $number->format($retrait['Operation']['credit']); ?></td>
			<td><?php echo  $retrait['Operation']['libelle']; ?></td>
			<td><?php echo  $retrait['Operation']['date']; ?></td>
	</tr>
<?php endforeach; ?>
</table>

<span class="titre">Deposits</span>
<br>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Type of Deposit</th>
			<th>Amount</th>
			<th>Description</th>
			<th>Date</th>
	</tr>
		<?php
	$i = 0;
	foreach ($ajouts as $ajout):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $ajout['Caiss']['name']; ?></td>
			<td><?php echo  $number->format($ajout['Operation']['debit']); ?></td>
			<td><?php echo  $ajout['Operation']['libelle']; ?></td>
			<td><?php echo  $ajout['Operation']['date']; ?></td>
	</tr>
<?php endforeach; ?>
</table>
<?php endif;?>
<br />
<br />
<br />
</div>
 <?php if(!empty($journalInfo)):?>
<div class="bas_page">
	<div class="left">
		<div class="text">
		<?php
			echo 'Signature : '.ucfirst($journalInfo['Personnel']['name']).'<br/>';	
		?>
		
		</div>
	</div>
	<div class="right"><?php  
		echo 'Signature : Cashier Supervisor <br />';
	?>
	</div>
	<div style="clear:both"></div>
</div>
<?php endif;?>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick="print_documents(jQuery('#etat_journal').attr('closed'))" >Print</li>
		<li class="link"  onclick="recherche()" >Search Options</li>
		<?php if(in_array($session->read('Auth.Personnel.fonction_id'),array(2,4))):?>
			<li class="link"  id="cloturer" >Close the report</li>
		<?php endif;?>
		<?php 
		$fonctions=(Configure::read('aser.disable_transfer'))?array(3,5,8):array(2,3,5,8);
		if(in_array($session->read('Auth.Personnel.fonction_id'),$fonctions)):?>
			<li class="link"  onclick="transfer()" >Invoice Transfer</li>
		<?php endif;?>
		<?php if(Configure::read('aser.touchscreen')):?>
		<li><?php echo $this->Html->link('Point Of Sale', array('controller' => 'ventes', 'action' => 'touchscreen')); ?> </li>
		<?php else : ?>
			<li><?php echo $this->Html->link('Point Of Sale', array('controller' => 'ventes', 'action' => 'index')); ?> </li>
		<?php endif; ?>
		<li class="link"  onclick="jQuery('#synthese_pyts').slideToggle()" >Show/Hide the Payments Details</li>
		<li class="link"  onclick="jQuery('#report_details').slideToggle()" >Show/Hide the Report Details</li>
		<?php if(Configure::read('aser.aserb')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
			<li class="link"  onclick="copier_bills_dans_b(1)" >Save the invoices</li>
			<li class="link"  onclick="copier_bills_dans_b(0)" >Remove the invoices</li>
		<?php endif;?>
	</ul>
</div>
<!-- transfer boxe -->
<div id="trans_boxe" style="display:none" title="Invoice Transfer">
<div class="dialog">
	<div id="message_trans"></div>
	<?php echo $this->Form->create('Vente');?>
	<span class="left">
		<?php
			echo $this->Form->input('Vente.personnel_id',array('id'=>'caissier','label'=>'Sélectionné le caissier'));
		?>
	</span>
	<span class="right">
		<?php
		//	echo $this->Form->input('Vente.paiements',array('id'=>'paiementsBox','options'=>array('no'=>'no','yes'=>'yes'),'label'=>'Inclure Paiements'));
			echo $this->Form->input('Vente.journal_id',array('id'=>'journalId','type'=>'hidden','value'=>$journalInfo['Journal']['id']));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
