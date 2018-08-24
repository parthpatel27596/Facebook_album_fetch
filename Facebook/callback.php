<?php
session_start();
require_once 'config.php';

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
/*
try
{
	$result = $fb -> get('/me?fields=albums,data,name,source,images' , $accessToken -> getValue());
}catch(Facebook\Exceptions\FacebookResponseException $e){
	echo 'Graph returned an error' . $e->getMessage();
	exit;
}catch(Facebook\Exceptions\FacebookSDKException $e){
	echo 'Facebook SDK returned an error' . $e->getMessage();
	exit;
}
*/
try
{
	$response = $fb -> get('/me?fields=albums{picture{url},edit_link}' , $accessToken -> getValue());
}catch(Facebook\Exceptions\FacebookResponseException $e){
	echo 'Graph returned an error' . $e->getMessage();
	exit;
}catch(Facebook\Exceptions\FacebookSDKException $e){
	echo 'Facebook SDK returned an error' . $e->getMessage();
	exit;
}

$fbuserdata = $response->getGraphUser()->asArray();
$_SESSION['userData']=$fbuserdata;


function fetch_albums($fbdata)

{
	foreach($fbdata as $key=>$img){
		echo '</br> ';
				
			
		if(is_array($img)){
			
			$a = fetch_albums($img);
		
			
	
		}else{
			if($key=='url'){
				
				echo "<img src=".$img."><br>";
			
			}
		}
	}
}

?>
<html>
<head><title>ALBUMS OF FACEBOOK</title>
<style type = "text/css">
h1{font-family:Arial,Helvetica,sans-serif,color:#999999;}<br>
</style><center>
<h1> FACEBOOK ALBUMS </h1>
<div><?php fetch_albums($fbuserdata) ?></div></center>
<a href = "logout.php"><img src ="out.jpg" align = "right"  ></a>

</head>
</html>


