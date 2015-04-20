
<div id="perte_boxe" style="display:none" title="Création d'un perte">
<div class="dialog">
	<div id="message_perte"></div>
	<?php echo $this->Form->create('Perte',array('id'=>'perteAdd','action'=>'add'));?>
	<span class="left">
		<?php	
			echo $this->Form->input('Perte.quantite');
			echo $this->Form->input('Perte.nature',array('options'=>$natures));
		?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('Perte.description');
		echo $this->Form->input('Perte.date',array('id'=>'Date2','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>