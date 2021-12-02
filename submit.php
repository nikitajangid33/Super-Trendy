<?php
require('config.php');
$total=$_POST['total'];
if(isset($_POST['stripeToken'])){
	\Stripe\stripe::setVerifySslCerts(false);
$token = $_POST['stripeToken'];
\Stripe\Charge::create(array(
"amount"=>$total,
"currency"=>"inr",
"description"=>"rental fashion website",
"source"=>$token,));
?>

    <script>
    alert("We will call you for confirmation very soon");
    </script>
<?php
    require_once 'orderform.php';
}
?>