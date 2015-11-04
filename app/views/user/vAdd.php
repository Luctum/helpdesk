<form method="post" action="Users/update">
<fieldset>
<legend>Ajouter/modifier un utilisateur</legend>

<div class="alert alert-info">Utilisateur : <?php echo $user->toString()?></div>

<div class="form-group">
    <input type="submit" value="Valider" id="submit" class="btn btn-default">
    <a class="btn btn-default" href="<?php echo $config["siteUrl"]?>users">Annuler</a>
    
    <?php if($user == Auth::getUser()){ ?>
        <input type="hidden" name="bonuser" value="1">
    <?php }else{ ?>
        <input type="hidden" name="bonuser" value="2">
    <?php } ?>
	<input type="hidden" name="id" value="<?php echo $user->getId()?>">
	<input type="mail" name="mail" id="mail" value="<?php echo $user->getMail()?>" placeholder="Entrez l'adresse email" class="form-control">
	<input type="text" name="login" id="login" value="<?php echo $user->getLogin()?>" placeholder="Entrez un login" class="form-control">
	<input type="password" name="password" id="password" placeholder="Entrez le mot de passe" class="form-control">
	Voulez vous être notifié ? :
	<input type="checkbox" name="notifie" id="notifie" value="1" <?php if($user->getNotifie() == 1){echo"checked";}?>><br/>
    <input type="hidden" name="rang" value="<?= $user->getRang()->getLibelle();?>">
    <?php if(Auth::isAdmin() && $user->getRang()->getId() != 1){ ?>

       Administrateur <input type="radio" name="rang" value="Administrateur" ><br/>
       Technicien <input type="radio" name="rang" value="Technicien" <?php if($user->getRang()->getId() == 2){echo"checked";}?>><br/>
       Utilisateur <input type="radio" name="rang" value="Utilisateur" <?php if($user->getRang()->getId() == 3){echo"checked";}?>><br/>

    <?php } ?>


</div>


</fieldset>
</form>
