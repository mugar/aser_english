<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
	jQuery('#params').change(function(){
		var params=jQuery(this).val();
 		if(params!='no'){
 			jQuery('.nullable').removeAttr('disabled');
 		}
 		else {
 			jQuery('.nullable').attr('disabled','disabled');
 		}
 	})
});
</script>
<div class="dialog">
<?php echo $this->Form->create('Personnel',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Full Name'));
		echo $this->Form->input('actif',array('id'=>'actif','options'=>array('yes'=>'yes','no'=>'no')));
		echo $this->Form->input('fonction_id',array('label'=>'Role','id'=>'fonction'));
		echo $this->Form->input('params',array('id'=>'params','label'=>'Change login credentials','options'=>array('no'=>'no','yes'=>'yes')));
	?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('identifiant',array('class'=>'nullable','disabled'=>'disabled','label'=>'Username'));
		echo $this->Form->input('mot_passe',array('label'=>'Password','type'=>'password','id'=>'mot_passe','class'=>'nullable','disabled'=>'disabled'));
		echo $this->Form->input('confirmer',array('label'=>'Password Confirmation','type'=>'password','class'=>'nullable','disabled'=>'disabled'));
		if(Configure::read('aser.touchscreen')||Configure::read('aser.swipe')){
			echo $this->Form->input('code',array('label'=>'POS code','type'=>'password','class'=>'nullable','disabled'=>'disabled'));
		}
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>