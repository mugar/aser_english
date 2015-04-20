<?php 
$filename=$this->MugTime->excel($datas);
//echo $this->Html->link('Test excel', '/files/'.$filename); 
readfile('/var/www/test.xlsx');
?>
