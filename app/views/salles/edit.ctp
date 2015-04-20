
<div class="dialog">
<?php echo $this->Form->create('Salle',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Nom de la salle'));
		echo $this->Form->input('montant',array('label'=>'Montant/Jour'));
	?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('capacite',array('label'=>'Capacité'));
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>