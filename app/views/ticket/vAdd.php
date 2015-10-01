<form method="post" action="tickets/update">
<fieldset>
<legend>Ajouter/modifier un ticket</legend>
<div class="form-group">
	<input type="submit" value="Valider" class="btn btn-default">
	<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>tickets">Annuler</a>
</div>
<div class="alert alert-info">Ticket : <?php echo $ticket->toString()?></div>
<input type="hidden" id="idCategorie" name="idCategorie" >
<input type="hidden" id="idStatut" name="idStatut" >
<input type="hidden" id="idUser" name="idUser" value="<?php $ticket->getUser()->getId()?>">
<?php if (Auth::isAdmin() == true) {?>
	<div class="form-group">
		<input type="hidden" name="id" value="<?php echo $ticket->getId()?>">
		<label for="statut">Modifier statut</label><br>
		<!-- Les 5 boutons permettant la modification du statut -->
		<?php if ($ticket->getStatut()->getLibelle() == "Nouveau") {?>
			<input type="submit" value="Nouveau" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="En attente" class="btn btn-default modif-statut" datatype="3">
			<input type="submit" value="Attribué" class="btn btn-default modif-statut" datatype="2">
			<input type="submit" value="Résolu" class="btn btn-default modif-statut" datatype="4">
			<input type="submit" value="Clos" class="btn btn-default modif-statut" datatype="5"><br>
		<?php } elseif ($ticket->getStatut()->getLibelle() == "En attente") {?>
			<input type="submit" value="Nouveau" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="En attente" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="Attribué" class="btn btn-default modif-statut" datatype="2">
			<input type="submit" value="Résolu" class="btn btn-default modif-statut" datatype="4">
			<input type="submit" value="Clos" class="btn btn-default modif-statut" datatype="5"><br>
		<?php } elseif ($ticket->getStatut()->getLibelle() == "Attribué") {?>
			<input type="submit" value="Nouveau" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="En attente" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="Attribué" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="Résolu" class="btn btn-default modif-statut" datatype="4">
			<input type="submit" value="Clos" class="btn btn-default modif-statut" datatype="5"><br>
		<?php } elseif ($ticket->getStatut()->getLibelle() == "Résolu") {?>
			<input type="submit" value="Nouveau" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="En attente" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="Attribué" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="Résolu" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="Clos" class="btn btn-default modif-statut" datatype="5"><br>
		<?php } elseif ($ticket->getStatut()->getLibelle() == "Clos") {?>
			<input type="submit" value="Nouveau" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="En attente" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="Attribué" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="Résolu" class="btn btn-default modif-statut" disabled>
			<input type="submit" value="Clos" class="btn btn-default modif-statut" disabled><br>
		<?php }?>
		<label for="type">Type</label>
		<select class="form-control" name="type" <?php if (Auth::getUser()->getId() != $ticket->getUser()->getId()) {?>disabled<?php }?>>
		<?php echo $listType;?>
		</select>
		<label for="idCategorie">Catégorie</label>
		<select class="form-control" id="idCategorie" name="idCategorie" <?php if (Auth::getUser()->getId() != $ticket->getUser()->getId()) {?>disabled<?php }?>>
		<?php echo $listCat;?>
		</select>
		<label for="titre">Titre</label>
		<input type="text" name="titre" id="titre" value="<?php echo $ticket->getTitre();?>" placeholder="Entrez le titre" class="form-control" <?php if (Auth::getUser()->getId() != $ticket->getUser()->getId()) {?>disabled<?php }?>>
		<label for="description">Description</label>
		<textarea name="description" id="description" placeholder="Entrez la description" class="form-control" <?php if (Auth::getUser()->getId() != $ticket->getUser()->getId()) {?>disabled<?php }?>><?php echo $ticket->getDescription()?></textarea>
		<input type="hidden" name="dateCreation" value="<?php echo $ticket->getDateCreation()?>">
		<input type="hidden" name="idStatut" value="<?php echo $ticket->getStatut()->getId()?>">
		<input type="hidden" name="idUser" value="<?php echo $ticket->getUser()->getId()?>">
	</div>
<?php } else {
	if ($ticket->getStatut()->getLibelle() == "Clos") {?>
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $ticket->getId()?>" disabled>
			<label for="type">Type</label>
			<select class="form-control" name="type" disabled>
			<?php echo $listType;?>
			</select>
			<label for="idCategorie">Catégorie</label>
			<select class="form-control" name="idCategorie" disabled>
			<?php echo $listCat;?>
			</select>
			<label for="titre">Titre</label>
			<input type="text" name="titre" id="titre" value="<?php echo $ticket->getTitre()?>" placeholder="Entrez le titre" class="form-control" disabled>
			<label for="description">Description</label>
			<textarea name="description" id="description" placeholder="Entrez la description" class="form-control" disabled><?php echo $ticket->getDescription()?></textarea>
		</div>
		<div class="form-group">
			<label>Statut</label>
			<div class="form-control" disabled><?php echo $ticket->getStatut()?></div>
			<label>Emetteur</label>
			<div class="form-control" disabled><?php echo $ticket->getUser()?></div>
			<label for="dateCreation">Date de création</label>
			<input type="text" name="dateCreation" id="dateCreation" value="<?php echo $ticket->getDateCreation()?>" disabled class="form-control">
			<input type="hidden" name="idStatut" value="<?php echo $ticket->getStatut()->getId()?>">
			<input type="hidden" name="idUser" value="<?php echo $ticket->getUser()->getId()?>">
		</div>
	<?php } else { ?>
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $ticket->getId()?>">
			<label for="type">Type</label>
			<select class="form-control" name="type">
			<?php echo $listType;?>
			</select>
			<label for="idCategorie">Catégorie</label>
			<select class="form-control" name="idCategorie">
			<?php echo $listCat;?>
			</select>
			<label for="titre">Titre</label>
			<input type="text" name="titre" id="titre" value="<?php echo $ticket->getTitre()?>" placeholder="Entrez le titre" class="form-control">
			<label for="description">Description</label>
			<textarea name="description" id="description" placeholder="Entrez la description" class="form-control"><?php echo $ticket->getDescription()?></textarea>
		</div>
		<div class="form-group">
			<label>Statut</label>
			<div class="form-control" disabled><?php echo $ticket->getStatut()?></div>
			<label>Emetteur</label>
			<div class="form-control" disabled><?php echo $ticket->getUser()?></div>
			<label for="dateCreation">Date de création</label>
			<input type="text" name="dateCreation" id="dateCreation" value="<?php echo $ticket->getDateCreation()?>" disabled class="form-control">
			<input type="hidden" name="idStatut" value="<?php echo $ticket->getStatut()->getId()?>">
			<input type="hidden" name="idUser" value="<?php echo $ticket->getUser()->getId()?>">
		</div>
	<?php }?>
<?php }?>
<div class="form-group">
	<input type="submit" value="Valider" class="btn btn-default">
	<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>tickets">Annuler</a>
</div>
</fieldset>
</form>
