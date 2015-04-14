<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../wishList/managmentWishlist.php';

class testWLmanagment extends PHPUnit_Framework_TestCase {

    public function testGetUser() {
        $wl = new \wishlist\managmentWishlist();
        print_r($u=$wl->getUserIdByEmail("a@a.com"));
        print_r($wl->getUserInfo($u));
        $this->assertTrue(1);
    }

    public function testGetLevels() {
//        $wl = new \wishlist\managmentWishlist();
//        print_r($wl->getUserlevelsByEmail("israellieb@gmail.com"));
        $this->assertTrue(false);
    }

    public function testCalcTimeLevel() {
        $wl = new \wishlist\managmentWishlist();
        $d = strtotime("-1 day");

        $n = $wl->calculateLevelDate($d);
        $this->assertEquals($n, 1);
    }

    public function testHowManyDaysInLevel() {
        $wl = new \wishlist\managmentWishlist();
        $days = $wl->getHowManyDaysInLevel(5957, 1309294999);
        var_dump($days);
        $this->assertTrue($days > 0);
    }

    public function testDeleteUSerFromLevel() {
        $wl = new \wishlist\managmentWishlist();
        $r =$wl->deleteUserFromLevel(1309294999,5957);
        var_dump($r);
        $this->assertTrue($r);
    }

}
