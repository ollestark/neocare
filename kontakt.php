<?php
session_start();

error_reporting(E_ALL & ~E_NOTICE);
if (isset($_SESSION['inloggad']) && $_SESSION['role'] == 2) {
    header('Location: admin_login.php');
} else if (!isset($_SESSION['inloggad'])) {
    header('Location: kontakt_visitor.php');
    //Här startas session om man är inloggad, och om man inte är inloggad hamnar man på index.php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NeoCare</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#094E79"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <link rel="icon" href="vgr.png" type="image/gif" sizes="16x16">


</head>
<body>

<?php
include 'dbConfig.php';
include 'myHeader.php';    
?>


<!-- <div class="container"> -->

<!-- Static navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a> <!--Neonatalvården</a>-->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="user_login.php">Mitt frågeformulär</a></li>
                <li><a href="user_checklist.php">Min checklista</a></li>
                <li><a href="user_growthchart.php">Min tillväxtkurva</a></li>
                <li><a href="info.php">Information</a></li>
                <li class="active"><a href="kontakt.php">Kontakt</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Inloggad
                        som: <?php echo $_SESSION['user'] ?></a></li>
                <li><a href="" data-toggle="modal" data-target="#modalLogin"><span
                            class="glyphicon glyphicon-log-in"></span> Logga ut</a></li>


            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
<div class="container">
    <!-- LOG IN MODAL -->
    <div id="modalLogin" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title" style="text-align-last: center">Logga ut</h3>
                </div>
                <div class="modal-body">
                    <form action="Logout.php" method="POST">
                        Du kommer nu loggas ut, men glöm inte komma tillbaka imorgon!
                        <br>
                        <button type="submit" class="btn btn-success">Logga ut</button>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>


                </div>
            </div>
        </div>
    </div>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">

        <h2>Kontakt</h2>
        <h4>Avdelning 34 - neonatal</h4>
        <br>

        <div class="checklistContainer" id="checkcontainer">
            <div class="row">
                <div class="col-md-6">
                    <p><span class="glyphicon glyphicon-earphone"></span>&nbsp; <b>Telefon</b></p>
                    <a href="#"><p>010-435 03 40</p></a>
                    <br>
                    <p><span class="glyphicon glyphicon-time"></span>&nbsp; <b>Telefontider</b></p>
                    <p>mån - sön ............. dygnet runt</p><br>
					<p>Hemsjukvården: 010-435 03 44 <br>(mån, tis, tor, fre 08:00-16:30)</p><br>
					<p>070-020 62 65</p>
                    <br>
                    <p><span class="glyphicon glyphicon-earphone"></span>&nbsp; <b>Växeltelefon</b></p>
                    <a href="#"><p>010-435 00 00</p></a>
                </div>


                <div class="col-md-6">
                    <p><span class="glyphicon glyphicon-time"></span>&nbsp; <b>Öppettider</b></p>
                    <p>mån - sön ............. dygnet runt</p>
                    <br>
                    <p><span class="glyphicon glyphicon-map-marker"></span>&nbsp; <b>Besöksadress</b></p>
                    <p>Lärketorpsvägen</p>
                    <p>361 73 Trollhättan</p>
                    <p>Målpunkt B Plan 3</p>
                    <br>
                    <a href="https://www.google.se/maps/place/Norra+%C3%84lvsborgs+L%C3%A4nssjukhus/@58.3185669,12.2633688,17z/data=!3m1!4b1!4m5!3m4!1s0x46453d3b2e8ff639:0x21021757bfee9b89!8m2!3d58.3185669!4d12.2655575"><p>Visa adress på karta</p></a>


                </div>
            </div>
            <div>
                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Visa mer
                    information
                </button>
                <div id="demo" class="collapse">

                    <div class="row">
                        <div class="col-md-6">

                        </div>

                        <div class="col-md-6">
                            <p><span class="glyphicon glyphicon-map-marker"></span>&nbsp; <b>Besöksadress</b></p>
                            <p>Lärketorpsvägen</p>
                            <p>361 73 Trollhättan</p>
                            <p>Målpunkt B Plan 3</p>
                            <br>
                            <p><span class="glyphicon glyphicon-map-marker"></span>&nbsp; <b>Vägbeskrivning</b></p>
                            <p>NÄL, Trollhättan. Följ vägskyltarna med röda kors.</p>
                            <p>Se vidare skyltning inom sjukhusområdet.</p>
                            <p>Information om kollektivtrafik: <a href="http://www.vasttrafik.se">www.vasttrafik.se</a>
                            <br>
                            <p><span class="glyphicon glyphicon-map-marker"></span>&nbsp; <b>Västtrafik -
                                    reseplaneraren</b></p>
                            <a href="http://reseplanerare.vasttrafik.se/bin/query.exe/sn?ZGID=9021014L%C3%A4rketorpsv%C3%A4gen,%20461%2073%20Trollh%C3%A4ttan">Hitta hit, Lärketorpsvägen, 461 73 Trollhättan</a>
                            <br>
                            <p><span class="glyphicon glyphicon-map-marker"></span>&nbsp; <b>Postadress</b></p>
                            <p>Avdelning 34 NÄL</p>
                            <p>Lärketorpsvägen</p>
                            <p>461 85 Trollhättan</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div><!-- /container -->

<footer class="footer">
    <?php include 'footer.php' ?>
</footer>


</body>
</html>
