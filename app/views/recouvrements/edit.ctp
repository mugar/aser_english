<div class="dialog">
<?php echo $this->Form->create('Recouvrement',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('date',array('type'=>'text','id'=>'DateEdit'));
		echo $this->Form->input('tier_id',array('label'=>'Customer','options'=>$tiers1));
		echo $this->Form->input('factures',array('label'=>'Invoices'));
		?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('montant',array('label'=>'Collected Amount'));
		echo $this->Form->input('done_by_id',array('options'=>$collectors1));
		echo $this->Form->input('comments');
		echo $this->Form->input('personnel_id',array('type'=>'hidden'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>