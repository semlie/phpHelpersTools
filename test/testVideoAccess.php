<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../access/videoAccessImp.php';
class videoAccessTest extends PHPUnit_Framework_TestCase {
    function testIsUser() {
        $a = new videoAccessImp();
        $b =$a->IsUser("israellieb@gmail.com");
        $this->assertTrue($b==true);
    }
    function testIsUserInLevel() {
        $a = new videoAccessImp();
        $b = $a->IsUserInLevel(1, 1212);
        print_r($b);
        $this->assertTrue($b);
    }
    public function testgetLevelId() {
         $a = new videoAccessImp();
        $b = $a->getLevelId("time-managemant");
        print_r($b);
        $this->assertTrue($b!=false);
    }
    
}