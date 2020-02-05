<?php

function checkAuthHeader(){
	global $config;
	//get headers
	$a = getallheaders();
	$provided_hmac=substr($a['Authorization'],5);

	for ($i=0; $i < count($config['teams']['secrets']); $i++) { 
		$hash = hash_hmac("sha256",file_get_contents('php://input'),base64_decode($config['teams']['secrets'][$i]), true);

		$calculated_hmac = base64_encode($hash);

		if(hash_equals($provided_hmac,$calculated_hmac)){
			return true;
		}
	}

	return false;
	
	// Validate the message came from an authorized source
	/*if(!hash_equals($provided_hmac,$calculated_hmac)){
		return false;
	}*/

	//return hash_equals($provided_hmac,$calculated_hmac);
}