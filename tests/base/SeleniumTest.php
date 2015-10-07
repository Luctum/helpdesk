<?php

class SeleniumTest extends AjaxUnitTest{
	public function testIndex(){
		$this->get("DefaultC/index");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->assertPageContainsText("Helpdesk");
		/*
		$bt=$this->getElementBySelector(".btn .btn-link");
		$this->assertEquals("accueil", $bt->getText());
		*/
		$btnDefault=$this->getElementsBySelector(".btn-default");
		foreach ($btsDefault as $bt){
			if($bt->getText()=="Annuler"){
				$bt->click();
				self::$webDriver->manage()->timeouts->implicitlyWait(5);
				$this->assertPageContainsText("Annuler");
				break;
			}
				
		}
		$this->assertTrue($doIt);
	}
}