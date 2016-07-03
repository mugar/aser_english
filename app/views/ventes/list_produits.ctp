				<?php
				$config=Configure::read('aser');
				foreach ($produits as $produit):
				?>
				<tr onclick="conso_activated(this)" 
					id="<?php echo $produit['Vente']['id'];?>"
					printed="<?php echo $produit['Vente']['printed'];?>"
				 >
					<td name="check">
						<input type="checkbox" name="case" value="<?php echo $produit['Vente']['id'];?>">
					</td>
				<?php if($config['beneficiaires']): ?>
					<td><?php echo $produit['Vente']['pourcentage']; ?>&nbsp;</td>
				<?php endif; ?>
					<td name="produit" id="<?php echo $produit['Produit']['id'];?>"><?php echo $produit['Produit']['name']; ?>&nbsp;</td>
					<td id="quantite_vente"><?php echo $produit['Vente']['quantite']; ?>&nbsp;</td>
					<td id="PU"><?php echo $produit['Vente']['PU']; ?>&nbsp;</td>
					<td id="prix"><?php echo $produit['Vente']['montant']; ?>&nbsp;</td>
					<td id="created_time"><?php echo $produit['Vente']['created']; ?>&nbsp;</td>
				</tr>
				<?php endforeach; ?>