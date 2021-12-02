<?php
require('config.php');
?>
<form action ="submit.php" method="post">
    <input type="hidden" name="total" value="<?php echo $_SESSION['total']?>">
<script
 src="https://checkout.stripe.com/checkout.js" class ="stripe-button"
 data-key ="<?php echo $publishablekey?>"
 data-amount = "<?php echo $_SESSION['total']*100?>"
 data-name="Super trendy"
 data-description ="rental fashion website"
 data-image =""
 data-currency="inr"
 >
 </script>
</form>