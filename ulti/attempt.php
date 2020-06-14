<?php
function Checklog($value = '')
{
    # code...

    $msg        = '';
    $ctime      = time() - 30;
    $ip_address = getIpAddr();
// Getting total count of hits on the basis of IP

    $query = $this->db->prepare('SELECT count(*) FROM loginlogs  WHERE TryTime >:ctime AND IpAddress=:ip_address');
    $query->execute(array(
        ':ctime'      => $ctime,
        ':ip_address' => $ip_address,
    ));
    $data        = $query->fetch();
    $total_count = $data['count'];
//Checking if the attempt 3, or youcan set the no of attempt her. For now we taking only 3 fail attempted
    if ($total_count == 3) {
        $msg = "To many failed login attempts. Please login after 30 sec";
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
            $query = $this->db->prepare('DELETE FROM loginlogs WHERE IpAddress=:ip_address');
            $query->execute(array(':ip_address' => $$ip_address));
            Session::Init();
            Session::Set('loginvalue', true);
            Session::Set('role', $data['role']);
            Session::Set('id', $data['user_id']);
            Auth::doLog($data['user_id'], 'ulti/log.txt');
            header('location:http://localhost/toxic/dashboard');

        } else {
            $total_count++;
            $rem_attm = 3 - $total_count;
            if ($rem_attm == 0) {
                $msg = "To many failed login attempts. Please login after 30 sec";
            } else {
                $msg = "Please enter valid login details.<br/>$rem_attm attempts remaining";
            }
            $try_time = time();
            $query    = $this->db->prepare('INSERT INTO loginlogs (TryTime,IpAddress)VALUES (:ctime,:ip_address)');
            $query->execute(array(
                ':ctime'      => $ctime,
                ':ip_address' => $ip_address,
            ));
            Session::Destory();
            header('location:http://localhost/toxic/login');
        }
    }
}
// Getting IP Address
function getIpAddr()
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
