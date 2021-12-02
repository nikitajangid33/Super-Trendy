<?php
require('stripe-php-master/init.php');
$publishablekey = "pk_test_51K1u6DSIuWqVqAKblpFqFo5nAkw9vLlmOM4WTcgFueQusJIVU64ikdV315kxdqLlqsWeIJoRu4Z3ymOOwpu8AZlB00rWIMs7gc";
$secretkey = "sk_test_51K1u6DSIuWqVqAKbMegkcCfTsJBhurYTFjanmfQ79hUsbgFZ4o4bIwcWF2kStJ0cpcO2iNhgrm5A4h74ywPnZeU500Rh7samvA";

\Stripe\Stripe::setApiKey($secretkey);


?>