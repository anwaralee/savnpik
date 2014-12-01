<?php
require_once('lib/Stripe.php');

$stripe = array(
  "secret_key"      => "sk_test_u16DZ4JjJsXkdiubaLdASfNm",
  "publishable_key" => "pk_test_doMM0L0QqW8xUarzlYWrLGYp"
);

Stripe::setApiKey($stripe['secret_key']);
?>