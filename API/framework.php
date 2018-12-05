<?php
	
	


/*
	MUDANÇAS A SEREM FEITAS
	
	-IMPLEMENTAR AUTOLOAD PARA LER OS ARQUIVO DE ROTA QUE FORAM CITADOS NA API.PHP
	-LER OS AQUIVOS QUE PRECISAO SER EXECUTADOS EM QUALQUER LOCAL E NAO SO NA PASTA ROUTES
	-CRIAR UMA FUNÇAO PARA MUDAR A PASTA ONDE ESTAO OS ARQUIVOS A SEREM EXECUTADOS( COLOCAR COMO PADRAO A PASTA RAIZ )
	
	**AS FUNÇOES SEMPRE SAO CHAMADAS, MESMO NAO SENDO A URL ESPECIFICA PARA A FUNÇÃO,
		PENSAR EM UMA ESTRATEGIA PRA ACABAR COM ISSO.
*/

	namespace api;
	include "class/rootPage.php";
	use rootPage\rootPage;

	class Api
	{
	
		private $rootPage ;

		function __construct(){

			header("Content-Type: application/json; charset=utf-8");
			$this->rootPage = new rootPage;
		}
		
		//Pega o JSON que foi enviado;
		public function getJson(){
			return json_decode(file_get_contents('php://input'), true);
		}

		//Resposta via JSON
		public function response($data,$code = 200){
			http_response_code($code);
			echo json_encode(['code' => $code, 'data' => $data]);
		}

		//Precisa enviar a url e o caminho do arquivo que vai ser enviado;
		// Exemplo : $api->get('/novo',inclui.php)
		public function get($url,$func){

			$pathUrl = getUrl();

			if ($url == $pathUrl){

				$method = $_SERVER['REQUEST_METHOD'];

				if ($method == 'GET') {			

					$page =  $this->rootPage->getRootPage();
					echo $page."\n";
					$queryStringAll =  $_SERVER['QUERY_STRING'];
					parse_str($queryStringAll, $queryString);
					$inc = './'.$page.'/'.$func;

					if (file_exists($inc)){

						require $inc;

					}else{

						$this->response("Arquivo nao existe!");

					}
 				} else{

 					$this->response("URL invalida!");
 				}
			}
		}

		// 
		public function post($url,$func){

			$pathUrl = getUrl();

			if ($url == $pathUrl) {

				if ($_SERVER['REQUEST_METHOD']=='POST') {

					$inc = './routes/'.$func;

					if (file_exists($inc)){

						require $inc;

					}else{

						$this->response("Arquivo nao existe!");

					}
				}else{
					$this->response("URL invalida!");
				}
			}
			
		}


		//Verificar se esta chamando corretamente
		public function run(){
			return true;
		}

	};

	
	
	class Config Extends rootPage
	{
		public $rootPage;

		function __construct(){

			$this->rootPage = new rootPage();

		}

		public function runConfig(){
			return true;
		}
		public function getRootPage(){
			return $this->rootPage->getRootPage();
		}
		public function setRootPage($page){
			return $this->rootPage->setRootPage($page);
		}
	};


	function getUrl(){
		$URL_ATUAL= $_SERVER['SCRIPT_NAME'];
    	$queryString =  $_SERVER['QUERY_STRING'];	
   		$u1 = str_replace($URL_ATUAL, "", $_SERVER["REQUEST_URI"]);
   		$u2 = str_replace($queryString, "", $u1);
   		$URL = str_replace('?', "", $u2);
    	return $URL;
	}


?>