<?php
	if(!empty($client)){
		echo '<span id="clientDetails" clientId="'.$client['id'].'">';
			echo $this->Html->link(ucfirst($client['name']), array('controller' => 'tiers', 'action' => 'view', $client['id'])).'<br />';
			if(!empty($client['compagnie']))	echo $client['compagnie'].'<br />';
			if(!empty($client['telephone']))	echo 'Tel : '.$client['telephone'].'<br />';
			if(!empty($client['email'])) 	echo 'E-mail : <a href="mailto:'.$client['email'].'">'.$client['email'].'</a> <br />';
			if(!empty($client['chambre'])) 	echo 'Chambre : '.$client['chambre'].' <br />';
			if(!empty($client['pers_contact'])) 	echo 'Personne de contact : '.$client['pers_contact'].' <br />';
		echo '</span>';
	}
?>