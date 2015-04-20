<?php
header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/file");
header ('Content-Disposition: attachment; filename="aser_'.date('Y-m-d').'.sql"');
header ("Content-Description: backup generation" );
?>
<?php echo $content_for_layout ?> 
