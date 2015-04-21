<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace wishlist;

require_once ( dirname(__FILE__) . '/../interface/IwishList.php');
require_once 'wlmapiclass.php';
require_once (dirname(__FILE__) . '/../Models/usersModel.php');
require_once (dirname(__FILE__) . '/../config.php');

/**
 * Description of managmentWishlist
 *
 * @author Admin
 */
class managmentWishlist implements \IwishList {

    private $api;

    public function __construct() {
        $this->api = new wlmapiclass(WLaddress, WLapikey);
        $this->api->return_format = 'php';
    }

    private function createNewUser(\model\usersModel $user) {

//add the data to send 
        $data = array();
        $data['user_login'] = $user;
        $data['user_email'] = $email;
        $data['user_pass'] = $user_pass;
        $data['address1'] = $address;
        $data['city'] = $city;
        $data['country'] = $country;
        $data['Levels'] = $levels;
        //expretion date 

        $expDateFild = "custom_exp_date_" . $maslul;
        $data[$expDateFild] = $expDate;
        //send it 
        $response = $api->post('/members', $data);
        $response = unserialize($response);

        try {
            if (is_a($response, 'array')) {
                list($success, $all) = $response;
            } else {
                $success = $response['success'];
            }
        } catch (Exception $exc) {
            errLog($exc->getTraceAsString());
        }

        if ($success) {
            $returnMessage[] = array("Success" => 'ההרשמה הסתימה בהצלחה');
            sendtofile("GOOD", $dataToLog);
            mail("israellieb@gmail.com", "נרשם משתמש חדש", "פרטים: $dataToLog");
        } else {
            
        }
    }

    public function addNewUser(\model\usersModel $user) {
        $userID = $this->findUserByEmail($user->getEmail());
        if ($userID) {
            return $userID;
        } else {
            return $this->createNewUser($user);
        }
    }

    public function addUserToLevel($levelId, $UserID) {
        
    }

    public function deleteUserById($userId) {
        
    }

    public function deleteUserFromLevel($levelId, $UserID) {
        $response = $this->api->delete('/levels/' . $levelId . '/members/' . $UserID);
        $response = unserialize($response);
        var_dump($response);
    }

    public function editUserDetails(\model\usersModel $user) {
        
    }

    public function findUserByEmail($email) {
        $mambers = $this->getAllUsers();
        foreach ($mambers['members']['member'] as $key => $valeu) {
            if ($valeu['user_email'] == $email) {
                return $valeu;
            }
        }
        return false;
    }

    public function getAllUsers() {
        $response = $this->api->get('/members');
        return unserialize($response);
    }

    public function getUserIdByEmail($userEmail) {
        $ret = $this->findUserByEmail($userEmail);
        return $ret != false ? $ret['id'] : $ret;
    }

    public function getUserInfo($userId) {
        $response = $this->api->get('/members/' . $userId);
        return unserialize($response);
    }

    public function getUserlevelsByEmail($email) {
        $userId = $this->getUserIdByEmail($email);
        return $userId != false ? $this->getUserlevels($userId) : false;
    }

    public function getUserlevels($userId) {
        if ($userId == false) {
            return false;
        }
        $ret = $this->getUserInfo($userId)["member"][0]["Levels"] ;
        return $ret ;
    }

    public function calculateLevelDate($timeStamp) {
        $now = time();
        $subTime = $now - $timeStamp;
        $y = ($subTime / (60 * 60 * 24 * 365));
        $d = ($subTime / (60 * 60 * 24)) % 365;
        return (int) (floor($y) * 365 + floor($d));
    }

    public function getHowManyDaysInLevel($userId, $levelId) {
        $userId ? $user = $this->getUserlevels($userId) : "";
        var_dump($user);
        return $user?$this->calculateLevelDate($user[$levelId]->Timestamp):false;
    }

    public function getAllLevels() {
        $response = $this->api->get('/levels');
        return unserialize($response)['levels']['level'];
    }

//put your code here
}
