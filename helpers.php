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

}
