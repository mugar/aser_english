<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Vente',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('Facture.date',array('type'=>'text'));
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
		echo '<span id="dateId">'.__('Date').' : '.$this->MugTime->toFrench($date).'</span><br/>';
		?>
		 <br/>
	</div>
	<div style="clear:both"></div>
</div>
</br>	
<? foreach($monnaies as $key=>$monnaie):?>
<? if(empty($monnaie['gpeCptableToShow'])):?>
<h3><? echo __('Pas de Credits');?></h3>
<? elseif($monnaie['total']>0): ?>
<h3><? echo __('Détail des crédits journaliers du restaurant, Spa et divers');?></h3>
<br />
<h4> <? echo '('.__('MONNAIE : ',true).$key.')';?></h4>
<br />
<table cellpadding="0" cellspacing="0" >
	<tr>
		<th><? echo __('Nom du Customer'); ?></th>
		<?php foreach($groupeComptables as $gpeCptableId=>$groupeComptable)
				if(in_array($gpeCptableId,$monnaie['gpeCptableToShow']))
					echo '<th>'.$groupeComptable.'</th>';
		?>
		<th><? echo __('T.P');?></th>
	</tr>
	<?php foreach($tiers as $tierId=>$tier):?>
		<? if(in_array($tierId,$monnaie['clientsToShow'])):?>
		<tr>
			<td><? echo $tier; ?></td>
			<?
			 foreach($groupeComptables as $gpeCptableId=>$groupeComptable)
				if(in_array($gpeCptableId,$monnaie['gpeCptableToShow']))
					echo '<td>'.$monnaie['data'][$tierId.'_'.$gpeCptableId].'</td>';
			?>
			<td><? echo $monnaie['data'][$tierId.'_total']; ?></td>
		</tr>
		<? endif;?>
	<? endforeach;?>
	<? if($monnaie['tva']>0):?>
		<tr class="strong">
			<td><? echo __('T.P WITHOUT TVA');?></td>
			<?php foreach($groupeComptables as $gpeCptableId=>$groupeComptable)
					if(in_array($gpeCptableId,$monnaie['gpeCptableToShow']))
						echo '<td></td>';
			?>
			<td><? echo $monnaie['total']-$monnaie['tva']; ?></td>
		</tr>
		<tr class="strong">
			<td><? echo __('TVA');?></td>
			<?php foreach($groupeComptables as $gpeCptableId=>$groupeComptable)
					if(in_array($gpeCptableId,$monnaie['gpeCptableToShow']))
						echo '<td></td>';
			?>
			<td><? echo $monnaie['tva']; ?></td>
		</tr>
	<? endif;?>	
	<tr class="strong">
		<td><? echo __('T.P');echo __('.TVAC');?></td>
		<?php foreach($groupeComptables as $gpeCptableId=>$groupeComptable)
				if(in_array($gpeCptableId,$monnaie['gpeCptableToShow']))
					echo '<td></td>';
		?>
		<td><? echo $monnaie['total']; ?></td>
	</tr>
</table>
<? endif;?>
<br />
<br/>
<? endforeach;?>
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
	