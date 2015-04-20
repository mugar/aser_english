<div><span id="loading" style="display:none">Chargement...</span>
<?php echo $this->Form->create('Reservation',array('id'=>'form_add'));?>
	<?php
		echo $this->Form->input('Affectation.id');
		echo $this->Form->input('Affectation.chambre_id');
		echo $this->Form->input('Affectation.tier_id');
		echo $this->Form->input('Affectation.etat',array('options'=>array('out'=>'out','in'=>'in')));
		echo $this->Form->input('Affectation.entree');
		echo $this->Form->input('Affectation.sortie');
		echo $this->Form->input('Affectation.commentaire');
	?>
</div>
