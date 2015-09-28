<?php
use micro\orm\DAO;
use micro\js\Jquery;
use micro\views\Gui;
/**
 * Gestion des tickets
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Tickets extends \_DefaultController {
	public function Tickets(){
		parent::__construct();
		$this->title="Tickets";
		$this->model="Ticket";
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
			if((Auth::getUser() == $object->getUser()) || Auth::isAdmin() == true){
				echo "<tr>";
				echo "<td>".$object->toString()."</td>";
				if(is_callable(array($object,"getUser"))){
					echo "<td>".$object->getUser()."</td>";
				}
				echo "<td class='td-center'><a class='btn btn-primary btn-xs' href='".$baseHref."/frm/".$object->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>".
				"<td class='td-center'><a class='btn btn-warning btn-xs' href='".$baseHref."/delete/".$object->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>".
				"<td class='td-center'><a class='btn btn-info btn-xs' href='".$baseHref."/messages/".$object->getId()."'><span class='glyphicon glyphicon-play' aria-hidden='true'></span></a></td>";
				echo "</tr>";
			}
		}
		echo "</tbody>";
		echo "</table>";
		echo "<a class='btn btn-primary' href='".$config["siteUrl"].$baseHref."/frm'>Ajouter...</a>";
	}
	
	
	public function messages($id){
		$ticket=DAO::getOne("Ticket", $id[0]);
		if(Auth::getUser() != $ticket->getUser() && Auth::isAdmin() != true){
				$ticket = null;
				echo "Veuillez vous assurez que votre compte posséde les droits suffisants pour accéder à cette ressource";
				echo "<br/><a class='btn btn-primary' href='".get_class($this)."'>Retour</a>";
		}
		
		echo "<h2>".$ticket."</h2>";
		echo "<h3>Reponses</h3>";
		echo "<div id='messages' class='container'>";
		
		
		$this->afficheDiscussion($id);
		
		echo "</div>";
		echo "<div id='newMsg' class='container'>";
		echo "</div>";
		
		$this->frmMsg($id,$ticket);
		echo Jquery::executeOn("#submitMsg", "click", "CKEDITOR.instances['contenu'].updateElement();");
		echo Jquery::postFormOn("click","#submitMsg","messages/update", "formMsg","#newMsg", false, Jquery::_get('tickets/afficheDiscussion/'.$id[0],'#messages'));
	}

	public function afficheDiscussion($id){
		
		$ticket=DAO::getOne("Ticket", $id[0]);
		$messages=DAO::getOneToMany($ticket, "messages");
		foreach($messages as $msg){
			echo "<div class='msg-box'>";
			if($msg->getUser()->getId() == $ticket->getUser()->getId()){
				echo "<div class='msg-rank-u'>";
			}
			else{
				echo "<div class='msg-rank-a'>";
				
			}
			echo "Le ".$msg->getDate().", ".$msg->getUser()." dit : ";
			echo "</div>";
			echo "<div class='msg-text'>";
			echo "<br/>";
			echo $msg->getContenu();
			echo "<br/>";
			echo "</div>";
			
			echo "</div>";
		}
	}
	
	//Formulaire d'envoi de message pour répondre aux tickets 
	public function frmMsg($id =NULL, $ticket){
		if($ticket!=NULL){	
			$this->loadView("message/vAdd", array("ticket"=>$ticket));
			echo Jquery::execute("CKEDITOR.replace('contenu');");
		}
	}
	
	public function frm($id=NULL){
		$ticket=$this->getInstance($id);
		$categories=DAO::getAll("Categorie");
		if($ticket->getCategorie()==null){
			$cat=-1;
		}else{
			$cat=$ticket->getCategorie()->getId();
		}
		$listCat=Gui::select($categories,$cat,"Sélectionner une catégorie ...");
		$listType=Gui::select(array("demande","intervention"),$ticket->getType(),"Sélectionner un type ...");

		$statuts=DAO::getAll("Statut");
		if ($ticket->getStatut() == NULL) {
			$stat = -1;
		} else {
			$stat = $ticket->getStatut()->getId();
		}
		$listStatuts=Gui::select($statuts,$stat);
		
		$this->loadView("ticket/vAdd",array("ticket"=>$ticket,"listCat"=>$listCat,"listType"=>$listType,"listStatuts"=>$listStatuts));
		echo Jquery::setOn("click", ".modif-statut", "#idStatut","$(event.target).attr('datatype')");
		echo Jquery::execute("CKEDITOR.replace( 'description');");
	}


	
	/* (non-PHPdoc)
	 * @see _DefaultController::setValuesToObject()
	 */
	protected function setValuesToObject(&$object) {
		parent::setValuesToObject($object);
		$categorie=DAO::getOne("Categorie", $_POST["idCategorie"]);
		$object->setCategorie($categorie);
		$statut=DAO::getOne("Statut", $_POST["idStatut"]);
		$object->setStatut($statut);
		$user=DAO::getOne("User", $_POST["idUser"]);
		$object->setUser($user);
	}

	/* (non-PHPdoc)
	 * @see _DefaultController::getInstance()
	 */
	public function getInstance($id = NULL) {
		$obj=parent::getInstance($id);
		if(null==$obj->getType())
			$obj->setType("intervention");
		if($obj->getStatut()===NULL){
			$statut=DAO::getOne("Statut", 1);
			$obj->setStatut($statut);
		}
		if($obj->getUser()===NULL){
			$obj->setUser(Auth::getUser());
		}
		if($obj->getDateCreation()===NULL){
			$obj->setdateCreation(date('Y-m-d H:i:s'));
		}
		return $obj;
	}


	/* (non-PHPdoc)
	 * @see BaseController::isValid()
	 */
	public function isValid() {
		return Auth::isAuth();
	}

	/* (non-PHPdoc)
	 * @see BaseController::onInvalidControl()
	 */
	public function onInvalidControl() {
		$this->initialize();
		$this->messageDanger("<strong>Autorisation refusée</strong>,<br>Merci de vous connecter pour accéder à ce module.&nbsp;".Auth::getInfoUser("danger"));
		$this->finalize();
		exit;
	}

	



}