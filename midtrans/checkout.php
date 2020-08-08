<?php
namespace Midtrans;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");

require_once(dirname(__FILE__) . '/vendor/autoload.php');
// include 'veritrans_token.php';

// if(empty($_GET['token_id'])) {
//   die('Empty token_id!');
// }

Config::$serverKey = "SERVER KEY KAMU";

if (strpos(Config::$serverKey,'your ') != false ) {
  echo "<code>";
  echo "<h4>Please set your server key from sandbox</h4>";
  echo "In file: " . __FILE__;
  echo "<br>";
  echo "<br>";
  echo htmlspecialchars('Veritrans_Config::$serverKey = \'<your server key>\';');
  die();
}

// Uncomment for production environment
// Veritrans_Config::$isProduction = true;

// Uncomment to enable sanitization
// Veritrans_Config::$isSanitized = true;

$transaction_details = array(
  'order_id'    => time(),
  'gross_amount'  => 200000
);
// Fill transaction details
$transaction = array(
  'transaction_details' => $transaction_details
);
$snapToken = Snap::getSnapToken($transaction);

//echo $snapToken;
// Populate items
$items = array(
    array(
      'id'       => 'item1',
      'price'    => 100000,
      'quantity' => 1,
      'name'     => 'Adidas f50'
    ),
    array(
      'id'       => 'item2',
      'price'    => 50000,
      'quantity' => 2,
      'name'     => 'Nike N90'
    ));

// Populate customer's billing address
$billing_address = array(
    'first_name'   => "Ahmad Naufal",
    'last_name'    => "Khalid",
    'address'      => "Jalan Al ihsan No.89 Jati Rahayu",
    'city'         => "Jakarta",
    'postal_code'  => "17414",
    'phone'        => "081322311801",
    'country_code' => 'IDN'
  );

// Populate customer's shipping address
$shipping_address = array(
    'first_name'   => "John",
    'last_name'    => "Watson",
    'address'      => "Bakerstreet 221B.",
    'city'         => "Jakarta",
    'postal_code'  => "51162",
    'phone'        => "081322311801",
    'country_code' => 'IDN'
  );

// Populate customer's info
$customer_details = array(
    'first_name'   => "Ahmad Naufal",
    'last_name'    => "Khalid",
    'email'            => "nauralpk@pusatkursus.com",
    'phone'            => "081322311801",
    'billing_address'  => $billing_address,
    'shipping_address' => $shipping_address
  );

// Token ID from checkout page
$token_id = $snapToken;

// Transaction data to be sent
$transaction_data = array(
    'payment_type' => 'credit_card',
    'credit_card'  => array(
      'token_id'      => $token_id,
      // 'bank'          => 'bni', // optional acquiring bank, must be the same bank with get-token bank
      //'save_token_id' => isset($_POST['save_cc'])
      'save_token_id' => true
    ),
    'transaction_details' => $transaction_details,
    'item_details'        => $items,
    'customer_details'    => $customer_details
  );

try {
  $response = Snap::createTransaction($transaction_data);
  
  echo json_encode($response);
} catch (Exception $e) {
  echo $e->getMessage();
  die();
}

