<div class="dialog">
<?php echo $this->Form->create('Type',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('type',array('options'=>array('depense'=>'Dépense','vente'=>'Entrée')));
		echo $this->Form->input('categorie',array('options'=>$categories));
		?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('actif',array('options'=>array('oui'=>'oui','non'=>'non')));
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>	