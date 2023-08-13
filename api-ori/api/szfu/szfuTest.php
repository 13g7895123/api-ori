<?php

// ***** 只接受A網站訪問 *****
header("Access-Control-Allow-Origin: https://paygo.tw/");
// header("Access-Control-Allow-Origin: *");

// ***** 引用Class *****
// include_once('./webClass.php');

// ***** 取得A網站傳過來的資料 *****
if (isset($_POST['foran'])){
	$foran = $_POST['foran'];
}else{
	// web::err_responce('伺服器資料錯誤-8000201。');	// 沿用原本網站錯誤訊息
	return;
}
if (isset($_POST['serverid'])){
	$serverid = $_POST['serverid'];
}else{
	// web::err_responce('伺服器資料錯誤-8000202。');	// 沿用原本網站錯誤訊息
	return;
}
if (isset($_POST['lastan'])){
	$lastan = $_POST['lastan'];
}else{
	// web::err_responce('伺服器資料錯誤-8000203。');	// 沿用原本網站錯誤訊息
	return;
}

echo json_encode([
	'foran' => $foran,
	'serverid' => $serverid,
	'lastan' => $lastan
])

?>

<!-- <body>
<form id="fff" method="post" action="<?=$_POST['gurl']?>">	
	<input type="hidden" name="ChoosePayment" value="<?=$_POST['ChoosePayment']?>">
	<input type="hidden" name="ChooseSubPayment" value="<?=$_POST['ChooseSubPayment']?>">
	<input type="hidden" name="EncryptType" value="<?=$_POST['EncryptType']?>">
	<input type="hidden" name="ItemName" value="<?=$_POST['ItemName']?>">
	<input type="hidden" name="MerchantID" value="<?=$_POST['MerchantID']?>">
	<input type="hidden" name="MerchantTradeDate" value="<?=$_POST['MerchantTradeDate']?>">
	<input type="hidden" name="MerchantTradeNo" value="<?=$_POST['MerchantTradeNo']?>">	
	<input type="hidden" name="ClientRedirectURL" value="<?=$_POST['ClientRedirectURL']?>">	
	<input type="hidden" name="PaymentType" value="<?=$_POST['PaymentType']?>">	
	<input type="hidden" name="ReturnURL" value="<?=$_POST['ReturnURL']?>">	
	<input type="hidden" name="TotalAmount" value="<?=$_POST['TotalAmount']?>">
	<input type="hidden" name="TradeDesc" value="<?=$_POST['TradeDesc']?>">
	<input type="hidden" name="CheckMacValue" value="<?=$_POST['CheckMacValue']?>">	
</form>

<script type="text/javascript">
	document.getElementById('fff').submit();
</script>
</body> -->

