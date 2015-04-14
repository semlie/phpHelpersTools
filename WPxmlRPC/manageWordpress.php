<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace wordpressXMLRPC;

require_once '../vendor/hieu-le/wordpress-xmlrpc-client/src/WordpressClient.php';
require_once '../Models/post.php';
require_once '../helpers.php';
require_once '../config.php';

/**
 * Description of manageWordpress
 *
 * @author Admin
 */
class manageWordpress {

    private $wp;

    public function __construct() {
        $this->wp = new \HieuLe\WordpressXmlrpcClient\WordpressClient(WPSiteUrl, WPUser, WPPas);
    }

    public function getPostById($param) {
        return $this->wp->getPosts();
    }

    public function addNewPost(\model\post $post) {
        
        list($sub, $desc, $customFields) = $post->getPost();
        $ret = $this->wp->newPost($sub, $desc, $customFields);
        var_dump($ret);
        
        return $ret;
        // list($a);
    }

    public function getArrayOfDataAndBuildPostArray($param) {
        $ret = Array();
        foreach ($param as $value) {
            $ret[] = \model\post::create()->setSubj($value[0])->setDesc($value[1])->setcustumFields(Array("key" => "video", "value" => $value[2]));
        }
        return $ret;
    }

    public function buildPostsFromCsvFile($file) {
        $fileLines = \helpers::readCsvFileAndReturnArray($file);
        return $this->getArrayOfDataAndBuildPostArray($fileLines);
    }

    public function sendListOfPostToSite(array $list) {
        foreach ($list as $value) {
            if ($value instanceof \model\post) {
                try {
                    $this->addNewPost($value);
                } catch (Exception $exc) {
                    echo $exc->getTraceAsString();
                }
            }
        }
    }
    public function getUserId($user) {
        
    }

}
