<?php
if(!session_id())
	session_start();
require_once 'C:/xampp/htdocs/Facebook/autoload.php';
$app_id = '####################';
$app_secret = '####################';
//$fb_page_id = '100005674542026';
$permissions = ['email']; // Optional permissions
$callbackurl = 'http://localhost/Facebook/callback.php';
$out = 'logout.php';
$fb = new Facebook\Facebook([
  'app_id' => $app_id, // Replace {app-id} with your app id
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.2',
							]);
$helper = $fb->getRedirectLoginHelper();
$loginUrl = $helper->getLoginUrl($callbackurl , $permissions);
?>