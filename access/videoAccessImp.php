<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'IvideoAccess.php';
include_once(dirname(__FILE__) . "/../wishList/managmentWishlist.php");

/**
 * Description of videoAccessImp
 *
 * @author Admin
 */
class videoAccessImp implements IvideoAccess {

    private $cls;
    private $userInfo;
    private $levels;

    function __construct() {
        $this->cls = new \wishlist\managmentWishlist();
        $this->levels = $this->cls->getAllLevels();
    }

    public function IsUser($userEmail) {
        $ret = $this->cls->getUserIdByEmail($userEmail);
        return $ret != false ? $ret : false;
    }

    public function IsUserInLevel($userEmail, $level) {
        if ($this->userInfo["member"][0]['UserInfo']['user_email'] != $userEmail) {
            $this->userInfo = $this->cls->getUserlevels($userEmail);
        }
         
        return $this->userInfo["member"][0]['Levels'];
    }

    public function getLevelId($levelName) {
        $ret = false;
        foreach ($this->levels as $lvl) {
            $lvl['name'] == $levelName ? $ret = $lvl['id'] : "";
        }
        return $ret;
    }

    public function getAgeInLevels($userEmail, $level) {
        
    }

//put your code here
}
