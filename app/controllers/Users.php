<?php
use micro\orm\DAO;
use PasswordCompat\binary;
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

    public function index($message=null){

        global $config;
        $baseHref=get_class($this);
        if(isset($message)){
            if(is_string($message)){
                $message=new DisplayedMessage($message);
            }
            $message->setTimerInterval($this->messageTimerInterval);
            $this->_showDisplayedMessage($message);
        }
        $objects=DAO::getAll($this->model);
        echo "<table class='table table-striped'>";
        echo "<thead><tr><th>".$this->model."</th></tr></thead>";
        echo "<tbody>";
        foreach ($objects as $object){
            echo "<tr>";
            echo "<td>".$object->toString()."</td>";
            echo "<td>".$object->getRang()->getLibelle()."</td>";
            echo "<td class='td-center'><a class='btn btn-primary btn-xs' href='".$baseHref."/frm/".$object->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>".
                "<td class='td-center'><a class='btn btn-warning btn-xs' href='".$baseHref."/delete/".$object->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "<a class='btn btn-primary' href='".$config["siteUrl"].$baseHref."/frm'>Ajouter...</a>";
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
		
        if(!empty($_POST['rang'])){
            $rang = DAO::getOne('Rang','libelle="'.$_POST['rang'].'"');
            $object->setRang($rang);
        }else{
            $rang = DAO::getOne('Rang','libelle="Utilisateur"');
            $object->setRang($rang);
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