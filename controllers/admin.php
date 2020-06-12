<?php

/**
 *
 */
class Admin extends Controller
{

    public function __construct()
    {
        parent::__construct();
        Session::Init();
        $check = Session::Get('loginvalue');
        $admin = Session::Get('role');
        

        {
            if ($check == false || $admin !== 'admin') {
                Session::Destory();
                header('location:http://localhost/toxic/login');
            }
        }
        $this->view->js  = array('admin/script/custom.js');
        $this->view->css = array('admin/css/default.css');
    }

    public function index()
    {
        //$this->view->data = $this->model->userList();
        $this->view->data = $this->model->List();
        $this->view->render('admin/index');
    }

    public function Create()
    {
        $csrf=Csrf::verifyToken('create');
        if($csrf!=true){
             header('location:http://localhost/toxic/login');
             exit;
        } 
        if (isset($_POST['username'])) {
            $form = new Form();
            $form->post('username');
            $form->filter('xss_clean');
            $form->val('minlength', 5);
            $form->post('password');
            $form->val('minlength', 5);
            $form->post('role');
            $submit = $form->submit();
            if ($submit === true) {

                $data         = $form->fetch();
                $data['name'] = $data['username'];
                unset($data['username']);
                $data['password'] = Hash::Create('md5', $data['password'], HSKEY);
                $render           = $this->model->Create($data);
                if ($render) {
                    header('location:http://localhost/toxic/admin');
                }
                //print_r($data);

            } else {
               // print_r($submit);
                $this->view->error = $submit;
                $this->view->data  = $this->model->List();
                $this->view->render('admin/index');

            }

        }
        // $data             = [];
        // $data['name']     = $_POST['username'];
        // $data['password'] = Hash::Create('md5',$_POST['password'],HSKEY);
        // $data['role']     = $_POST['role'];
        // //$data['date']=true;

        // $render = $this->model->Create($data);

        // if ($render) {
        //     header('location:http://localhost/UMS/admin');

        // }

    }

    public function Edit($id)
    {
        $csrf=Csrf::verifyToken('edit');
        if($csrf!=true){
             header('location:http://localhost/toxic/login');
             exit;
        }
        // $this->view->data  = $this->model->userList();
        // $this->view->data1 = $this->model->userList('', $id);
        $data              = [];
        $data['id']        = $id;
        $this->view->data  = $this->model->List();
        $this->view->data1 = $this->model->List($data);
        $this->view->render('admin/edit');

    }

    public function EditSave($id)
    {
        $data            = [];
        $data['user_id'] = $id;
        $data['name']    = $_POST['username'];
        if (!empty($_POST['password'])) {
            $data['password'] = Hash::Create('md5', $_POST['password'], HSKEY);
        }

        $data['role'] = $_POST['role'];
        //$data['date']=true;

        $render = $this->model->Update($data);
        if ($render) {
            header('location:http://localhost/toxic/admin');

        }

    }

    public function Delete($id)
    {
        // $csrf=Csrf::verifyToken('delete');
        // if($csrf!=true){
        //      header('location:http://localhost/UMS/login');
        //      exit;
        // } 
        $data            = [];
        $data['user_id'] = $id;
        $render          = $this->model->Delete($data);
        if ($render) {
            header('location:http://localhost/toxic/admin');

        }

    }

}
