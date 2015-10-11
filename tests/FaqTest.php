<?php
use micro\orm\DAO;
class FaqTest extends AjaxUnitTest {

    public static function setUpBeforeClass(){
        parent::setUpBeforeClass();
        global $config;
        DAO::Connect($config['database']['dbName']);
    }

    public function testLecture(){
        $user = new DefaultC();
        $user->asUser();

        $this->get("FAQs/");
        self::$webDriver->manage()->timeouts()->implicitlyWait(5);
        $bt = $this->getElementBySelector(".table > tbody:nth-child(2) > tr:nth-child(1) > td:nth-child(5) > a:nth-child(1)");
        $bt->click();
        self::$webDriver->manage()->timeouts()->implicitlyWait(5);
        $this->assertPageContainsText("L'adresse de l'application est");
    }

    public function testAuth(){
        $this->get("FAQs/");
        $this->assertPageContainsText("Autorisation refusée,");
    }

    public function testListe(){
        $user = new DefaultC();
        $user->asUser();

        $this->get("FAQs/");
        self::$webDriver->manage()->timeouts()->implicitlyWait(5);
        $bt = $this->getElementBySelector("#mainNav-navzone-1-link-3");
        $bt->click();
        self::$webDriver->manage()->timeouts()->implicitlyWait(5);
        $this->assertPageContainsText("Faq");
    }
}