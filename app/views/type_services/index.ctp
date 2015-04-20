<div class="typeServices index">
	<h2><?php __('Type Services');?></h2>
	<?php echo $this->Form->create('TypeService',array('name'=>'checkbox','id'=>'TypeService_typeServices'));?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<? if(Configure::read('aser.comptabilite')):?>
			<th><?php echo $this->Paginator->sort('groupe_comptable_id');?></th>
			<? endif;?>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
		</tr>
	<?php
	
	foreach ($typeServices as $typeService):
		
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$typeService['TypeService']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$typeService['TypeService']['id'])); ?>
		</td>
		<td><?php echo $typeService['TypeService']['name']; ?>&nbsp;</td>
		<td><?php echo $typeService['TypeService']['description']; ?>&nbsp;</td>
		<? if(Configure::read('aser.comptabilite')):?>
			<td><?php if(isset($groupeComptables[$typeService['TypeService']['groupe_comptable_id']]))
						echo $groupeComptables[$typeService['TypeService']['groupe_comptable_id']]; ?>&nbsp;</td>
		<? endif;?>
		<td>
			<?php echo $this->Html->link($typeService['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $typeService['Personnel']['id'])); ?>
		</td>
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
<div id="separator" class="back" title="Cacher Le Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Type Service', true)), array('action' => 'add')); ?></li>
		<li class="link" onclick="actions('checkbox','edit')" >Modifier</li>
		<li class="link" onclick="actions('checkbox','delete')" >Effacer</li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Services', true)), array('controller' => 'services', 'action' => 'index')); ?> </li>
	</ul>
</div>
