<?php

/**
 *
 */
class Login_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
        //echo "This is login model";

    }

    public function check()
    {

        $password = Hash::Create('md5', $_POST['password'], HSKEY);
        $query    = $this->db->prepare('SELECT * FROM user WHERE name=:name AND password=:password AND role=:role');
        $query->execute(array(
            ':name'     => $_POST['username'],
            ':password' => $password,
            ':role'     => $_POST['role'],
        ));
        $data  = $query->fetch();
        $count = $query->rowCount();

        if ($count > 0) {

            Session::Init();
            Session::Set('loginvalue', true);
            Session::Set('role', $data['role']);
            Session::Set('id', $data['user_id']);
            Auth::doLog($data['user_id'], 'ulti/log.txt');

            header('location:http://localhost/toxic/dashboard');

        } else {
            Session::Destory();
            header('location:http://localhost/toxic/login');
        }

    }
    public function Checklog($usertime=60,$userlimit=5)
    {
        # code...
        $time=30;
        $limit=3;
        if($usertime!=null){
            $time=$usertime;

        }
        if($userlimit!=null){
            $limit=$userlimit;
        }


        $msg        = false;
        $ctime      = time() - $time;
        $ip_address = Auth::getIpAddr();
// Getting total count of hits on the basis of IP

        $query = $this->db->prepare('SELECT count(*) as attempt FROM logs  WHERE tryTime >:ctime AND ipAddress=:ip_address');
        $query->execute(array(
            ':ctime'      => $ctime,
            ':ip_address' => $ip_address,
        ));
        $data        = $query->fetch(PDO::FETCH_ASSOC);
        $total_count = $data['attempt'];
//Checking if the attempt 3, or youcan set the no of attempt her. For now we taking only 3 fail attempted
        if ($total_count == $limit) {
            $msg = "To many failed login attempts. Please login after $time sec";
        } else {
//Getting Post Values
            $password = Hash::Create('md5', $_POST['password'], HSKEY);
            $query    = $this->db->prepare('SELECT * FROM user WHERE name=:name AND password=:password AND role=:role');
            $query->execute(array(
                ':name'     => $_POST['username'],
                ':password' => $password,
                ':role'     => $_POST['role'],
            ));
            $data  = $query->fetch();
            $count = $query->rowCount();
            if ($count > 0) {
                $query = $this->db->prepare('DELETE FROM logs WHERE ipAddress=:ip_address');
                $query->execute(array(':ip_address' => $ip_address));
                Session::Init();
                Session::Set('loginvalue', true);
                Session::Set('role', $data['role']);
                Session::Set('id', $data['user_id']);
                Auth::doLog($data['user_id'], 'ulti/log.txt');
                $msg        = true;

            } else {
                $total_count++;
                $rem_attm = $limit - $total_count;
                if ($rem_attm == 0) {
                    $msg = "To many failed login attempts. Please login after $time sec";
                } else {
                    $msg = "Please enter valid login details.<br/>$rem_attm attempts remaining $total_count";
                }
                $try_time = time();
                $query    = $this->db->prepare('INSERT INTO logs (tryTime,ipAddress)VALUES (:ctime,:ip_address)');
                $query->execute(array(
                    ':ctime'      => time(),
                    ':ip_address' => $ip_address,
                ));
                //Session::Destory();
                //$msg=false;
            }
        }

     return $msg;
    }

}
