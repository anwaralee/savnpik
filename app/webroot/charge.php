<?php
    $amount = $_POST['amount'];
  require_once('config.php');

  $token  = $_POST['stripeToken'];

  $customer = Stripe_Customer::create(array(
      'email' => 'warriorbik@gmail.com',
      'card'  => $token
  ));

  if($charge = Stripe_Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $amount,
      'currency' => 'aed'
  )))
      echo '<h1>Successfully charged '.$amount.'AED!</h1>';
  else
    echo "failed";
?>

