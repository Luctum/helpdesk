<form method="post" action="Faqs/update">
    <fieldset>
        <legend>Ajouter/modifier un article</legend>



        <div class="alert alert-info">Faq : <?php echo $faq->toString()?></div>

        <label>Auteur</label>
        <div class="form-control" disabled><?php echo $faq->getUser()?></div>

        <input type="hidden" name="id" value="<?php echo $faq->getId()?>">
        <input type="hidden" id="idUser" name="idUser" value="<?php echo $faq->getUser()->getId()?>">
        <input type="hidden" id="idCategorie" name="idCategorie" value="<?php echo $faq->getCategorie()->getId()?>">

        <div class="form-group">
            <label for="idCategorie">Catégorie</label>
            <select class="form-control" id="idCategorie" name="idCategorie" <?php if (Auth::getUser()->getId() != $faq->getUser()->getId()) {?>disabled<?php }?>>
                <?php echo $listCat;?>
            </select>
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="<?php echo $faq->getTitre();?>" placeholder="Entrez le titre" class="form-control" <?php if (Auth::getUser()->getId() != $faq->getUser()->getId()) {?>disabled<?php }?>>
        </div>

        <div class="form-group">
            <textarea name="contenu" id="contenu" placeholder="Entrez le contenu" class="form-control"><?php echo $faq->getContenu()?></textarea>
            <label for="dateCreation">Date de création</label>
            <input type="text" name="dateCreation" id="dateCreation" value="<?php echo $faq->getDateCreation()?>" disabled class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" value="Valider" class="btn btn-default">
            <a class="btn btn-default" href="<?php echo $config["siteUrl"]?>Faqs">Annuler</a>
        </div>

    </fieldset>
</form>
