<?php
use micro\orm\DAO;
/**
 * Gestion des users
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Users extends \_DefaultController {

	public function Users(){
		parent::__construct();
		$this->title="Utilisateurs";
		$this->model="User";
	}

	public function frm($id=NULL){
		$user=$this->getInstance($id);
		if(($id != null && ($user == Auth::getUser() || Auth::isAdmin())) || $id == null){
        	$this->loadView("user/vAdd",array("user"=>$user));
		}
        else{
			echo "<div class='alert alert-danger'>Vous ne disposez pas des droits</div>";
		}
    }

    public function update(){
        parent::update();
        if($_POST["id"] && $_POST["bonuser"] == "1" ) {
            $user = DAO::getOne("User", "login='" . $_POST['login'] . "'");
            $_SESSION['user'] = $user;
        }
    }

	/* (non-PHPdoc)
	 * @see _DefaultController::setValuesToObject()
	 */
	protected function setValuesToObject(&$object) {
		parent::setValuesToObject($object);
		if(isset($_POST["admin"])){
			$object->setAdmin($_POST["admin"]);
		}
        if(!empty($_POST['password'])){
            $object->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
        }
	}

	public function tickets(){
		$this->forward("tickets");
	}
	
	public function connect(){
		$this->loadView("user/vConnect");
	}
	
}