<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('log in as a regular user');

$I->amOnPage('/customer/account/login');
$I->fillField('Email Address','janedoe@example.com');
$I->fillField('Password','password');
$I->click('Login');
$I->see('Hello, Jane Doe!');