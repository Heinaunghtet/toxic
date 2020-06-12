<?php 

/**
 * 
 */
class Files
{
	

	public static function uploadFile($filename, $dir, $uniqname = false)
    {
        //$dir    = "uploads/";
        $target_file = '';
        $temp_path   = $_FILES[$filename]["tmp_name"];
        if ($uniqname) {
            //$uniquesavename= uniqid();
            $uniquesavename = time() . uniqid(rand());
            $fname          = $_FILES[$filename]['name'];
            $ext            = pathinfo($fname, PATHINFO_EXTENSION);
            $new_name       = $uniquesavename . '.' . $ext;
            $target_file    = $dir . $new_name;
        } else {
            $new_name    = basename($_FILES[$filename]["name"]);
            $target_file = $dir . $new_name;
        }

        if (move_uploaded_file($temp_path, $target_file)) {
            return $new_name;
        } else {
            return false;
        }

    }

    public static function uploadFiles($filename, $dir, $uniqname = false)
    {
        //$dir    = "uploads/";
        $total       = count($_FILES[$filename]["name"]);
        $total_files = [];
        for ($i = 0; $i < $total; $i++) {
            $target_file = '';
            if ($uniqname) {
                $uniquesavename = time() . uniqid(rand());
                $fname          = $_FILES[$filename]['name'][$i];
                $ext            = pathinfo($fname, PATHINFO_EXTENSION);
                $new_name       = $uniquesavename . '.' . $ext;
                $target_file    = $dir . $new_name;
            } else {
                $new_name     = basename($_FILES[$filename]["name"][$i]);
                $target_file = $dir . $new_name;
            } // name conditon end

            $temp_path = $_FILES[$filename]["tmp_name"][$i];

            if ($temp_path != '') {
                if (move_uploaded_file($temp_path, $target_file)) {
                    $total_files[]=$new_name;
                } else {
                    return false;
                }

            } //upload condition end

        } //forloop end

        return $total_files;
    }

    public static function deleteFile($filename, $directory)
    {
        $path = $directory . $filename;
        if (unlink($path)) {
            return true;

        } else {
            return false;

        }
    }

// $files = ['./first.jpg','./second.jpg','./third.jpg'];
    public static function deletfiles($files = '', $directory)
    {
        foreach ($files as $file) {
            $path = $directory . $filename;
            if (file_exists($path)) {
                if (unlink($path)) {
                    return true;

                } else {
                    return false;

                }
            } else {
                return false;
            }
        }
    }

// $directory = "Articles/";
    public static function alldelete($directory, $remain = '')
    {

        // Open a directory, and read its contents
        if (is_dir($directory)) {
            if ($opendirectory = opendir($directory)) {
                while (($file = readdir($opendirectory)) !== false) {
                    if (strpos($file, $remain) !== false) {
                        unlink($directory . $file);
                    }
                }
                closedir($opendirectory);
            }
        }
    }


}
?>