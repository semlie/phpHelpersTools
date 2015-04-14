<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace wishlist;

require_once 'managmentWishlist.php';

/**
 * Description of ashiraDeleteExpairdSubscribtion
 *
 * @author Admin
 */
class ashiraDeleteExpairdSubscribtion {

    //put your code here
    private $wl;
    private $UsersList;

    public function __construct() {
        $this->wl = new \wishlist\managmentWishlist();
        $this->UsersList = $this->wl->getAllUsers();
    }

    public function getUserIdByMail($email) {
        //var_dump($this->UsersList);
        foreach ($this->UsersList["members"]['member'] as $value) {
            //var_dump($value['user_email']);
            if ($value['user_email'] == $email)
                return $value['id'];
        }
        return FALSE;
    }

    public function mapUsers($UserArr) {
//            ["member"][0]
        $ret = Array();
        foreach ($UserArr as $value) {
          //  var_dump($UserArr);
            if ($uId = $this->getUserIdByMail($value['email'])) {
                $value['UserId'] = $uId;
                $ret[] = $value;
            }
        }
        return $ret;
    }

    public function mapExierdDateLevels($usersList) {
        foreach ($usersList as $user) {
            try {
                $this->removeExpiered($user);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
    }

    public function isDateExpird($param) {
        
    }

    function removeExpiered($parm) {
        $s = json_decode($parm['sub'], TRUE);
        if (is_array($s)) {
            foreach ($s as $key => $value) {
                if ($value != "" && $key != "sub10") {
                    if ($this->timeDelta($value)) {
                        $this->removeFromLevel($parm["UserId"], $key);
                        $this->sendtofile("remove", $parm["email"] . ", from:" . $key);
                    }
                }
            }
        }
    }

    private function timeDelta($oldDate) {
        $d = date('Y-m-d');
        //print_r($d);
        if (date('Y-m-d', strtotime($oldDate)) < $d)
            return TRUE;
        return FALSE;
    }

    public function removeFromLevel($userId, $sub) {
        $levels = Array();
        switch ($sub) {
            case 'sub10':

                $levels[] = '1399927557';
                $levels[] = '1406849722';
                break;
            case 'sub40':

                $levels[] = '1406849698';
                $levels[] = '1399927557';
                break;
            case 'sub44':
                $levels[] = '1406849698';
                $levels[] = '1399927557';
                break;

            case 'sub30':
                $levels[] = '1399927557';
                break;

            case 'sub34':
                $levels[] = '1399927557';
                break;

            case 'sub50':
                $levels[] = '1406849722';
                $levels[] = '1406849698';
                break;
            case 'sub54':
                $levels[] = '1406849722';
                $levels[] = '1406849698';
        }
        foreach ($levels as $level) {
            $this->wl->deleteUserFromLevel($level, $userId);
        }
    }

    public function sendtofile($stat, $parm) {
        $log = $stat . ", " . $parm . " ," . date("d/m/Y H:i:s") . "\n";
        $fileName = "removes.csv";
        $file = fopen($fileName, 'a') or die("Can't open log file");
        fwrite($file, $log);
        fclose($file);
    }

}
