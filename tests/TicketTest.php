<?php
use micro\orm\DAO;
class TicketTest extends AjaxUnitTest {

	public static function setUpBeforeClass(){
		global $config;
		DAO::Connect($config['database']['dbName']);
	}

}