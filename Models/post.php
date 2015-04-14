<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of post
 *
 * @author Admin
 */
class post {
    //put your code here
    private $subject;
    private $description ;
    private $custumFields;
    public function __construct() {
        
    }
    public static function create(){
       return new self(); 
    }
    public function setDesc($param) {
        $this->description = $param;
        return $this;
        }
    public function setSubj($param) {
        $this->subject = $param;
        return $this;
        }
    public function setcustumFields(array $param) {
        $this->custumFields = Array("custom_fields" =>Array($param));
        return $this;
        }

    public function getPost() {
        return Array($this->subject,$this->description,$this->custumFields);
    }
    
}
