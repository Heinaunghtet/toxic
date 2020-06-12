<?php

/**
 * \
 */
class Help extends Controller
{

    public function __construct()
    {
        parent::__construct();
       
    }

    public function index(){
         $this->view->render('help/index');
         
    
    }

    public function other()
    {
        echo "This is  help/other controller<br>";
        $this->view->render('help/other');
    }
        
}
