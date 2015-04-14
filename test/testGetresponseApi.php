<?php

include '../getResponseApi/getResponseApi.php';
include '../getResponseApi/manageGetResponse.php';
require_once '../helpers.php';
require_once '../config.php';
require_once '../Models/newsletter.php';

class getResponseApiTest extends PHPUnit_Framework_TestCase {

    // ...

    public function testGetCmapainName() {
        // Arrange
        $api = new \getResponse\GetResponse('5d18b610393c0135e638fb506d6cc9ed');
        $campaigns = (array) $api->getCampaignByName("test2121");
        var_dump($campaigns);
        $this->assertEquals($campaigns[0], 'Vun9w');
    }

//     public function testAddAutoresponse() {
//                 $api = new \getResponse\GetResponse('5d18b610393c0135e638fb506d6cc9ed');
//                 
//                 $subject ='test subject';
//                 $cycle_day = 12;
//                 $html ="<h3>test html messege</h3>";
//                 $response = $api->addAutoresponder('Vun9w', $subject, $cycle_day, $html);
//                 var_dump($response);
//             $this->assertEquals($response,'SECCESS');    
//         
//     }
//    public function testReadCsvFile() {
//        $file = "c://tmp/get_response.csv";
//        $readFileToArr = new \getResponse\manageGetResponse();
//        $response = $readFileToArr->readCsvToArray($file);
//        $api = new \getResponse\GetResponse('5d18b610393c0135e638fb506d6cc9ed');
//        var_dump($response);
//        foreach ($response as $value) {
//                $subject =$value[0];
//                 $cycle_day = $value[3];
//                 $html =$value[1];
//                 $r = $api->addAutoresponder('Vun9w', $subject, $cycle_day, $html);
//                 var_dump($r);
//                  
//        }
//    }
//         public function testConvertArrayToNewsLeter() {
//        // Arrange
//        $readFileToArr = new \getResponse\manageGetResponse();
//        $file = "c://tmp/get_response.csv";
//        $response = $readFileToArr->readCsvToArray($file);
//        $nArray = $readFileToArr->arrayToNewsletersArray($response);
//        var_dump($nArray);
//        $this->assertEquals(count($response),  count($nArray));
//    }
    public function testSendFormatedNewsLeter() {
        // Arrange
        $getResp = new \getResponse\manageGetResponse();
        
        $fileNewsleters =  $getResp->arrayToNewsletersArray("c://tmp/getResponceYael.csv");
        $getResp->setListId("Vun9w");

        foreach ($fileNewsleters as $newsletter) {
            try {
                var_dump($getResp->sendNewsletterToGetResponse($newsletter));
            } catch (Exception $exc) {
              //  echo $exc->getTraceAsString();
            }
                    
        }
//        $response = $readFileToArr->buildNewsLeterTemplate("");
//        var_dump($response);
//        $api = new \getResponse\GetResponse('5d18b610393c0135e638fb506d6cc9ed');
//
//        $subject = 'test subject';
//        $cycle_day = 20;
//        $html = $response;
//        $r = $api->addAutoresponder('Vun9w', $subject, $cycle_day, $html);
//        var_dump($r);

        $this->assertTrue($getResp);
    }
    public function testBuildNewsletterTemplate() {
        $a = new  \getResponse\manageGetResponse();
       
        $fileA = helpers::readCsvFileAndReturnArray("c://tmp/getResponceYael.csv");
        foreach ($fileA as $value) {
            var_dump($a->buildNewsLeterTemplate("sub", "seqMsg", "msg", "url"));
        }
    }
}
