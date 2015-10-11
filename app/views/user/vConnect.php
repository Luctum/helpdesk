<form method="post" action="users/connectAction" class="panel panel-info">
<fieldset>
<legend class="panel-heading" >Se connecter</legend>
<div class="form-group panel panel-body">
	<input type="text" name="login" placeholder="Entrez un login" class="form-control">
	<input type="password" name="password" placeholder="Entrez le mot de passe" class="form-control">
</div>
	<p>Vous n'avez pas de compte ? Inscrivez-vous ! <a href="users/frm">S'inscrire</a></p>
	<input type="submit" value="Valider" id="submit" class="btn btn-default">
	<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>users">Annuler</a>
	
</fieldset>
</form>
