<?php 

$I = new FunctionalTester($scenario);

$I->am("un usuario de Dengo");
$I->wantTo('buscar una noticia');

$I->amOnPage('/');

$I->haveTestingNews(['title' => 'Dengo vuelve a la web después de un tiempo de inactividad']);
$I->haveTestingNews(['title' => 'Hola dengo']);
$I->haveTestingNews(['title' => 'Esta noticia no tiene nada que ver']);

$I->seeRecord('news', [
	'title' => 'Hola dengo'
]);

$I->fillField('search', "Revive Dengo");
$I->click('Buscar');

$I->seeCurrentUrlEquals('/search');

$I->see('Dengo vuelve a la web después de un tiempo de inactividad');
$I->see('Hola dengo');
$I->dontSee('Esta noticia no tiene nada que ver');