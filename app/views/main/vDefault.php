
<div class="container">

    <div class="panel panel-primary">
        <table class='table table-striped'>
        <div class='panel-heading'>Votre dernier <a href="Tickets" style="color: #ffc343">Ticket</a></div>
        <thead><tr><th>Ticket</th><th>User</th><th>Attribution</th></tr></thead>
        <?php foreach($ticket as $tickets){ ?>
       <tr><td><a href="Tickets/messages/<?=$tickets->getId()?>"> <?=$tickets->toString()?> </a></td>
        <td> <?=$tickets->getUser()?> </td>
       <td> <?php if($tickets->getAttribuer() != null){echo $tickets->getAttribuer()->getLogin();}else{echo "Non attribué";}?> </td></tr>
        <?php } ?>
        </table>
    </div>
    <div class="panel panel-primary">
        <table class='table table-striped'>
            <div class='panel-heading'>Derniers article de la <a href="Faqs" style="color:  #ffc343">Faq</a></div>
            <thead><tr><th>Sujet</th><th>User</th></tr></thead>
            <?php foreach($faq as $f){ ?>
                <tr><td><a href="Faqs/lecture/<?=$f->getId()?>"> <?=$f->toString()?> </a></td>
                    <td> <?=$f->getUser()?> </td></tr>
            <?php } ?>
        </table>
    </div>
    <?php if(Auth::isAdmin()){ ?>
	<div class="well well-lg">
		<div id="main">
			<fieldset>
				<legend>Données</legend>
				<a class="btn btn-link" href="#">Accueil</a>
				<a class="btn btn-default" href="Users">Utilisateurs</a>
				<a class="btn btn-primary" href="Categories">Catégories</a>
				<a class="btn btn-info" href="Tickets">Tickets</a>
				<a class="btn btn-success" href="Statuts">Statuts</a>
				<a class="btn btn-warning" href="Faqs">Faq</a>
			</fieldset>
		</div>
		<div id="response"></div>
	</div>
<?php } ?>
</div>