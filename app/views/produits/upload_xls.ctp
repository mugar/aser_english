
<?php echo $this->Form->create('Produit',array('type'=>'file'));?>
	<fieldset>
 		<legend class="upload"><?php printf(__('Importer la liste des produits en excel', true)); ?></legend>
	<?php
	
		echo $this->Form->file('Produit.file');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Envoyer', true));?>
