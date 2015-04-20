<div class="etages index">
	<h2><?php __('Etages');?></h2>
	<?php echo $this->Form->create('Etage',array('name'=>'checkbox','id'=>'Etage_etages'));?>	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
		</tr>
	<?php
	$i = 0;
	$j = 0;
	foreach ($etages as $etage):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Form->input('Id.'.$j.'',array('label'=>'','type'=>'checkbox','value'=>$etage['Etage']['id'])); ?>
		</td>
		<td><?php echo $etage['Etage']['name']; ?>&nbsp;</td>
	</tr>
<?php  $j++; endforeach; ?>
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
<div id="separator" class="back" title="Cacher Le Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Etage', true)), array('action' => 'add')); ?></li>
		<li class= "link" onclick = "actions('checkbox','edit')" >Modifier</li>
		<li class="link"  onclick="actions('checkbox','view')" >Afficher</li>
		<li class="link" onclick="actions('checkbox','delete')" >Effacer</li>
		
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Chambres', true)), array('controller' => 'chambres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Chambre', true)), array('controller' => 'chambres', 'action' => 'add')); ?> </li>
	</ul>
</div>
