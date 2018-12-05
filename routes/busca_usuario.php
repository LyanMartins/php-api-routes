<?php

	use Api\Api;
	$api = new Api;
	$saida = array(
		"retorno" => "ok"
	);
	$api->response($saida,200);

?>