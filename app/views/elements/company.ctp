<?php if($enable_info): ?>
<?php 
$logo=Configure::read('logo');
$monnaie=(!isset($monnaie))?Configure::read('aser.default_currency'):$monnaie;

echo $this->Html->image($logo['name'], array('alt'=>'test logo', 'border' => '0','width'=>$logo['width'],'height'=>$logo['height']));?>
		<div class="text">
			<?php if(!empty($company['address1'])) echo $company['address1'].'<br/>';?>	
			<?php if(!empty($company['address2'])) echo $company['address2'].'<br/>';?>	
			<?php if(!empty($company['tel'])) echo 'Tél : '.$company['tel'].'<br/>';?>	
			<?php if(Configure::read('aser.all_company_info')):?>
				<?php if(!empty($company['compte_BIF'])) echo 'Compte BIF : '.$company['compte_BIF'].'<br/>';?>	
				<?php if(!empty($company['compte_USD'])) echo 'Compte USD : '.$company['compte_USD'].'<br/>';?>	
				<?php if(!empty($company['compte_EUR'])) echo 'Compte EUR : '.$company['compte_EUR'].'<br/>';?>	
				<?php if(!empty($company['nif'])) echo 'NIF : '.$company['nif'].'<br/>';?>
				<?php if(!empty($company['email'])) echo 'E-mail : '.$company['email'].'<br/>';?>
				<?php if(!empty($company['bp'])) echo 'BP : '.$company['bp'].'<br/>';?>
			<?php endif;?>
		</div>
<?php endif; ?>
