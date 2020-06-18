<?php

/**
 *
 */
class Dashboard_Model extends Model
{

    public function __construct()
    {
        
        parent::__construct();
    }

    public function addUser()
    {
        print_r($_POST);
        
    }
    public function xhrInsert()
    {
        $text=$_POST['text'];
        $query=$this->db->prepare('INSERT INTO news (text)VALUES (:text)');
        $query->execute(array(
 			':text'=>$_POST['text']
 		));

        $data=array('text'=>$text,'id'=>$this->db->lastInsertId());
        echo json_encode($data);


    }

    public function xhrGet()
    {
        
        $query=$this->db->prepare('SELECT * FROM news');
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        $data=$query->fetchAll();
        echo json_encode($data);
    }

    public function xhrDelete()
    {
        $id=$_POST['id'];
        $query=$this->db->prepare('DELETE FROM news WHERE post_id=:id');
        $query->execute(array(':id'=>$id));
         
        
    }

    public function xhrUpdate()
    {
        
        $id=$_POST['id'];
        $data=$_POST['updatedata'];

        $query=$this->db->prepare('UPDATE news SET text=:text WHERE post_id=:id');
        if($query->execute(array(':id'=>$id,':text'=>$data))){
            echo 1;
        }
        
    }
}