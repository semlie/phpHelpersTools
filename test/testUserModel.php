<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../Models/usersModel.php';
class testUserModel extends PHPUnit_Framework_TestCase {

    public function testSerilaize() {
        $a = new usersModel();
        $a->setUserName("sem")->setFullName("lieb")->setAddress("hertzog 16")->setEmail("a@a.com");
        print_r((array)$a);
        print_r(json_encode((array)$a));
        $this->assertTrue(true);
    }

}
