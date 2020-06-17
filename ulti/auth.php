<?php

/**
 *
 */
class Auth
{

    public function loginAuth()
    {
        Session::Init();
        $check = Session::Get('loginvalue');
        $admin = Session::Get('role');

        {
            if ($check == false) {
                Session::Destory();
                header('location:http://localhost/toxic/login');
                exit;
            }
        }
    }

    public function doLog($text,$filename)
    {
        // open log file
        //$filename = "ulti/log.txt";
        $fh       = fopen($filename, "a") or die("Could not open log file.");
        fwrite($fh, date("d-m-Y, H:i") . " - $text\n") or die("Could not write file!");
        fclose($fh);
    }

    public function getIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddr = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ipAddr = $_SERVER['REMOTE_ADDR'];
        }
        return $ipAddr;
    }
}
