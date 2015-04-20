
<div class="bas_page">
	<?php if(!isset($modele)):?>
	<div class="left">
		<div class="text">
		<?php
			echo __('Signature du Caissier').'<br/><br/><br/>';	
			echo __('Verifié par').' <br/>';	
		?>
		
		</div>
	</div>
	<div class="right"><?php  
			echo __('Contrôleur financier').'<br/><br/><br/>';	
		echo __('Approuvée par').'<br />';
	?>
	</div>
	<? elseif($modele==1):?>
		
	<div class="left">
		<div class="text">
		<?php
			
		?>
		
		</div>
	</div>
	<div class="right"><?php  
		echo __('Signature du Caissier');	
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