<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Models/post.php';
include '../WPxmlRPC/manageWordpress.php';

function testBuildArrayOfPosts() {
         $post = new \wordpressXMLRPC\manageWordpress();
         $postArray = $post->buildPostsFromCsvFile('c:\\tmp\\postToAshirForZals.csv');
         $post->sendListOfPostToSite($postArray);
         $this->assertFalse($postArray);
     }
     testBuildArrayOfPosts();
