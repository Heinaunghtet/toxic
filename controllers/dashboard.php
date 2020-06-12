<?php
class Dashboard extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		Auth::loginAuth();
		
		
				
		$this->view->js=array('dashboard/script/custom.js');
		$this->view->css=array('dashboard/css/default.css');
	}

	public function index()
	{

		$this->view->render('dashboard/index');
	}

	public function logout()
	{
		Session::Destory();
		header('location:http://localhost/toxic/');
	}


	public function xhrGet()
	{
		
        $this->model->xhrGet();
        

	}
	public function xhrInsert()
	{
		
        $this->model->xhrInsert();
        

	}

	public function xhrDelete()
	{
		
        $this->model->xhrDelete();
        

	}

	public function xhrRead()
	{
		
        $this->model->xhrRead();
        

	}
	public function xhrUpdate()
	{
		
        $this->model->xhrUpdate();
        

	}

	
}
?>