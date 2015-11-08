<form id="formMsg" name="formMsg">
<fieldset>
<legend>Repondre / Poster un message</legend>

<div class="form-group">
	<input type="hidden" name="id">
	<input type="hidden" name="idTicket" value="<?php echo $ticket->getId()?>">
	<textarea name="contenu" id="contenu" placeholder="Entrez le contenu de votre message" class="form-control"></textarea>
</div>
<div class="form-group">
	<a class="btn btn-default" id="submitMsg">Valider</a>
</div>
</fieldset>
</form>
