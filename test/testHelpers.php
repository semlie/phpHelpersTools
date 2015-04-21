<?php

include '../helpers.php';

class testHelpers extends PHPUnit_Framework_TestCase {

    function testRedeRemoteCsvFile(){
        $h = new helpers();
        $ret =$h->readCsvFileFromWebAndReturnArray("fileName");
        print_r($ret);
        $this->assertTrue($ret!=null);
    }
}