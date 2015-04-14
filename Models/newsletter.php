<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of newsletter
 *
 * @author Admin
 */
class newsletter {

    //put your code here
    private $seqNewsletter;
    private $messege;
    private $url;
    private $emailSubject;
    private $sycleDay;
    private $title;

    public function __construct() {
        
    }

    public static function create() {
        return new self();
    }

    public function setSeqNewsletter($param) {
        $this->seqNewsletter = $param;
        return $this;
    }

    public function setTitle($param) {
        $this->title = $param;
        return $this;
    }

    public function setMessege($param) {
        $this->messege = $param;
        return $this;
    }

    public function setUrl($param) {
        $this->url = $param;
        return $this;
    }

    public function setEmailSubject($param) {
        $this->emailSubject = $param;
        return $this;
    }

    public function setSycleDay($param) {
        $this->sycleDay = $param;
        return $this;
    }

    public function getNewsletter() {

        return Array($this->title, $this->seqNewsletter, $this->messege, $this->url, $this->emailSubject, $this->sycleDay);
    }

}
