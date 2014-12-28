<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class AcceptanceHelper extends \Codeception\Module
{
	
	public function logInAsAdminUser()
	{
		$browser = $this->getModule('PhpBrowser');
		
		/**
		 * If we use WebDriver (selenium) then maybe it would be worth putting those
		 * tests into another suite e.g. AcceptanceSelenium. Then it would just mean
		 * the browser variable would be set like this $browser = $this->getModule('WebDriver');
		 */
		
		$browser->amOnPage('/admin');
		$browser->fillField('User Name:','alan');
		$browser->fillField('Password:','password1');
		$browser->click('Login');
	}
}