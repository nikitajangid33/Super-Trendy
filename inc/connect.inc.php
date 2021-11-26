<?php 
	$ccon=mysqli_connect("","root","root","grocerydb") or die("Couldn't connect to SQL server");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>