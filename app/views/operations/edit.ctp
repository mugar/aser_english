
<div class="dialog">
<?php echo $this->Form->create('Operation',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('date',array('type'=>'text','id'=>'DateEdit'));
		echo $this->Form->input('libelle');
		?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('montant');
		echo $this->Form->input('monnaie');
		echo $this->Form->input('ordre');
		echo $this->Form->input('op_num',array('type'=>'hidden'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>