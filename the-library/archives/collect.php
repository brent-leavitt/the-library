<?php 
	// Collection Page
	
	//require_once('vendor/autoload.php');
	
	echo $_SERVER['DOCUMENT_ROOT'];
	
	
	
	echo "I am being called!" ;
	
	echo "<pre>";
	
	var_dump( $_SERVER );
	
	echo "</pre>";
	
	
	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here: https://dashboard.stripe.com/account/apikeys
	\Stripe\Stripe::setApiKey("sk_test_o4TdZr2hwSlbbbgzC5SMAdUS");

	// Token is created using Checkout or Elements!
	// Get the payment token ID submitted by the form:
	$token = $_POST['stripeToken'];

	$charge = \Stripe\Charge::create([
		'amount' => 999,
		'currency' => 'usd',
		'description' => 'Example charge',
		'source' => $token,
	]);

	
	
?>