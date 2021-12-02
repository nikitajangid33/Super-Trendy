<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	header("location: login.php");
	$user = "";
}
else {
	$user = $_SESSION['admin_login'];
	$result = mysqli_query($ccon,"SELECT * FROM admin WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$utype_db=$get_user_email['type'];
			if($utype_db == 'staff'){
				header("location: login.php");
			}
}



require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$sales_report = new Dompdf();
$page = file_get_contents("sales_report_pdf.php");


$output = '
		<html>
		<head>
			<title>Welcome to Super Trendy</title>
			<link rel="stylesheet" type="text/css" href="../css/style.css">
		</head>
		<body style="">
		<div style="width:400px; margin: 2% 17%;">
		<h2 style="text-align: center; padding: 10px;">Sales Report</h2>
			<table class="rightsidemenu">
				<tr style="font-weight: bold;" colspan="10" bgcolor="#4DB849">
					<th>Customer Id</th>
					<th>Customer Name</th>
					<th>Product Name</th>
					<th>Payment</th>
				</tr>
				';

$total = 0;
$query = "SELECT * FROM orders WHERE dstatus='yes' ORDER BY id DESC";
$run = mysqli_query($ccon,$query);
while ($row=mysqli_fetch_assoc($run)) {
	$uid = $row['uid'];
	$productId = $row['pid'];
	$quantity = $row['quantity'];
	$query1 = "SELECT * FROM user WHERE id='$uid'";
	$run1 = mysqli_query($ccon,$query1);
	$row1=mysqli_fetch_assoc($run1);
	$FirstName = $row1['firstName'];

	$query2 = "SELECT * FROM products WHERE id='$productId'";
	$run2 = mysqli_query($ccon,$query2);
	$row2=mysqli_fetch_assoc($run2);
	$pPrice = $row2['price'];
	$pName=$row2['pName'];
	$payment = $pPrice * $quantity;
	$total+=$payment;
	$output .=
			'<tr><th>'.$uid.'</th>
			<th>'.$FirstName.'</th>
			<th>'.$pName.'</th>
			<th>'.$payment.'Php</th>
			</tr>';
}

$output .= 
				'<tr style="font-weight: bold;" colspan="10" bgcolor="#4DB849">
					<th>Total Sales</th>
					<th></th>
					<th></th>
					<th>'.$total.'Php</th>
				</tr>
			</table>
		</div></body>';

$doc = new \DOMDocument();
$doc->loadHTML($output);
$filenew = $doc->saveHTML();
$salesreport = html2pdf($filenew);

header("Location: ../loadfile.php?p=tmp/". $salesreport ."&filename=salesreport"); /* Redirect browser */
exit();

function html2pdf($html_string,$fileName=NULL){
    $rand_value = rand(10,9999999);
    $rand_value1 = rand(10,9999999);
    $date = date('Ymdhis', time());
    if($fileName){
        $file_name=$fileName;
        $file_name_html = _PATH_."/tmp/".$rand_value.$rand_value1."_date_".$date;
    }else{
        $file_name = "../tmp/".$rand_value.$rand_value1."_date_".$date;
        $file_name_html = "../tmp/".$rand_value.$rand_value1."_date_".$date;
    }
    $file = fopen($file_name_html.".html", 'w+');
    fwrite($file, $html_string);
    fclose($file);
    $cmd = '"c:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe" '.$file_name.".html ".$file_name.".pdf";

    shell_exec($cmd);
    unlink($file_name_html.".html");
    if(file_exists($file_name.".pdf")) {
        return basename($file_name.".pdf");
    }
    return null;
}



?>


