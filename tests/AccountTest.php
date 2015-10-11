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
		$user = DAO::getOne("User","login='user'");
		$_SESSION["user"]= $user;
		
		//L'utilisateur clique sur Editer mon profil
		$this->get("DefaultC/index");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$btnEdit=$this->getElementsBySelector(".btn .btn-primary");

		foreach ($btnEdit as $bt){
			if($bt->getText()=="profil"){
				$bt->click();
				self::$webDriver->manage()->timeouts()->implicitlyWait(5);
				$this->assertPageContainsText("Ajouter/modifier un utilisateur");
				//L'utilisateur entre des valeurs et clique sur valider
				$this->setField("mail", "user1@local.fr");
				$this->clickSubmit("Valider");
				self::$webDriver->manage()->timeouts()->implicitlyWait(5);
				$test = DAO::getOne("User","login='user'");
				$mail = $test->getMail();
				$this->assert($mail, Auth::getUser()->getMail());
			}

		}
		//L'utilisateur essaie d'accéder à un profil qui n'est pas le sien (user = 2, test sur le 4éme)
		$this->get("Users/frm/4");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->assertPageContainsText("Vous ne disposez pas des droits");
		$_SESSION['user'] = null;
	}

    public function testConnexion(){
        $this->get("DefaultC/index");
        self::$webDriver->manage()->timeouts()->implicitlyWait(5);
        $this->assertPageContainsText("Se connecter");
        $this->setField("mail", "admin");
        $this->setField("password", "admin");
        $this->clickSubmit("Valider");
        self::$webDriver->manage()->timeouts()->implicitlyWait(5);
        $this->assert(Auth::getUser()->getLogin(), "admin");
    }

    public function testDeconnexion(){
        $user = DAO::getOne("User","login='user'");
        $_SESSION["user"]= $user;
        $this->get("DefaultC/index");
        self::$webDriver->manage()->timeouts()->implicitlyWait(5);
        $this->assertPageContainsText("Déconnexion");
        $btDeco=$this->getElementBySelector(".btn-warning");
        $this->click($btDeco);
        self::$webDriver->manage()->timeouts()->implicitlyWait(5);
        $this->get("DefaultC/index");
        $this->assert(Auth::getUser, NULL);
    }

}