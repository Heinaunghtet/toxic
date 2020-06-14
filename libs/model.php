<?php
/**
 *
 */
class Model
{

    public function __construct()
    {
        $this->db = new Database(DBTYPE, DBHOST, DBNAME, DBUSER, DBPWS);

    }

    

}
