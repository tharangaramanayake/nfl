<?php

include ("../res/x5engine.php");
$ecommerce = Configuration::getCart();
// Check the coupon code
if (@$_GET['action'] == 'chkcpn' && isset($_POST['coupon'])) {
	header('Content-type: application/json');
	echo $ecommerce->checkCoupon($_POST['coupon']);
	exit();
}
// Check the dynamic products status
else if (@$_GET['action'] == 'productstatus' && !isset($_POST['product_id']) && ($headers = imRequestHeaders()) !== false) {
	$token = "";
	foreach ($headers as $key => $value) {
		if (strtolower($key) == 'x-incomedia-wsx5-token') {
			$token = $value;
		}
	}
	if ($token == '662hj90t0wnjqi39d1wtk6s23lvgpjffy0jn5hlj') {
		header('Content-type: application/json');
		echo json_encode(array('data' => $ecommerce->getDynamicProductsStatus()));
		exit();
	}
}
// Check a single dynamic products status
else if (@$_GET['action'] == 'productstatus' && isset($_POST['product_id'])) {
	header('Content-type: application/json');
	echo $ecommerce->getDynamicProductQuantity(@$_POST['product_id']);
	exit();
}
// Download a digital product
else if (isset($_GET['download'])) {
	try {
		$ecommerce->startProductDownload($_GET['download']);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	exit();
}
else if (@$_GET['action'] == 'sndrdr' && isset($_POST['orderData'])) {
	$orderNo = $_POST['orderData']['orderNo'];
	$ecommerce->setOrderData($_POST['orderData']);
	$ecommerce->sendOwnerEmail();
	$ecommerce->sendCustomerEmail();
	header('Content-type: application/json');
	echo '{ "status": "ok", "orderNumber": "' . $orderNo . '" }';
	exit;
}

// End of file x5cart.php
