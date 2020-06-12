<?php

/**
 * 
 */
class Auth 
{
	
	public function loginAuth()
	{
		Session::Init();
		$check=Session::Get('loginvalue');
		$admin=Session::Get('role');
	
		{
			if($check == false){
				Session::Destory();
				header('location:http://localhost/UMS/login');
				exit;
			}
		}
	}
}

?>