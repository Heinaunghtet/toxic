<?php 

/**
  * 
  */
 class Login_Model extends Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		//echo "This is login model";
 		
 		
 	}

 	public function check()
 	{
 		
 		$password=Hash::Create('md5',$_POST['password'],HSKEY);
 		$query=$this->db->prepare('SELECT * FROM user WHERE name=:name AND password=:password AND role=:role');
 		$query->execute(array(
 			':name'=>$_POST['username'],
 			':password'=>$password,
 			':role'=>$_POST['role']
 		));
 		$data=$query->fetch();
 		$count=$query->rowCount();
 		
 		
 		if($count>0){
 			//$randomtoken = base64_encode( openssl_random_pseudo_bytes(32));
            Session::Init();
           // Session::Set('csrfToken',$randomtoken);
            Session::Set('loginvalue',true);
            Session::Set('role',$data['role']);
            Session::Set('id',$data['user_id']);
 			header('location:http://localhost/toxic/dashboard');

 		}else{
 			Session::Destory();
 			header('location:http://localhost/toxic/login');
 		}



 	}
 } 
?>