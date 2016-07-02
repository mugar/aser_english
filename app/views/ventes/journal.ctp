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
<h3>Rapport Caisse <?php if(!empty($journalInfo)) echo ' de '.ucfirst($journalInfo['Personnel']['name']).'';?></h3>
<h4><?php if(!empty($journalInfo)) {
			echo '(';
			echo 'Du '.$this->MugTime->toFrench($journalInfo['Journal']['date']);
			echo ' à '.date('H:i:s').', ';
			echo 'N° : '.$journalInfo['Journal']['numero'];
			if($journalInfo['Journal']['closed']) 
				echo ' State : <span id="etat_journal" closed="1">clôturée</span>';
			else
				echo ' State : <span id="etat_journal" closed="0">Non clôturée</span>';
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
			<th align="center" colspan="2">RESUME</th>
	</tr>
	<tr>
		<td>TOTAL VENTES</td>
		<td><?php echo  $number->format($total_factures['resto']+0,$formatting); ?></td>
	</tr>
	<tr>
		<td>TOTAL CASH</td>
		<td><?php echo  $number->format($total_cash['resto']+0,$formatting); ?></td>
	</tr>
	<tr>
		<td>TOTAL CREDITS</td>
		<td><?php echo  $number->format($total_credits['resto']+0,$formatting); ?></td>
	</tr>
	<?php if(Configure::read('aser.bonus')):?>
	<tr>
		<td>TOTAL BONUS</td>
		<td><?php echo  $number->format($bonus+0,$formatting); ?></td>
	</tr>
	<?php endif;?>
	<tr>
		<td>TOTAL PAIEMENTS</td>
		<td><?php echo  $number->format($total_pyts['resto']+0,$formatting); ?></td>
	</tr>
	<tr>
		<td>TOTAL DEPENSES</td>
		<td><?php echo  $number->format($total_depenses+0,$formatting); ?></td>
	</tr>
	
	<tr>
		<td>TOTAL AJOUTS</td>
		<td><?php echo  $number->format($total_ajouts+0,$formatting); ?></td>
	</tr>
	<tr>
		<td>TOTAL VERSEMENT</td>
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
			<td>PAIEMENTS CREES PAR D'AUTRES</td>
			<td><?php echo  $number->format($other_people_pyts['total']+0,$formatting); ?></td>
		</tr>
	<?php endif; ?>
</table>

<div id="journal_details">
<br />
<br />
<br />
<?php if(!empty($journals)): ?>
	<span class="titre">Rapports</span>
<br>
<table cellpadding="0" cellspacing="0" id="pytTab">
	<tr>	
			<th>Numero</th>
			<th>State</th>
	</tr>
	<?php
		foreach ($journals as $journal):
	?>
	<tr>
		<td><?php echo  $journal['Journal']['numero']; ?></td>
		<td><?php if($journal['Journal']['closed']) echo 'Clôturée'; else echo 'Non clôturée' ; ?></td>
	</tr>
<?php endforeach; ?>
	
</table>
<?php endif; ?>
<?php if(!$mensuelle) :?>
<span class="titre">Factures</span>
<br>
<?php echo $this->Form->create('Vente',array('name'=>'checkbox','id'=>'Vente_ventes'));?>	
<table cellpadding="0" cellspacing="0">
	<tr>
			<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th>Customer</th>
			<th>Invoice N°</th>
			<th>State Facture</th>
			<th>Montant Original</th>
			<th>Reduction %</th>
			<th>Montant</th>
			<th>Reste</th>
			<th>Currency</th>
			<?php if(!Configure::read('aser.magasin')):?>
				<th>Table</th>
				<th>Serveur</th>
			<?php endif;?>
			<th>Date</th>
			<th>Observation</th>
			<th>Vente</th>
		
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
<span class="titre">Paiements</span>
<br>
<table cellpadding="0" cellspacing="0" id="pytTab">
	<tr>	
			<th>Date de Paiement</th>
			<th>Date de Facturation</th>
			<th>Invoice N°</th>
			<th>Type De Facture</th>
			<th>Montant</th>
			<th>Montant Equivalent</th>
			<th>Payment Mode</th>
			<th>Réference</th>
			<th>Personnel</th>
	</tr>
		<?php
		foreach ($pyts as $pyt){
			echo $this->element('../paiements/add',array('paiement'=>$pyt,'facture'=>true));
		}
		
	 	?>
	
</table>
<?php if(!empty($other_people_pyts['pyts'])):?>
	<span class="titre">Paiements Créés par d'autres</span>

	<table cellpadding="0" cellspacing="0" id="pytTab">
	<tr>	
			<th>Date de Paiement</th>
			<th>Date de Facturation</th>
			<th>Invoice N°</th>
			<th>Type De Facture</th>
			<th>Montant</th>
			<th>Montant Equivalent</th>
			<th>Payment Mode</th>
			<th>Réference</th>
			<th>Personnel</th>
	</tr>
		<?php
		foreach ($other_people_pyts['pyts'] as $pyt){
			echo $this->element('../paiements/add',array('paiement'=>$pyt,'facture'=>true));
		}
		
	 	?>
	
</table>
<?php endif; ?>
<span class="titre">Dépenses</span>
<br>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Libéllé</th>
			<th>Montant</th>
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

<span class="titre">Ajouts</span>
<br>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Libellé</th>
			<th>Montant</th>
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
		echo 'Signature : Caissière Principale <br />';
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
			<li class="link"  id="cloturer" >Clôturer le rapport</li>
		<?php endif;?>
		<?php 
		$fonctions=(Configure::read('aser.disable_transfer'))?array(3,5,8):array(2,3,5,8);
		if(in_array($session->read('Auth.Personnel.fonction_id'),$fonctions)):?>
			<li class="link"  onclick="transfer()" >Transfer des factures</li>
		<?php endif;?>
		<?php if(Configure::read('aser.touchscreen')):?>
		<li><?php echo $this->Html->link('Interface De Vente', array('controller' => 'ventes', 'action' => 'touchscreen')); ?> </li>
		<?php else : ?>
			<li><?php echo $this->Html->link('Interface De Vente', array('controller' => 'ventes', 'action' => 'index')); ?> </li>
		<?php endif; ?>
		<li class="link"  onclick="jQuery('#journal_details').slideToggle()" >Show/Hide les Détails</li>
		<?php if(Configure::read('aser.aserb')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
			<li class="link"  onclick="copier_bills_dans_b(1)" >Save les factures </li>
			<li class="link"  onclick="copier_bills_dans_b(0)" >Enlever les factures</li>
		<?php endif;?>
	</ul>
</div>
<!-- transfer boxe -->
<div id="trans_boxe" style="display:none" title="Transfer de Facture">
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
		//	echo $this->Form->input('Vente.paiements',array('id'=>'paiementsBox','options'=>array('non'=>'non','oui'=>'oui'),'label'=>'Inclure Paiements'));
			echo $this->Form->input('Vente.journal_id',array('id'=>'journalId','type'=>'hidden','value'=>$journalInfo['Journal']['id']));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
