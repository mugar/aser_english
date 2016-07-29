<div id="mass_modification" title="Mass Modification" style="display:none">
  <div class="dialog">
    <span class="left">
    <?php 
      echo $this->element('combobox',array('n°'=>2));
      echo $this->Form->input('unite_id',array('label'=>'Measuring Unit','options'=>$unites,'selected'=>0));
    ?>
    </span>
    <span class="right">
      <?php
        echo $this->Form->input('type',array('options'=>$typeDeProduits1,
                          'selected'=>0,
                        'label'=>'Product Type'
                        ));
        if(Configure::read('aser.advanced_stock')) {
          echo $this->Form->input('acc',array('label'=>'Garnish',
                                'options'=>array(''=>'',
                                        'avec'=>'with',
                                        'acc'=>'is a garnish',
                                        'sans'=>'without'
                                        )
                                )
                      );
        }
        if(Configure::read('aser.comptabilite')) 
          echo $this->Form->input('groupe_comptable_id',array('options'=>$groupeComptables1));
          
        echo $this->Form->input('actif',array('label'=>'Actif',
                          'options'=>array(''=>'',
                                  'yes'=>'yes',
                                  'no'=>'no',                                   )
                              )
                    );
      ?>
    </span>
  </div>
</div>