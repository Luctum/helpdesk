<?php
use micro\orm\DAO;
class NotifTest extends AjaxUnitTest {

    public static function setUpBeforeClass(){
        parent::setUpBeforeClass();
        global $config;
        DAO::Connect($config['database']['dbName']);
    }

    public function setUp(){
        parent::setUp();
        $this->get("DefaultC/disconnect");
    }

    public function testNotifTickets(){
        $this->get("DefaultC/asAdmin");
        $this->get("Tickets/index");
        $this->assertPageContainsText("btn-warning");
    }

    public function testNewMessages(){
        $this->get("DefaultC/asAdmin");
        $this->get("Tickets/messages/30");
        $this->assertPageContainsText("NEW");
    }
}