<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if (!isset($_SESSION['inloggad'])) {
    header('Location: http://webbkurs.ei.hv.se/~neonatalvard/');
    //Här startas session om man är inloggad, och om man inte är inloggad hamnar man på index.php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NeoCare</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <link rel="icon" href="vgr.png" type="image/gif" sizes="16x16">

    <div id="logo-container">
        <img src="NeoCare.png" alt=""/>
    </div>

    <script>
        $(document).ready()
        {
            $(".nav li a").on("click", function () {
                $(".nav").find(".active").removeClass("active");
                $(this).parent().addClass("active");
            });
        }
        ;
    </script>
</head>
<body>

<?php
$servername = "localhost";
$username = "neonatalvard";
$password = "Mgc31cn9";
$dbname = "neonatalvard";

// Skapa anslutning med databasen
$conn = new mysqli($servername, $username, $password, $dbname);
// Kontrollera anslutning
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
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
                <li><a href="http://webbkurs.ei.hv.se/~neonatalvard/user_login.php">Mitt frågeformulär</a></li>
                <li><a href="http://webbkurs.ei.hv.se/~neonatalvard/user_checklist.php">Min checklista</a></li>
                <li><a href="http://webbkurs.ei.hv.se/~neonatalvard/user_growthchart.php">Min tillväxtkurva</a></li>
                <li><a href="http://webbkurs.ei.hv.se/~neonatalvard/info.php">Information</a></li>
                <li><a href="http://webbkurs.ei.hv.se/~neonatalvard/kontakt.php">Kontakt</a></li>
                <!--<li class="active"><a href="http://webbkurs.ei.hv.se/~neonatalvard/kontakt.php">Kontakt</a></li>-->

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
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>


                </div>
            </div>
        </div>
    </div>