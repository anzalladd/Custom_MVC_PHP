<?php 

namespace App\Core;

class Core {

	private $Url = null;
	private $Controller = '';
	private $Action = '';
	private $Params = [];

	Public function run(){
		$this->getUrl();
		$this->getControllerActionParam();
		$this->execute();
	}
	private function getUrl(){
		$url='/';
		if (isset($_GET['url'])){
			$url .=$_GET['url'];
		}
		$this->Url =$url;
	}
	private function getControllerActionParam() {

		if (!empty($this->Url) && $this->Url !='/') {
			$this->Url =explode('/', $this->Url);			
			array_shift($this->Url);

			$this->Controller = $this->Url[0] . 'Controller';
			array_shift($this->Url);

			$this->getAction();
			$this->getParams();
		}
	}
	private function getAction(){
		$this->Action ='index';
		if (isset($this->Url[0]) && !empty($this->Url[0])) {
			$this->Action =$this->Url[0];
			array_shift($this->Url);
		}
	}
	private function getParams(){
		if (count($this->Url) > 0) {
			$this->Params = $this->Url;
		}
	}
	 private function execute() {
        $controllerClassName = '\\App\\Controllers\\' . $this->Controller;

        // $fileClass = BASEDIR . "App/Controllers/" . $this->Controller . '.php';
        // var_dump($fileClass);
        // if(file_exists($fileClass)){
        // 	require_once $fileClass;
        // 	require_once BASEDIR . "App/Core/Controller.php";
        // }else{
        // 	//die("Langka brooo");
        // }
        
        if (!class_exists($controllerClassName)) {
            (new \App\Controllers\errorController())->index();
            return;
        }
        $controllerClass = new $controllerClassName();

        call_user_func_array(array($controllerClass, $this->Action), $this->Params);
    }
}