<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Vente',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('Facture.date1',array('type'=>'text','label'=>__('Date Début',true)));
			echo $this->Form->input('Facture.date2',array('type'=>'text','label'=>__('Date Fin',true)));
		?>
	</span>
	
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
	
<div id="entete">
	<div class="right">
	<?php  
		echo __('Date Début').' : '.$this->MugTime->toFrench($date1).'<br/>';
		echo __('Date Fin').' : '.$this->MugTime->toFrench($date2).'<br/>';
		?>
		 <br/>
	</div>
	<div style="clear:both"></div>
</div>
</br>	
<? if(false):?>
<h3><?php echo __('Pas d\'activitées pour le '); echo $this->MugTime->toFrench($date);?></h3>
<? else: ?>
<h3><?php echo  __('Synthèse des ventes journalières du service restaurant, Spa et divers');?></h3>
<br />
<br />

<table cellpadding="0" cellspacing="0" >
	<tr class="border">
		<th rowspan="2"><? echo __('Nature des services');?></th>
		<?php foreach($facturationCurrencys as $monnaie):?>
				<th colspan="2"><? echo $monnaie;?></th>
		<? endforeach;?>
	</tr>
	<tr class="border">
		
		<?php foreach($facturationCurrencys as $monnaie):?>
				<th><? echo __('VENTES PAID AMOUNTS');?></th>
				<th><? echo __('VENTES CREDITS');?></th>
		<? endforeach;?>
		
	</tr>
	<? foreach($gpeCptables as $gpeCptable):?>
		<? if(($gpeCptable['credit']>0)||(isset($gpeCptable['detail']))):?>
		<tr>
			<td><? echo $gpeCptable['GroupeComptable']['name'];?></td>
			<?php foreach($facturationCurrencys as $monnaie):?>
				<td><? if(isset($gpeCptable['payee'][$monnaie])) echo $gpeCptable['payee'][$monnaie];?></td>
				<td><? if(isset($gpeCptable['credit'][$monnaie])) echo $gpeCptable['credit'][$monnaie];?></td>
			<? endforeach;?>
		</tr>
		<? endif;?>
	<? endforeach;?>
	<tr class="strong">
			<td>TOTAL</td>
			<?php foreach($facturationCurrencys as $monnaie):?>
				<td><? echo $total['payee'][$monnaie];?></td>
				<td><? echo $total['credit'][$monnaie];?></td>
			<? endforeach;?>
		</tr>
</table>

<? endif;?>
<br />
<br />
<? echo $this->element('signature');?>
</div>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Liste des Factures', array('controller' => 'factures', 'action' => 'index')); ?> </li>
	</ul>
</div>
	