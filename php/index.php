<?php
include ('line-bot.php');
$channelSecret = 'd831e7e4bd15e966b258ed6757a9cb99';
$access_token  = 'XCBJd9Dqc1kfB/VLFnVuEWJ/AjkLXgLdLnSbGuqXeMDwvpfV/XF3iHVtZNso7Jq4onCK9fmbHQ8MZsgrU7ZjCS1+tQk+STz2/0gm4Juod3sG7lRtRmv6bRGtGPAZABQqH3593dxp7W+ladz/KDMR0gdB04t89/1O/w1cDnyilFU=';
$bot = new BOT_API($channelSecret, $access_token);
$text = $bot->event_text;
$originalUrl = null;
$previewUrl = null;

if (!empty($bot->isEvents)) {
	//Get user profile
	$res = $bot->getProfile($bot->userId);
	if ($res->isSucceeded()) {
	    $profile = $res->getJSONDecodedBody();
	    $displayName = $profile['displayName'];
	    $statusMessage = $profile['statusMessage'];
	    $pictureUrl = $profile['pictureUrl'];
	}
	
	//if (strpos($text, '#g1') !== false){
	if ($text == '#g1'){
		$reply_message = "Unit 1 : 37.8 MW" . "\r\n" 
				. "Unit 2 : 41.6 MW";
	} else if ($text == '#ge'){
		$reply_message = "GT 1A : 22.5 MW" . "\r\n" 
				. "GT 1B : 23.4 MW" . "\r\n" 
				. "GT 1C : Shutdown";
	} else if ($text == '#cfb'){
		$reply_message = "CFB1 : 117.88 MW" . "\r\n"
				. "CFB2 : 118.80 MW" . "\r\n"
				. "CFB3 : 110.70 MW";
	} else if ($text == '#getrend'){
		$originalUrl = "http://blog.dataparcsolutions.com/wp-content/uploads/2015/09/troubleshooting.jpg";
		$previewUrl = "http://blog.dataparcsolutions.com/wp-content/uploads/2015/09/troubleshooting.jpg";
	} else {
		$reply_message = "Hello " . $displayName . ", how may I assist you today?";		
	}
	

	$bot->replyMessageNew($bot->replyToken, $reply_message,$originalUrl,$previewUrl);
	if ($bot->isSuccess()) {
		echo 'Succeeded!';
		exit();
	}	
	// Failed
	echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
	exit();
}
