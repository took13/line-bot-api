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
	} else if ($text == '#singleline'){
		$originalUrl = "https://www.picz.in.th/images/2018/06/27/4FdLxJ.jpg";
		$previewUrl = "https://www.picz.in.th/images/2018/06/27/4yM4nn.jpg";
	} else if ($text == '#cfb3'){
		$originalUrl = "https://www.picz.in.th/images/2018/06/27/4FdYMg.jpg";
		$previewUrl = "https://www.picz.in.th/images/2018/06/27/4Fd7RS.jpg";
	} else if ($text == '#daily'){
		$originalUrl = "https://www.picz.in.th/images/2018/06/27/4FdSun.jpg";
		$previewUrl = "https://www.picz.in.th/images/2018/06/27/4FdWVV.jpg";
	} else if ($text == '#trend'){
		$originalUrl = "https://www.picz.in.th/images/2018/06/27/4Fd41W.jpg";
		$previewUrl = "https://www.picz.in.th/images/2018/06/27/4Fd0YQ.jpg";
	//} else if ($text == '#video'){
	//	$originalUrl = "https://www.dropbox.com/s/4xwem8kaefizlxb/551766571.300296.mp4?dl=0";
	//	$previewUrl = "https://www.picz.in.th/images/2018/06/27/4Fd0YQ.jpg";
	} else if ($text == '#help'){
		$reply_message = "You can use following commands to show specific results:" . "\r\n"
				. "#g1 : show MW for GSPP1" . "\r\n\"
				. "#ge : show MW for Glow Energy" . "\r\n\"
				. "#cfb : show MW for CFB 1,2,3" . "\r\n\"
				. "#singleline : show GSPP2&3 single line diagram" . "\r\n\"
				. "#cfb3 : show CFB3 diagram" . "\r\n\"
				. "#daily : show daily report" . "\r\n\"
				. "#trend : show sample trend for Glow Energy";
	} else {
		$reply_message = "Hello " . $displayName . ", how may I assist you today?" . "\r\n" 
				. "if you need to trial this application, please type #help to get commands description.";		
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
