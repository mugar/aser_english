<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
  <div id="message_recherche"></div>
  <?php echo $this->Form->create('Paiement',array('id'=>'recherche'));?>
  <span class="left">
    <?php
      echo $this->Form->input('tier_id',array('label'=>'Customer Name'));
      echo $this->Form->input('compagnie',array('label'=>'Customer Company'));
      echo $this->Form->input('monnaie',array('label'=>'Currency'));
    ?>
  </span>
  <span class="right">
    <?php
      
      echo $this->Form->input('date1',array('label'=>'Start Date','type'=>'text')); 
      
      echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));
      echo $this->Form->input('mode_paiement',array('label'=>'Payment Mode',
                            'options'=>array()+$modePaiements,
                                ));
    ?>
  </span>
  </form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<h3><?php 
$config=Configure::read('aser');
  echo 'Deposit Payments Report';
    if(isset($date1)){
      echo '<h4>( '.$this->MugTime->toFrench($date1).'-'.$this->MugTime->toFrench($date2).' )</h4>';
    }
  ?>
</h3>
<br>
<?php 
echo $this->element('../paiements/payments_table',array('checkbox'=>true, 'pyts'=>$pyts, 'hide_title'=>true, 'customer'=>true,'sums'=>$sumPyts));
?>
</div>
</div>
<div class="actions">
  <h3><?php __('Actions'); ?></h3>
  <ul>
    <li class="link" onclick = "print_documents()" >Print</li>  
    <li class="link" onclick = "pyt(null, 'deposit')" >Create Deposit</li>
    <?php if(in_array($session->read('Auth.Personnel.fonction_id'),array(3,5,8))) :?>
      <li class= "link" onclick = "edit('pyts')" >Edit Deposit</li>
        <li class="link" onclick = "view_pyt()" >Show Deposit Receipt</li>
      <li class="link" onclick = "remove_pyt('off')" >Delete a Deposit</li>
    <?php endif;?>
    <li class="link"  onclick = "recherche()" >Search Options</li>
    <li><?php echo $this->Html->link('Bookings Management', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
  </ul>
</div>

<!--paiement box-->
<?php echo $this->element('../paiements/edit',array('reste'=>0,'action'=>'add','deposit'=>true));?>
<div id="pyt_edit_boxe"></div>