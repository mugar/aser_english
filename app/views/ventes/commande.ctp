<div id="order" style="display:none" title='Commande pour le Bar et la cuisine'>
<div class="dialog">
	<?php echo $this->Form->create('Vente');?>
	<span class="left">
		<?php
			echo $this->Form->input('msg1',array('id'=>'msg1','type'=>'textarea','label'=>'Message pour le Barman'));
			echo $this->Form->input('msg2',array('id'=>'msg2','type'=>'textarea','label'=>'Message pour le Cuisinier'));
		?>
	</span>
	<span class="right">
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>