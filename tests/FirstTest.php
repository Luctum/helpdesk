<?php
use micro\orm\DAO;
class FirstTest extends \PHPUnit_Framework_TestCase {
	
	
	// Test doit être noté dans le nom de la fonction au debut, ou alors doit être annoté
	/**
	 * @Test
	 */
	//on redefinis la méthode setupbeforeclass pour définir la co a la bdd;
	public static function setUpBeforeClass(){
		global $config;
		DAO::Connect($config['database']['dbName']);	
	}
	
	public function testYoupi(){
		 $this->assertEquals(1,1);
	}
}