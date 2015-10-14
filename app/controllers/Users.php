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
		if($id != null && ($user == Auth::getUser() || Auth::isAdmin())){
        	$this->loadView("user/vAdd",array("user"=>$user));
		}else{
			echo "Vous ne disposez pas des droits";
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
	}

	public function tickets(){
		$this->forward("tickets");
	}
	
	public function connect(){
		$this->loadView("User/vConnect");
	}
	
	public function connectAction(){
		$login = $_POST['login'];
		$password = $_POST['password'];
		$user = DAO::getOne("User","login='$login'");
		
		if(!empty($user) && $user->getPassword() == $password){
			$_SESSION["user"]= $user;
				
		}
		$this->index();
	}
	
	
	
}