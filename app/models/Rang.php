<?php
/**
 * Représente un rang
 * @author jcheron
 * @version 1.1
 * @package helpdesk.models
 */
class Rang extends Base{
    /**
     * @Id
     */
    private $id;
    private $libelle;

    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle($libelle) {
        $this->libelle=$libelle;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id=$id;
        return $this;
    }

    /* (non-PHPdoc)
     * @see Base::toString()
     */
    public function toString(){
        return $this->libelle;
    }


}