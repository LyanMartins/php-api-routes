<?php
require "./API/framework.php";


use api\Config;
use api\Api;

/*
	Configuraçoes necessarias para o funcionamento do framework
*/

$config = new Config;
if($config->runConfig()){
	echo "Configuraçoes rodando...\n";
}

$config->setRootPage('files');
echo $config->getRootPage();
//echo $config->getRootPage(); 
/*
	As funcões da api recebem como parametro a url e o arquivo php correspondente a url citada
	Os arquivos atualmente precisao esta na pasta routes
*/


$api = new Api;
$api->get('/novo','busca_usuario_.php');
$api->post('/insere','insere_usuario.php');
$api->get('/teste', 'teste.php');

if ($api->run()) {
	//echo " rodando...";
}
?>