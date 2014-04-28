<?php

class TextCleanerTest extends TestCase {

	public function setUp()
	{
		$this->textCleaner = new TextCleaner();
	}

	public function testgetUnwantedSymbolsArray()
	{
		$unwantedCharsForRegex = array(".",",",")","(","\"","!","¡","\'",":",";","?","¿","=","/","&","#","°","*","¬","|","@","·","~","½","\"","{","[","]","}","\\","“","”");
		$actual = $this->textCleaner->getUnwantedSymbolsArray();
		$this->assertEquals($unwantedCharsForRegex, $actual);
	}
}