<?php
require("vendor/autoload.php");

define('SITE_URL', 'http://www.dorochat.com/paypal');

$paypal= new \PayPal\Rest\ApiContext(
 new \PayPal\Auth\OAuthTokenCredential(
 	'ASgm5y7cFFfz52bFJp3THh6o8JvREV5TTdqUbACIoKb8AIZssNgqQbB21r2_y3ROroAts3nbiPDueS7s',
 	'EALL9RkpOyEHTX1Wfc6WUtHMiPbjNgIqKRTjKUfU0UW4FrJmk94v8FzNCpkZp9bkpMUfZ8p4hCp7WCyA'

)

	);


$paypal->setConfig(
  array(
    'mode' => 'live',
    'log.LogEnabled' => true,
    'log.FileName' => 'PayPal.log',
    'log.LogLevel' => 'FINE'
  )
);

?>