<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function cleanData(&$str)
    {
        if ($str == 't') $str = 'TRUE';
        if ($str == 'f') $str = 'FALSE';
        if (preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
            $str = "'$str";
        }
        if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }

    public function fileToDownload()
    {

        $data = array(
            array("firstname" => "Mary", "lastname" => "Johnson", "age" => 25),
            array("firstname" => "Amanda", "lastname" => "Miller", "age" => 18),
            array("firstname" => "James", "lastname" => "Brown", "age" => 31),
            array("firstname" => "Patricia", "lastname" => "Williams", "age" => 7),
            array("firstname" => "Michael", "lastname" => "Davis", "age" => 43),
            array("firstname" => "Sarah", "lastname" => "Miller", "age" => 24),
            array("firstname" => "Patrick", "lastname" => "Miller", "age" => 27)
        );

        $filename = "website_data_" . date('Ymd') . ".csv";



        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: text/csv");

        $out = fopen("php://output", 'w');

        $flag = false;
        foreach ($data as $row) {
            if (!$flag) {
                // display field/column names as first row
                fputcsv($out, array_keys($row), ',', '"');
                $flag = true;
            }
            array_walk($row, array($this, 'cleanData'));
            fputcsv($out, array_values($row), ',', '"');
        }

        fclose($out);

        exit;
    }
}
