<?php
use micro\orm\DAO;
use micro\js\Jquery;
use micro\views\Gui;
/**
 * Gestion des tickets
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */

class Tickets extends \_DefaultController {

	public function Tickets(){
		parent::__construct();
		$this->title="Tickets";
		$this->model="Ticket";
	}

	public function index($message=null){
        global $config;
        $baseHref=get_class($this);

        $nouveau=DAO::getAll($this->model,"idStatut=1");
		if(isset($message)){
			if(is_string($message)){
				$message=new DisplayedMessage($message);
			}
			$message->setTimerInterval($this->messageTimerInterval);
			$this->_showDisplayedMessage($message);
		}

        echo "<a class='btn btn-primary' href='".$config["siteUrl"].$baseHref."/frm'>Ajouter...</a>";

        echo "<h3>Mes Tickets<p class='glyphicon glyphicon-collapse-down btn-xs' id='showP'></p><p class='glyphicon glyphicon-collapse-up btn-xs' id='hideP'></p></h3>";
        echo "<div id='postes' ></div>";

        if(Auth::isAdmin() || Auth::getUser()->getRang()->getId() != 3){
            echo "<h3>Interventions<p class='glyphicon glyphicon-collapse-down btn-xs' id='showI'></p><p class='glyphicon glyphicon-collapse-up btn-xs' id='hideI'></p></h3>";
            echo "<div id='intervenu' ></div>";


            echo "<h3>Nouveaux<span class='btn btn-info' style='border-radius:50%;'>".count($nouveau)."</span><p class='glyphicon glyphicon-collapse-down btn-xs' id='showN'></p><p class='glyphicon glyphicon-collapse-up btn-xs' id='hideN'></p></h3>";
            echo "<div id='nouveau' ></div>";
        }

        echo Jquery::getOn("click", "#showP", "Tickets/postes","#postes");
        echo Jquery::doJqueryOn("#showP", "click", "#postes", "show");
        echo Jquery::doJqueryOn("#hideP", "click", "#postes", "hide");

        if(Auth::isAdmin() || Auth::getUser()->getRang()->getId() != 3) {

            echo Jquery::getOn("click", "#showN", "Tickets/nouveaux", "#nouveau");
            echo Jquery::doJqueryOn("#showN", "click", "#nouveau", "show");
            echo Jquery::doJqueryOn("#hideN", "click", "#nouveau", "hide");

            echo Jquery::getOn("click", "#showI", "Tickets/intervenu", "#intervenu");
            echo Jquery::doJqueryOn("#showI", "click", "#intervenu", "show");
            echo Jquery::doJqueryOn("#hideI", "click", "#intervenu", "hide");
        }
	}


    public function postes(){
        global $config;
        $baseHref=get_class($this);
        if(isset($message)){
            if(is_string($message)){
                $message=new DisplayedMessage($message);
            }
            $message->setTimerInterval($this->messageTimerInterval);
            $this->_showDisplayedMessage($message);
        }

        $objects=DAO::getAll($this->model);
        $notifications = DAO::getAll("Notification");
        echo "<table class='table table-striped'>";
        echo "<thead><tr><th>".$this->model."</th><th>User</th><th>Attribution</th></tr></thead>";
        echo "<tbody>";


        // Affiche les tickets créer par l'utilisiateur connecté
        foreach ($objects as $object){
            $config["debug"]=false;
            $msg = DAO::getAll("Message", "idTicket=".$object->getId()."");
            $config["debug"]=true;

            if(Auth::getUser()->getId() == $object->getUser()->getId()){
                echo "<tr>";
                echo "<td>".$object->toString()."</td>";
                echo "<td>".$object->getUser()."</td>";
                if($object->getAttribuer() != null){
                    echo "<td>".$object->getAttribuer()."</td>";
                }else{
                    echo "<td></td>";
                }

                $button = "<td class='btn-success'></td>";
                foreach($notifications as $n){

                    if($n->getTicket() == $object && $n->getUser() != Auth::getUser()) {
                        //error_reporting(0);
                        //xdebug_disable();

                        $button = "<td class='btn-warning'></td>";

                        //xdebug_enable();
                        //error_reporting(-1);
                    }
                }

                echo $button;
                if(empty($msg) || Auth::isAdmin()){
                    echo "<td class='td-center'><a class='btn btn-primary btn-xs' href='".$baseHref."/frm/".$object->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                    echo "<td class='td-center'><a class='btn btn-warning btn-xs'  href='".$baseHref."/delete/".$object->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
                }
                else{
                    echo "<td class='td-center'><a class='btn btn-link btn-xs'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                }

                echo "<td class='td-center'><a class='btn btn-info btn-xs' href='".$baseHref."/messages/".$object->getId()."'><span class='glyphicon glyphicon-play' aria-hidden='true'></span></a></td>";
                echo "</tr>";
            }
        }

        echo "</tbody>";
        echo "</table>";

    }

	public function nouveaux(){
        global $config;
        $baseHref=get_class($this);
        $nouveau=DAO::getAll($this->model,"idStatut=1");
        $notifications = DAO::getAll("Notification");

            echo "<table class='table table-striped'>";
            echo "<thead><tr><th>".$this->model."</th><th>User</th></tr></thead>";
            echo "<tbody>";

            foreach($nouveau as $object2){
                $config["debug"]=false;
                $msg = DAO::getAll("Message", "idTicket=".$object2->getId()."");
                $config["debug"]=true;

                    echo "<tr>";
                    echo "<td>".$object2->toString()."</td>";

                    if(is_callable(array($object2,"getUser"))){
                        echo "<td>".$object2->getUser()."</td>";
                    }




                    $button = "<td class='btn-success'></td>";


                    foreach($notifications as $n2){

                        if($n2->getTicket() == $object2 && $n2->getUser() != Auth::getUser()) {
                            //error_reporting(0);
                            //xdebug_disable();

                            $button = "<td class='btn-warning'></td>";

                            //xdebug_enable();
                            //error_reporting(-1);
                        }
                    } // fin foreach
                    echo $button;
                    if(empty($msg) || Auth::isAdmin()){
                        echo "<td class='td-center'><a class='btn btn-primary btn-xs' href='".$baseHref."/frm/".$object2->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                    }
                    else{
                        echo "<td class='td-center'><a class='btn btn-link btn-xs'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                    }
                    echo "<td class='td-center'><a class='btn btn-warning btn-xs'  href='".$baseHref."/delete/".$object2->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>".
                        "<td class='td-center'><a class='btn btn-info btn-xs' href='".$baseHref."/messages/".$object2->getId()."'><span class='glyphicon glyphicon-play' aria-hidden='true'></span></a></td>";
                    echo "</tr>";


            }//fin foreach
            echo "</tbody>";
            echo "</table>";
    }
	public function intervenu(){
        global $config;
        $baseHref=get_class($this);
        $objects=DAO::getAll($this->model,"attribuer=".Auth::getUser()->getId()."");
        $notifications = DAO::getAll("Notification");
        if(Auth::getUser()->getRang()->getId() == 2 || Auth::isAdmin()){
            echo "<table id='intervention' class='table table-striped'>";
            echo "<thead><tr><th>".$this->model."</th><th>User</th><th>Attribution</th></tr></thead>";
            echo "<tbody>";
            // Affiche les tickets ou l'utilisateur est intervenu

            foreach ($objects as $object){
                $config["debug"]=false;
                $msg = DAO::getAll("Message", "idTicket=".$object->getId()."");
                $config["debug"]=true;

                echo "<tr>";

                    echo "<td>".$object->toString()."</td>";
                    echo "<td>".$object->getUser()."</td>";

                    echo "<td>".$object->getAttribuer()."</td>";

                    $button = "<td class='btn-success'></td>";
                    foreach($notifications as $n){
                        if($n->getTicket() == $object && $n->getUser() != Auth::getUser()) {
                            $button = "<td class='btn-warning'></td>";
                        }
                    }

                    echo $button;
                    if(empty($msg) || Auth::isAdmin()){
                        echo "<td class='td-center'><a class='btn btn-primary btn-xs' href='".$baseHref."/frm/".$object->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                        echo "<td class='td-center'><a class='btn btn-warning btn-xs'  href='".$baseHref."/delete/".$object->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
                    }
                    else{
                        echo "<td class='td-center'><a class='btn btn-link btn-xs'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                    }

                    echo "<td class='td-center'><a class='btn btn-info btn-xs' href='".$baseHref."/messages/".$object->getId()."'><span class='glyphicon glyphicon-play' aria-hidden='true'></span></a></td>";
                    echo "</tr>";

                }
            }
            echo "</tbody>";
            echo "</table>";

    }


	public function messages($id){
		$ticket=DAO::getOne("Ticket", $id[0]);
		if(Auth::getUser() != $ticket->getUser() && Auth::isAdmin() != true){
				$ticket = null;
				echo "Veuillez vous assurez que votre compte posséde les droits suffisants pour accéder à cette ressource";
				echo "<br/><a class='btn btn-primary' href='".get_class($this)."'>Retour</a>";
		}

		$notifs = DAO::getAll("Notification");
		foreach($notifs as $n){
			if($n->getTicket() == $ticket && Auth::getUser() != $n->getUser()){
				DAO::delete($n);
			}
		}
		
		
		echo "<h2>".$ticket."</h2>";
        echo "".$ticket->getDescription();
		echo "<h3>Reponses</h3>";
		echo "<div id='messages' class='container'>";
		
		
		$this->afficheDiscussion($id);
		
		echo "</div>";
		echo "<div id='newMsg' class='container'>";
		echo "</div>";
		


		$this->frmMsg($id,$ticket);
		echo Jquery::executeOn("#submitMsg", "click", "CKEDITOR.instances['contenu'].updateElement();");
		echo Jquery::postFormOn("click","#submitMsg","Messages/update", "formMsg","#newMsg", false, Jquery::_get('Tickets/afficheDiscussion/'.$id[0],'#messages'));

	}

	public function afficheDiscussion($id){
		global $config;
		$ticket=DAO::getOne("Ticket", $id[0]);
		$messages=DAO::getOneToMany($ticket, "messages");
		foreach($messages as $msg){
			
			if($msg->getUser()->getId() == $ticket->getUser()->getId()){
				echo "<div class='panel panel-info'>";                                                       
			}                                                                                
			else{           
				echo "<div class='panel panel-warning'>";
				                                                                                                    	                                                                             
			}
			echo "<div class='panel-heading'>";
			if($msg->getLu() == 0 && Auth::getUser() != $msg->getUser()){
				echo "<span class='msg-new btn btn-warning'>NEW</span>";
			}
			//error_reporting(0);
			//xdebug_disable();
			
			echo "Le ".$msg->getDate().", ".$msg->getUser()." dit : ";                                                                                       
			echo "</div>";                                                                                                                                                       
			echo "<div class='msg-text'>";                                                                                                                                   
			echo "<br/>";                                                                    
			echo $msg->getContenu();                                                         
			echo "<br/>";                                                                    
			echo "</div>";                                                                                                                                                    
			echo "</div>"; 
			
			if($msg->getLu() == 0 && Auth::getUser() != $msg->getUser()){
				$config["debug"]=false;
				$msg->setLu(1);
				DAO::update($msg);
				$config["debug"]=true;
			}
            
			//xdebug_enable();
			//error_reporting(-1);
		}                                                                                    
	}                                                
	                                                                                        
	//Formulaire d'envoi de message pour répondre aux tickets 
	public function frmMsg($id =NULL, $ticket){
		if($ticket!=NULL){	
			$this->loadView("message/vAdd", array("ticket"=>$ticket));
			echo Jquery::execute("CKEDITOR.replace('contenu');");
		}
	}
	
	public function frm($id=NULL){
		$ticket=$this->getInstance($id);
		$categories=DAO::getAll("Categorie");
        $users = DAO::getAll("User","idRang=2 OR idRang=1");
		if($ticket->getCategorie()==null){
			$cat=-1;
		}else{
			$cat=$ticket->getCategorie()->getId();
		}
		$listCat=Gui::select($categories,$cat,"Sélectionner une catégorie ...");
		$listType=Gui::select(array("demande","intervention"),$ticket->getType(),"Sélectionner un type ...");

		$statuts=DAO::getAll("Statut");
		if ($ticket->getStatut() == NULL) {
			$stat = -1;
		} else {
			$stat = $ticket->getStatut()->getId();
		}

		$listStatuts=Gui::select($statuts,$stat);
		
		$this->loadView("ticket/vAdd",array("ticket"=>$ticket,"listCat"=>$listCat,"listType"=>$listType,"listStatuts"=>$listStatuts, "users"=>$users));
		echo Jquery::setOn("click", ".modif-statut", "#idStatut","$(event.target).attr('datatype')");
		echo Jquery::execute("CKEDITOR.replace( 'description');");
	}

	
	/* (non-PHPdoc)
	 * @see _DefaultController::setValuesToObject()
	 */
	protected function setValuesToObject(&$object) {
		parent::setValuesToObject($object);
		$categorie=DAO::getOne("Categorie", $_POST["idCategorie"]);
		$object->setCategorie($categorie);
		$user=DAO::getOne("User", $_POST["idUser"]);
		$object->setUser($user);
        $attribuer=DAO::getOne("User", $_POST["attribuer"]);
        $object->setAttribuer($attribuer);

        if($_POST['nouveau'] != "oui"){
            if($_POST['idStatut'] == 1){
                $statut=DAO::getOne("Statut", "id=3");
                $object->setStatut($statut);
            }else{
            	$statut=DAO::getOne("Statut", $_POST["idStatut"]);
            	$object->setStatut($statut);
            }
        }else{
                $statut=DAO::getOne("Statut", $_POST["idStatut"]);
                $object->setStatut($statut);
        	}
	}

	/* (non-PHPdoc)
	 * @see _DefaultController::getInstance()
	 */
	public function getInstance($id = NULL) {
		$obj=parent::getInstance($id);
		if(null==$obj->getType())
			$obj->setType("intervention");
		if($obj->getStatut()===NULL){
			$statut=DAO::getOne("Statut", 1);
			$obj->setStatut($statut);
		}
		if($obj->getUser()===NULL){
			$obj->setUser(Auth::getUser());
		}
		if($obj->getDateCreation()===NULL){
			$obj->setdateCreation(date('Y-m-d H:i:s'));
		}
		return $obj;
	}


	/* (non-PHPdoc)
	 * @see BaseController::isValid()
	 */
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

	public function update() {
		parent::update();
		global $config;
		$config["debug"]=false;
		if(!empty($_POST['id']) && Auth::isAdmin()){
		
			$ticket=DAO::getOne("Ticket", "id=".$_POST['id']."");
			$message = new Message();
			$message->setTicket($ticket);
			$message->setUser(Auth::getUser());
			$message->setContenu("Une modification à été effectué sur ce ticket (concernant le statut ou le titre)");
			$message->setLu(0);
			DAO::insert($message);
		}

		$config["debug"]=true;
		
	}


}