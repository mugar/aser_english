	<tr id="<?php echo $produit['Product']['id'];?>">
		<td>
			<?php echo $this->Form->input('Id.'.$produit['Product']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$produit['Product']['id'])); ?>
		</td>
		
		<td><?php echo $produit['Product']['id']; ?>&nbsp;</td>
		<td>
			<?php if(isset($sections[$produit['Groupe']['section_id']])) echo $sections[$produit['Groupe']['section_id']]; ?>
		</td>
		<td>
			<?php echo $produit['Groupe']['name']; ?>
		</td>
		<td name="nom"><?php echo $produit['Product']['name']; ?>&nbsp;</td>
		<td name="pa">
			<?php echo $produit['Product']['PA']; ?>
		</td>
		<?php if(!Configure::read('aser.multi_pv')): ?>
			<td name="pv"><input style="width:100px;" onchange="change_pv(this);" type="text" value="<?php echo $produit['Product']['PV']; ?>" id="<?php echo $produit['Product']['id'];?>"/>&nbsp;</td>
		<?php else : ?>
			<?php 
			foreach($bars as $barCode=>$barName):?>
				<td name="pv"><input style="width:80px;" onchange="change_pv(this);" type="text" bar="<?php echo $barCode; ?>"  value="<?php echo $produit['Product'][$barCode]; ?>" id="<?php echo $produit['Product']['id'];?>"/>&nbsp;</td>
			<?php endforeach;?>
		<? endif;?>
		<?php if(Configure::read('aser.default_stock')>0):?>
			<td>
			<?php echo $produit['Product']['quantite']; ?>
		</td>
		<?php endif;?>
		<td>
			<?php echo $produit['Unite']['name']; ?>
		</td>
		<td><?php echo $produit['Product']['type']; ?>&nbsp;</td>
		<?php if(Configure::read('aser.pharmacie')):?>
		<td><?php echo $produit['Product']['expiration']; ?>&nbsp;</td>
		<?php endif; ?>
		<?php if(Configure::read('aser.advanced_stock')):?>
		<td><?php echo $produit['Product']['acc']; ?>&nbsp;</td>
		<?php endif; ?>
			<?php if(Configure::read('aser.comptabilite')):?>
		<td><?php echo $produit['GroupeComptable']['name']; ?>&nbsp;</td>
		<?php endif; ?>
		<td><?php echo $produit['Product']['min']; ?>&nbsp;</td>
		<td><?php echo $produit['Product']['description']; ?>&nbsp;</td>
		<td><?php echo $produit['Product']['actif']; ?>&nbsp;</td>
	</tr>
