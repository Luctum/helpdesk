<?php
use micro\orm\DAO;
use micro\utils\RequestUtils;
/**
 * Gestion des notifications
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Notifications extends \_DefaultController {
	
	public function Notifications(){
		parent::__construct();
		$this->title="Notifications";
		$this->model="Notification";
	}
	
	
}