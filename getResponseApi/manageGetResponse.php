<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace getResponse;

require_once '../Models/newsletter.php';
require_once '../getResponseApi/getResponseApi.php';
require_once '../helpers.php';
require_once '../config.php';

/**
 * Description of manageGetResponse
 *
 * @author Admin
 */
class manageGetResponse {

    private $getRes;
    private $listId;

    public function __construct() {
        
        $this->getRes = new \getResponse\GetResponse(ApiKeyGetResponse);
    }
    public function setListId($param) {
        $this->listId = $param;
        return $this;
    }
    public function arrayToNewsletersArray($fileName) {
        $linesArray = \helpers::readCsvFileAndReturnArray($fileName);

        $newsLetersArray = Array();

        foreach ($linesArray as $value) {

            $a = \model\newsletter::create()->setTitle($value[0])->setSeqNewsletter($value[1])->setMessege($value[2])->setUrl($value[3])->setEmailSubject($value[4])->setSycleDay($value[5]);

//            $a['subject'] = $value[0];
//            $a['cycle_day'] = $value[3];
//            $a['html'] = $value[1];
            $newsLetersArray[] = $a;
        }
        return $newsLetersArray;
    }

    public function sendNewsletterToGetResponse(\model\newsletter $newsletter) {
        list($title,$seqNewsletter, $msg, $url, $emailSubject, $cycle_day) = $newsletter->getNewsletter();
        $html = $this->buildNewsLeterTemplate($emailSubject, $seqNewsletter, $msg, $url);
        return $this->getRes->addAutoresponder($this->listId, $emailSubject, $cycle_day, $html);
    }

    public function buildNewsLeterTemplate($sub, $seqMsg, $msg, $url) {
        $file = file_get_contents('newsleter_template.txt', TRUE);
       // var_dump($file);
        // $a = $this->arrayToNewsletersArray($this->readCsvToArray($fileName))
//        $sub = '';
//        $mesNum = '';
//        $messege = '';
//        $url = '';
        $formated = str_replace("%%","%",sprintf($file, $msg, $seqMsg,$url));
        //var_dump($formated);
        return $formated;
    }

}
