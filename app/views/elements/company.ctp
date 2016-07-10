<?php if($enable_info): ?>
<?php 
$logo=Configure::read('logo');
$monnaie=(!isset($monnaie))?Configure::read('aser.default_currency'):$monnaie;

echo $this->Html->image($logo['name'], array('alt'=>'test logo', 'border' => '0','width'=>$logo['width'],'height'=>$logo['height']));?>
		<div class="text">
			<?php if(!empty($company['address1'])) echo $company['address1'].'<br/>';?>	
			<?php if(!empty($company['address2'])) echo $company['address2'].'<br/>';?>	
			<?php if(!empty($company['tel'])) echo 'Tel : '.$company['tel'].'<br/>';?>	
			<?php if(Configure::read('aser.all_company_info')):?> 
				<?php if(!empty($company['compte_RWF'])) echo 'RWF Account : '.$company['compte_RWF'].'<br/>';?>	
				<?php if(!empty($company['compte_USD'])) echo 'USD Account : '.$company['compte_USD'].'<br/>';?>	
				<?php if(!empty($company['compte_EUR'])) echo 'EUR Account : '.$company['compte_EUR'].'<br/>';?>	
				<?php if(!empty($company['nif'])) echo 'NIF : '.$company['nif'].'<br/>';?>
				<?php if(!empty($company['email'])) echo 'E-mail : '.$company['email'].'<br/>';?>
				<?php if(!empty($company['bp'])) echo 'PO BOX : '.$company['bp'].'<br/>';?>
			<?php endif;?>
		</div>
<?php endif; ?>
