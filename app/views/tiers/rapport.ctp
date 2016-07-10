<div id='view'>
<div class="document">
<h3>Liste des Customers</h3>
<?php if(!empty($tiers)){
	echo '<h4> (Total : '.count($tiers).' )</h4>';
}
?>
<br/>
<table cellpadding="0" cellspacing="0">
	<tr>
		<?php if(Configure::read('aser.accounting')):?>
			<th>N° du compte</th>
		<?php endif; ?>
			<th>name</th>
			<th>type</th>
			<th>compagnie</th>
			<th>tel</th>
			<th>email</th>
		<?php if(Configure::read('aser.hotel')):?>
			<th>nationalite</th>
			<th>passport</th>
		<?php endif; ?>
			<th>Réducton (%)</th>
			<th>actif</th>
		</tr>
	<?php
	
	foreach ($tiers as $tier):
	?>
	<tr>
		<?php if(Configure::read('aser.accounting')):?>
		<td><?php echo $tier['Tier']['numero']; ?>&nbsp;</td>
		<?php endif;?>
		<td><?php echo $tier['Tier']['name']; ?>&nbsp;</td>
		<td><?php echo $tier['Tier']['type']; ?>&nbsp;</td>
		<td><?php echo $tier['Tier']['compagnie']; ?>&nbsp;</td>
		<td><?php echo $tier['Tier']['telephone']; ?>&nbsp;</td>
		<td><?php echo $tier['Tier']['email']; ?>&nbsp;</td>
		<?php if(Configure::read('aser.hotel')):?>
		<td><?php echo $tier['Tier']['nationalite']; ?>&nbsp;</td>
		<td><?php echo $tier['Tier']['passport']; ?>&nbsp;</td>
		<?php endif;?>
		<td><?php echo $tier['Tier']['reduction']; ?>&nbsp;</td>
		<td><?php echo $tier['Tier']['actif']; ?>&nbsp;</td>
	</tr>
<?php  endforeach; ?>
	</table>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Lister Tiers', array('controller' => 'tiers', 'action' => 'index')); ?> </li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Tier',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('name',array('id'=>'nom','value'=>'toutes'));
			echo $this->Form->input('type',array('type'=>'hidden','value'=>'client'));
			echo $this->Form->input('compagnie',array('value'=>'toutes'));
			echo $this->Form->input('adresse',array('value'=>'toutes'));
			echo $this->Form->input('passport',array('value'=>'toutes'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('tel',array('value'=>'toutes'));
			echo $this->Form->input('email',array('value'=>'toutes'));
			echo $this->Form->input('nationalite',array('value'=>'toutes'));
			echo $this->Form->input('reduction',array('value'=>'toutes'));
			echo $this->Form->input('actif',array('options'=>array('toutes'=>'toutes',
																	'yes'=>'yes',
																	'no'=>'no'
																	)
												)
									);

			echo $this->Form->input('export',array('label'=>'Exporter vers xls','type'=>'checkbox'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
