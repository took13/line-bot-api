<?php
include ('line-bot.php');
$channelSecret = 'd831e7e4bd15e966b258ed6757a9cb99';
$access_token  = 'XCBJd9Dqc1kfB/VLFnVuEWJ/AjkLXgLdLnSbGuqXeMDwvpfV/XF3iHVtZNso7Jq4onCK9fmbHQ8MZsgrU7ZjCS1+tQk+STz2/0gm4Juod3sG7lRtRmv6bRGtGPAZABQqH3593dxp7W+ladz/KDMR0gdB04t89/1O/w1cDnyilFU=';
$bot = new BOT_API($channelSecret, $access_token);
$text = $bot->event_text;

if (!empty($bot->isEvents)) {
	//Get user profile
	$res = $bot->getProfile($bot->userId);
	if ($res->isSucceeded()) {
	    $profile = $res->getJSONDecodedBody();
	    $displayName = $profile['displayName'];
	    $statusMessage = $profile['statusMessage'];
	    $pictureUrl = $profile['pictureUrl'];
	}
	
	if (strpos($text, '#g1') !== false){
		$reply_message = "Unit 1 : 37.8 MW" . "\r\n" 
				. "Unit 2 : 41.6 MW";
	} else if (strpos($text, '#ge') !== false){
		$reply_message = "GT 1A : 22.5 MW" . "\r\n" 
				. "GT 1B : 23.4 MW" . "\r\n" 
				. "GT 1C : Shutdown";
	} else if (strpos($text,'#cfb') !== false){
		$reply_message = "CFB1 : 117.88 MW" . "\r\n"
				. "CFB2 : 118.80 MW" . "\r\n"
				. "CFB3 : 110.70 MW";
	} else if (strpos($text,'#getrend') !== false){
		$img_url = "https://cdn.shopify.com/s/files/1/0379/7669/products/sampleset2_1024x1024.JPG?v=1458740363";
		$outputText = new LINE\LINEBot\MessageBuilder\ImageMessageBuilder($img_url, $img_url);
		$response = $bot->replyMessage($event->getReplyToken(), $outputText);
	} else {
		$reply_message = "Hello " . $displayName . ", how may I assist you today?";		
	}
	

	$bot->replyMessageNew($bot->replyToken, $reply_message);
	if ($bot->isSuccess()) {
		echo 'Succeeded!';
		exit();
	}	
	// Failed
	echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
	exit();
}
