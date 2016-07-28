<?php
	// search for modules settings 
	$config=Configure::read('aser'); 
	$loggedUser=$session->read('Auth.Personnel.name');
?>
	<? if($enabled):?> 
		<div id="menu">
			<ul id="nav">
				<?php if(Configure::read('aser.stock')):?>
				<li><?php echo $html->link(__('Inventory', true), '#'); ?>
					<ul>
						<li class="folder"><?php echo $this->Html->link(__('Store Management', true), '/stocks/index'); ?></li>
						<li class="folder"><?php echo $this->Html->link(__('Inventory Operations', true), '/historiques/index'); ?></li>
						<li class="folder"><?php echo $this->Html->link(__('Final Stock Controls', true), '/final_stocks/index'); ?></li>
						<li  class="folder"><?php echo $this->Html->link(__('Store Transfers', true), '/mouvements/index'); ?></li>
						<li class="rapport"><?php echo $this->Html->link(__('Products Movements Report', true), '/produits/balance'); ?></li>
						<li class="rapport"><?php echo $this->Html->link(__('Inventory Closing Report', true), '/produits/rapport'); ?></li>
						<!-- <li class="rapport"><?php echo $this->Html->link(__('Evolution journalière', true), '/produits/monthly'); ?>
						</li> -->
						<!-- <li class="rapport"><?php echo $this->Html->link(__('State journalier', true), '/produits/shifts'); ?></li>
						<li class="rapport"><?php echo $this->Html->link(__('Conso Théoriques', true), '/produits/conso_theorique'); ?></li> -->
					</ul>
					<?endif;?>
				</li>
				<?php if(Configure::read('aser.POS')):?>
					<li><?php echo $html->link(__('Products', true), '#'); ?>
								<ul>	
									<?php if(Configure::read('aser.stock')):?>
										
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
										<ul>
											<?php if($session->read('Auth.Personnel.fonction_id') == 3):?>
												<li class="upload"><?php echo $this->Html->link(__('Importer des produits', true), '/produits/upload_xls'); ?></li>
											<?php endif;?>
										</ul>	
									</li>
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
							<li class="folder"><?php echo $this->Html->link('Bills Collections', '/recouvrements/index'); ?></li>
							<li class="folder"><?php echo $this->Html->link('Deposits Payments', '/paiements/deposits'); ?></li>
					</ul>
				</li>
				
				<?php if($config['POS']): ?>
				<li><?php  echo $html->link(__('Point Of Sale', true), '#');?>
						<ul>
							<li class="rapport"><?php echo $this->Html->link(__('Restaurant POS', true), '/ventes/touchscreen'); ?></li>	
							<?php if(Configure::read('aser.services')):?>
								<li class="rapport"><?php echo $this->Html->link(__('Services POS', true), '/ventes/index/null/yes'); ?></li>
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
				<?php if(false&&$config['services']): ?>
				<li><?php echo $html->link(__('Services', true), '#'); ?>
					<ul>
						<li class="folder"><?php echo $this->Html->link(__('Service Types Management', true), '/type_services/index'); ?></li>
						<li class="folder"><?php echo $this->Html->link(__('Services Management', true), '/services/index'); ?>
							<ul>
								<li class="rapport"><?php echo $this->Html->link(__('Edition de rapport', true), '/services/rapport'); ?></li>
							</ul>
						</li>
						
					</ul>
				</li>
				<?php endif; ?>
				
				<?php if(Configure::read('aser.tresorerie')):?>
				<li><?php echo $this->Html->link(__('Cash', true), '#'); ?>
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
				<li><?php echo $this->Html->link(__('Settings', true), '#'); ?>
					<ul>
						<li class="rapport"><?php echo $this->Html->link(__('General Settings', true), '/configs/index'); ?></li>
						<li class="rapport"><?php echo $this->Html->link(__('Export the Database', true), '/configs/backup'); ?></li>
						<?php if(in_array($session->read('Auth.Personnel.fonction_id'),array(3))):?>
							<li class="rapport"><?php echo $this->Html->link(__('Import the Database', true), '/configs/restore_db'); ?></li>
							<li class="rapport"><?php echo $this->Html->link(__('Repair the Database', true), '/configs/repair_all_tables'); ?>
							<li class="rapport"><?php echo $this->Html->link(__('Delete all the Database Operations', true), '/configs/reset_db/partial'); ?></li>
							<li class="rapport"><?php echo $this->Html->link(__('Delete completely the Database', true), '/configs/reset_db/complete'); ?></li>
						<?php endif;?>
						</li>
					</ul>	
				</li>
				<li><?php echo $this->Html->link(__('Users', true), '#'); ?>
					<ul>
						<li class="personnel"><?php echo $this->Html->link(__('Users Management', true), '/personnels/index'); ?></li>
					</ul>
				</li>
				<!-- <li><a href="/manual/Index.html">Aide</a></li> -->
				<li><?php echo $this->Html->link(__('Home Page', true), '/'); ?></li>
				<li><?php echo $this->Html->link('Logout ('.$loggedUser.')', '/personnels/logout'); ?></li>
			</ul>
		</div>
		<?php else: ?>
		<div id="menu" >
			<ul id="nav1">
					<li> </li>
			</ul>
		</div>
	<?php endif; ?>
