<?php use micro\orm\DAO; ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1.0', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            <?php foreach($user as $u){
                $attrib = DAO::getAll("Ticket", "attribuer =".$u->getId());
                if(!empty($attrib)){
                $count = count($attrib); }else{$count = 0;}?>

                ['<?= $u->getLogin() ?>', <?= $count ?>],
            <?php } ?>
        ]);

        // Set chart options
        var options = {'title':'Répartition des tickets attribués',
            'width':400,
            'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

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
     <div id="chart_div" style="display: inline-block"></div>
	<div style="display: inline-block; vertical-align:top">

        <div id="main" >
			<fieldset>
                <ul>
                    <li><a class="btn btn-default" href="Users">Utilisateurs</a></li>
                    <li><a class="btn btn-primary" href="Categories">Catégories</a></li>
                    <li><a class="btn btn-info" href="Tickets">Tickets</a></li>
                    <li><a class="btn btn-success" href="Statuts">Statuts</a></li>
                    <li><a class="btn btn-warning" href="Faqs">Faq</a></li>
                </ul>
			</fieldset>
		</div>
		<div id="response"></div>
	</div>
<?php } ?>
</div>