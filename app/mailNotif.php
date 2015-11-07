<?php
use micro\controllers\Autoloader;
use micro\orm\DAO;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__).DS);
$config=include_once ROOT.DS.'config.php';
require_once ROOT.'micro/log/Logger.php';
require_once ROOT.'micro/controllers/Autoloader.php';
require_once ROOT.'./../vendor/ircmaxell/password-compat/lib/password.php';
require_once ROOT.'./../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
Autoloader::register();

extract($config["database"]);
$db=$config["database"];
DAO::connect($db["dbName"],@$db["serverName"],@$db["port"],@$db["user"],@$db["password"]);

$user = DAO::getAll("User");
$notifs;
$tickets = DAO::getAll("Ticket");

foreach($user as $u){
    $notifs = DAO::getAll("Notification","idUser = ".$u->getId()."");
	if( $u->getNotifie() == 1){
		$ctrl=new DefaultC();
		$body=$ctrl->loadView("mail/vMail",array("tickets"=>$tickets,"u"=>$u, "notifs"=>$notifs), true);
		$to = $u->getMail();
	
	
	
		$mail = new PHPMailer;
		
		//$mail->SMTPDebug = 3;
		
		$mail->isSMTP();
		$mail->Host = 'smtp.live.com';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 25;
		$mail->SMTPAuth = true;
		$mail->Username = 'luctum@hotmail.fr';
		$mail->Password = '';
		$mail->setFrom('admin@helpdesk.com');
		$mail->addAddress("testaa@yopmail.com");
		
		$mail->isHTML(true);
		
		$mail->Subject = "HELPDESK | ".$u->getLogin()." vos nouvelles notifications!";
		$mail->Body    = $body;
		
		if(!$mail->send()) {
			echo 'Une erreur est survenue lors de l\'envoi de message.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Le message à bien été envoyé !';
		}
	}
}	
	
