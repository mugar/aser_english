
 	<?php
			foreach($ingredients as $ingredient):?>
			<div class="ingredient">
				<span class='left'>
					<?php echo $this->Form->input($ingredient['DeuxiemeProduit']['id'].'.quantite',array('label'=>$ingredient['DeuxiemeProduit']['name'],'value'=>0));?>
				</span>
				<span class='right'>
					<?php echo $this->Form->input($ingredient['DeuxiemeProduit']['id'].'.unite',array('label'=>'unité','options'=>$unites));?>
				</span>
				<div style="clear:both"></div>
			</div>
			
	<?php endforeach; ?>