<?php 

require ('../config/dbconfig.php');
require ('../libs/form.php') ;
require ('../libs/database.php');
require ('../libs/model.php');
require ('../libs/file.php');



if(isset($_REQUEST['run'])){
	$form =new Form();
	$form->post('name');
	//$form->val('print');
	// $form->file('fileToUpload');
	// $form->fileval('checkImage');
	// $submit = $form->submit();
	// print_r($submit);
	$delete=['1.txt','2.txt'];
	$dir='img/';
	$aaa=File::alldelete($dir);
	print_r($aaa);
	//$form->val('maxlength',5);
	//$form->val( 'xss_clean_obj');
	//$form->post('age');
	//$form->val('digit');
	//$form->post('sex');
	//$form->file('fileToUpload');
	//$form->fileval('print');
	//$submit = $form->submit();
	//print_r($submit);
	//$data=$form->fetch();
	//print_r($data);
	// if($submit===true){

	// 	$data=$form->fetch();
	// 	// print_r($data);
	// 	$table='test';
	// 	$db = new Database(DBTYPE, DBHOST, DBNAME, DBUSER, DBPWS);
	// 	$db->insert($data, $table);
	// }
	// else{
	// 	echo $submit;
	// }
	
	
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>

	<form  method="post" action="?run" enctype="multipart/form-data">
		<input type="text" name="name[]">
		<input type="text" name="name[]">
		<input type="text" name="age">
		<select name="sex">
			<option value="male">Male</option>
			<option value="female">Female</option>
		</select>
		<input type="file" name="fileToUpload[]" multiple>
		
		<input type="submit" value="TEST">
	</form>
	
</body>
</html>