<?php

include '../CrmApi.php';

class crmTest extends PHPUnit_Framework_TestCase {

    // ...


//    public function testGetUserById() {
//        // Arrange
//        $crm = new \CrmApi();
//        $b = $crm->getCrmContactByUserId(1);
//        // Act
//        // Assert
//        $this->assertEquals(1, $b['id']);
//    }
//
//    public function testSearchUserByEmail() {
//        // Arrange
//        $crm = new \CrmApi();
//        $c = $crm->searchCrmContactByEmail("iiii@gmmmail.com");
//        // Act
//        // Assert
//        var_dump($c);
//        
//        $this->assertEquals(1, $c['id']);
//    }
    public function testDeleteUser() {
        // Arrange
        $crm = new \CrmApi();
        $n = $crm->searchCrmContactByEmail("iiii@gmmmail.com");
        $c = $crm->deleteCrmContact($n);
        // Act
        // Assert
        $this->assertFalse($c);
    }
//    public function testSAddNewUser() {
//        // Arrange
//        $crm = new \CrmApi();
//        $c = $crm->addNewCrmContact($crm->buildUserData(""));
//        // Act
//        // Assert
//        var_dump($c);
//        $this->assertEquals(1, $c);
//    }

    // ...
}
