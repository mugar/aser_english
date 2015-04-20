<div class="paies index">
	<h2><?php __('Paies');?></h2>
	<?php echo $this->Form->create('Paie',array('name'=>'checkbox','id'=>'Paie_paies'));?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('salaire_id');?></th>
			<th><?php echo $this->Paginator->sort('ILA');?></th>
			<th><?php echo $this->Paginator->sort('INDD');?></th>
			<th><?php echo $this->Paginator->sort('RBA');?></th>
			<th><?php echo $this->Paginator->sort('INSS');?></th>
			<th><?php echo $this->Paginator->sort('IPR');?></th>
			<th><?php echo $this->Paginator->sort('SNET');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('mois');?></th>
			<th><?php echo $this->Paginator->sort('annee');?></th>
		</tr>
	<?php
	
	foreach ($paies as $paie):
		
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$paie['Paie']['id'],array('label'=>'','type'=>'checkbox','value'=>$paie['Paie']['id'])); ?>
		</td>
		<td><?php echo $paie['Paie']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($paie['Salaire']['id'], array('controller' => 'salaires', 'action' => 'view', $paie['Salaire']['id'])); ?>
		</td>
		<td><?php echo $paie['Paie']['ILA']; ?>&nbsp;</td>
		<td><?php echo $paie['Paie']['INDD']; ?>&nbsp;</td>
		<td><?php echo $paie['Paie']['RBA']; ?>&nbsp;</td>
		<td><?php echo $paie['Paie']['INSS']; ?>&nbsp;</td>
		<td><?php echo $paie['Paie']['IPR']; ?>&nbsp;</td>
		<td><?php echo $paie['Paie']['SNET']; ?>&nbsp;</td>
		<td><?php echo $paie['Paie']['date']; ?>&nbsp;</td>
		<td><?php echo $paie['Paie']['mois']; ?>&nbsp;</td>
		<td><?php echo $paie['Paie']['annee']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
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
<div id="separator" class="back" title="Etendre" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Paie', true)), array('action' => 'add')); ?></li>
		<li class="link" onclick="actions('checkbox','edit')" >Modifier</li>
		<li class="link" onclick="actions('checkbox','view')" >Afficher</li>
		<li class="link" onclick="actions('checkbox','delete')" >Effacer</li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Salaires', true)), array('controller' => 'salaires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Salaire', true)), array('controller' => 'salaires', 'action' => 'add')); ?> </li>
	</ul>
</div>
