<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of helpers
 *
 * @author Admin
 */
class helpers {

    //put your code here
    public static function readCsvFileAndReturnArray($fileName) {
        $arr = Array();
        $file = fopen($fileName, "r");

        while (!feof($file)) {
            $arr[] = fgetcsv($file);
        }
        fclose($file);
        return $arr;
    }

    public static function readCsvFileFromWebAndReturnArray($fileName) {
        $arr = Array();
        $videoId = 1;
        $baseUrl = "http://vid.yaelzals.co.il/files/"; //time-management.csv";
        $file = file_get_contents($baseUrl . $fileName);
        $convert = explode("\n", $file);
        for ($index = 0; $index < count($convert)-1; $index++) {
            $row = explode(",", $convert[$index]);
            
          $arr[] = Array("videoId" => ($videoId++), "day" => $row[1], "name" => $row[0], "path" => $row[2], "attachFile" => ($row[3]!="\r")?$row[3]:"");
        }
        
        return $arr;
    }

}
