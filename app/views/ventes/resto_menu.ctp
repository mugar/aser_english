
		<fieldset class='ingredient'>
 			<legend>Liste des Boissons</legend>
			<?php foreach($groupes as $groupe):?>
				<?php if(!empty($groupe['Produit'])): ?>
			<div class="items" >
				<h4 onclick="Element.toggle($('personnel'))" style="cursor:pointer;"><?php echo $groupe['Groupe']['name']?></h4>
				<div id="personnel">
					<?php 
					foreach($groupe['Produit'] as $produit) {
						echo $this->Form->input('Product.'.$produit['id'],array('label'=>$produit['name']));
					}
					?>
				</div>
			</div>
			<?php endif; ?>
 			<?php endforeach; ?>
		</fieldset>
		<fieldset class='ingredient'>
 			<legend>Liste des Plats</legend>
 			
			<?php  $j=0; foreach($categories as $category):?>
				<?php if(!empty($category['Plat'])): ?>
				<div class='items'>
					<h4 onclick="Element.toggle($('category<?php echo $j?>'))" style="cursor:pointer;"><?php echo $category['Category']['name']?></h4>
					<div id="category<?php echo $j?>">
						<?php 
						foreach($category['Plat'] as $plat) {
							echo $this->Form->input('Plat.'.$plat['id'],array('label'=>$plat['name']));
						}
						?>
					</div>
				</div>
				<?php endif; ?>
 			<?php $j++ ;endforeach; ?>
		</fieldset>