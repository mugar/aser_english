<div class="caisseInterdites form">
<?php echo $this->Form->create('Config',array('type'=>'file'));?>
  <fieldset>
    <legend class="edit"><?php echo "Importer la base de données sous format SQL" ?></legend>
  <?php
    echo $this->Form->file('Config.file',array('style'=>'width: 400px; height: 50px;'));
  ?>
  </fieldset>
<?php echo $this->Form->end(__('Restaurer', true));?>
</div>
<div class="actions">
  <h3><?php __('Actions'); ?></h3>
  <ul>
    <li><?php echo $this->Html->link(__('Page d\'accueil', true), '/'); ?></li>
  </ul>
</div>