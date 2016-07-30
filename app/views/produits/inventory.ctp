<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
      jQuery( "#Date" ).datepicker( "option", "maxDate", new Date() );
    
  });
</script>
<div id='view'>
<div class="document">
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
  <div id="message_recherche"></div>
  <?php echo $this->Form->create('Produit',array('id'=>'recherche','action'=>'inventory'));?>
  <span class="left">
    <?php
      echo $this->Form->input('stock_id',array('label'=>"Store"));
      // echo $this->element('combobox',array('n°'=>1));
      // echo $this->Form->input('produit_id',array('options'=>$list,'selected'=>0,'id'=>'produits'));
    ?>
  </span>
  <span class="right">
    <?php
       echo $this->Form->input('date',array('label'=>'Date','id'=>'Date'));
      // echo $this->Form->input('export',array('label'=>'Export to excel','type'=>'checkbox'));
    ?>
  </span>
  </form>
<div style="clear:both"></div>
</div>
</div>

<?php if(!$show_data):?>
<h3 id="inventory" 
    stock_id="0" 
    date="null" 
>
Please use the search options on right menu to select a store and a date to show.
</h3>
<?php else:?>
<h3 id="inventory" 
    stock_id="<?php echo $stock_id;?>" 
    date="<?php echo $date;?>" 
>
 Inventory Movements
</h3>
<?php
      echo '<h4> Store : '.strtoupper($stocks[$stock_id]).'</h4>';
      echo '<h4> Date : '.$this->MugTime->toFrench($date).'</h4>';
    
?>
<br />  
<br />
<?php echo $this->Form->create('Produit',array('name'=>'checkbox','id'=>'Produit_produits','action'=>'index'));?> 
<table cellpadding="0" cellspacing="0" id="recherche">
  <tr class="border">
      <th rowspan="2"><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
      <th rowspan="2" style="width: 200px;">Products</th>
      <th rowspan="2">Intial Qty</th>
      <th rowspan="2">Entry</th>
      <th colspan="2">Transfers</th>
      <th rowspan="2">Sale</th>
      <th rowspan="2">Consumption</th>
      <th rowspan="2">Loss</th>
      <th rowspan="2">Final Qty</th>
      <th rowspan="2">Exit Qty</th>
    
  </tr>
  <tr class="border">
      <th>IN</th>
      <th>OUT</th>
  </tr>
    <?php
    $i=0;
  foreach ($mouvements as $mouvement):
    $i++;
  ?>
  <tr id="<?php echo $mouvement['Produit']['id'];?>">
    <td>
      <?php echo $this->Form->input('Id.'.$mouvement['Produit']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$mouvement['Produit']['id'])); ?>
    </td>
    <td>
      <?php echo $this->Html->link($mouvement['Produit']['name'], array('controller' => 'produits', 'action' => 'view', $mouvement['Produit']['id'],$stock_id)); ?>
    </td>
      <td><?php echo  $mouvement['Produit']['initial_quantity']; ?></td>
      <td name="Entree"  ><input style="width:40px;" onchange="create_inventory_operation(this);" type="text" value="<?php echo $mouvement['Produit']['Entry']; ?>"/></td>
      <td name="transfer_in"><input style="width:40px;" onchange="create_inventory_operation(this);" type="text" value="<?php echo $mouvement['Produit']['Transfer_in']; ?>"/></td>
      <td name="transfer_out"  ><input style="width:40px;" onchange="create_inventory_operation(this);" type="text" value="<?php echo $mouvement['Produit']['Transfer_out']; ?>"/></td>
      <td name="Vente"  ><input style="width:40px;" onchange="create_inventory_operation(this);" type="text" value="<?php echo $mouvement['Produit']['Sale']; ?>"/></td>
      <td name="Sorti"  ><input style="width:40px;" onchange="create_inventory_operation(this);" type="text" value="<?php echo $mouvement['Produit']['Consumption']; ?>"/></td>
      <td name="Perte"  ><input style="width:40px;" onchange="create_inventory_operation(this);" type="text" value="<?php echo $mouvement['Produit']['Consumption']; ?>"/></td>
      <td name="FinalStock"><input style="width:40px;" onchange="create_inventory_operation(this);" type="text" value="<?php echo $mouvement['Produit']['final_quantity']; ?>"/></td>
      <td name="exit_quantity"><?php echo  $mouvement['Produit']['exit_quantity']; ?></td>
  </tr>
<?php endforeach; ?>
</table>
</form>
<?php endif;?>
<br />
<br />
<div class="bas_page" style="display: none;">
  <div class="left">
    <?php  
    echo 'Controleur';
  ?>
  </div>
  
  <div class="middle">
    <?php  
    echo 'DAF';
  ?>
  </div>
  
  <div class="right"><?php  
    echo 'Barman';
  ?>
  </div>
  <div style="clear:both"></div>
</div>
</div>
</div>
<div class="actions">
  <h3><?php __('Actions'); ?></h3>
  <ul>
    <li class="link"  onclick = "print_documents()" >Print</li>
    <li class="link"  onclick = "recherche()" >Search Options</li>
    <li class= "link" onclick = "edit('checkbox',true)" >Edit</li>
    <li class= "link" onclick = "mass_delete()">Delete</li>
    <li  class="link" onclick = "mass_modification()" >Mass Modification</li>
    <li><?php echo $this->Html->link('Products Management', array('action' => 'index')); ?></li>
    <li><?php echo $this->Html->link('Inventory Operations', array('controller'=>'historiques','action' => 'index')); ?></li>
  </ul>
</div>



<!-- transfer form -->
<div id="transfer_boxe" style="display:none" title="Transfer Boxe">
<div class="dialog">
  <div id="message_recherche"></div>
  <?php echo $this->Form->create('Produit');?>
  <span class="left">
    <?php
      echo '<label id="transfer_label"></label>';
      echo $this->Form->input('stock_id',array('id'=>'transfer_stock','label'=>"",'options'=>$transfer_stores));
    ?>
  </span>
  <span class="right">
    <?php
    ?>
  </span>
  </form>
<div style="clear:both"></div>
</div>
</div>

<!-- form for mass modification -->
<?php echo $this->element('../produits/mass_modification');?>