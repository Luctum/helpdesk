<?php 
	echo "<p>Bonjour, </p><br/>";
	echo "<p>Vous avez reçu des notifications aujourd'hui ! Les voici :</p><br/>";

	
		foreach($notifs as $n){
				echo "<p>";
				echo "<i>".$n->getUser()->getLogin()."</i>";
				echo " a modifié <b>".$n->getTicket()->getTitre()."</b> le ".$n->getDate()."<br/>";
				echo "<br/>";
				echo "</p><br/><br/>";
		}

	echo "En esperant vous revoir bientôt sur Helpdesk! <br/>";
	echo "L'équipe de Helpdesk <br/>";

?>