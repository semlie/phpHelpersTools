<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/');
$I->see('Hello defoult,');
$I->amOnPage('/leads/myUrl');
$I->fillField('firstname', 'davert');
$I->fillField('lastname', 'qwerty');
$I->click('submit');
$I->see('davert');

