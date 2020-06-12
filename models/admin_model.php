<?php

/**
 *
 */
class Admin_Model extends Model
{

    public function __construct()
    {
        //echo 'This is dashboard model<br>';
        parent::__construct();
    }

    public function userList($data = null, $id = null)
    {
        if ($id != null) {
            $id = ['user_id' => $id];
            return $this->db->Retrieve('', 'user', $id);
        } else {
            return $this->db->Retrieve('', 'user', '');
        }

        return $this->db->Retrieve('', 'user', '');
    }

    public function Create($data)
    {

        return $this->db->Insert($data, 'user');

    }

    public function Update($data)
    {

        return $this->db->Update($data, 'user', '`user_id`=:user_id');

    }

    public function Delete($data)
    {

        return $this->db->Delete($data, 'user');

    }

    public function list($where= null) {
        if ($where != null) {
            return $this->db->select('SELECT * FROM user WHERE `user_id`=:id', $where);
        } else {
            return $this->db->select('SELECT * FROM user');
        }
    }

}
