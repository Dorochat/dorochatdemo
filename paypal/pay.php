<?php
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
require "app/start.php";

if(!isset($_GET['success'],$_GET['paymentId'],$_GET['PayerID'])){

	echo "Paypal could not charge your account.";

	die();

}


if((bool)$_GET['success']===false){

	echo "You have decided to cancel payment please let us know if there's something else we can do for you!";


	die();

}

$paymentId=$_GET['paymentId'];
$PayerID= $_GET['PayerID'];

$payment= Payment::get($paymentId, $paypal);

$Execution= new PaymentExecution();
$Execution->setPayerID($PayerID);


try{

	$result= $payment->execute($Execution, $paypal);

}
catch(Exception $e){

	$data= json_decode($e->getData());
	echo $data->message;

	die();

}


echo "Payment made successfully Thank you so much!";

?>