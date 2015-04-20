<h3 align=center ><?php __('Rapport Trésorerie');?> <span style="font-size:13px !important; color:#367889; cursor:pointer;" onclick="jQuery('#filter').toggle();">(Options de recherche)</span></h3>
 
<fieldset class="recherche">
	<span style="font-size:15px !important; color:#367889;">Période entre le <?php echo $this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2) ?></span>
	<br>
	<br>
<div id="filter" style="display:none;" class="recherche">
<fieldset>
<?php echo $this->Form->create('Caiss');?>
<?php
		echo $this->Form->input('Caiss.id',array('selected'=>0,'options'=>$options,'label'=>'Caisse'));
		echo $this->Form->input('date1',array('label'=>'Choisissez une date début',
												'type'=>'date',
												'format'=>'d-m-y')
											);									
		echo $this->Form->input('date2',array('label'=>'et une date fin pour le rapport',
												'type'=>'date',
												'format'=>'d-m-y')
											);
		echo $this->Form->end(__('Envoyer', true));
		?>
</fieldset>
		</div>
		<?php
	$i = 0;
	if(!empty($datas)):
	foreach ($datas as $data):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
<table class="tableau" cellpadding="0" cellspacing="0">
	<thead onclick="Element.toggle($('body<?php echo $i; ?>'))" style="cursor:pointer; font-size=10px !important; " >
			<th>Caisse : <?php echo  $data['Caiss']['name']; ?></th>
			<th>Reste  : <?php echo  $data['Caiss']['total']; ?></th>
		
	</thead>
	<tbody id="body<?php echo $i; ?>">
		<tr>
				<td>Ajouts :<?php echo  $data['Ajout'][0]['Ajout']['total']+0; ?></td>
				<td>Retraits :<?php echo  $data['Retrait'][0]['Retrait']['total']+0; ?></td>
		</tr>
		<tr>
				<td>Sortis :<?php echo  $data['Sorti'][0]['Sorti']['total']+0; ?></td>
				<td>Entrees :<?php echo  $data['Entree'][0]['Entree']['montant']+0; ?></td>
		</tr>
		<tr>
				<td>Creances :<?php echo  $data['Creance'][0]['Creance']['montant_paye']+0; ?></td>
				<td>Dettes :<?php echo  $data['Dette'][0]['Dette']['montant_paye']+0; ?></td>
		</tr>
		<?php if(Configure::read('aser.transport')) :?>
		<tr>
				<td>Transports :<?php echo  $data['Transport'][0]['Transport']['avance']+0; ?></td>
				<td>Entretiens :<?php echo  $data['Entretien'][0]['Entretien']['montant']+0; ?></td>
		</tr>
		<?php endif;?>
		<tr>
				<td>&nbsp;</td>
				<td>Salaires :<?php echo  $data['Salaire'][0]['Salaire']['avance']+0; ?></td>
		</tr>
		<tr>
				<td>Marge net</td>
				<td><?php echo  $data['marge']+0; ?></td>
		</tr>
	</tbody>
</table>
<?php endforeach;
		endif;
 ?>

</fieldset>
