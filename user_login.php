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
    <script src="http://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="icon" href="vgr.png" type="image/gif" sizes="16x16">

	</head> 
<body>

<?php
    include 'myHeader.php';
    include 'dbConfig.php';
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

        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="user_login.php">Mitt
                        frågeformulär</a></li>
                <li><a href="user_checklist.php">Min checklista</a></li>
                <li><a href="user_growthchart.php">Min tillväxtkurva</a></li>
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
</nav><!--/.navbar -->


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
    </div> <!--/.modal for login -->


    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h1>Välkommen tillbaka <?php echo $_SESSION['user'] ?>!</h1>
        <p>Var vänlig och fyll i detta formulär så vi vet hur du och din familj mår.</p>
        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Fyll i här
        </button>
        <br>
        <br>

		<div class="container">
			  <h1 class="visible-xs bg-info">Vänd din enhet för att se graferna.</h1>
			  <h1 class="visible-sm bg-info">Vänd din enhet för att se graferna.</h1>
		</div>
		
		
        <br>
        <br>
        <div id="containergrej" style="width:100%; height:400px;"></div>


        <script>
            Highcharts.chart('containergrej', {
                title: {
                    text: 'Kurvor för välmående',
                    x: -20 //center
                },
                
                xAxis: {
                    categories: [<?php
                        if (isset($_SESSION['userID'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['userID'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $date = $row["Date"];
                            echo "'" . $date . "',";

                        }}
                        ?>]
                },
                yAxis: {
                    title: {
                        text: 'Värden'
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
                    name: 'Hur mår ert barn?',
                    data: [<?php
                        if (isset($_SESSION['userID'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['userID'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ett = $row["1"];
                            echo "" . $ett . ",";

                        }}
                        ?>]
                }, {
                    name: 'Hur ofta vaknar barnet till måltid?',
                    data: [<?php
                        if (isset($_SESSION['userID'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['userID'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $tva = $row["2"];
                            echo "" . $tva . ",";

                        }}
                        ?>]
                }, {
                    name: 'Hur ofta orkar barnet suga på mamma?',
                    data: [<?php
                        if (isset($_SESSION['userID'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['userID'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $tre = $row["3"];
                            echo "" . $tre . ",";

                        }}
                        ?>]
                }, {
                    name: 'Har barnet kräkts?',
                    data: [<?php
                        if (isset($_SESSION['userID'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['userID'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $fyra = $row["4"];
                            echo "" . $fyra . ",";

                        }}
                        ?>]
                }, {
                    name: 'Är barnet oroligt?',
                    data: [<?php
                        if (isset($_SESSION['userID'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['userID'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $fem = $row["5"];
                            echo "" . $fem . ",";

                        }}
                        ?>]
                }, {
                    name: 'Har barnet ont i magen?',
                    data: [<?php
                        if (isset($_SESSION['userID'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['userID'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sex = $row["6"];
                            echo "" . $sex . ",";

                        }}
                        ?>]
                }, {
                    name: 'Blir barnet lugnt av att stoppas om eller hållas om?',
                    data: [<?php
                        if (isset($_SESSION['userID'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['userID'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sju = $row["7"];
                            echo "" . $sju . ",";

                        }}
                        ?>]
                }, {
                    name: 'Upplever du att du kan tolka barnets signaler?',
                    data: [<?php
                        if (isset($_SESSION['userID'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['userID'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $atta = $row["8"];
                            echo "" . $atta . ",";

                        }}
                        ?>]
                }, {
                    name: 'Hur mår ni som föräldrar idag?',
                    data: [<?php
                        if (isset($_SESSION['userID'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['userID'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $nio = $row["9"];
                            echo "" . $nio . ",";

                        }}
                        ?>]
                }]
            });</script>




        <div class="container"> <!-- /. Container för frågeformulär -->

            <!-- Modal för frågeformulär -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title text-center">Var vänlig fyll i formuläret om dig och ditt barns
                                välmående.</h3>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-3">
                                </div>
								
								
                                <div class="col-md-6">
                                    <form method="post" action="FormInsert.php">
                                        <b>Hur mår ert barn?</b> <br><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="questOne" value="1">1
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questOne" value="2">2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questOne" value="3">3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questOne" value="4">4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questOne" value="5">5
                                        </label>
                                        <br><br>
                                        1 - mycket dåligt, 3 - medel, 5 - mycket bra
                                        <br>
                                        _________________________________________
                                        <br><br>
                                        <b>Hur ofta vaknar barnet till måltid?</b> <br><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="questTwo" value="1">1
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questTwo" value="2">2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questTwo" value="3">3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questTwo" value="4">4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questTwo" value="5">5
                                        </label>
                                        <br><br>
                                        1 - aldrig, 3 - till hälften av måltiderna, 5 - alla måltider
                                        <br>
                                        _________________________________________
                                        <br><br>
                                        <b>Hur ofta orkar barnet suga på mamma?</b> <br><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="questThree" value="1">1
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questThree" value="2">2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questThree" value="3">3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questThree" value="4">4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questThree" value="5">5
                                        </label>
                                        <br><br>
                                        1 - aldrig, 3 - till hälften av måltiderna, 5 - alla måltider
                                        <br>
                                        _________________________________________
                                        <br><br>
                                        <b>Har barnet kräkts?</b> <br><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="questFour" value="1">1
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questFour" value="2">2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questFour" value="3">3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questFour" value="4">4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questFour" value="5">5
                                        </label>
                                        <br><br>
                                        1 - nej, 3 - vid hälften av måltiderna, 5 - vid alla måltider
                                        <br>
                                        _________________________________________
                                        <br><br>

                                        <b>Är barnet oroligt?</b> <br><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="questFive" value="1">1
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questFive" value="2">2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questFive" value="3">3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questFive" value="4">4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questFive" value="5">5
                                        </label>
                                        <br><br>
                                        1 - stor del av dygnet, 3 - några gånger per dygn, 5 - mycket sällan
                                        <br>
                                        _________________________________________
                                        <br><br>
                                        <b>Har barnet ont i magen?</b> <br><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="questSix" value="1">1
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questSix" value="2">2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questSix" value="3">3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questSix" value="4">4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questSix" value="5">5
                                        </label>
                                        <br><br>
                                        1 - stor del av dygnet, 3 - några gånger per dygn, 5 - mycket sällan
                                        <br>
                                        _________________________________________
                                        <br><br>
                                        <b>Blir barnet lugnt av att stoppas om eller hållas om?</b> <br><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="questSeven" value="1">1
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questSeven" value="2">2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questSeven" value="3">3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questSeven" value="4">4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questSeven" value="5">5
                                        </label>
                                        <br><br>
                                        1 - nej, 3 - ibland, 5 - alltid
                                        <br>
                                        _________________________________________
                                        <br><br>
                                        <b>Upplever du att du kan tolka barnets signaler?</b> <br><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="questEight" value="1">1
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questEight" value="2">2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questEight" value="3">3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questEight" value="4">4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questEight" value="5">5
                                        </label>
                                        <br><br>
                                        1 - nej, 3 - ibland, 5 - alltid
                                        <br>
                                        _________________________________________
                                        <br><br>
                                        <b>Hur mår ni som föräldrar idag?</b> <br><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="questNine" value="1">1
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questNine" value="2">2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questNine" value="3">3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questNine" value="4">4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="questNine" value="5">5
                                        </label>
                                        <br><br>
                                        1 - mycket dåligt, 3 - medel, 5 - mycket bra
                                        <br>
                                        _________________________________________
                                        <br><br>

                                        <button type="submit" class="btn btn-default">Spara</button>
                                    </form>
                                </div>
                                <div class="col-md-3">


                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /. Container för frågeformulär -->

        <br>
        <br>



    </div> <!-- /container -->
</div> <!-- /div class container row 98 -->

	<!-- #####
			#####		
					Inkluderar en extern footer
															#####
															##### -->
<footer class="footer">
    <?php include 'footer.php' ?>
</footer>

</body>
</html>
