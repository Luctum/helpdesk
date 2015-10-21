<?php
use micro\orm\DAO;
/**
 * Gestion des articles de la Faq
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Faqs extends \_DefaultController {
	public function Faqs(){
		parent::__construct();
		$this->title="Foire aux questions";
		$this->model="Faq";
	}

    public function index(){
        global $config;
        $baseHref=get_class($this);
		$model = "".$this->model."";
		
        if(!isset($_POST['recherche'])){
        	$objects=DAO::getAll($model);
        }
        else{
        	$objects=DAO::getAll($model, "UPPER(titre) LIKE UPPER('%".$_POST['recherche']."%')");
        }

        ///Champ de recherche
        echo '<form method="POST" action="Faqs/index">
						<div class="input-group">
		      				<input type="text" class="form-control" name="recherche" placeholder="Rechercher dans la FAQ">
		      				<span class="input-group-btn">
		       					<input type="submit" class="btn btn-default" type="button">Recherche</button>
						    </span> 
						</div><!-- /input-group -->
				   </form>';


        //Affiche la liste des articles de l'admin
        if(Auth::isAdmin()) {

            echo "<h3>Mes Articles</h3>";

            echo "<table class='table table-striped'>";
            echo "<thead><tr><th>".$this->model."</th></tr></thead>";
            echo "<tbody>";

            foreach ($objects as $o) {
                if($o->getUser() == Auth::getUser()){
                    echo "<tr>";
                    echo "<td>" . $o->toString() . "</td>";
                    if (is_callable(array($o, "getUser"))) {
                        echo "<td>" . $o->getUser() . "</td>";
                    }

                    echo "<td class='td-center'><a class='btn btn-primary btn-xs' href='" . $baseHref . "/frm/" . $o->getId() . "'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>" .
                        "<td class='td-center'><a class='btn btn-warning btn-xs' href='" . $baseHref . "/delete/" . $o->getId() . "'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>" .
                        "<td class='td-center'><a class='btn btn-info btn-xs' href='" . $baseHref . "/lecture/" . $o->getId() . "'><span class='glyphicon glyphicon-play' aria-hidden='true'></span></a></td>";
                    echo "</tr>";
                }
            }
            echo "</tbody>";
            echo "</table>";
        }


        //Affiche la liste de tous les utilisateurs
        echo "<table class='table table-striped'>";
        echo "<thead><tr><th>".$this->model."</th></tr></thead>";
        echo "<tbody>";

        echo "<h3>Tous les articles</h3>";

        foreach ($objects as $object){

            echo "<tr>";
            echo "<td>".$object->toString()."</td>";
            if(is_callable(array($object,"getUser"))){
                echo "<td>".$object->getUser()."</td>";
            }

            echo "<td class='td-center'><a class='btn btn-primary btn-xs' href='".$baseHref."/frm/".$object->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>".
                "<td class='td-center'><a class='btn btn-warning btn-xs' href='".$baseHref."/delete/".$object->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>".
                "<td class='td-center'><a class='btn btn-info btn-xs' href='".$baseHref."/lecture/".$object->getId()."'><span class='glyphicon glyphicon-play' aria-hidden='true'></span></a></td>";
            echo "</tr>";

        }

        echo "</tbody>";
        echo "</table>";
        echo "<a class='btn btn-primary' href='".$config["siteUrl"].$baseHref."/frm'>Ajouter...</a>";
    }


    public function lecture($id){
        $faq=DAO::getOne("Faq", $id[0]);

        echo "<div class='panel panel-primary'>";
        echo "<div class='panel-heading'>".$faq."</div>";
        echo "<div class='panel-body'>";

        echo $faq->getContenu();
        echo "</div>";
        echo "</div>";
    }


	/* (non-PHPdoc)
	 * @see _DefaultController::setValuesToObject()
	 */
	protected function setValuesToObject(&$object) {
		parent::setValuesToObject($object);
		$object->setUser(Auth::getUser());
		$categorie=DAO::getOne("Categorie", $_POST["idCategorie"]);
		$object->setCategorie($categorie);
	}

	public function test(){
		$faqs=DAO::getAll("Faq","1=1 order by dateCreation limit 1,1");
		foreach ($faqs as $faq){
			echo $faq."<br>";
		}
		echo DAO::$db->query("SELECT max(id) FROM Faq")->fetchColumn();
		$ArticleMax=DAO::getOne("Faq","id=(SELECT max(id) FROM Faq)");
		echo $ArticleMax;
	}
	
	public function isValid() {
		return Auth::isAuth();
	}
	
	/* (non-PHPdoc)
	 * @see BaseController::onInvalidControl()
	 */
	public function onInvalidControl() {
		$this->initialize();
		$this->messageDanger("<strong>Autorisation refusée</strong>,<br>Merci de vous connecter pour accéder à ce module.&nbsp;");
		$this->loadView("user/vConnect");
		$this->finalize();
		exit;
	}
	
}