
 	<div class="input text required"><label for="ProductName" >Product</label></div>
	<?php
		echo $ajax->autoComplete('Product.name','/produits/autoComplete/appro');
?>
		