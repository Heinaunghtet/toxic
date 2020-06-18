<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require ('../config/dbconfig.php');
//require ('../libs/form.php') ;
require ('../libs/database.php');
require ('../libs/model.php');
require ('../libs/file.php');
require ('../ulti/validate.php');

require '../libs/SimpleXLSX.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>excel</title>
	<link rel="stylesheet" href="">
    <style type="text/css" media="screen">
        .{
         background-color: ;
        }
        
    </style>
</head>
<body>
	<form action="excel.php" method="post" enctype="multipart/form-data">
		<input type="file" name="file">
		<input type="submit" value="paste">
	</form>
</body>
</html>
<?php

//print_r( $xlsx->rows() ); //each column as array
//print_r( $xlsx->rowsEx() );// each colum as two dimensional array
//print_r( $xlsx->sheetNames(), true );//sheet name as array
//print_r( $xlsx->dimension() ); // an arry for first sheet contain row and column
//print_r( $xlsx->dimension(1) );// an array for second sheet contain row and column
if (isset($_FILES['file'])) {
  $data=['digit','name','digit','digit','digit'];
  csvInsert('file');
   // $db = new Database(DBTYPE, DBHOST, DBNAME, DBUSER, DBPWS);
   // $data=['rank','country','pol','est','world'];
   // excelInsert('excel',$data,'file',true);
}



 function csvInsert($filename)
    {
       

        $fileName = $_FILES[$filename]["tmp_name"];

       
        if (($handle = fopen($fileName, "r")) !== false) {
            echo '<h2 style="color:red;">Parsing Result</h2>';
            echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';

            while (($column = fgetcsv($handle, 1000, ",")) !== false) {
                $num = count($column);
                echo '<tr">';             
               
                for ($c = 0; $c < $num; $c++) {
                    
                    echo '<td >' . (isset($column[$c]) ? $column[$c] : '&nbsp;') . '</td>';
                }
                
                echo '</tr>';
            }
            fclose($handle);
        }

        // return $check;
    }

function excelShowplus($filename,$check,$allsheet = false)
{
    if ($xlsx = SimpleXLSX::parse($_FILES[$filename]['tmp_name'])) {
        echo '<h2 style="color:red;">Parsing Result</h2>';
        echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';

        if ($allsheet == false) {

            $dim  = $xlsx->dimension();
            $cols = $dim[0];
            $count = 1;
            if($check){
                $val=new Validate();
            }

            foreach ($xlsx->rows() as $k => $r) {
                //        if ($k == 0) continue; // skip first row
                echo '<tr">';
                if ($k == 0) {
                        echo '<td>No</td>';
                    } else {
                        echo '<td>' . $count . '</td>';
                        $count++;
                    }
                for ($i = 0; $i < $cols; $i++) {
                    $method=$check[$i];
                    $para=$r[$i];
                    //echo ($val->$method($para)).'<br>';
                    if(empty($val->$method($para))){

                        echo '<td >' . (isset($r[$i]) ? $r[$i] : '&nbsp;') . '</td>';

                    }else{
                         echo '<td style="background-color:red;">' . (isset($r[$i]) ? $r[$i] : '&nbsp;') . '</td>';
                    }

                    
                }
                echo '</tr>';
            }

        } else {

            $page  = count($xlsx->sheetNames());
            $count = 1;
            for ($a = 0; $a < $page; $a++) {
                $dim  = $xlsx->dimension($a);
                $cols = $dim[0];

                foreach ($xlsx->rows($a) as $k => $r) {
                    //        if ($k == 0) continue; // skip first row
                    echo '<tr>';
                    if ($k == 0) {
                        echo '<td>No</td>';
                    } else {
                        echo '<td>' . $count . '</td>';
                        $count++;
                    }

                    for ($i = 0; $i < $cols; $i++) {

                        echo '<td>' . (isset($r[$i]) ? $r[$i] : '&nbsp;') . '</td>';
                    }
                    echo '</tr>';

                }

            }

        }
        echo '</table>';
    } else {
        echo SimpleXLSX::parseError();
    }

}



function excelShow($filename, $allsheet = false)
    {
        if ($xlsx = SimpleXLSX::parse($_FILES[$filename]['tmp_name'])) {
            echo '<h2>Parsing Result</h2>';
            echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';

            if ($allsheet == false) {

                $dim   = $xlsx->dimension();
                $cols  = $dim[0];
                $count = 1;

                foreach ($xlsx->rows() as $k => $r) {
                    //        if ($k == 0) continue; // skip first row
                    echo '<tr>';
                    if ($k == 0) {
                        echo '<td>No</td>';
                    } else {
                        echo '<td>' . $count . '</td>';
                        $count++;
                    }
                    for ($i = 0; $i < $cols; $i++) {
                        echo '<td>' . (isset($r[$i]) ? $r[$i] : '&nbsp;') . '</td>';
                    }
                    echo '</tr>';
                }

            } else {

                $page  = count($xlsx->sheetNames());
                $count = 1;
                for ($a = 0; $a < $page; $a++) {
                    $dim  = $xlsx->dimension($a);
                    $cols = $dim[0];

                    foreach ($xlsx->rows($a) as $k => $r) {
                        //        if ($k == 0) continue; // skip first row
                        echo '<tr>';
                        if ($k == 0) {
                            echo '<td>No</td>';
                        } else {
                            echo '<td>' . $count . '</td>';
                            $count++;
                        }

                        for ($i = 0; $i < $cols; $i++) {

                            echo '<td>' . (isset($r[$i]) ? $r[$i] : '&nbsp;') . '</td>';
                        }
                        echo '</tr>';

                    }

                }

            }
            echo '</table>';
        } else {
            echo SimpleXLSX::parseError();
        }

    }



?>