<div id="order" style="display:none" title='Order for the kitchen and/or the Bar'>
<div class="dialog">
	<?php echo $this->Form->create('Vente');?>
	<span class="left">
		<?php
			echo $this->Form->input('msg1',array('id'=>'msg1','type'=>'textarea','label'=>'Message for the Barman'));
			echo $this->Form->input('msg2',array('id'=>'msg2','type'=>'textarea','label'=>'Message for the kitchen chief'));
		?>
	</span>
	<span class="right">
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>