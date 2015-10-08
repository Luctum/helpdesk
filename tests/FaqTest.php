<?php
use micro\orm\DAO;
class FaqTest extends AjaxUnitTest {

	public static function setUpBeforeClass(){
		global $config;
		DAO::Connect($config['database']['dbName']);
	}

}