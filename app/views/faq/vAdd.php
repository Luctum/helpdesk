<form method="post" action="Faqs/update">
    <fieldset>
        <legend>Ajouter/modifier un article</legend>

        <div class="form-group">
            <?php if($id != NULL){  ?>
                <div class="alert alert-info">Faq : <?php echo $faq->toString()?></div>
                <input type="hidden" name="idUser" value="<?= $faq->getUser()->getId()?>">
                <input type="hidden" id="dateCreation" name="dateCreation" value="<?= $faq->getDateCreation();?>">
                <label>Emetteur</label>
                <div class="form-control" disabled><?php echo $faq->getUser()?></div>
                <label>Date de création</label>
                <div class="form-control" disabled><?php echo $faq->getDateCreation()?></div>
            <?php }?>
            <input type="hidden" name="id" value="<?= $faq->getId();?>">
        </div>


        <div class="form-group">
            <label for="titre">Titre</label>

            <input type="text" name="titre" id="titre" value="<?php echo $faq->getTitre()?>" placeholder="Entrez le titre" class="form-control">
            <label for="idCategorie">Catégorie</label>
            <select class="form-control" name="idCategorie">
                <?php echo $listCat;?>
            </select>
            <label for="description">Contenu</label>
            <textarea name="contenu" id="contenu" placeholder="Entrez le contenu" class="form-control"><?php echo $faq->getContenu()?></textarea>
        </div>

        <div class="form-group">
            <input type="submit" value="Valider" class="btn btn-default">
            <a class="btn btn-default" href="<?php echo $config["siteUrl"]?>Faqs">Annuler</a>
        </div>


    </fieldset>
</form>
