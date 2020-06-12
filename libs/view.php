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
}
