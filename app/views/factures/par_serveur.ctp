<?php
App::import('Vendor','Graph',array('file' => 'jpgraph/jpgraph.php'));
App::import('Vendor','PieGraph', array('file' => 'jpgraph/jpgraph_pie.php'));
?>
<?php
// Create the Pie Graph.
$graph = new PieGraph(1300,650,"auto");
$graph->SetShadow();
$graph ->legend->Pos( 0.1,0.5,"right" ,"center");
$graph->title->SetMargin (20); 

$periode=(!is_null($date1)&&!is_null($date2))?("pour la periode entre le $date1 to $date2"):('');
// Set A title for the plot
$graph->title->Set("Repartition des Factures par Personnel $periode");

// Create plots
$size=150;
$p1 = new PiePlot($value);
$p1->SetLegends($legend);
$p1->SetSize($size);
$p1->SetGuideLines(true,false);
$p1->SetGuideLinesAdjust(1.1,3);
$p1->SetCenter(400,350);
$p1->title->SetMargin(45);
$p1->SetSliceColors(array('red','gray','pink','cyan','maroon','orange','yellow','green','purple','blue','brown','black','white','violet')); 
$graph->Add($p1);
$graph->Stroke();
?>

