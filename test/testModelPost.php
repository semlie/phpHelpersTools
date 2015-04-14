<?php

include '../Models/post.php';
include '../WPxmlRPC/manageWordpress.php';

class crmTest extends PHPUnit_Framework_TestCase {
     public function testModels() {
        // Arrange
        $crm = \model\post::create()->setSubj("name")->setDesc("subcect")->setcustumFields(array("key"=>"video","value"=>"/yael/a.mp4"))->getPost();
        var_dump($crm);

        // Act
        // Assert
        list($a,$b,$c) = $crm;
        $this->assertFalse($a);
     }
//     public function testAddNewPost() {
//          $crm = \model\post::create()->setSubj("name")->setDesc("subcect")->setcustumFields(array("key"=>"video","value"=>"/yael/a.mp4"));
//         $post = new \wordpressXMLRPC\manageWordpress();
////         $add =$post->addNewPost($crm);
//         var_dump($add);
//         $arrPosts = $post->getArrayOfDataAndBuildPostArray(Array(Array("a","b","c"),Array("a1","b2","c3")));
//         var_dump($arrPosts);
//         $this->assertTrue($arrPosts[1] instanceof \model\post);
//     }
     public function testBuildArrayOfPosts() {
         $post = new \wordpressXMLRPC\manageWordpress();
         $postArray = $post->buildPostsFromCsvFile('c:\\tmp\\postToAshirForZals.csv');
         $post->sendListOfPostToSite($postArray);
         $this->assertFalse($postArray);
     }
//     public function testGetPosts() {
//         $post = new \wordpressXMLRPC\manageWordpress();
//         var_dump($post->getPostById(""));
//     }
}
