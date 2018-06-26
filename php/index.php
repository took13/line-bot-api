<?php
include ('line-bot.php');
$channelSecret = 'd831e7e4bd15e966b258ed6757a9cb99';
$access_token  = 'XCBJd9Dqc1kfB/VLFnVuEWJ/AjkLXgLdLnSbGuqXeMDwvpfV/XF3iHVtZNso7Jq4onCK9fmbHQ8MZsgrU7ZjCS1+tQk+STz2/0gm4Juod3sG7lRtRmv6bRGtGPAZABQqH3593dxp7W+ladz/KDMR0gdB04t89/1O/w1cDnyilFU=';
$bot = new BOT_API($channelSecret, $access_token);
$reply_message = null;
$message = $bot->message;

if (!empty($bot->isEvents)) {
	//Get user profile
	$res = $bot->getProfile($bot->userId);
	if ($res->isSucceeded()) {
	    $profile = $res->getJSONDecodedBody();
	    $displayName = $profile['displayName'];
	    $statusMessage = $profile['statusMessage'];
	    $pictureUrl = $profile['pictureUrl'];
	}
	
    $reply_message = "Hello " . $displayName . ", how may I assist you today?";
    $bot->replyMessageNew($bot->replyToken, $message);
    if ($bot->isSuccess()) {
	echo 'Succeeded!';
	exit();
    }	
    // Failed
    echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
    exit();
}
