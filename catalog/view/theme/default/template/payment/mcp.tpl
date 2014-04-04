<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body onLoad="return document.payment_form.submit();">
<!--body-->
<div align="center">
</div>
<form name="payment_form" method="post" action="https://webpaytest.mcpayment.net/WebPay/post/submit">
<input type="hidden" name="mid" value="<?php echo $mid; ?>">
<input type="hidden" name="txntype" value="SALE">
<input type="hidden" name="ref" value="<? echo $ref; ?>">
<input type="hidden" name="cur" value="SGD">
<input type="hidden" name="amt" value="<?php echo $amt; ?>">
<input type="hidden" name="shop" value="TestShop"> 
<input type="hidden" name="buyer" value="<?php echo $buyer; ?>">
<input type="hidden" name="tel" value="<?php echo $tel; ?>">
<input type="hidden" name="email" value="<?php echo $email; ?>">
<input type="hidden" name="product" value="<?php echo $product; ?>">
<input type="hidden" name="lang" value="EN">
<input type="hidden" name="returnurl" value="<? echo $base; ?>">
<input type="hidden" name="statusurl" value="<? echo $base; ?>" >
<input type="hidden" name="param1" value="-">
<input type="hidden" name="param2" value="-">
<input type="hidden" name="param3" value="-">
<input type="hidden" name="charset" value="UTF-8">
<input type="hidden" name="fgkey" value="<?php echo $fgkey; ?>">
<input type="submit" value="Submit">
</form>
</body>
