<div class="container">
<div class="col-md-3"></div>
    <div class="col-md-6">
        <form method="post" action="DefaultC/connectAction" class="panel panel-info">
            <legend class="panel-heading" >Se connecter</legend>

            <div class="form-group panel panel-body">
	            <input type="text" name="login" id="login" value="<?php if(isset($_COOKIE['login'])){ echo $_COOKIE['login']; }?>" placeholder="Entrez un login" class="form-control">
	            <input type="password" name="password" id="password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; }?>" placeholder="Entrez le mot de passe" class="form-control">
                <input type="checkbox" name="retenir" id="retenir"> - Retenir mes identifiants</input>


                <p style="text-align: center;">Vous n'avez pas de compte ? Inscrivez-vous ! <a href="Users/frm">S'inscrire</a></p>

                <div style="margin: 0;">
                    <input type="submit" value="Valider" id="submit" class="btn btn-default">
                    <a class="btn btn-default" href="<?php echo $config["siteUrl"]?>users">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>
