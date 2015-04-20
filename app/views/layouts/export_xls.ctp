<?php
header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type:  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header ("Content-Disposition: attachment; filename=\"Rapport.xls" );
header ("Content-Description: Generated Report" );
?>
<?php echo $content_for_layout ?> 