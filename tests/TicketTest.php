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
		$bt = $this->getElementBySelector("#showP");
		$bt->click();
		$this->get("Tickets/postes");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->assertPageContainsText("dsqd");

	}
	
	/*public function testModifStatut() {
	
		$this->get("DefaultC/asAdmin");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->get("Tickets/index");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$bt = $this->getElementBySelector("#showP");
		$bt->click();
		$this->get("Tickets/postes");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$bt1 = $this->getElementBySelector(".glyphicon-edit");
		$bt1->click();
		$this->get("Tickets/frm/34");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$bt2 = $this->getElementBySelector("input.btn:nth-child(5)");
		$bt2->click();
		$this->get("Ticket/update");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->assertPageContainsText("Système");
		
		
	}*/

	
}