<?php 

//auto loader 
require 'ulti/validate.php';

function __autoload($class){
	
	require LIBS.$class.'.php';
}
// require 'libs/loader.php';
// require 'libs/controller.php';
// require 'libs/model.php';
// require 'libs/view.php';

// require 'libs/database.php';
// require 'libs/session.php';
require 'ulti/auth.php';
require 'ulti/hash.php';


require 'config/paths.php';
require 'config/dbconfig.php';
require 'config/hashconfig.php';





$app=new loader();
$app->init();