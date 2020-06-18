<?php

/**
 * Database class
 * @param  extend PDO
 */
class Database extends PDO
{

    public function __construct($DBTYPE, $DBHOST, $DBNAME, $DBUSER, $DBPWS)
    {
        //parent::__construct('mysql:host=localhost;dbname=ums','root','');
        parent::__construct($DBTYPE . ':host=' . $DBHOST . ';dbname=' . $DBNAME, $DBUSER, $DBPWS);
        date_default_timezone_set("Asia/Yangon");
    }

    /**
     * Create function
     * @param  [array]   $data -> insert data
     * @param  [string]   $table -> table name
     * @return [boolean]   true /false ->success/fail
     */

    public function insert($data, $table)
    {

        $check = false;

        // date value should be true or false
        if (isset($data['date'])) {
            $date         = date("Y-m-d h:i:s");
            $data['date'] = $date;

        }

        $attribute = '`' . implode('`,`', array_keys($data)) . '`';
        $param     = ' :' . implode(',:', array_keys($data));

        // echo $attribute;
        // echo $param;

        $query = "INSERT INTO $table ($attribute) VALUES ($param)";

        $insert = $this->prepare($query);

        foreach ($data as $key => $value) {
            $insert->bindValue(":$key", $value);
            // echo ($key . '=>' . $value);
        }

        if ($insert->execute()) {
            $check = true;
        }

        return $check;

    }

    /**
     * Read function
     * @param  [array/null]   $data -> require data
     * @param  [string]   $table -> table name
     * @param  [array/null]   $where -> predicate
     * @return [array]   data from table
     */

    public function retrieve($data = null, $table, $where = null)
    {

        $check      = false;
        $attribute  = ''; //data
        $prediciate = ''; //where
        if ($data != null && $where != null) {

            foreach ($data as $key => $value) {
                $attribute = '`' . implode('`,`', array_values($data)) . '`';
            }

            $tempattr = [];
            foreach ($where as $key => $value) {
                $tempattr[] = '`' . $key . '`' . '=:' . $key;
            }

            $predicate = implode(" AND ", $tempattr);
            //echo "SELECT {$attribute} FROM {$table} WHERE {$predicate}";
            $query    = "SELECT {$attribute} FROM {$table} WHERE {$predicate}";
            $retrieve = $this->prepare($query);
            foreach ($where as $key => $value) {
                $retrieve->bindValue(":$key", $value);
                //echo ($key . '=>' . $value);
            }

        } elseif ($where != null) {

            $tempattr = [];
            foreach ($where as $key => $value) {
                $tempattr[] = '`' . $key . '`' . '=:' . $key;
            }

            $predicate = implode(" AND ", $tempattr);
            //echo "SELECT * FROM {$table} WHERE {$predicate}";
            $query    = "SELECT * FROM {$table} WHERE {$predicate}";
            $retrieve = $this->prepare($query);
            foreach ($where as $key => $value) {
                $retrieve->bindValue(":$key", $value);
                //echo ($key . '=>' . $value);
            }

        } elseif ($data != null) {

            foreach ($data as $key => $value) {
                $attribute = '`' . implode('`,`', array_values($data)) . '`';
            }
            //echo "SELECT {$attribute} FROM $table";
            $query    = "SELECT {$attribute} FROM $table";
            $retrieve = $this->prepare($query);

        } else {
            //echo "SELECT * FROM $table";
            $query    = "SELECT * FROM $table";
            $retrieve = $this->prepare($query);

        }

        $retrieve->execute();
        $result = $retrieve->fetchAll();
        if ($result) {
            return $result;
        } else {
            return $check;
        }

    }

    /**
     * Update function
     * @param  [array-]   $data -> update data
     * @param  [string]   $table -> table name
     * @param  [array/null]   $where -> predicate
     * @return [boolean]   true/false -> success/fail
     */

    public function update($data, $table, $where)
    {

        $check = false;

        if (isset($data['date'])) {
            $date         = date("Y-m-d h:i:s");
            $data['date'] = $date;

        }

        $attrParam = '';

        foreach ($data as $key => $value) {
            $attrParam .= "`$key`=:$key,";
        }
        $attrParam = rtrim($attrParam, ',');

        $query = "UPDATE $table SET $attrParam WHERE $where";

        $update = $this->prepare($query);

        foreach ($data as $key => $value) {
            $update->bindValue(":$key", $value);

        }

        if ($update->execute()) {
            $check = true;
        }

        return $check;

    }

    /**
     * Delete function
     * @param  [array]   $id -> predicate
     * @param  [string]   $table -> table name
     * @return [boolean]   true/false -> success/fail
     */

    public function delete($id, $table, $limit = 1)
    {

        $check = false;

        $prediciate = '`' . implode('`,`', array_keys($id)) . '`' . '=:' . implode(',:', array_keys($id));

        $param = ':' . implode(',:', array_keys($id));
        $value = implode('', array_values($id));

        $query  = "DELETE FROM $table WHERE $prediciate LIMIT $limit";
        $delete = $this->prepare($query);
        $delete->bindValue($param, $value);
        if ($delete->execute()) {
            $check = true;
        }

        return $check;

    }

    /**
     * Read function(need query for what you want to get data from table)
     * @param  [string]   $query -> query string
     * @param  [array/null]   $where -> predicate
     * @param  [pdo::method]   $fetchmode -> fetch mode from pdo
     * @return [array]   data from table
     */

    public function select($query, $where = [], $fetchMode = PDO::FETCH_ASSOC)
    {

        $check  = false;
        $select = $this->prepare($query);
        //echo $query;
        //print_r($where);
        foreach ($where as $key => $value) {
            $select->bindValue(":$key", $value);
        }
        $select->execute();
        $result = $select->fetchAll($fetchMode);
        if ($result) {
            return $result;
        } else {
            return $check;
        }

    }

    public function selectdelete($query, $where = [])
    {

        $check     = false;
        $selectdel = $this->prepare($query);
        //echo $query;
        //print_r($where);
        foreach ($where as $key => $value) {
            $selectdel->bindValue(":$key", $value);
        }

        if ($selectdel->execute()) {
            $check = true;
        }
        return $check;

    }

    // $data=['rank','country','pol','est','world'];
    // excelInsert('excel',$data,'file',true);

    public function excelInsert($table, $data, $filename, $allsheet = false)
    {
        $check     = false;
        $attribute = '`' . implode('`,`', array_values($data)) . '`';
        $param     = ' :' . implode(',:', array_values($data));

        // echo $attribute;
        // echo $param;

        $query  = "INSERT INTO $table ($attribute) VALUES ($param)";
        $insert = $this->prepare($query);

        if ($xlsx = SimpleXLSX::parse($_FILES[$filename]['tmp_name'])) {

            if ($allsheet == false) {

                $dim        = $xlsx->dimension();
                $cols       = $dim[0];
                $insertData = $xlsx->rows();
                unset($insertData[0]);
                foreach ($insertData as $fields) {
                    foreach ($fields as $key => $value) {
                        $insert->bindValue(":$data[$key]", $value);
                        // echo ($key . '=>' . $value);
                    }

                    if ($insert->execute()) {
                        $check = true;
                    } else {
                        $check = false;
                        exit;
                    }

                }

            } else {

                $page  = count($xlsx->sheetNames());
                $count = 1;
                for ($a = 0; $a < $page; $a++) {
                    $dim        = $xlsx->dimension($a);
                    $cols       = $dim[0];
                    $insertData = $xlsx->rows($a);
                    unset($insertData[0]);
                    foreach ($insertData as $fields) {
                        foreach ($fields as $key => $value) {
                            $insert->bindValue(":$data[$key]", $value);
                            // echo ($key . '=>' . $value);
                        }

                        if ($insert->execute()) {
                            $check = true;
                        } else {
                            $check = false;
                            exit;
                        }

                    }

                }

            }

        } else {
            $check = SimpleXLSX::parseError();
        }

        return $check;
    }

    // $data=['rank','country','pol','est','world'];
    // csvInsert('excel',$data,'file');
    public function csvInsert($table, $data, $filename)
    {
        $check     = false;
        $attribute = '`' . implode('`,`', array_values($data)) . '`';
        $param     = ' :' . implode(',:', array_values($data));

        // echo $attribute;
        // echo $param;

        $query  = "INSERT INTO $table ($attribute) VALUES ($param)";
        $insert = $this->prepare($query);

        $fileName = $_FILES[$filename]["tmp_name"];

        
        if (($handle = fopen($fileName, "r")) !== false) {

            while (($column = fgetcsv($handle, 1000, ",")) !== false) {
                // $num  = count($column);
                // $keys = count($data);

                foreach ($column as $key => $value) {
                    $insert->bindValue(":$data[$key]", $value);
                    // echo ($data[$key] . '=>' . $value);
                }

                if ($insert->execute()) {
                    $check = true;
                } else {
                    $check = false;
                    exit;
                }
               
            }

            fclose($handle);
        }

         return $check;
    }

    // $data['id']= array("1", "2", "3", "4");
    // $table =table name
    public function selectedData($table, $reqdata)
    {
        $check      = false;
        $prediciate = '';
        $tempattr   = [];
        $result     = [];
        foreach ($reqdata as $key => $value) {
            $tempattr[] = '`' . $key . '`' . '=:' . $key;
            $predicate  = implode("", $tempattr);
            foreach ($value as $keyvalue) {
                $query    = "SELECT * FROM {$table} WHERE {$predicate}";
                $retrieve = $this->prepare($query);
                $retrieve->bindValue(":$key", $keyvalue);
                if ($retrieve->execute()) {
                    $result[] = $retrieve->fetchAll();
                } else {
                    return $check;
                    exit();
                }

            }
        }

        return $result;
    }

    // $data['id']= array("1", "2", "3", "4");
    // $table =table name
    public function deleteData($table, $reqdata, $limit = 1)
    {
        $check     = false;
        $predicate = '';
        $tempattr  = [];

        foreach ($reqdata as $key => $value) {
            $tempattr[] = '`' . $key . '`' . '=:' . $key;
            $predicate  = implode("", $tempattr);
            foreach ($value as $keyvalue) {
                $query  = "DELETE FROM {$table} WHERE {$predicate} LIMIT $limit";
                $delete = $this->prepare($query);
                $delete->bindValue(":$key", $keyvalue);
                if ($delete->execute()) {
                    $check = true;
                } else {

                    $check = false;
                    return $check;
                    exit();
                }

            }
        }

        return $check;
    }

}

/**
 *@param
 *@param
 *@param
 *@param
 *@param
 */
