<?php
use micro\orm\DAO;
use micro\views\Gui;
/**
 * Gestion des rangs
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Rangs extends \_DefaultController {

    public function Rangs(){
        parent::__construct();
        $this->title="Rangs";
        $this->model="Rang";
    }
}