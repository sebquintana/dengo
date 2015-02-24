<?php 
$I = new FunctionalTester($scenario);
$I->am('un nuevo usuario sin cuenta');
$I->wantTo('registrame una cuenta en dengo');

$I->amOnPage('/');
$I->click('Registrate!');
$I->seeCurrentUrlEquals('/register');

$I->fillField('Usuario:', "JuanRomanRiquelme");
$I->fillField('Email:', "jr10@mail.com");
$I->fillField('Contraseña:', "pass");
$I->fillField('Confirmación de contraseña:', "pass");
$I->click('Registrarme');

$I->seeCurrentUrlEquals('');
$I->see('Bienvenido a Dengobook!');
$I->seeRecord('users', [
	'username' => 'JuanRomanRiquelme',
	'email' => 'jr10@mail.com'
]);

$I->assertTrue(Auth::check());