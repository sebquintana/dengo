<?php namespace Codeception\Module;

use Laracasts\TestDummy\Factory as TestDummy;
use Dengo\News\News;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module
{

	public function signIn()
	{
		$user = 'Foobar';
		$email = 'test@test.com';
		$password = 'test';
		// $this->haveAnAccount(compact('email', 'password'));

		$I = $this->getModule('Laravel4');

		$I->amOnPage('/');
		$I->click('Registrate');
		$I->seeCurrentUrlEquals('/register');

		$I->fillField('Usuario:', $user);
		$I->fillField('Email:', $email);
		$I->fillField('Contraseña:', $password);
		$I->fillField('Confirmación de contraseña:', "test");
		$I->click('Registrarme');

		//$I->click('Cerrar Sesión');

		$I->amOnPage('/login');
		$I->fillField('email', $email);
		$I->fillField('password', $password);
		$I->click('Iniciar Sesión');
	}

	public function have($model, $overrides = []) 
	{
		return TestDummy::create($model, $overrides);
	}

	public function postAStatus($body) 
	{
		$I = $this->getModule('Laravel4');

		$I->fillField('body', $body);
		$I->click('Post Status');
	}

	public function haveAnAccount($overrides = []) 
	{
		return $this->have('Dengo\Users\User', $overrides);
	}

	public function haveTestingNews($overrides = []) 
	{
		return $this->have('Dengo\News\News', $overrides);
	}
}
