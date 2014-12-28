<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('log in as an admin user');

$I->logInAsAdminUser();
$I->see('Dashboard');