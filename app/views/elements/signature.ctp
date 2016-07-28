
<div class="bas_page">
	<?php if(!isset($modele)):?>
	<div class="left">
		<div class="text">
		<?php
			echo __('Cashier Signature').'<br/><br/><br/>';	
			echo __('Verified by').' <br/>';	
		?>
		
		</div>
	</div>
	<div class="right"><?php  
			echo __('Supervisor').'<br/><br/><br/>';	
		echo __('Approved by').'<br />';
	?>
	</div>
	<? elseif($modele==1):?>
		
	<div class="left">
		<div class="text">
		<?php
			echo 'PREPARED BY : '.$session->read('Auth.Personnel.name');
			echo '<br/>';
			echo 'VERIFIED BY :';
			echo '<br/>';
			echo 'APPROVED BY :';

		?>
		
		</div>
	</div>
	<div class="right"><?php  
		echo __('Received By :');	
		for($i=0; $i<30; $i++){
			echo '&nbsp;';
		}
	?>
	</div>
	<? elseif($modele==2):?>
		
	<div class="left">
		<div class="text">
		<?php
			
		?>
		
		</div>
	</div>
	<div class="right"><?php  
	foreach(explode(',',$signature) as $line){
		echo $line.'<br/>';
	}
		
	?>
	</div>
	<? endif;?>
	<div style="clear:both"></div>
</div>