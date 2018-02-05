<?php
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
require "app/start.php";

$product= "WhatsApp clone using Bootstrap,php and Websocket";

$amount= 20;

$shipping= 2.00;

$total= $amount + $shipping;

$payer= new Payer();

$payer->setPaymentMethod('paypal');

$item= new Item();

$item->setName($product)
     ->setCurrency('USD')
     ->setQuantity(1)
     ->setPrice($amount);

$itemList= new ItemList();

$itemList->setItems([$item]);

$details= new Details();

$details->setShipping($shipping)
        ->setSubtotal($amount);

$amount= new Amount();

$amount->setCurrency('USD')
       ->setTotal($total)
       ->setDetails($details);

$transaction= new Transaction();

$transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("WatsApp clone Application")
            ->setInvoiceNumber(uniqid());


$RedirectUrls= new RedirectUrls();

$RedirectUrls->setReturnUrl(SITE_URL. '/pay.php?success=true')
             ->setCancelUrl(SITE_URL. '/pay.php?success=false');


$payment= new Payment();
$payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($RedirectUrls)
        ->setTransactions([$transaction]);

        try{

        	$payment->create($paypal);

        }
        catch(Exception $e){

        	die($e);


        }
        
$approvalUrl= $payment->getApprovalLink();

header("location: {$approvalUrl}");

?>