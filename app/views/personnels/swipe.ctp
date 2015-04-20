<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
   
	 jQuery(window).load(function () {
    	jQuery('#PersonnelCode').focus();
	  });

  	jQuery('#PersonnelCode').live('cut copy paste', function(e) {
	 e.preventDefault();
	});
	
});
</script>
<div id="login">
<?php
echo $form->create('Personnel',array('action' =>'swipe','id'=>'form_test'));?>
	<fieldset>
 		<legend>Connexion</legend>
 		<span id="loading" style="display:none;">Vérification ...</span>
	<?php

echo $form->input('Personnel.code',array('type'=>'password'));
?>
</fieldest>
<?php if(Configure::read('aser.swipe')):?>
<input style="margin-left:15px;" type="submit" value="Connexion" >
<button id="test" style="margin-left:5px; height:40px;" onclick="connexion('<?php echo $action;?>'); return false;"><?php echo $action;?> Swipe</button>
</form>
<?php else :
	echo $form->end(__('connexion', true));
?>
<?php endif;?>
</div>