<?php
use micro\orm\DAO;
use micro\js\Jquery;
use micro\controllers\BaseController;
use micro\views\Gui;
/**
 * Contrôleur par défaut (défini dans config => documentRoot)
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class DefaultC extends BaseController {

	/**
	 * Affiche la page par défaut du site
	 * @see BaseController::index()
	 */
	public function index() {
		$auth = Auth::getUser();
		$admin = Auth::isAdmin();
		$notif = DAO::getAll("Notification");
		$this->loadView("main/vHeader",array("infoUser"=>Auth::getInfoUser()));
        if(isset($_SESSION['logged'])){
            if($_SESSION['logged']==false){
                echo "<div class='container'><div class='alert alert-danger'>La connexion a échouée, veuillez vérifier vos identifiants</div></div>";
            }elseif($_SESSION['logged']=="success"){
                echo "<div class='container'><div class='alert alert-success'>Bienvenue ".Auth::getUser()->getLogin()." !</div></div>";
            }
            $_SESSION['logged'] = null;
        }
		if($auth != NULL){
			
			echo "<div class='container'>";
			echo "<div class='panel panel-info'>";
			echo "<div class='panel-heading'>Notifications</div>";
			echo "<div class='panel-body'>";
			echo "<table class='table table-striped'>";
			echo "<div class='tbody'>";
			
			foreach($notif as $n){
				
				if($auth == $n->getUser() || $admin == true){
                    if($auth != $n->getUser()){
					    echo "<tr><td><b>".$n->getUser()." </b >a modifié <b>".$n->getTicket()."</b></td><tr>";
                    }
				}

			}
			echo "</div>";
			echo "</table>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			
			if($admin){
				$this->loadView("main/vDefault");
			}
		}
		else{
			$this->loadView("User/vConnect");
		}
		
		
		
		
		$this->loadView("main/vFooter");
		Jquery::getOn("click", ".btAjax", "sample/ajaxSample","#response");
		echo Jquery::compile();
	}

	/**
	 * Affiche la page de test
	 */
	public function test() {
		$this->loadView("main/vHeader",array("infoUser"=>Auth::getInfoUser()));
		$this->loadView("main/vTest");
		$this->loadView("main/vFooter");
	}
	/**
	 * Connecte le premier administrateur trouvé dans la BDD
	 */
	public function asAdmin(){
		$_SESSION["user"]=DAO::getOne("User", "idRang=1");
		$_SESSION['KCFINDER'] = array(
				'disabled' => false
		);
		$this->index();
	}

	/**
	 * Connecte le premier utilisateur (non admin) trouvé dans la BDD
	 */
	public function asUser(){
		$_SESSION["user"]=DAO::getOne("User", "idRang=3");
		$_SESSION['KCFINDER'] = array(
				'disabled' => true
		);
		$this->index();
	}

	/**
	 * Déconnecte l'utilisateur actuel
	 */
	public function disconnect(){
		$_SESSION = array();
		$_SESSION['KCFINDER'] = array(
				'disabled' => true
		);
		$this->index();
	}

	public function ckEditorSample(){
		$this->loadView("main/vHeader",array("infoUser"=>Auth::getInfoUser()));
		echo "<div class='container'>";
		echo "<h1>Exemple ckEditor</h1>";
		echo "<textarea id='editor1'>Exemple de <strong>contenu</strong></textarea>";
		echo Jquery::execute("CKEDITOR.replace( 'editor1');");
		echo "</div>";
		$this->loadView("main/vFooter");
	}

	public function ajaxSample(){
		$users=DAO::getAll("User");
		echo '<ul class="list-group">';
		foreach ($users as $u){
			echo '<li class="list-group-item" id="'.$u->getId().'"><input type="checkbox" class="ck">&nbsp;'.$u->toString()."</li>";
		}
		echo "</ul>";
		echo "<button id='btClose' class='btn btn-primary'>Fermer</button>";

		Jquery::bindMethods(true,false);
		Jquery::getOn("click", ".list-group-item", "Users/frm","#response");
		Jquery::doJqueryOn(".ck", "click", "$(event.target).parent()", "toggleClass",array("disabled","$(event.target).prop('checked')"));
		Jquery::doJqueryOn(".list-group-item", "mouseenter", "this", "addClass",array("active"));
		Jquery::doJqueryOn(".list-group-item", "mouseout", "this", "removeClass","active");
		Jquery::doJqueryOn("#btClose", "click", "#response", "html","");
		Jquery::doJqueryOn("#btClose", "click", "#main", "show");
		Jquery::doJquery("#main", "hide");
		echo Jquery::compile();
	}


    public function connectAction(){
    	
        $login = $_POST['login'];
        $password = $_POST['password'];

        $user = DAO::getOne("User","login='$login'");

        if(!empty($user) && password_verify($password, $user->getPassword())){
            $_SESSION["user"]= $user;
            $_SESSION['logged'] = true;

            if(isset($_POST['retenir']) && $_POST['retenir'] == "on"){
                setcookie("login",$_POST['login'],time()+60*60*24*7,"/");
                setcookie("password",$_POST['password'],time()+60*60*24*7,"/");
            }
            else{
                setcookie("login","",- 3600,"/");
                setcookie("password","",- 3600,"/");
            }
        }
        else{
            $_SESSION['logged'] = false;
        }
        $this->index();
    }


}