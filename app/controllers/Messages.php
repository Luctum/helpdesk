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
        $object->setLu('0');
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
                }catch(Exception $e){
                }
            }else {
                try {
                    DAO::insert($object);
                } catch (Exception $e) {
                }
            }
            $notif = new Notification();
            $notif->setTicket($object->getTicket());
            $notif->setUser(Auth::getUser());
            DAO::insert($notif);
        }
    }

}