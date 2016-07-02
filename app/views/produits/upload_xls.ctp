
<?php echo $this->Form->create('Product',array('enctype' => 'multipart/form-data'));?>
	<fieldset>
 		<legend class="upload"><?php printf(__('Importer la liste des produits en excel', true)); ?></legend>
	<?php
	
		echo $this->Form->file('Product.file', array('type'=>'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
