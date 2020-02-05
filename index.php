<?php
# Teams Bot
# Ron Egli - Github.com/smugzombie
# V0.3
require(__DIR__.'/security.php');
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
$command_string = strtolower(str_replace('nbsp', '', preg_replace("/[^A-Za-z0-9 ]/", '', preg_replace($bot_regex, "", $message_body))));
$command_string_parts = explode(" ", $command_string);
$argument_string = implode(" ", str_replace($command_string_parts[0]." ","", $command_string));
$argument_string_parts = explode("", $argument_string);

if(isset($command_string_parts[0])){
	$command = $command_string_parts[0];
}

// DEBUG
if($config['debug']){
	error_log(json_encode($data));
	error_log($message_body);
	error_log($bot_name);
	error_log($command);
}
// DEBUG

if(file_exists(__DIR__."/bots/".strtolower($bot_name)."_bot.php")){
	require(__DIR__."/bots/".strtolower($bot_name)."_bot.php");
}else{
	$response['type'] = "message";
	$response['text'] = "This bot is not setup. Please setup the bot and try again.";
	echo json_encode($response); exit();
}

$response = array();
$response['type'] = "message";
$response['text'] = $responseText;
echo json_encode($response);