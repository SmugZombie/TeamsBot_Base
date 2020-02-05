<?php

// Switch based on what command was provided
switch($command){
	case "status":
		$responseText = lookupPage();
		break;
	case "whoami":
		$responseText = $data['from']['name'];
		break;
	case "whoareyou":
		$responseText = "I am $bot_name, Nice to meet you!";
		break;
	default:
		$user = $data['from']['name'];
		$responseText = "Sorry $user but that is an Invalid Command ($command)";
}



function lookupPage(){

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://playground.alreadydev.com/nodetest.php",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "Content-Type: application/json"
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;

}