
<div class="dialog">
<?php echo $this->Form->create('Paiement',array('id'=>'edit_form'));?>
  <span class="left">
    <?php
    echo $this->Form->input('id');
    echo $this->Form->input('date',array('type'=>'text','label'=>'Payment Date','id'=>'Date'));
    echo $this->Form->input('tier_id',array('label'=>'Customer Name'));
    echo $this->Form->input('facture_number',array('label'=>'Invoice N°'));
    echo $this->Form->input('operation',array('label'=>'Invoice Type','options'=>$models));
  ?>
  </span>
   <span class="right">
    <?php
         echo $this->Form->input('montant',array('label'=>'Amount'));
        echo $this->Form->input('monnaie',array('id'=>'monnaie','label'=>'Currency'));
        echo $this->Form->input('mode_paiement',array('id'=>'mode','label'=>'Payment Mode'));
        echo $this->Form->input('reference',array('label'=>'Reference'));
        ?>
    </span>
  </form>
<div style="clear:both"></div>
</div>