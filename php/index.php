<?php
include ('line-bot.php');
$channelSecret = 'd831e7e4bd15e966b258ed6757a9cb99';
$access_token  = 'XCBJd9Dqc1kfB/VLFnVuEWJ/AjkLXgLdLnSbGuqXeMDwvpfV/XF3iHVtZNso7Jq4onCK9fmbHQ8MZsgrU7ZjCS1+tQk+STz2/0gm4Juod3sG7lRtRmv6bRGtGPAZABQqH3593dxp7W+ladz/KDMR0gdB04t89/1O/w1cDnyilFU=';
$bot = new BOT_API($channelSecret, $access_token);
	
if (!empty($bot->isEvents)) {
    $profile = $bot->getProfile($bot->userId);
	//echo json_encode($profile);
    $bot->replyMessageNew($bot->replyToken, json_encode($profile));
    if ($bot->isSuccess()) {
        echo 'Succeeded!';
        exit();
    }	
    // Failed
    echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
    exit();
}
