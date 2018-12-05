<?php 

namespace rootPage;
/**
 * 
 */
class rootPage
{
	
	function __construct()
	{
		
	}

	private $rootPage ;

	public function getRootPage(){
		return $this->rootPage;
	}
	public function setRootPage($page){
		$this->rootPage = $page;
		return $page;
	}
}

 ?>