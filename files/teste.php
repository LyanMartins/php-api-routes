<?php 


	use Api\Api;
	$api = new Api;
	$saida = array(
		"retorno" => "pasta files"
	);
	$api->response($saida,200);

 ?>