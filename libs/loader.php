<?php

/**
 *
 */
class Loader
{
    private $_url = null;

    private $_controller = null;

    private $_modelPath      = 'models/';
    private $_controllerPath = 'controllers/';
    private $_errorPath      = 'error.php';
    private $_defaultPath    = 'index.php';

    public function init()
    {

        $this->_getUrl();

        if (empty($_GET['url'])) {
            $this->_loadDefault();
            return false;
        }

        $this->_loadExist();
        // $this->_loadController();
        $this->_loadControllerNew();

    }

    public function setControllerPath($path)
    {
        $this->_controllerPath = trim($path, '/') . '/';
    }

    public function setModelPath($path)
    {
        $this->_modelPath = trim($path, '/') . '/';
    }

    public function setDefaultFile($path)
    {
        $this->_defaultPath = trim($path, '/');
    }

    public function setErrorFile($path)
    {
        $this->_errorPath = trim($path, '/');
    }

    private function _getUrl()
    {
        $url               = isset($_GET['url']) ? $_GET['url'] : null;
        $url               = rtrim($url, '/');
        $url               = filter_var($url, FILTER_SANITIZE_URL);
        return $this->_url = explode('/', $url);

    }

    private function _loadDefault()
    {
        require 'controllers/index.php';
        $this->_controller = new Index();
        $this->_controller->index();
    }

    private function _loadExist()
    {
        $file = 'controllers/' . $this->_url[0] . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            $this->_error();
        }
        $this->_controller = new $this->_url[0];
        $this->_controller->LoadModel($this->_url[0]);
    }

    private function _loadController()
    {

        if (isset($this->_url[2])) {
            if (method_exists($this->_controller, $this->_url[1])) {
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                //print_r($this->_url);

            } else {
                $this->_error();

            }

        } else {
            if (isset($this->_url[1])) {
                if (method_exists($this->_controller, $this->_url[1])) {
                    $this->_controller->{$this->_url[1]}();
                    //print_r($this->_url);
                } else {
                    $this->_error();
                }

            } else {
                $this->_controller->index();
            }

        }
    }

    /**
     * @param String
     *
     *
     */

    private function _loadControllerNew()
    {
        $length = count($this->_url);

        if ($length > 1) {
            if (!method_exists($this->_controller,$this->_url[1])) {
                $this->_error();
            }
        }

        //echo $length;
        switch ($length) {
            case 5:
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
                //print_r($this->_url);
                break;
            case 4:
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
                //print_r($this->_url);
                break;
            case 3:
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                //print_r($this->_url);
                break;
            case 2:
                $this->_controller->{$this->_url[1]}();
                //print_r($this->_url);
                break;
            default:
                $this->_controller->index();
                break;
        }
    }

    private function _error()
    {
        require 'controllers/error.php';
        $this->_controller = new Errxr();
        $this->_controller->index();
        exit;
    }
}
