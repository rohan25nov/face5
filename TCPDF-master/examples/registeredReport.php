<?php
session_start();
if(isset($_SESSION['admin'])):
    ini_set('max_execution_time', 300);
require_once('tcpdf_include.php');
include '../../sql.php';
$i=0;
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$fontpac = TCPDF_FONTS::addTTFfont('../../ttffont/Pacifico.ttf', 'TrueTypeUnicode', '', 32);
$fontalex = TCPDF_FONTS::addTTFfont('../../ttffont/Montez-Regular.ttf', 'TrueTypeUnicode', '',32);
//$pdf->AddPage();
$id=$_GET['id'];
$pdf->SetAutoPageBreak(true, 0);
$pdf->setJPEGQuality(75);
$str="select * from userdetails where ActiveFlag=1 and id='$id'";
$res=mysqli_query($sql,$str);
$arr=mysqli_fetch_assoc($res);
$arrimage=substr($arr['image'],22);
$caddr=$arr['address']."<br/>".$arr['street']."<br/>".$arr['city']."<br/>".$arr['state']."-".$arr['pincode'];
$caddr1=$arr['address']."\n".$arr['street']."\n".$arr['city']."\n".$arr['state']."-".$arr['pincode'];
require_once(dirname(__FILE__).'/tcpdf_barcodes_1d_include.php');
require_once(dirname(__FILE__).'/tcpdf_barcodes_2d_include.php');
//$barcodeobj = new TCPDFBarcode("www.facebook.com", 'C128');
//$qrcodeobj = new TCPDF2DBarcode('localhost/face5/TCPDF-master/examples/registeredReport.php?id='.$id, 'QRCODE,H');

$params = $pdf->serializeTCPDFtagParameters(array($arr['name']."\n".$arr['mobile']."\nADDRESS:\n".$caddr1, 'C128', '', '', 185, 20, 0.4, array('position'=>'S', 'border'=>true, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>false, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
$params1 = $pdf->serializeTCPDFtagParameters(array($arr['name']."\n".$arr['mobile']."\n".$arr['email']."\nADDRESS:\n".$caddr1, 'QRCODE', 135, 93, 32, 32, array('position'=>'S', 'border'=>true, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));

$html="<html><head><link rel=\"stylesheet\" href=\"../../include/bootstrap.min.css\"></head><body style=\"color:black;\"><br/>";
$html.="<table width=\"100%\"><tr><td style=\"font-size: 12px;text-align: left;font-weight: bold;color: #112266;\">Created on : ".date('d-M-Y h:i:s A')." </td><td style=\"font-size: 9px;text-align: right;color: #112266;padding-right: 2%;font-family: ".$fontpac."\">Originated by Gensys</td></tr></table><br/><br/>";
$html.="<table cellpadding=\"5px\" style=\"font-weight: bold;color: black;\" border=\"1\" width=\"100%\"><tr><td colspan=\"2\" style=\"font-size: 25px;text-align: center\">USER DETAILS</td></tr>";
$html.="<tr><th>Name : ".strtoupper($arr['name'])." </th><th rowspan=\"4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"".$arr['image']."\" height=\"125\" width=\"150\" /></th></tr>";
$html.="<tr><th>Mobile : ".$arr['mobile']." </th></tr>";
$html.="<tr><th>Email : ".$arr['email']." </th></tr>";
$html.="<tr><th><br/>Gender : ".strtoupper($arr['gender'])." </th></tr>";
$html.="<tr style=\"height: 25px\"><th><br/>Address : ".$caddr."<br/><br/><br/></th><th rowspan=\"3\"><tcpdf method=\"write2DBarcode\" params=\"".$params1."\" /></th></tr>";
$html.="<tr><td colspan=\"2\"><tcpdf method=\"write1DBarcode\" params=\"".$params."\" /></td></tr>";
$html.="</table>";


$html.="</div></body></html>";
$pdf->AddPage();
$pdf->setPageMark();
$pdf->setTextColor(245,245,245);
$pdf->writeHTML($html, true, 0);


$pdf->lastPage();
$pdf->Output("User-".strtoupper($arr['name'])."-".$arr['mobile'].".pdf", 'I');
else:
    header("Location: ../../index.html");
endif;
?>