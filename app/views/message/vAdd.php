<form method="post" action="messages/update/<?= $ticket-> getId() ?>">
<fieldset>
<legend>Repondre / Poster un message</legend>

<div class="form-group">
	<input type="hidden" name="id">
	<input type="hidden" name="idTicket" value="<?php echo $ticket->getId()?>">
	<textarea name="contenu" id="contenu" placeholder="Entrez le contenu de votre message" class="form-control"></textarea>
</div>
<div class="form-group">
	<input type="submit" value="Valider" class="btn btn-default">
</div>
</fieldset>
</form>
