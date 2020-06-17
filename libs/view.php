<?php
/**
 *
 */
class View
{

    public function __construct()
    {
        //echo "This is main view <br>";
    }

    public function render($viewFile, $requireFile = false)
    {
        if ($requireFile == true) {
            require 'views/' . $viewFile . '.php';
        } else {
            require 'views/header.php';
            require 'views/' . $viewFile . '.php';
            require 'views/footer.php';
        }
    }

    public function script($script)
    {
        if ($script) {
            foreach ($script as $value) {
                echo '<script type="text/javascript" src="' . URL . 'views/' . $value . '"></script>';
            }
        }
    }
    public function style($css)
    {
        if ($css) {
            foreach ($css as $value) {
                echo '<link rel="stylesheet" href="' . URL . 'views/' . $value . '">';
            }
        }
    }

    public function excelShow($filename, $allsheet = false)
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
}
