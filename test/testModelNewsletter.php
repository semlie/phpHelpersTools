<?php

require_once '../Models/newsletter.php';

class NewsletterModelTest extends PHPUnit_Framework_TestCase {

    public function testNewletterModelGet() {
        $nl = model\newsletter::create()->setEmailSubject("sub")->setMessege("this is messege")->setSeqNewsletter("3 day")->setSycleDay(13)->setUrl("/aaa/bbb");
list($a,$b) = $nl;
var_dump($a);
        $this->assertTrue(count($b) > 0);
    }

}
