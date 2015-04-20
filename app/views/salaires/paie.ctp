
<div id="paie" style="display:none" title="<? echo __('Executer la paie');?>">
<div class="dialog">
	<?php echo $this->Form->create('Salaire',array('id'=>'paie_form','action'=>'executerLaPaie'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date',array('label'=>__('Date de la paie',true),'value'=>date('Y-m-d')));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('mois',array('type'=>'hidden','value'=>date('m')));
			echo $this->Form->input('annee',array('type'=>'hidden','value'=>date('Y')));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<h3><? echo 'LISTE DE PAIE DE '.strtoupper($this->MugTime->giveMonth(date('m'))).' '.date('Y');?></h3>
<br />
<br />

<?php echo $this->Form->create('Salaire',array('name'=>'checkbox','action'=>'executerLaPaie'));?>
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
		<th><? echo __('EMPLOYE');?></th>
		<th><? echo __('S.B');?></th>
		<th><? echo __('ABSC');?></th>
		<th><? echo __('S.B REEL');?></th>
		<th><? echo __('H.S');?></th>
		<th><? echo __('PRIMES');?></th>
		<th><? echo __('ALLOC');?></th>
		<th><? echo __('I.D');?></th>
		<th><? echo __('I.L');?></th>
		<th><? echo __('S.M');?></th>
		<th><? echo __('BRUT');?></th>
		<th><? echo __('BASE INSS');?></th>
		<th><? echo __('QP SAL');?></th>
		<th><? echo __('QP PAT');?></th>
		<th><? echo __('RISK');?></th>
		<th><? echo __('TOTAL INSS');?></th>
		<th><? echo __('ASSUR');?></th>
		<th><? echo __('NET IMP');?></th>
		<th><? echo __('IPR');?></th>
		<th><? echo __('AVANCE');?></th>
		<th><? echo __('COTIS');?></th>
		<th><? echo __('NET A PAYER');?></th>
	</tr>
		<?php
		$formatting=array('places'=>0,'before'=>'','escape'=>false,'decimal'=>'.','thousands'=>'-');
	foreach ($salaires as $salaire):
	?>
	<tr>
		<td><?php echo $this->Form->input('Id.'.$salaire['Salaire']['id'],array('label'=>'','type'=>'checkbox','value'=>$salaire['Salaire']['id'])); ?></td>
		<td><?php echo  $salaire['Personnel']['name']; ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['SB'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['ABSC'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['SBR'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['HS'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['PRIME'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['ALLOC'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['INDD'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['INDL'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['SM'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['BRUT'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['BINSS'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['QPSAL'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['QPENT'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['RISK'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['INSS'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['ASSUR'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['BIMP'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['IPR'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['AVANCE'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['COTIS'],$formatting); ?></td>
		<td><?php echo  $number->format($salaire['Salaire']['SNET'],$formatting); ?></td>
	</tr>
<?php endforeach; ?>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li class="link"  onclick = "executerLaPaie()" ><? echo __('Exécuter la paie');?></li>
		<li><?php echo $this->Html->link('Lister Salaires', array('controller' => 'salaires', 'action' => 'index')); ?> </li>
	</ul>
</div>

