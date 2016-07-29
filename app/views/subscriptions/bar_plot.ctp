<?php
App::import('Vendor','Graph',array('file' => 'jpgraph/jpgraph.php'));
App::import('Vendor','LinePlot', array('file' => 'jpgraph/jpgraph_bar.php'));
$data1y=$Yaxis1;
$data2y=$Yaxis2;
// Create the graph. These two calls are always required
$graph = new Graph(1310,400,"auto");    
$graph->SetScale("textlin");
//$graph->legend->Pos( 0.1,0.5,"right" ,"top");

$graph->SetShadow();
$graph->img->SetMargin(60,30,20,40);

// Create the bar plots
$b1plot = new BarPlot($data1y);
$b1plot->SetFillColor("orange");
$b1plot->SetLegend($year1);
$b1plot->value->Show();
$b1plot->value->SetFont(FF_FONT1,FS_BOLD);
//$b1plot->value->SetFormat('%0.1f');
$b2plot = new BarPlot($data2y);
$b2plot->SetFillColor("blue");
$b2plot->SetLegend($year2);
$b2plot->value->Show();
$b2plot->SetValuePos('bottom');
$b2plot->value->SetFont(FF_FONT1,FS_BOLD);
$b2plot->value->SetColor('red');

// Create the grouped bar plot
$gbplot = new GroupBarPlot(array($b1plot,$b2plot));

// ...and add it to the graPH
$graph->Add($gbplot);

$graph->title->Set('Comparaison de l\'an '.$year1.' et '.$year2.'');
$graph->xaxis->title->Set("mois");
// Specify X-labels
$graph->xaxis->SetTickLabels($percentage);
$graph->yaxis->title->Set("subscriptions");
$graph->yaxis->scale->SetGrace(20);
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
// Display the graph
$graph->Stroke();
?>
