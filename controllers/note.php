<?php

/**
 *
 */
class Note extends Controller
{

    public function __construct()
    {
        parent::__construct();
        Session::Init();
        $check = Session::Get('loginvalue');
        $admin = Session::Get('role');

        {
            if ($check == false) {
                Session::Destory();
                header('location:http://localhost/toxic/login');
            }
        }
        //$this->view->js  = array('admin/script/custom.js');
        //$this->view->css = array('admin/css/default.css');
    }

    public function index()
    {
        $id=['user' =>Session::Get('id')];
        $this->view->data = $this->model->userList('',$id);
        //$this->view->data = $this->model->List();
        $this->view->render('note/index');
    }

    public function Create()
    {
        if (isset($_POST['title'])) {
            $form = new Form();
            $form->post('title');
            $form->post('content');
           
            $submit = $form->submit();
            if ($submit === true) {

                $data = $form->fetch();

                $data['date'] =true;
                $data['user'] =Session::Get('id');
                $render = $this->model->Create($data);
                    if ($render) {
                        header('location:http://localhost/toxic/note');
                    }
                print_r($data);

            } else {
                $this->view->error=$submit;
                $this->view->data = $this->model->List();
                $this->view->render('note/index');

            }

        }
        

    }

    public function Edit($id)
    {
        
 
        $id=['note_id' => $id];
        $this->view->data = $this->model->userList('',$id);
        $this->view->render('note/edit');

    }

    public function EditSave($id)
    {
        $data            = [];
        $data['note_id'] = $id;
        $data['date']    =true;
        $data['title']   = $_POST['title'];
        $data['content'] = $_POST['content'];
        
        //print_r($data);
        $render = $this->model->Update($data);
        if ($render) {
            header('location:http://localhost/toxic/note');

        }

    }

    public function Delete($id)
    {
        $data            = [];
        $data['note_id'] = $id;
        $render          = $this->model->Delete($data);
        if ($render) {
            header('location:http://localhost/UMS/note');

        }

    }

}
