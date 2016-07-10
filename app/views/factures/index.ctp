<div class="factures index">
	<h2><?php __('Invoices');?></h2>
	<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('tier_id',array('selected'=>0,'options'=>$tiers1,'label'=>'Customer'));
			echo $this->Form->input('Tier.compagnie',array('label'=>'Company'));
			echo $this->Form->input('Facture.etat',array('label'=>'State','options'=>array(''=>'',
																		'in_progress'=>'in_progress',	
																		'printed'=>'printed',
																		'paid'=>'paid',
																		'credit'=>'credit',
																		'half_paid'=>'half_paid',
																		'bonus'=>'bonus',
																		'canceled'=>'canceled',
																		'not_canceled'=>'Not Canceled'
																		)
																	));
			echo $this->Form->input('monnaie',array('options'=>$monnaies1,'label'=>'Currency'));
			echo $this->Form->input('operation',array('options'=>$models));
		?>
	</span>
	<span class="right">
		<?php
			
			echo $this->Form->input('id',array('label'=>'Facture Id','type'=>'text'));
			echo $this->Form->input('numero',array('label'=>'Invoice N°'));
			echo $this->Form->input('linked',array('label'=>__('Linked bills',true)));
			echo $this->Form->input('Facture.montant',array('label'=>'Amount'));
			echo $this->Form->input('date1',array('label'=>'Start Date','type'=>'text'));				
			echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));	
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
			<th><?php echo $this->Paginator->sort('Customer','tier_id');?></th>
			<th><?php echo $this->Paginator->sort('Invoice N°','numero');?></th>
			<th><?php echo $this->Paginator->sort('operation');?></th>
			<th><?php echo $this->Paginator->sort('Amount','montant');?></th>
			<th><?php echo $this->Paginator->sort('Left To Pay','reste');?></th>
			<th><?php echo $this->Paginator->sort('VAT','tva');?></th>
			<th><?php echo $this->Paginator->sort('Currency','monnaie');?></th>
			<th><?php echo $this->Paginator->sort('State','etat');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('Split Invoice N°','linked');?></th>
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
	'format' => __('Page %page% of %pages%, showing  %current% records out of %count%, from %start%, to %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div id="separator" class="back" title="Hide the Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick="actions('checkbox','view')" >SHow the details</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link(__('Edition de Rapport', true), array('controller' => 'factures', 'action' => 'rapport')); ?> </li>
		<li class="link"  onclick="actions('checkbox','trace')" >Show the log</li>
		<?php if(in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
		<li class="link"  onclick="bonus()" >Change state to bonus</li>
		<?php endif;?>
		<?php if(Configure::read('aser.aserb')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
			<li class="link"  onclick="copier_bills_dans_b(1)" >Save les factures </li>
			<li class="link"  onclick="copier_bills_dans_b(0)" >Enlever les factures</li>
			<li class="link"  onclick="aserb()" >Save un montant de factures</li>
			<li class="link"  onclick="actions('checkbox','cancel_aserb_bill')" >Delete la copie</li>
		<?php endif;?>
	</ul>
</div>
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