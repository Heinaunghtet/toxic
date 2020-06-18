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

    public function exportExcel($data, $name)
    {
        $timestamp = time();
        $filename  = $name . $timestamp . '.xls';

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $isPrintHeader = false;
        foreach ($data as $row) {
            if (!$isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
        exit();
    }


    public function exportCVS($data, $name)
    {
        $timestamp = time();
        $filename  = $name . $timestamp . '.cvs';

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $isPrintHeader = false;
        foreach ($data as $row) {
            if (!$isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
        exit();
    }

    

    

}
