<?php
$logo=Configure::read('logo');
$html='<div id="view">
<div class="document">
<div id="entete">
	<div class="left">'.$this->element('company',array('short_version')).'
	</div>
	<div class="right"> 
		Date : <span id="dateId">'.date('d/m/Y').'</span><br/>
	</div>
	<div style="clear:both"></div>
</div>
<br />
<br />
<span class="titre">CONFIRMATION DE RESERVATION N° '.$id.'</span>
<br/>
<br/>
<div id="lettre">
Chère Madame, Cher Monsieur, Dear Madam, Dear Sir : <span style="font-weight:bold;">'.$reservation['Tier']['name'].'</span>
<br/>
<br/>
<br/>
Nous avons le plaisir de vous confirmer la réservation nexte :
<br/>
We have the pleasure to confirm the following reservation :
<br/>
<br/>
<br/>
Arrival le, check in :	<span class="red">'.$this->MugTime->toFrench($reservation['Reservation']['checked_in']).'</span>				
<br/>
Départ le, check out :  <span class="red">'.$this->MugTime->toFrench($reservation['Reservation']['depart']).'</span>	
<br/>
Type de chambre / type of room :   <span class="red">'.$reservation['Chambre']['TypeChambre']['name'].'</span>
<br/>
Prix de la chambre/room rate :   <span class="red">'.$number->format($reservation['Reservation']['PU'],$formatting).' '.$reservation['Reservation']['monnaie'].'</span>
<br/>
<br/>
<br/>
<span class="red">
Votre réservation est disponible à partir de 14h00 et votre départ devra se faire avant 13h00.
<br/>
Your reservation is available from 2:00 PM and check-out must be done before 1:00PM
</span>
<br/>
<br/>
Dans le cas d’un <strong>NO-SHOW</strong> ou d’une <strong>ANNULATION</strong> à moins de 24 heures avant la date du jour de votre arrivée, le prix de la première nuit vous sera facturé. In the évent of a <strong>NO-SHOW</strong> or a late <strong>CANCELLATION</strong> with less than 24 hours before the day of your arrival, the cost of the first night will be charged .
Dans l’attente de vous accueillir, nous vous prions de recevoir, Madame, Monsieur, l’assurance de nos meilleures salutations.
<br/>
<br/>
<br/>
Yours faithfully
<br/>
<br/>

La Direction/ the management.
<br/>
</div>
</div>
</div>';
$html.='<style>
div#lettre {
	text-align:left;
	font-size:15px;
	padding: 20px 30px 20px 30px;
}
div#lettre span.red {
	color:red;
}

div.document .table_center td{
	text-align:center;
}
div.document p {
	margin:60px 0 0 0;
	font-style: italic;
}
tr.first td {
	font-weight: bold;
	border-top:2px solid #333;
}
div.document .left {
	width:300px;
	float:left;
	line-height: 18px;
	text-align: left;
}
div.document .left .text {
	float:left;
	width:200px;
	height:100px;
	padding:0px 10px 10px 0px;
	text-align:left;
	margin-left:20px;
	line-height: 35px;
	margin-top:-20px;
/*	background:url(../img/star.jpg) top left no-repeat;*/
}

div.document .right {
	width:300px;
	float:right;
	text-align:right;
	line-height: 35px;
	margin-top:20px;
}
div.document .right span#dateId {
	font-size:15px;
}
div.document #bas_page {
	height:60px;
	line-height: 35px;
	margin:20px 0 60px 0;
	font-weight:bold;
}
div.document #bas_page .left {
	float:left;
	height:inherit;
	text-align:left;
	margin-top:10px;
	width:400px;
}

div.document #bas_page .right {
	float:right;
	height:inherit;
	text-align:right;
	margin-top:-10px;
	padding:0;
	width:400px;
}

div.document #bas_page .middle {
	width:200px;
	float:left;
	text-align:center;
	line-height: 35px;
	margin-left:300px;
}
div.document .left img {
	display:block;
	margin:10px 10px 50px 10px;
}
div#facture_details {
	color: #999;
	font-style: italic;
	border:1px dashed #999;
	border-radius: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	padding:5px;
	text-align:left;
	width: 200px;
	float:left;
	margin:0 0 20px -60px;
}
div.document .titre {
	display: block;
	color:black;
	font-size: 17px;
	font-weight: bold;
	text-decoration: underline;
}

.line {
	line-height: 50px;
}
div.document table {
	width:100%;
}
div.document .strong {
	font-weight: bold;
	border-top:2px solid #555 !important;
}
div.document h4,div.tabella h4{
	color:#0A246A;
}
</style>';

if($action==0){
	$html.='<style> div.document {
		float:left;
		width: 80%;
		margin:10px 20px 10px 10px;
		border:2px solid #555;
		padding: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
		-webkit-border-radius: 10px;
		-webkit-border-radius: 10px;
		text-align: center;
		} </style>';
	echo $html;
}	
else if($action==1){
	require_once(ROOT.'/vendors/mpdf/mpdf.php');
	$mpdf = new mPDF('utf-8', 'A4'); 
	
	$html.='<style> div.document {
		float:left;
		width: 100%;
		margin:10px 20px 10px 10px;
		border:2px solid #555;
		padding: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
		-webkit-border-radius: 10px;
		-webkit-border-radius: 10px;
		text-align: center;
		} </style>';
	
	$mpdf->WriteHTML($html); 
	$mpdf->Output('confirmation_'.$id.'.pdf','D');
	exit;
}