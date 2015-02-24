<?php 
$I = new FunctionalTester($scenario);

$I->am('un usuario de Dengo');
$I->wantTo('ver las Dengo del día!');

$I->amOnPage('/');

$I->see('Las Dengo del día:');