<?php  

/**
 * 
 */
class Teacher extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		Session::Init();
		$check=Session::Get('loginvalue');
		$admin=Session::Get('role');
		// echo $check;
		// echo $admin;
		{
			if($check == false || $admin !=='teacher'){
				Session::Destory();
				header('location:http://localhost/toxic/login');
			}
		}
		$this->view->js=array('teacher/script/custom.js');
		$this->view->css=array('teacher/css/default.css');
	}

	public function index()
	{

		$this->view->render('teacher/index');
	}


	public function Create()
	{
		
        $this->model->Create();
        

	}

	public function Read()
	{
		
        $this->model->Read();
        

	}
	public function Update()
	{
		
        $this->model->Update();
        

	}

	public function Delete()
	{
		
        $this->model->Delete();
        

	}

	
	
}
?>
