<?php unset($modePaiements['transfer']);?>
<span class="titre"> <?php echo 'Payments Summary';?></span>
<br />
<br />
<table cellpadding="0" cellspacing="0">
	<tr>
		<th align="center"><? echo _('Modes de Paiement');?></th>
		<?php foreach($monnaies as $monnaie):?>
			<th align="center"><?php echo __('Montant en ').$monnaie;?></th>
		<?php endforeach;?>
	</tr>
	<?php foreach($modePaiements as $mode=>$modePaiement):?>
		<tr>
			<td><?php echo $modePaiement;?></td>
			<?php foreach($monnaies as $monnaie):?>
				<td><?php echo $synthesePyts['detail'][$monnaie.'_'.$mode];?></td>
			<?php endforeach;?>
		</tr>
	<?php endforeach;?>
	<tr class="strong">
		<td>TOTAL</td>
		<?php foreach($monnaies as $monnaie):?>
			<td><?php echo $synthesePyts['total'][$monnaie];?></th>
		<?php endforeach;?>
	</tr>
</table>

<? if(!isset($hide_signature)) echo $this->element('signature');?>
