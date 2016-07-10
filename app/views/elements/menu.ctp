<?php
	// search for modules settings 
	$config=Configure::read('aser'); 
	$loggedUser=$session->read('Auth.Personnel.name');
?>
	<? if($enabled):?> 
		<div id="menu">
			<ul id="nav">
				<?php if(Configure::read('aser.POS')):?>
					<li><?php echo $html->link(__('Stock', true), '#'); ?>
						<ul>
							<li class="folder"><?php echo $this->Html->link(__('Products Configuration', true), '#'); ?>
								<ul>	
									<?php if(Configure::read('aser.stock')):?>
										<li class="folder"><?php echo $this->Html->link(__('Stocks Management', true), '/stocks/index'); ?></li>
									<?endif;?>
									<li class="folder"><?php echo $this->Html->link(__('Sections Management', true), '/sections/index'); ?></li>
									<li class="folder"><?php echo $this->Html->link(__('Groups Management', true), '/groupes/index'); ?></li>
									<?php if(Configure::read('aser.comptabilite')):?>
										<li class="folder"><?php echo $this->Html->link(__('Gestion des Groupes Comptables', true), '/groupe_comptables/index'); ?></li>
									<?endif;?>
									<?php if(Configure::read('aser.stock')):?>
										<li class="folder"><?php echo $this->Html->link(__('Measuring Units Management', true), '/unites/index'); ?></li>
									<?endif;?>
									<li class="folder"><?php echo $this->Html->link(__('Products Management', true), '/produits/index'); ?>
				    					<?php if(Configure::read('aser.stock')):?>
				    	  					<ul>
												<li class="rapport"><?php echo $this->Html->link(__('Rapport Des Products', true), '/produits/rapport'); ?></li>
												<li class="rapport"><?php echo $this->Html->link(__('Mouvements Des Products', true), '/produits/balance'); ?></li>
												<li class="rapport"><?php echo $this->Html->link(__('Evolution journalière', true), '/produits/monthly'); ?></li>
												
												<!-- <li class="rapport"><?php echo $this->Html->link(__('State journalier', true), '/produits/shifts'); ?></li>
												<li class="rapport"><?php echo $this->Html->link(__('Conso Théoriques', true), '/produits/conso_theorique'); ?></li> -->
												<?php if($session->read('Auth.Personnel.fonction_id') == 3):?>
												<li class="upload"><?php echo $this->Html->link(__('Importer des produits', true), '/produits/upload_xls'); ?></li>
												<?php endif;?>
											</ul>
										<?endif;?>
									</li>
								</ul>
							</li>
							<?php if(Configure::read('aser.stock')):?>
								<li class="folder"><?php echo $this->Html->link(__('Gestion des Opérations', true), '#'); ?>			
									<ul>
										<li class="folder"><?php echo $this->Html->link(__('Gestion des Entrées', true), '/entrees/index'); ?>
											<ul>
												<li class="rapport"><?php echo $this->Html->link(__('Edition de rapport', true), '/entrees/rapport'); ?></li>
											</ul>
										</li>
										<li class="folder"><?php echo $this->Html->link(__('Gestion des Sorties', true), '/sortis/index'); ?>
											<ul>
												<li class="rapport"><?php echo $this->Html->link(__('Edition de rapport', true), '/sortis/rapport'); ?></li>
											</ul>
										</li>
										<li class="folder"><?php echo $this->Html->link(__('Gestion des Pertes', true), '/pertes/index'); ?>
											<ul>
												<li class="rapport"><?php echo $this->Html->link(__('Rapport Pertes', true), '/pertes/rapport'); ?></li>
											</ul>
										</li>
										<li  class="folder"><?php echo $this->Html->link(__('Gestion des Mouvements', true), '/mouvements/index'); ?></li>
									</ul>	
								</li>
							<?php endif;?>
					</ul>
				</li>
				<?php endif;?>
				<li><?php echo $this->Html->link(__('Customers & Invoices', true), '#'); ?>
					<ul>
						<li class="folder"><?php echo $this->Html->link(__('Customers Management', true), '/tiers/index'); ?></li>
						<?php if(Configure::read('aser.gestion_reduction')):?>
							<li class="folder"><?php echo $this->Html->link(__('Discounts Management', true), '/reductions'); ?></li>
						<?php endif;?>
						<li class="folder"><?php echo $this->Html->link(__('Invoices Management', true), '/factures/index'); ?>
							<ul>	
								<li class="rapport"><?php echo $this->Html->link(__('Invoices Report', true), '/factures/rapport'); ?></li>
								<li class="rapport"><?php echo $this->Html->link(__('Monthly Sales Report', true), '/factures/monthly'); ?></li>
								<li class="rapport"><?php echo $this->Html->link(__('Daily Report', true), '/factures/cash'); ?></li>
								<li class="rapport"><?php echo $this->Html->link(__('Payments Report', true), '/paiements/payment/no'); ?></li>
								<li class="rapport"><?php echo $this->Html->link(__('Debtors Report', true), '/factures/credit'); ?></li>
								<?php if((Configure::read('aser.aserb')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3,5)))||
									in_array(Configure::read('aser.name'),array('aserb','belair'))	
								):?>
									<li class="rapport"><?php echo $this->Html->link(__('Liste des Customers', true), '/factures/declaration'); ?></li>
								<?php endif;?>
								<?php if(Configure::read('aser.silhouette')):?>
									<li class="rapport"><?php echo $this->Html->link(__('Listes Des Factures', true), '/factures/silhouette'); ?>
										<ul>
											<li class="rapport"><?php echo $this->Html->link(__('Limites', true), '/limits'); ?></li>
										</ul>
									</li>
								<?php endif;?>
								<?php if(in_array(Configure::read('aser.name'),array('aserb','belair'))||Configure::read('aser.silhouette')):?>
									<li class="rapport"><?php echo $this->Html->link(__('Impression Journalière', true), '/factures/show_bills'); ?></li>
								<?php endif;?>	
								<?php if($config['POS']):?>
									<li class="rapport"><?php echo $this->Html->link(__('Unlocked Invoices Report', true), '/ventes/unlocked_bills'); ?></li>
								<? endif;?>	
								<?php if(Configure::read('aser.xls_copy')):?>
									<li class="rapport"><?php echo $this->Html->link(__('Factures envoyées', true), '/factures/aserb_report'); ?></li>
								<? endif;?>	
							</ul>
							
						</li>	
						<?php if($config['proforma']):?>
							<li class="folder"><?php echo $this->Html->link(__('Gestion des Proformas', true), '/proformas/index'); ?></li>
						<?php endif;?>
						<?php if($config['ebenezer']):?>
							<li class="folder"><?php echo $this->Html->link(__('Gestion des Dettes', true), '/dettes/index'); ?></li>
						<?php endif;?>
						
					</ul>
				</li>
				
				<?php if($config['POS']): ?>
				<li><?php 
						if($config['magasin']) echo $html->link(__('Point Of Sale', true), '#');
						else  echo $html->link(__('Restaurant', true), '#');?>
						<ul>
							<?php if(Configure::read('aser.touchscreen')):?>
							<li class="rapport"><?php echo $this->Html->link(__('Point Of Sale', true), '/ventes/touchscreen'); ?></li>
							<?php else : ?>
								<li class="rapport"><?php echo $this->Html->link(__('Point Of Sale', true), '/ventes/index'); ?></li>
							<?php endif; ?>
							<?php if($config['pos_sales_report']):?>
								<li class="rapport"><?php echo $this->Html->link(__('Sales Report', true), '/ventes/rapport'); ?></li>
							<?php endif;?>
							<li class="rapport"><?php echo $this->Html->link(__('Sales Report By Product', true), '/ventes/consommations'); ?></li>
							<li class="rapport"><?php echo $this->Html->link(__('Cashier Report', true), '/ventes/journal'); ?></li>
							<?php if(in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
								<li class="rapport"><?php echo $this->Html->link(__('List of Cashier Reports', true), '/journals/index'); ?></li>
							<?php endif; ?>
							<? if(Configure::read('aser.comptabilite')):?>
								<li class="rapport"><?php echo $this->Html->link(__('Synthèse des ventes journalières', true), '/ventes/syntheseCptableDVente'); ?></li>
								<li class="rapport"><?php echo $this->Html->link(__('Détail des crédits journaliers', true), '/ventes/creditCptable'); ?></li>
								<li class="rapport"><?php echo $this->Html->link(__('Ventes Par Groupes Comptable', true), '/ventes/par_produits_groupe_cptable'); ?></li>
							<? endif;?>
							<?php if($config['bon']):?>
								<li class="rapport"><?php echo $this->Html->link(__('Not Sent Orders', true), '/ventes/unprinted_orders'); ?></li>
							<? endif;?>	
							<li class="rapport"><?php echo $this->Html->link(__('Removed Orders', true), '/ventes/removed_orders'); ?></li>
							</ul>
				</li>
				<?php endif; ?>
				<?php if($config['hotel']): ?>
				<li><?php echo $html->link(__('Accommodation', true), '#'); ?>
					<ul>
						<li class="folder"><?php echo $this->Html->link(__('Room Types Management', true), '/typeChambres/index'); ?></li>
						<li class="folder"><?php echo $this->Html->link(__('Room Management ', true), '/chambres/index'); ?>
							<?php if(Configure::read('aser.gouvernance')):?>
							<ul>
								<li class="rapport"><?php echo $this->Html->link(__('Listes des chambres à nettoyer', true), '/reservations/rooms_to_clean'); ?></li>
							</ul>
							<?php endif; ?>
						</li>
						<li class="folder"><?php echo $this->Html->link(__('Bookings Management', true), '/reservations/tabella'); ?>
							<ul>
								<li class="rapport"><?php echo $this->Html->link(__('Occupancy Report', true), '/reservations/etat_occupation'); ?></li>
								<li class="rapport"><?php echo $this->Html->link(__('Upcoming arrivals', true), '/reservations/arrivals'); ?></li>
								<li class="rapport"><?php echo $this->Html->link(__('Monthly Report', true), '/reservations/monthly'); ?></li>
								<li class="rapport"><?php echo $this->Html->link(__('Payment Report', true), '/paiements/payment'); ?></li>
								<li class="rapport"><?php echo $this->Html->link(__('Bookings by nationality', true), '/reservations/hosted'); ?></li>
							</ul>
						</li>
					</ul>
				</li>
				
				<?php endif; ?>
				<?php if($config['conference']): ?>
						<li><?php echo $html->link(__('Salles de Conférence', true), '#'); ?>
							<ul>
								<li class="folder"><?php echo $this->Html->link(__('Gestion des Salles', true), '/salles/index'); ?></li>
								<li class="folder"><?php echo $this->Html->link(__('Gestion des Locations', true), '/locations/tabella'); ?>
									<ul>
										<li class="rapport"><?php echo $this->Html->link(__('Edition de rapport', true), '/locations/rapport'); ?></li>
									</ul>
								</li>
							</ul>
						</li>
						<?php endif; ?>
				<?php if($config['services']): ?>
				<li><?php echo $html->link(__('Services', true), '#'); ?>
					<ul>
						<li class="folder"><?php echo $this->Html->link(__('Gestion des Type de Services', true), '/type_services/index'); ?></li>
						<li class="folder"><?php echo $this->Html->link(__('Gestion des Services', true), '/services/index'); ?>
							<ul>
								<li class="rapport"><?php echo $this->Html->link(__('Edition de rapport', true), '/services/rapport'); ?></li>
							</ul>
						</li>
						
					</ul>
				</li>
				<?php endif; ?>
				
				<?php if(Configure::read('aser.tresorerie')):?>
				<li><?php echo $this->Html->link(__('Cash Management', true), '#'); ?>
					<ul>
						<li class="money"><?php echo $this->Html->link(__('Accounts Management', true), '/caisses/index'); ?>
							<ul>
								<li class="rapport"><?php echo $this->Html->link(__('Operations Summary', true), '/operations/balance/caisses'); ?></li>	
								<li class="rapport"><?php echo $this->Html->link(__('Expenses Report', true), '/operations/depenses'); ?></li>
							</ul>
						</li>
						<li class="folder"><?php echo $this->Html->link(__('Operations Management', true), '/operations/index'); ?>	
						</li>
						<li class="folder"><?php echo $this->Html->link(__('Operations Types', true), '/types/index'); ?></li>
						<li class="rapport"><?php echo $this->Html->link('SUMMARY Report', '/operations/resultat'); ?></li>
						<!--
							<li class="folder"><?php echo $this->Html->link(__('Gestion des Caisses interdites', true), '/caisse_interdites/index'); ?></li>
						-->
					</ul>
				</li>
				<?php endif;?>
				<li><?php echo $this->Html->link(__('Configuration', true), '#'); ?>
					<ul>
						<li class="rapport"><?php echo $this->Html->link(__('Paramétrage du logiciel', true), '/configs/index'); ?></li>
						<li class="rapport"><?php echo $this->Html->link(__('Sauvergarder la base de données', true), '/configs/backup'); ?></li>
						<?php if(in_array($session->read('Auth.Personnel.fonction_id'),array(3))):?>
							<li class="rapport"><?php echo $this->Html->link(__('Importer la base de données', true), '/configs/restore_db'); ?></li>
							<li class="rapport"><?php echo $this->Html->link(__('Réparer la base de données', true), '/configs/repair_all_tables'); ?>

							<li class="rapport"><?php echo $this->Html->link(__('Delete complétement la base de données', true), '/configs/reset_db/complete'); ?></li>
							<li class="rapport"><?php echo $this->Html->link(__('Delete juste les opérations dans base de données', true), '/configs/reset_db/partial'); ?></li>
						<?php endif;?>
						</li>
					</ul>	
				</li>
				<li><?php echo $this->Html->link(__('Accès', true), '#'); ?>
					<ul>
						<li class="group"><?php echo $this->Html->link(__('Gestion des Fonctions', true), '/fonctions/index'); ?></li>
						<li class="personnel"><?php echo $this->Html->link(__('Gestion du Personnel', true), '/personnels/index'); ?></li>
						<li class="home_min"><?php echo $this->Html->link(__('Page d\'accueil', true), '/'); ?></li>
					</ul>
				</li>
				<li><a href="/manual/Index.html">Aide</a></li>
				<li><?php echo $this->Html->link('Déconnexion ('.$loggedUser.')', '/personnels/logout'); ?></li>
			</ul>
		</div>
		<?php else: ?>
		<div id="menu">
			<ul id="nav1">
				<?php if($config['POS']||$config['stock']): ?>
					<li> Stock </li>
				<?php endif; ?>
				<li> Customers & Fournisseurs </li>
				<?php if($config['POS']): ?>
					<li>Point De Vente </li>
				<?php endif; ?>
				<?php if($config['hotel']): ?>
					<li>Hébergement </li>
				<?php endif; ?>
				<?php if($config['conference']): ?>
					<li>Salles de Conférence </li>
				<?php endif; ?>
				<?php if($config['services']): ?>
					<li>Services </li>
				<?php endif; ?>
				<?php if($config['tresorerie']): ?>
				<li>Trésorerie </li>
				<?php endif; ?>
				<?php if(false&&$config['comptabilite']): ?>
					<li>Comptabilité </li>
				<?php endif; ?>
				<li>Configuration </li>
				<li>Accès </li>
			</ul>
		</div>
	<?php endif; ?>
