
 	<div class="input text required"><label for="ProduitName" >Produit</label></div>
	<?php
		echo $ajax->autoComplete('Produit.name','/produits/autoComplete/appro');
?>
		