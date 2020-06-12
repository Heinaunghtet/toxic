<?php

/**
 * \
 */
class Index extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->js=array('index/script/custom.js');
        $this->view->css=array('index/css/default.css');
        $this->view->title='unknown university';
    
    }

    public function index()
    {
        $this->view->render('index/index');
    }

    public function xhrGet()
    {
        
        $this->model->xhrGet();
        

    }
}
