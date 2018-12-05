<?php 	
	use Api\Api;
	$api = new Api;
	$json = $api->getJson();
	echo $json['id'];

	$api->response($json);
?>