<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
   
	 jQuery(window).load(function () {
    	jQuery('#PersonnelIdentifiant').focus();
	  });
	});
</script>
<div id="login">
<?php
echo $form->create('Personnel',
 array('action' =>'login'));?>
	<fieldset>
 		<legend>Login</legend>
 		<span id="loading" style="display:none;">Vérification ...</span>
	<?php

echo $form->input('Personnel.identifiant',array('label'=>'username'));
echo $form->input('Personnel.mot_passe',array('type'=>'password','label'=>'Password'));
echo $form->input('Personnel.remember_me',array('label'=>'Remember Me','type'=>'checkbox'));
?>
</fieldest>
<?php if(Configure::read('aser.swipe')):?>
<input style="margin-left:15px;" type="submit" value="Connexion">
<button id="test" style="margin-left:5px; height:40px;" onclick="connexion('<?php echo $action;?>'); return false;"><?php echo $action;?> Swipe</button>
</form>
<?php else :
	echo $form->end(__('Login', true));
?>
<?php endif;?>
</div>