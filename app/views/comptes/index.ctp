<div class="comptes index">
	<h2><?php __('Comptes');?></h2>
	<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Numéro</th>
		<th>Intitulé des Comptes</th>	
	<!--<th>Tier ou Individu</th>	-->
		<th>Type</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Compte',array('action'=>'add'));?>
		
		<td><?php echo $this->Form->input('numero',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('name',array('label'=>''));?></td>
	<!--	<td><?php echo $this->Form->input('tier_id',array('label'=>'','selected'=>0));?></td>-->
		<td><?php echo $this->Form->input('type',array('label'=>'','options'=>array('actif'=>'actif','passif'=>'passif')));?></td>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Compte',array('name'=>'checkbox','id'=>'Compte_comptes'));?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('numero');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('actif');?></th>
		</tr>
	<?php
	
	foreach ($comptes as $compte):
		
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$compte['Compte']['id'],array('label'=>'','type'=>'checkbox','value'=>$compte['Compte']['id'])); ?>
		</td>
		<td><?php echo $compte['Compte']['numero']; ?>&nbsp;</td>
		<td><?php echo $compte['Compte']['name']; ?>&nbsp;</td>
		<td><?php echo $compte['Compte']['type']; ?>&nbsp;</td>
		<td><?php echo $compte['Compte']['actif']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
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
		<li class="link" onclick="actions('checkbox','edit')" >Edit</li>
		<li class="link" onclick="actions('checkbox','view')" >Afficher l'Historique</li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Compte Operations', true)), array('controller' => 'compte_operations', 'action' => 'index')); ?> </li>
	</ul>
</div>
