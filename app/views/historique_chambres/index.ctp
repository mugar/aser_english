<div class="historiqueChambres index">
	<h2><?php __('Historique des  Chambres');?></h2>
	<?php echo $this->Form->create('HistoriqueChambre',array('name'=>'checkbox','id'=>'HistoriqueChambre_historiqueChambres'));?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
			<th><?php echo $this->Paginator->sort('chambres');?></th>
			<th><?php echo $this->Paginator->sort('etat');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('heure');?></th>
		</tr>
	<?php
	
	foreach ($historiqueChambres as $historiqueChambre):
		
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$historiqueChambre['HistoriqueChambre']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$historiqueChambre['HistoriqueChambre']['id'])); ?>
		</td>
		<td><?php echo $historiqueChambre['HistoriqueChambre']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($historiqueChambre['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $historiqueChambre['Personnel']['id'])); ?>
		</td>
		<td><?php echo $historiqueChambre['HistoriqueChambre']['chambres']; ?>&nbsp;</td>
		<td><?php echo $historiqueChambre['HistoriqueChambre']['etat']; ?>&nbsp;</td>
		<td><?php echo $historiqueChambre['HistoriqueChambre']['date']; ?>&nbsp;</td>
		<td><?php echo $historiqueChambre['HistoriqueChambre']['heure']; ?>&nbsp;</td>
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
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Chambres', true)), array('controller' => 'chambres', 'action' => 'index')); ?> </li>
	</ul>
</div>
