<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');


require_once ($_SERVER['DOCUMENT_ROOT'] . '/Resources/PHP/tcpdf/tcpdf.php');


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


//set Document informations
$pdf->SetCreator('PDF_CREATOR');
$pdf->SetAuthor('Exinit');
$pdf->SetTitle('Berichtheft');
$pdf->SetSubject('Berichtshefteintrag Nummer: ');
$pdf->SetKeywords('Berichtsheft, recordbook, PDF');

//set default header Data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Berichtsheft', '', array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);




// set default font subsetting mode
//$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
//$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Resources/Private/Layouts/print/styleDailyRecord.html');
$content .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Resources/Private/Layouts/print/mainDailyRecord.html');

/*
 * Hier müssen die Daten aus der Datenbank abgefragt, in die Tabellenspalten eingetragen und der
 * $conten Variable übergeben werden damit das pdf ordentlich angezeigt wird
 *
 *
 * <tr>
      <td style="width: 20%">Tag</td>
      <td style="width: 60%; text-align: left">Bericht zum angegebenen Tag</td>
      <td style="width: 20%">Stunden</td>
    </tr>

 */



$content .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Resources/Private/Layouts/print/mainSignature.html');
$pdf->writeHTML($content, true, false, true, false, '');

$pdf->Output('Exinit-Berichtsheft.pdf', 'I');

?>







