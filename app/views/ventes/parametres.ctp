
<div id="parametres" style="display:none" title="Configuration des paramètres">
	<div class="dialog">
		<?php echo $this->Form->create('Vente',array('id'=>'parametres','action'=>'update_produits'));?>
		<span class="left">
			<?php
				echo $this->Form->input('Vente.stock_id');
				echo $this->Form->input('Vente.pos',array('options'=>$bars,'label'=>'Place','selected'=>$session->read('pos')));
				if($action=='index'){
					$mode=$session->read('mode_restaurant');
					if(!Configure::read('aser.magasin')||($mode!='')){
						if(($mode==1)||($mode==''))
							echo $this->Form->input('mode_restaurant',array('type'=>'checkbox','checked'=>'checked'));
						else 
							echo $this->Form->input('mode_restaurant',array('type'=>'checkbox'));
					}
				}
			?>
		</span>
		<span class="right">
			<?php
				if($action=='index'){
					echo $this->Form->input('Product.section_id',array('options'=>$sections1,'multiple'=>true));
				}
			?>
		</span>
		</form>
		<div style="clear:both"></div>
	</div>
</div>