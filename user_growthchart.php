<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if (isset($_SESSION['inloggad']) && $_SESSION['role'] == 2) {
    header('Location: admin_login.php');
} else if (!isset($_SESSION['inloggad'])) {
    header('Location: index.php');
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
    <script src="http://code.highcharts.com/maps/highmaps.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="icon" href="vgr.png" type="image/gif" sizes="16x16">

	<!-- Funktion för att scrolla emellan graferna vid knapptryck -->
    <script>
        $(document).ready(function () {

            $('a[href^="#"]').on('click', function (e) {
                e.preventDefault();

                var target = this.hash;
                var $target = $(target);

                //Scroll and don't show hash
                $('html, body').animate({
                    'scrollTop': $target.offset().top
                }, 1000, 'swing');

                //});
            });
        });

    </script>

</head>
 
<body>
<?php
    include 'myHeader.php';
    include 'dbConfig.php';
    
    //Post-funktion för formulär som uppdaterar vikt- och längdvärden i databasen
if (isset($_POST['skicka'])) {
    if (isset($_POST['weight']) && isset($_POST['date'])) {

        $sqlCheckResult = "INSERT INTO Weightchart (`User_ID`, `Gram`, `Date`) Values (" . $_SESSION['userID'] . "," . $_POST['weight'] . ",'" . $_POST['date'] . "')";
        if ($conn->query($sqlCheckResult) === TRUE) {
            //echo "Record updated successfully" . $_POST['date'];
        }
    }
    if (isset($_POST['length']) && isset($_POST['date'])) {

        $sqlCheckResult = "INSERT INTO Lengthchart (`User_ID`, `Centimeter`, `Date`) Values (" . $_SESSION['userID'] . "," . $_POST['length'] . ",'" . $_POST['date'] . "')";
        if ($conn->query($sqlCheckResult) === TRUE) {
            //echo "Record updated successfully" . $_POST['date'];
        }
    }

}
?>
<!-- Toppmeny -->
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
            <a class="navbar-brand" href="#"></a> 
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="user_login.php">Mitt frågeformulär</a></li>
                <li><a href="user_checklist.php">Min checklista</a></li>
                <li class="active"><a href="user_growthchart.php">Min
                        tillväxtkurva</a></li>
                <li><a href="info.php">Information</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>

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
    <!--Bekräftelseruta som visas vid knapptryck på "Logga ut"-knappen -->
    <div id="modalLogin" class="modal fade" role="dialog">
        <div class="modal-dialog">
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


    <!-- Huvudinnehållet för sidan -->
    <div class="jumbotron">
        <h1>Välkommen tillbaka <?php echo $_SESSION['user'] ?>!</h1>
        <p>Här kan du redigera ditt barns tillväxtkurva.</p>
        <br>
        <br>
        <br>
        <br>
        <div class="container" id="Langd">
            <ul class="pager">
                <li><a href="#Vikt">Gå till viktkurvan</a></li>
            </ul>
        </div>
        <div id="grafForLangd" style="width:100%; height:400px;"></div>

		<!-- Externt JavaScript-bibliotek som hämtar värden ifrån databasen och ritar upp en graf baserat på parametrar -->
        <script>
            Highcharts.chart('grafForLangd', {
                title: {
                    text: 'Tillväxtkurva för längd',
                    x: -20
                },
                xAxis: {
                    categories: [<?php
                        if (isset($_SESSION['userID'])){
                        $result = mysqli_query($conn, "select * from Lengthchart where User_ID =" . $_SESSION['userID'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $date = $row["Date"];
                            echo "'" . $date . "',";

                        }
                        }
                        ?>]
                },
                yAxis: {
                    title: {
                        text: 'cm'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: ' ', showInLegend: false,
                    data: [<?php
                        if (isset($_SESSION['userID'])){
                        $result = mysqli_query($conn, "select * from Lengthchart where User_ID =" . $_SESSION['userID'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cm = $row["Centimeter"];
                            echo "" . $cm . ",";

                        }
                        }
                        ?>]
                }]
            });</script>

        <br>
    </div>

	<!-- Inmatning av värden som ska sparas i graferna -->
    <div class="container">
        <h2>Redigera här:</h2>
        <form class="form-horizontal" method="post" action="user_growthchart.php">
            <div class="form-group">
                <label class="control-label col-sm-2" for="date">Datum:</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" name="date" id="date" placeholder="Ex. 2017-02-01">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="weight">Längd:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="length" id="length" placeholder="Ange centimeter">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="weight">Vikt:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="weight" id="weight" placeholder="Ange gram">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="skicka">Spara</button>
                </div>
            </div>
        </form>
    </div>
    <br>

    <div class="container" id="Vikt">
        <ul class="pager">
            <li><a href="#Langd">Gå till längdkurvan</a></li>
        </ul>
    </div>
    <div id="grafForVikt" style="width:100%; height:400px;"></div>

</div>
<br><br><br>

<!-- Externt JavaScript-bibliotek som hämtar värden ifrån databasen och ritar upp en graf baserat på parametrar -->
<script>
    Highcharts.chart('grafForVikt', {
        title: {
            text: 'Tillväxtkurva för vikt',
            x: -20 
        },
        
        xAxis: {
            categories: [<?php
                if (isset($_SESSION['userID'])){
                $result = mysqli_query($conn, "select * from Weightchart where User_ID =" . $_SESSION['userID'])
                or die("Failed to query database " . mysql_error());
                while ($row = mysqli_fetch_assoc($result)) {
                    $date = $row["Date"];
                    echo "'" . $date . "',";

                }
                }
                ?>]
        },
        yAxis: {
            title: {
                text: 'gram'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
       
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: ' ', showInLegend: false,
            data: [<?php
                if (isset($_SESSION['userID'])){
                $result = mysqli_query($conn, "select * from Weightchart where User_ID =" . $_SESSION['userID'])
                or die("Failed to query database " . mysql_error());
                while ($row = mysqli_fetch_assoc($result)) {
                    $g = $row["Gram"];
                    echo "" . $g . ",";

                }
                }
                ?>]
        }]
    });</script>

<!-- Gemensam footer som inkluderas på varje sida -->
<footer class="footer">
    <?php include 'footer.php' ?>
</footer>


</body>
</html>
