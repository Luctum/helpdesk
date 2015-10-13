<?php
use micro\orm\DAO;
class AccountTest extends AjaxUnitTest {

	public static function setUpBeforeClass(){
		parent::setUpBeforeClass();
		global $config;
		DAO::Connect($config['database']['dbName']);
	}	
	
	//Edition d'un profil par un utilisateur
	public function testEditUser(){
		//Connect
    	$this->get("DefaultC/asUser");
    	self::$webDriver->manage()->timeouts()->implicitlyWait(5);
    	
    	$this->get("DefaultC/index");
    	self::$webDriver->manage()->timeouts()->implicitlyWait(5);

		$bt=$this->getElementById("edit");
        $bt->click();
        
        self::$webDriver->manage()->timeouts()->implicitlyWait(5);
        $this->assertPageContainsText("Ajouter/modifier un utilisateur");
        
		$user = DAO::getOne("User", "login='user'");
        //L'utilisateur entre des valeurs et clique sur valider
        $this->setField("mail", "user1@local.fr");
        
        $btok=$this->getElementBySelector("input.btn");
        $btok->click();
        
        self::$webDriver->manage()->timeouts()->implicitlyWait(5);
        $test = DAO::getOne("User","login='user'");
        $this->assertNotEquals($user, $test);

		//L'utilisateur essaie d'accéder à un profil qui n'est pas le sien (user = 2, test sur le 4éme)
		$this->get("Users/frm/4");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->assertPageContainsText("Vous ne disposez pas des droits");
		$this->get("DefaultC/disconnect");
	}

    public function testConnexion(){
        $this->get("DefaultC/index");
        self::$webDriver->manage()->timeouts()->implicitlyWait(5);
        $this->setField("login", "admin");
        $this->setField("password", "admin");
        $bt=$this->getElementBySelector("#submit");
        $bt->click();
        $this->get("DefaultC/index");
        self::$webDriver->manage()->timeouts()->implicitlyWait(5);
        $this->assertPageContainsText("Utilisateur");
        $this->get("DefaultC/disconnect");
    }

    public function testDeconnexion(){
		//Connect
    	$this->get("DefaultC/asUser");
    	self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		
		$this->get("DefaultC/index");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);

        $this->assertPageContainsText("Déconnexion");
        $btDeco=$this->getElementBySelector("#logout");
        $btDeco->click();
        self::$webDriver->manage()->timeouts()->implicitlyWait(5);
        $this->get("DefaultC/index");
        $this->assertPageContainsText("Se connecter");
    }

    public function testNotif(){
        //Connect
		//Connect
		
    	$this->get("DefaultC/asUser");
    	self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		
		$this->get("DefaultC/index");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		
        $this->assertPageContainsText("Notifications");
        $this->get("DefaultC/disconnect");
    }
}