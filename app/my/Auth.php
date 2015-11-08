<?php
/**
 * Classe de gestion de l'authentification
 * @author jcheron
 * @version 1.1
 * @package helpdesk.my
 */
class Auth {
	/**
	 * Retourne l'utilisateur actuellement connecté<br>
	 * ou NULL si personne ne l'est
	 * @return User
	 */
	public static function getUser(){
		$user=null;
		if(array_key_exists("user", $_SESSION))
			$user=$_SESSION["user"];
		return $user;
	}

	/**
	 * Retourne vrai si un utilisateur est connecté
	 * @return boolean
	 */
	public static function isAuth(){
		return null!==self::getUser();
	}

	/**
	 * Retourne vrai si un utilisateur de type administrateur est connecté<br>
	 * Faux si l'utilisateur connecté n'est pas admin ou si personne n'est connecté
	 * @return boolean
	 */
	public static function isAdmin(){
		$user=self::getUser();
        if($user instanceof User && ($user->getAdmin() || $user->getTech())){
        $admin= true;
        }else{$admin = false;}
        return $admin;
	}

	/**
	 * Retourne la zone d'information au format HTML affichant l'utilisateur connecté<br>
	 * ou les boutons de connexion si personne n'est connecté
	 * @return string
	 */
	public static function getInfoUser($style="primary"){
		$user=self::getUser();
		
		if(isset($user)){
			$userId=self::getUser()->getId();
			$infoUser="<a class='btn btn-primary' id='edit' href='Users/frm/$userId'>Editer mon profil <span class='label label-success'>".$user."</span></a>";
		}else{
			$infoUser='<div class="btn-group">
							<button type="button" class="btn btn-'.$style.' dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								Se connecter / S\'inscrire<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="users/connect">&nbsp;Se connecter</a></li>
								<li><a href="users/frm">&nbsp;S\'inscrire</a></li>
							</ul>
						</div>';
		}
		return $infoUser;
	}
}