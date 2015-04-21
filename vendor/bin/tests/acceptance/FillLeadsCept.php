<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/');
$I->see('Hello defoult,');
$I->amOnPage('/leads/myUrl');

$I->submitForm('#update_form', array('user' => array(
     'firstname' => 'Miles',
     'lastname' => 'Davis',

)),'submit' );
//$I->click('submit');
$I->see('davert');
