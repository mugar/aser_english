<div class="dialog">
<?php echo $this->Form->create('Type',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('type',array('options'=>array('depense'=>'Expense','vente'=>'Deposit')));
		echo $this->Form->input('categorie',array('options'=>$categories, 'label'=>'Category'));
		?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('actif',array('options'=>array('yes'=>'yes','no'=>'no')));
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>	