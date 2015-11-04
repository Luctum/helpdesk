<?php
/**
 * Représente un utilisateur
 * @author jcheron
 * @version 1.1
 * @package helpdesk.models
 */
class User extends Base{
	/**
	 * @Id
	 */
	private $id;
	private $login="";
	private $password="";
	private $mail="";
	private $notifie;
	
    /**
     * @ManyToOne
     * @JoinColumn(name="idRang",className="Rang",nullable=false)
     */
    private $rang;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id=$id;
		return $this;
	}

	public function getLogin() {
		return $this->login;
	}

	public function setLogin($login) {
		$this->login=$login;
		return $this;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password=$password;
		return $this;
	}

	public function getMail() {
		return $this->mail;
	}

	public function setMail($mail) {
		$this->mail=$mail;
		return $this;
	}

    public function getRang(){
        return $this->rang;
    }

    public function setRang($rang){
        $this->rang = $rang;
        return $this;
    }

    public function getAdmin() {
        if($this->getRang()->getId() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function toString(){
        return $this->mail. "-".$this->login." ".$this->getRang();
    }
    
	public function getNotifie(){
		return $this->notifie;
	}
	
	public function setNotifie($notifie){
		$this->notifie = $notifie;
		return $this->notifie;
	}
}