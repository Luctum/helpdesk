<?php
use micro\orm\DAO;
class TicketTest extends AjaxUnitTest {

	public static function setUpBeforeClass(){
		parent::setUpBeforeClass();
		global $config;
		DAO::Connect($config['database']['dbName']);
	}

    public function setUp(){
        parent::setUp();
        $this->get("DefaultC/disconnect");
    }

	public function testListeTickets() {
		
		$this->get("Tickets/index");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->setField("login", "admin");
		$this->setField("password", "admin");
		$bt=$this->getElementBySelector("#submit");
		$bt->click();
		$this->get("Tickets/index");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->assertPageContainsText("Ticket 1");

	}
	
	
}