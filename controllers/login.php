<?php

/**
 * 

 */
class Login extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		//echo "This is Login Controller<br>";
		
	}

	public function index(){

		$this->view->render('login/index');
		//echo Hash::Create('md5','haha',HSKEY);

	}

	public function check(){
		$this->model->check();
		


	}
}
?>