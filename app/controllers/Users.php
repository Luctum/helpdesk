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
		if(Auth::getUser() == $user || Auth::isAdmin()){
			$this->loadView("user/vAdd",array("user"=>$user));
		}
	}

	/* (non-PHPdoc)
	 * @see _DefaultController::setValuesToObject()
	 */
	protected function setValuesToObject(&$object) {
		parent::setValuesToObject($object);
		$object->setAdmin(isset($_POST["admin"]));
	}

	public function tickets(){
		$this->forward("tickets");
	}
	
	public function connect(){
		$this->loadView("user/vConnect");
	}
	
	public function connectAction(){
		$login = $_POST['login'];
		$password = $_POST['password'];
		$user = DAO::getOne("User","login='$login'");
		
		if($user->getPassword() == $password){
			$_SESSION["user"]= $user;
				
		}
		$this->index();
	}
	
	
	
}