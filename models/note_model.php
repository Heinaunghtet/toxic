<?php

/**
 *
 */
class Note_Model extends Model
{

    public function __construct()
    {
        //echo 'This is dashboard model<br>';
        parent::__construct();
    }

    public function userList($data = null, $id = null)
    {
        if ($id != null) {
            
            return $this->db->Retrieve('', 'note', $id);
        } else {
            return $this->db->Retrieve('', 'note', '');
        }

        return $this->db->Retrieve('', 'user', '');
    }

    public function Create($data)
    {

        return $this->db->Insert($data, 'note');
        //print_r($data);

    }

    public function Update($data)
    {
        //print_r($data);
        return $this->db->Update($data, 'note', '`note_id`=:note_id');

    }

    public function Delete($where)
    {

        return $this->db->Delete($where, 'note');

    }

    // public function list($where= null) {
    //     if ($where != null) {
    //         return $this->db->select('SELECT * FROM note WHERE `user_id`=:id', $where);
    //     } else {
    //         return $this->db->select('SELECT * FROM note');
    //     }
    // }

}
