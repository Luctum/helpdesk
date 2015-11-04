<?php
/**
 * Représente un champ customisé pour les tickets
* @author jcheron
* @version 1.1
* @package helpdesk.models
*/
class Custom extends Base{
	/**
	 * @Id
	 */
	private $id;
	private $libelle;
	private $type;
	private $display;
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	public function getLibelle() {
		return $this->libelle;
	}
	
	public function setLibelle($libelle) {
		$this->libelle = $libelle;
		return $this;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function setType($type) {
		$this->type = $type;
		return $this;
	}
	
	public function getDisplay() {
		return $this->display;
	}
	
	public function setDisplay($display) {
		$this->display = $display;
		return $this;
	}
	
	
	
}