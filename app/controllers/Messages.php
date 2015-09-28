<?php
use micro\orm\DAO;
use micro\utils\RequestUtils;
/**
 * Gestion des messages
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Messages extends \_DefaultController {
	public function Messages(){
		parent::__construct();
		$this->title="Messages";
		$this->model="Message";
	}
	
	/* (non-PHPdoc)
	 * @see _DefaultController::setValuesToObject()
	 */
	protected function setValuesToObject(&$object) {
		parent::setValuesToObject($object);
		$object->setUser(Auth::getUser());
		$ticket=DAO::getOne("Ticket", $_POST["idTicket"]);
		$object->setTicket($ticket);
	}
	
	public function update($params=null){
		if(RequestUtils::isPost()){
            global $config;
			$className=$this->model;
			$object=new $className();
			$this->setValuesToObject($object);
			if($_POST["id"]){
				try{
					DAO::update($object);
					$msg=new DisplayedMessage($this->model." `{$object->toString()}` mis à jour");
				}catch(Exception $e){
					$msg=new DisplayedMessage("Impossible de modifier l'instance de ".$this->model,"danger");
				}
			}else {
                try {
                    DAO::insert($object);
                    $msg = new DisplayedMessage("Instance de " . $this->model . " `{$object->toString()}` ajoutée");
                } catch (Exception $e) {
                    $msg = new DisplayedMessage("Impossible d'ajouter l'instance de " . $this->model, "danger");
                }
            }
            
            //header("Location: ".$config["siteUrl"]."tickets/messages/".$params[0]);
		}
	}
	
}