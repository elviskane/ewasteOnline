<?php
include'modules/header.php';
if(isset($_GET['inventory'])){
   
    
    $generated = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')) )), 0, 10);//FUNCTION USED TO GENERATE RANDOM UNIQUE FILENAME TO BE USED TO PDF NAME FILE CREATED 
    $filename=$generated;
require_once('tcpdf/tcpdf.php');//IMPORT LIBRARY TO CREATE PDF FILES

	// Load table data from file
	function LoadData() {
        $data='';
        $dbconnect=mysqli_connect("localhost","root","","ewastedb");
		 $inventres=$dbconnect->query("select * from inventory");
        while($res=mysqli_fetch_assoc($inventres)){
            $data .= '<tr>
                        <td>'.$res['inventoryKey'].'</td>
                        <td>'.$res['cartKey'].'</td>
                        <td>'.$res['deviceKey'].'</td>
                        <td>'.$res['recyclerKey'].'</td>
                        <td>'.$res['deviceName'].'</td>
                        <td>'.$res['serialNumber'].'</td>
                        <td>'.$res['quantity'].'</td>
                        <td>'.$res['age'].'</td>
                        <td>'.$res['sellDate'].'</td>    
            
                     </tr>';
        }
		return $data;
	}
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Inventory');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data

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

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();
    $html='';
$html .='<h2 align="center">INVENTORY REPORT</h2><hr/><br/>
                    <table border="1" cellspacing="0" cellpadding="3" padding="5px">
                        <tr>
                            <th width="8%">No</th>
                            <th width="8%">CartId</th>
                            <th width="12%">DeviceId</th>
                            <th width="13%">RecyclerId</th>
                            <th width="15%">DeviceName</th>
                            <th width="18%">SerialNumber</th>
                            <th width="10%">Quantity</th>
                            <th width="7%">Age</th>
                            <th width="10%">SellDate</th>
                        </tr><br/>
                        <tbody>';
// data loading
$html .= LoadData();
$html .='</tbody>
                    </table>';

// ---------------------------------------------------------

// close and output PDF document
$pdf->WriteHTML($html);//CONVERT HTML CONTENT TO PDF FILE
$pdf->Output(BASEURL.'reports/inventory_'.$filename.'.pdf', 'FI');//FI MEANS TO CREATE PDF FILE AS WELL AS VIEW IT ON THE BROWSER

}
//payment
if(isset($_GET['pay'])){
    
   
    
    $generated = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')) )), 0, 10);//FUNCTION USED TO GENERATE RANDOM UNIQUE FILENAME TO BE USED TO PDF NAME FILE CREATED 
    $filename=$generated;
require_once('tcpdf/tcpdf.php');//IMPORT LIBRARY TO CREATE PDF FILES

	// Load table data from file
	function LoadData() {
        $data='';
        $dbconnect=mysqli_connect("localhost","root","","ewastedb");
		 $recyclerres=$dbconnect->query("select * from recycler_payment");
        while($res=mysqli_fetch_assoc($recyclerres)){
            $paystate=$res['paymentStatus'];
                            $recid=$res['recyclerKey'];
                            $recres=$dbconnect->prepare("select * from recycler where recyclerKey=?");
                            $recres->bind_param("i",$recid);
                            $recres->execute();
                            $rec=$recres->get_result()->fetch_array();
                            $names=$rec['recyclerEmail'];
            $data .= '<tr>
                        <td>'.$res['recycler_paymentkey'].'</td>
                        <td>'.$names.'</td>
                        <td>'.$res['ammount'].'</td>
                        <td>'.$res['mpesaCode'].'</td>
                        <td>'.$res['paymentStatus'].'</td>           
                     </tr>';
        }
		return $data;
	}
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Recycler_payment');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data

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

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();
    $html='';
$html .='<h2 align="center">RECYCLER PAYMENT REPORT</h2><hr/><br/>
                    <table border="1" cellspacing="0" cellpadding="3" padding="5px">
                        <tr>
                            <th width="15%">Recycler id</th>
                            <th width="25%">Recycler Email</th>
                            <th width="15%">Ammount</th>
                            <th width="25%">MpesaCode</th>
                            <th width="20%">Payment Status</th>
                        </tr><br/>
                        <tbody>';
// data loading
$html .= LoadData();
$html .='</tbody>
                    </table>';

// ---------------------------------------------------------

// close and output PDF document
$pdf->WriteHTML($html);//CONVERT HTML CONTENT TO PDF FILE
$pdf->Output(BASEURL.'reports/payment_'.$filename.'.pdf', 'FI');//FI MEANS TO CREATE PDF FILE AS WELL AS VIEW IT ON THE BROWSER

}
?>