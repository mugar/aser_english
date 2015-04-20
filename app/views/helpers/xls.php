<?php
/**
* This xls helper is based on the one at
* http://bakery.cakephp.org/articles/view/excel-xls-helper
*
* The difference compared with the original one is this helper
* actually creates an xml which is openable in Microsoft Excel.
*
* Written by Yuen Ying Kit @ ykyuen.wordpress.com
*
*/
class XlsHelper extends AppHelper {
/**
* set the header of the http response.
*
* @param unknown_type $filename
*/
function setHeader($filename) {
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Type: application/force-download");
header("Content-Type: application/download");;
//header("Content-Disposition: inline; filename=\"".$filename.".xml\"");
// Name the file to .xlsx to solve the excel/openoffice file opening problem
header("Content-Disposition: inline; filename=\"".$filename.".xls\"");
}

/**
* add the xml header for the .xls file.
*
*/
function addXmlHeader() {
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "\n";
return;
}

/**
* add the worksheet name for the .xls.
* it has to be added otherwise the xml format is incomplete.
*
* @param unknown_type $workSheetName
*/
function setWorkSheetName($workSheetName) {
echo "\t\n";
echo "\t\t\n";
return;
}

/**
* add the footer to the end of xml.
* it has to be added otherwise the xml format is incomplete.
*
*/
function addXmlFooter() {
echo "\t\t\n";
echo "\t\n";
echo "\n";
return;
}

/**
* move to the next row in the .xls.
* must be used with closeRow() in pair.
*
*/
function openRow() {
echo "\t\t\t\n";
return;
}

/**
* end the row in the .xls.
* must be used with openRow() in pair.
*
*/
function closeRow() {
echo "\t\t\t\n";
return;
}

/**
* Write the content of a cell in number format
*
* @param unknown_type $Value
*/
function writeNumber($Value) {
if (is_null($Value)) {
echo "\t\t\t\t \n";
} else {
echo "\t\t\t\t".$Value."\n";
}
return;
}

/**
* Write the content of a cell in string format
*
* @param unknown_type $Value
*/
function writeString($Value) {
echo "\t\t\t\t".$Value."\n";
return;
}
}
?>