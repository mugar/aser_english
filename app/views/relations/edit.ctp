<div class="relations form">
<?php echo $this->Form->create('Relation');?>
	<fieldset>
 		<legend class="edit"><?php printf(__('Edit %s', true), __('Relation', true)); ?></legend>
	<?php
		$i=0;
		echo $this->Form->input('id');
		 echo $this->Form->input('Product.stock_id',array('id'=>$i.'StockId','label'=>''));
		echo $ajax->observeField($i.'StockId',array('url' =>'/produits/stock'));
   		echo $ajax->autoComplete($i.'1produit','/produits/autoComplete',array('id'=>$i.'1produit',
																				'name'=>'data[PremierProduct][name]',
																				'value'=>$this->data['PremierProduct']['name']));
		echo $this->Form->input('relation',array('options'=>array('composer_par'=>'composer_par')));
		echo $ajax->autoComplete($i.'2produit','/produits/autoComplete',array('id'=>$i.'2produit',
																					'name'=>'data[DeuxiemeProduct][name]',
																					'value'=>$this->data['DeuxiemeProduct']['name']));
		echo $this->Form->input('quantite');
		echo $this->Form->input('unite_id');	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Relation.id')), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $this->Form->value('Relation.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Relations', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Stocks', true)), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Stock', true)), array('controller' => 'stocks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister / Créer  %s', true), __('Products', true)), array('controller' => 'produits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Premier Product', true)), array('controller' => 'produits', 'action' => 'add')); ?> </li>
	</ul>
</div>
