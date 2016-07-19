
<div class="dialog">
<?php echo $this->Form->create('TypeService',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'name'));
    echo $this->Form->input('code',array('label'=>'code'));
	?>
	</span>
  <span class="right">
    <?php
    echo $this->Form->input('montant',array('label'=>'Amount in RWF'));
  ?>
  </span>
	</form>
<div style="clear:both"></div>
</div>