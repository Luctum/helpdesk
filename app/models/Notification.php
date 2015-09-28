<?php
/**
 * Représente les notifications
 * @author jcheron
 * @version 1.1
 * @package helpdesk.models
 */
class Notification extends Base{

	/**
	 * @ManyToOne
	 * @JoinColumn(name="id",className="User",nullable=false)
	 */
	private $idUser;

	/**
	 * @ManyToOne
	 * @JoinColumn(name="id",className="Ticket",nullable=false)
	 */
	private $idTicket;

	public function getIdUser() {
		return $this->idUser;
	}

	public function setIdUser($user) {
		$this->idUser=$user;
		return $this;
	}

	public function getIdTicket(){
		return $this->idTicket;
	}

    public function setIdTicket($ticket) {
        $this->idTicket=$ticket;
        return $this;
    }

	public function toString(){

	}



}