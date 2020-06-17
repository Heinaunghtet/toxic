<?php

/**
 *
 */
class Student extends Controller
{

    public function __construct()
    {
        parent::__construct();
        Session::Init();
        $check = Session::Get('loginvalue');
        $admin = Session::Get('role');
        // echo $check;
        // echo $admin;
        {
            if ($check == false || $admin !== 'student') {
                Session::Destory();
                header('location:http://localhost/toxic/login');
            }
        }
        $this->view->js  = array('student/script/custom.js');
        $this->view->css = array('student/css/default.css');
    }

    public function index()
    {

        $this->view->render('student/index');
    }

    public function logout()
    {
        Session::Destory();
        header('location:http://localhost/toxic/');
    }

    public function addUser()
    {

        $this->model->addUser();

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
