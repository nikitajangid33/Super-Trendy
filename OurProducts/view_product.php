<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($ccon,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}
if (isset($_REQUEST['pid'])) {
	
	$pid =$_REQUEST['pid'];
}else {
	header('location: index.php');
}


$getposts = mysqli_query($ccon,"SELECT * FROM products WHERE id ='$pid'") or die(mysqli_error());
					if (mysqli_num_rows($getposts)) {
						$row = mysqli_fetch_assoc($getposts);
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$piece=$row['piece'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						$available =$row['available'];
					}	


if (isset($_POST['addcart'])) {
	$getposts = mysqli_query($ccon,"SELECT * FROM cart WHERE pid ='$pid' AND uid='$user'") or die(mysqli_error($ccon));
	if (mysqli_num_rows($getposts)) {
		header('location: ../mycart.php?uid='.$user.'');
	}else{
		if(mysqli_query($ccon,"INSERT INTO cart (uid,pid,quantity) VALUES ('$user','$pid', 1)")){
			header('location: ../mycart.php?uid='.$user.'');
		}else{
			header('location: ../index.php');
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>View-Prod</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include ( "../inc/mainheader.inc.php" ); ?>
	<div class="categolis">
		<table>
			<tr>
                <th>
                    <a href="MenWomenWear.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Men & Women Wear</a>
                </th>
                <th><a href="Seasonings.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #24bfae;border-radius: 12px;">Seasonings</a></th>
                <th><a href="Drinks.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Drinks</a></th>
                <th><a href="Accessories.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Accessories</a></th>
                <th><a href="FootWear.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">FootWear</a></th>
                <th><a href="Watches.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Watches</a></th>
                <th><a href="PartyWear.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">PartyWear</a></th>
                <th><a href="KidFashion.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">KidFashion</a></th>
			</tr>
		</table>
	</div>
	<div style="margin: 0 97px; padding: 10px">

		<?php 
			echo '
				<div style="float: left;">
				<div>
					<img src="../image/product/'.$item.'/'.$picture.'" style="height: 500px; width: 500px; padding: 2px; border: 2px solid #c7587e;">
				</div>
				</div>
				<div style="float: right;width: 40%;color: #067165;background-color: #ddd;padding: 10px;">
					<div style="">
						<h3 style="font-size: 25px; font-weight: bold; ">'.$pName.'</h3><hr>
						<h3 style="padding: 20px 0 0 0; font-size: 20px;">Price: '.$price.'Php</h3><hr>
						<h3 style="padding: 20px 0 0 0; font-size: 22px; ">Pieces:'.$piece.'</h3>
						<h3 style="padding: 20px 0 0 0; font-size: 22px; ">Description:</h3>
						<p>
							'.$description.'
						</p>

						<div>
							<h3 style="padding: 20px 0 5px 0; font-size: 20px;">Want to buy this product? </h3>
							<div id="srcheader">
								<form id="" method="post" action="">
								        <input type="submit" name="addcart" value="Add to cart" class="srcbutton" >
								</form><br/>
								<form id="" method="post" action="../orderform.php?poid='.$pid.'">
								        <input type="submit" value="Order Now" class="srcbutton" >
								</form>
								<div class="srcclear"></div>
							</div>
						</div>

					</div>
				</div>

			';
		?>

	</div>
</body>
</html>