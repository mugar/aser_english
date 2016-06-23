<div class="factures index">
	<h2><?php __('Factures');?></h2>
	<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('tier_id',array('selected'=>0,'options'=>$tiers1,'label'=>'Nom Du Client'));
			echo $this->Form->input('Tier.compagnie');
			echo $this->Form->input('Facture.etat',array('options'=>array(''=>'',
																		'en_cours'=>'en_cours',	
																		'cloturer'=>'cloturer',
																		'payee'=>'payee',
																		'credit'=>'credit',
																		'avance'=>'avance',
																		'bonus'=>'bonus',
																		'annulee'=>'annulee',
																		'non_nul'=>'Non annulee'
																		)
																	));
			echo $this->Form->input('monnaie',array('options'=>$monnaies1));
			echo $this->Form->input('operation',array('options'=>$models));
		?>
	</span>
	<span class="right">
		<?php
			
			echo $this->Form->input('id',array('label'=>'Facture Id','type'=>'text'));
			echo $this->Form->input('numero',array('label'=>'Facture N°'));
			echo $this->Form->input('linked',array('label'=>__('Factures liées',true)));
			echo $this->Form->input('Facture.montant');
			echo $this->Form->input('date1',array('label'=>'Date Début','type'=>'text'));				
			echo $this->Form->input('date2',array('label'=>'Date Fin','type'=>'text'));	
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>

	<?php echo $this->Form->create('Facture',array('name'=>'checkbox','id'=>'Facture_factures'));?>	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('tier_id');?></th>
			<th><?php echo $this->Paginator->sort('numero');?></th>
			<th><?php echo $this->Paginator->sort('operation');?></th>
			<th><?php echo $this->Paginator->sort('montant');?></th>
			<th><?php echo $this->Paginator->sort('Reste à Payer','reste');?></th>
			<th><?php echo $this->Paginator->sort('tva');?></th>
			<th><?php echo $this->Paginator->sort('monnaie');?></th>
			<th><?php echo $this->Paginator->sort('etat');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('N° séparé','linked');?></th>
			<?php if(Configure::read('aser.aserb')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
			<th><?php echo $this->Paginator->sort('inclure');?></th>
			<?php endif;?>
		</tr>
	<?php
	foreach ($factures as $facture):
	
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$facture['Facture']['id'],array('label'=>'','type'=>'checkbox','value'=>$facture['Facture']['id'])); ?>
		</td>
		<td><?php echo $facture['Facture']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($facture['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $facture['Tier']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($facture['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $facture['Facture']['id'])); ?>
		</td>
		<td name="operation"><?php echo $facture['Facture']['operation']; ?></td>
		<td><?php echo $number->format($facture['Facture']['montant'],$formatting); ?>&nbsp;</td>
		<td><?php echo $number->format($facture['Facture']['reste'],$formatting); ?>&nbsp;</td>
		<td><?php echo $number->format($facture['Facture']['tva'],$formatting); ?>&nbsp;</td>
		<td><?php echo $facture['Facture']['monnaie']; ?>&nbsp;</td>
		<td name="etat"><?php echo $facture['Facture']['etat']; ?></td>
		<td name="date" value="<?php echo $facture['Facture']['date'];?>"><?php echo $this->MugTime->toFrench($facture['Facture']['date']); ?></td>
		<td><?php echo $facture['Facture']['linked']; ?>&nbsp;</td>
		<?php if(Configure::read('aser.aserb')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
			<td name="inclure"><?php echo $facture['Facture']['inclure']; ?>&nbsp;</td>
		<?php endif;?>
	</tr>
<?php  endforeach; ?>
	</table>
</form>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% de %pages%, affichage de %current% enregistrements sur %count% au total, à partir du numéro %start%, jusqu\'au numéro %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('précédent', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('suivant', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div id="separator" class="back" title="Cacher Le Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick="actions('checkbox','view')" >Afficher Les Détails</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link(__('Edition de Rapport', true), array('controller' => 'factures', 'action' => 'rapport')); ?> </li>
		<li class="link"  onclick="actions('checkbox','trace')" >Afficher l'Historique</li>
		<?php if(in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
		<li class="link"  onclick="bonus()" >Changer en bonus</li>
		<?php endif;?>
		<?php if(Configure::read('aser.aserb')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
			<li class="link"  onclick="copier_bills_dans_b(1)" >Envoyer les factures </li>
			<li class="link"  onclick="copier_bills_dans_b(0)" >Enlever les factures</li>
			<li class="link"  onclick="aserb()" >Envoyer un montant de factures</li>
			<li class="link"  onclick="actions('checkbox','cancel_aserb_bill')" >Effacer la copie</li>
		<?php endif;?>
	</ul>
</div>
<!-- stock select for historique -->
<div id="aserb_boxe" style="display:none" title="Copier les factures dans ASER B">
<div class="dialog">
	<span class="left">
		<?php
			echo $this->Form->input('mois',array('type'=>'date','dateFormat'=>'M'));
			echo $this->Form->input('annee',array('type'=>'date','dateFormat'=>'Y'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('montant_desire',array('id'=>'montant_desire','type'=>'text','value'=>0));
			echo $this->Form->input('action',array('id'=>'action','options'=>array('approximer'=>'approximer le montant',
																				'copier'=>'copier le montant'),
																	'value'=>0,'Copier le montant trouvé'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>