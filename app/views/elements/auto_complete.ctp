
 	<div class="input text required"><label for="ProductName" >Product</label></div>
	<?php
		echo $ajax->autoComplete('Produit.name','/produits/autoComplete/appro');
?>
		