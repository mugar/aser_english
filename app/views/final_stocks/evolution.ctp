<?php
App::import('Vendor','Graph',array('file' => 'jpgraph/jpgraph.php'));
App::import('Vendor','LinePlot', array('file' => 'jpgraph/jpgraph_line.php'));
$ydata =$Yaxis;

// Create the graph. These two calls are always required
$graph = new Graph(1000,700);
$graph->SetScale('textlin');
$graph->title->Set ('Courbe de croissance des final_stocks par jour');
$graph->img-> SetMargin(60,20 ,60,60); 
$graph->xaxis-> SetTickLabels($Xaxis);
$graph->xaxis-> title->Set("Jours" );
// Create the linear plot
$lineplot=new LinePlot($ydata);
$lineplot->SetColor('red');
 $lineplot->SetFillColor('green');
 
// Ajouter the plot to the graph
$graph->Add($lineplot);
 
// Display the graph
$graph->Stroke(); 

