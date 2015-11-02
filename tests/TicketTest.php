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
		
		$this->get("DefaultC/asAdmin");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->get("Tickets/index");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->assertPageContainsText("Ticket 1");

	}
	
	public function testModifStatut() {
	
		$this->get("DefaultC/asAdmin");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->get("Tickets/index");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$bt = $this->getElementBySelector("table.table:nth-child(4) > tbody:nth-child(2) > tr:nth-child(2) > td:nth-child(4) > a:nth-child(1)");
		$bt->click();
		$this->get("Ticket/vAdd");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$bt1 = $this->getElementBySelector("input.btn:nth-child(5)");
		$bt1->click();
		$this->get("Ticket/update");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this
		
	}

	
}