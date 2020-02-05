<?php
# Teams Bot
# Ron Egli - Github.com/smugzombie
# V0.1
require(__DIR__.'/security.php');
require(__DIR__.'/functions.php');
header('Content-type: application/json');

// Load Config
try{
	$config = json_decode(file_get_contents(__DIR__.'/config.json'), true);
} catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
	return;
}

// Check if authorized to communicate
if(!checkAuthHeader()){
	$response['type'] = "message";
	$response['text'] = "Invalid Authorization Provided!";
	echo json_encode($response); exit();
}

// Decode the payload
$data = json_decode(file_get_contents('php://input'), true);

// Seperate the Bot from the command and command parts
$message_body = $data['text'];
$bot_name = explode("<at>",explode("</at>", $message_body)[0])[1];
$bot_regex = '/<at>.*<\/at>\s?/m';
$command = strtolower(str_replace('nbsp', '', preg_replace("/[^A-Za-z0-9 ]/", '', preg_replace($bot_regex, "", $message_body))));

// DEBUG
error_log(json_encode($data));
error_log($message_body);
error_log($bot_name);
error_log($command);
// DEBUG

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

$response = array();
$response['type'] = "message";
$response['text'] = $responseText;
echo json_encode($response);