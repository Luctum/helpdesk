<?php
use micro\orm\DAO;
class TicketTest extends AjaxUnitTest {

	public static function setUpBeforeClass(){
		parent::setUpBeforeClass();
		global $config;
		DAO::Connect($config['database']['dbName']);
	}

	public function testListeTickets() {
		
		$user = new DefaultC();
		$user->asUser();
		
		$this->get("Tickets/index");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->assertContains("table.table:nth-child(6) > tbody:nth-child(2) > tr:nth-child(1)", "table.table:nth-child(6)");
		
	}
	
	
}