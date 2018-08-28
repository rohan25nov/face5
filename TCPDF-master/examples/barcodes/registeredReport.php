<?php
session_start();
if(isset($_SESSION['admin'])):
ini_set('max_execution_time', 300);
require_once('../tcpdf_include.php');
include '../../../sql.php';
$i=0;
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/../lang/eng.php');
    $pdf->setLanguageArray($l);
}
$fontpac = TCPDF_FONTS::addTTFfont('../../../ttffont/Pacifico.ttf', 'TrueTypeUnicode', '', 32);
$fontalex = TCPDF_FONTS::addTTFfont('../../../ttffont/Montez-Regular.ttf', 'TrueTypeUnicode', '',32);
//$pdf->AddPage();
$id=$_GET['id'];
$pdf->SetAutoPageBreak(true, 0);
$str="select * from userdetails where ActiveFlag=1 and id='$id'";
$res=mysqli_query($sql,$str);
$arr=mysqli_fetch_assoc($res);
$caddr=$arr['address']." ".$arr['street']." ".$arr['city']." ".$arr['state']." ".$arr['pincode'];
require_once(dirname(__FILE__).'/tcpdf_barcodes_1d_include.php');
require_once(dirname(__FILE__).'/tcpdf_barcodes_2d_include.php');
$barcodeobj = new TCPDFBarcode('http://www.facebook.com', 'C128');
$qrcodeobj = new TCPDF2DBarcode('localhost/face5/TCPDF-master/examples/registeredReport.php', 'QRCODE,H');

$html="<html><head><link rel=\"stylesheet\" href=\"../../../include/bootstrap.min.css\"></head><body style=\"color:black;\"><h1></h1>";
$html.="<table width=\"100%\"><tr><td style=\"font-size: 25px;text-align: left;\">Date : </td><td style=\"font-size: 25px;text-align: right;font-family: ".$fontpac."\">Originated by</td></tr></table>";
$html.="<table cellpadding=\"5px\" style=\"font-family: ".$fontpac."\" border=\"1\" width=\"100%\"><tr><td colspan=\"2\" style=\"font-size: 25px;text-align: center\">USER DETAILS</td></tr>";
$html.="<tr><th style=\"font-family: ".$fontpac."\">Name : ".$arr['name']." </th><th rowspan=\"3\"><img src=".$arr['image']."/></th></tr>";
$html.="<tr><th style=\"font-family: ".$fontpac."\">Mobile : ".$arr['mobile']." </th></tr>";
$html.="<tr><th style=\"font-family: ".$fontpac."\">Email : ".$arr['email']." </th></tr>";
$html.="<tr><th style=\"font-family: ".$fontpac."\">Gender : ".$arr['gender']." </th><th rowspan=\"3\"></th>".$qrcodeobj->getBarcodeHTML(6, 6, 'black')."</tr>";
$html.="<tr><th style=\"font-family: ".$fontpac."\">Address : ".$caddr."</th></tr>";
$html.="<tr><th colspan=\"2\">".$barcodeobj->getBarcodeHTML(1, 30, 'black')."</th></tr>";
$html.="</table>";






$html.="</div></body></html>";
$pdf->AddPage();
$pdf->setPageMark();
$pdf->setTextColor(245,245,245);
$pdf->writeHTML($html, true, 0);


$pdf->lastPage();
$pdf->Output('ReportBlockWise.pdf', 'I');
else:
    header("Location: ../../../index.html");
endif;
?>