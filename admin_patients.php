<?php
session_start();
//error_reporting(E_ALL & ~E_NOTICE);
/*if (isset($_SESSION['inloggad']) && $_SESSION['role'] == 1) {
    header('Location: user_login.php');
} else if (!isset($_SESSION['inloggad'])) {
    header('Location: index.php');
    //Här startas session om man är inloggad, och om man inte är inloggad hamnar man på index.php
}*/

?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <title>NeoCare</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#094E79"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="http://code.highcharts.com/maps/highmaps.js"></script>
    <link rel="icon" href="vgr.png" type="image/gif">

    <script>    
        var chart1, chart2, chart3;
        $(document).ready(function () {
            $("#sel1").change(function () {
                var vald = $(this).val();
                if (vald != "EjValbart") {
                    var selectedPatient = $(this).val();
                    /* WITH MORE TIME THESE SHOULD BE COMBINED TO MAKE ONE CALL TO THE SERVER
                    MAKE SEPARATE CALLS FOR SIMPLICITY NOW
                    */
                    $.ajax({
                        type: "POST",
                        url: "PatientLista.php",
                        data: {SelectedPatient: selectedPatient},
                        success: function (data) {
                            for (i = 0; i <= 86; i++) {
                                $('#' + i).css("background-color", "#E1E1E1");
                            }
                            data = $.parseJSON(data);
                            $.each(data, function (i, item) {
                                var btnID = item;
                                $('#' + btnID).css("background-color", "#7fff00");
                            });
                        }
                    });
                    
                    
                    //update length graph
                    $.ajax({
                        type: "POST",
                        url: "updateLengthGraph.php",
                        data: {SelectedPatient: selectedPatient},
                        success: function (data) {
                           chart1.title.update({ text: 'Tillväxtkurva för längd (' + selectedPatient +')' , x: -20 });
                            data = $.parseJSON(data);
                            var categories = new Array();
                            var series = new Array();
                            $.each(data, function (i, item) {
                                if(i % 2 == 0)
                                    categories.push(item);
                                else
                                    series.push(parseFloat(item));
                            });
                            chart1.xAxis[0].setCategories(categories);
                            chart1.series[0].setData(series);     
                        }
                    });
                    
                    //update weight graph
                    $.ajax({
                        type: "POST",
                        url: "updateWeightGraph.php",
                        data: {SelectedPatient: selectedPatient},
                        success: function (data) {
                           chart2.title.update({ text: 'Tillväxtkurva för vikt (' + selectedPatient +')' , x: -20 });
                            data = $.parseJSON(data);
                            var categories = new Array();
                            var series = new Array();
                            $.each(data, function (i, item) {
                                if(i % 2 == 0)
                                    categories.push(item);
                                else
                                    series.push(parseFloat(item));
                            });
                            chart2.xAxis[0].setCategories(categories);
                            chart2.series[0].setData(series); 
                        }
                    });
                    
                     //update välmående graph
                    $.ajax({
                        type: "POST",
                        url: "updateFeelingGraph.php",
                        data: {SelectedPatient: selectedPatient},
                        success: function (data) {
                           chart3.title.update({ text: 'Tillväxtkurva för vikt (' + selectedPatient +')' , x: -20 });
                            data = $.parseJSON(data);
                            var rowData = new Array();
                            var categories = new Array();
                            var series = new Array();
                             $.each(data, function (i, item) {
                                    rowData = data[i].split(",");
                                    categories.push(rowData[0]);
                                    for (i = 1; i <= rowData.length-1; i++) {
                                        series.push(parseFloat(rowData[i]));
                                    }
                            });
                            //console.log(series);
                            chart3.xAxis[0].setCategories(categories);
                            //REALLY UGLY HACK! Should transpose matrix and iterate series in graphs
                            //but the api would not allow me to iterate series...strange...FIX LATER //and TEST
                            var temp1 = [],temp2 = [],temp3 = [],temp4 = [],temp5 = [],temp6 = [],temp7 = [],temp8 = [],temp9 = [];
                            for (i = 0; i <= series.length-1; i=i+9) {
                                temp1.push(series[i]);
                                temp2.push(series[i+1]);
                                temp3.push(series[i+2]);
                                temp4.push(series[i+3]);
                                temp5.push(series[i+4]);
                                temp6.push(series[i+5]);
                                temp7.push(series[i+6]);
                                temp8.push(series[i+7]);
                                temp9.push(series[i+8]);
                            }
                            chart3.series[0].setData(temp1);
                            chart3.series[1].setData(temp2);
                            chart3.series[2].setData(temp3);
                            chart3.series[3].setData(temp4);
                            chart3.series[4].setData(temp5);
                            chart3.series[5].setData(temp6);
                            chart3.series[6].setData(temp7);
                            chart3.series[7].setData(temp8);
                            chart3.series[8].setData(temp9);
                        }
                    });                   
                    
                    
                    
                    
                } //end of if
            });
        });

    </script>

</head>
<body>

<?php
include 'dbConfig.php';
include 'myHeader.php';
?>


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
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="admin_login.php">Lägg till patient</a></li>
                <li class="active"><a href="#">Mina patienter</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" data-toggle="modal" data-target="#modalRegister"><span
                            class="glyphicon glyphicon-user"></span> Inloggad som: Admin</a></li>
                <li><a href="index.php"><span
                            class="glyphicon glyphicon-log-in"></span> Logga ut</a></li>


            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
<div class="container">
    


    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h1> Se över dina patienter </h1>


        <div class="form-group">
            <label for="sel1"></label>
            <select class="form-control" id="sel1">
                <option value="EjValbart">Välj patient</option>
                <?php
                $result = mysqli_query($conn, "select * from User where Role ='1'")
                or die("Failed to query database " . mysql_error());
                while ($row = mysqli_fetch_assoc($result)) {
                    $patient = $row["Username"];
                    $patientID = $row["User_ID"];
                    echo "<option value=" . $patient . " class='patientList'>" . $patient . "</option>";

                }
                ?>
            </select>
        </div>
       

        <div>
            <ul class="pager">
                <li id="checklistaknapp" style="float: left;"><a href="#checklista" style="display: block; margin-right: 50px; color: #005C95">Visa
                        checklista</a></li>
                <li id="tillvaxtkurvaknapp" style="float: left;"><a href="#tillvaxtkurvor" style="display: block; margin-right: 50px; color: #005C95">Visa
                        tillväxtkurvor</a></li>
                <li id="formularknapp" style="float: left;"><a href="#grafForValmaende" style="display: block; margin-right: 50px; color: #005C95">Visa
                        formulärgraf</a></li>
            </ul>
        </div>
     

		<div id="tillvaxtkurvor"><div id="grafForLangd" style="width:100%; height:400px;"></div><br><div id="grafForVikt" style="width:100%; height:400px;"></div>

        <script>
            chart1 = new Highcharts.chart('grafForLangd', {
                title: {
                    text: /*'Tillväxtkurva för längd'*/ <?php 
                    if (isset ($_SESSION['valdPatient'])){
                        $selectedPatient = $_SESSION['valdPatient'];
                        $sqlFindPatientUsername = mysqli_query($conn, "Select Username From User Where `User_ID`='".$selectedPatient."'");
                        $sqlUserArray = $sqlFindPatientUsername->fetch_assoc();
                        $sqlSelectedPatient = $sqlUserArray['Username'];
                        echo "'Tillväxtkurva för längd (".$sqlSelectedPatient.")'";
                        
                    }
                    else{
                        echo "'Tillväxtkurva för längd'";
                    }
                    ?>,
                    x: -20 //center
                },
                /*subtitle: {
                 text: 'Source: WorldClimate.com',
                 x: -20
                 },*/
                xAxis: {
                    categories: [<?php
                        if (isset ($_SESSION['valdPatient'])){
					       $valdUser = $_SESSION['valdPatient'];
					       $sqlString= "select * from Lengthchart where User_ID =".$valdUser; //.$_SESSION['valdPatient']."'";
                            $result = mysqli_query($conn, $sqlString)
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $date = $row["Date"];
                            echo "'" . $date . "',";

                        }}
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
                /*tooltip: {
                 valueSuffix: '°C'
                 },*/
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: ' ', showInLegend: false,
                    data: [<?php
                        if (isset ($_SESSION['valdPatient'])){
					$valdUser = $_SESSION['valdPatient'];
					$sqlString= "select * from Lengthchart where User_ID =".$valdUser; //.$_SESSION['valdPatient']."'";
                        $result = mysqli_query($conn, $sqlString)
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cm = $row["Centimeter"];
                            echo "" . $cm . ",";

                        }}
                        ?>]
                }]
            });
            </script>
			<br><br><br>
			

<script>
    chart2 = new Highcharts.chart('grafForVikt', {
        title: {
            text: /*'Tillväxtkurva för vikt'*/<?php 
                    if (isset ($_SESSION['valdPatient'])){
                        $selectedPatient = $_SESSION['valdPatient'];
                        $sqlFindPatientUsername = mysqli_query($conn, "Select Username From User Where `User_ID`='".$selectedPatient."'");
                        $sqlUserArray = $sqlFindPatientUsername->fetch_assoc();
                        $sqlSelectedPatient = $sqlUserArray['Username'];
                        echo "'Tillväxtkurva för vikt (".$sqlSelectedPatient.")'";
                        
                    }
                    else{
                        echo "'Tillväxtkurva för vikt'";
                    }
                    ?>,
            x: -20 //center
        },
        /*subtitle: {
         text: 'Source: WorldClimate.com',
         x: -20
         },*/
        xAxis: {
            categories: [<?php
                if (isset ($_SESSION['valdPatient'])){
			$valdUser = $_SESSION['valdPatient'];
					$sqlString= "select * from Weightchart where User_ID =".$valdUser; //.$_SESSION['valdPatient']."'";
                        $result = mysqli_query($conn, $sqlString)
                or die("Failed to query database " . mysql_error());
                while ($row = mysqli_fetch_assoc($result)) {
                    $date = $row["Date"];
                    echo "'" . $date . "',";

                }}
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
        /*tooltip: {
         valueSuffix: '°C'
         },*/
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: ' ', showInLegend: false,
            data: [<?php
                if (isset ($_SESSION['valdPatient'])){
                $valdUser = $_SESSION['valdPatient'];
					$sqlString= "select * from Weightchart where User_ID =".$valdUser; //.$_SESSION['valdPatient']."'";
                        $result = mysqli_query($conn, $sqlString)
                or die("Failed to query database " . mysql_error());
                while ($row = mysqli_fetch_assoc($result)) {
                    $g = $row["Gram"];
                    echo "" . $g . ",";

                }}
                ?>]
        }]
    });</script>
            </div>
			<div class="container">
			    <h1 class="visible-xs bg-info">Vänd din enhet för att se graferna.</h1>
			    <h1 class="visible-sm bg-info">Vänd din enhet för att se graferna.</h1>
		    </div>
			<div id="grafForValmaende" style="width:100%; height:400px;"></div>

        
        <script>
            chart3 = new Highcharts.chart('grafForValmaende', {
                title: {
                    text: /*Kurvor för välmående'*/<?php
                    if (isset ($_SESSION['valdPatient'])){
                        $selectedPatient = $_SESSION['valdPatient'];
                        $sqlFindPatientUsername = mysqli_query($conn, "Select Username From User Where `User_ID`='".$selectedPatient."'");
                        $sqlUserArray = $sqlFindPatientUsername->fetch_assoc();
                        $sqlSelectedPatient = $sqlUserArray['Username'];
                        echo "'Kurvor för välmående (".$sqlSelectedPatient.")'";
                        
                    }
                    else{
                        echo "'Kurvor för välmående'";
                    }
                    ?>,
                    x: -20 //center
                },
                /*subtitle: {
                 text: 'Source: WorldClimate.com',
                 x: -20
                 },*/
                xAxis: {
                    categories: [<?php
                        if (isset ($_SESSION['valdPatient'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['valdPatient'])
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
                        if (isset ($_SESSION['valdPatient'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =". $_SESSION['valdPatient'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ett = $row["1"];
                            echo "" . $ett . ",";

                        }}
                        ?>]
                }, {
                    name: 'Hur ofta vaknar barnet till måltid?',
                    data: [<?php
                        if (isset ($_SESSION['valdPatient'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['valdPatient'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $tva = $row["2"];
                            echo "" . $tva . ",";

                        }}
                        ?>]
                }, {
                    name: 'Hur ofta orkar barnet suga på mamma?',
                    data: [<?php
                        if (isset ($_SESSION['valdPatient'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['valdPatient'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $tre = $row["3"];
                            echo "" . $tre . ",";

                        }}
                        ?>]
                }, {
                    name: 'Har barnet kräkts?',
                    data: [<?php
                        if (isset ($_SESSION['valdPatient'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =". $_SESSION['valdPatient'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $fyra = $row["4"];
                            echo "" . $fyra . ",";

                        }}
                        ?>]
                }, {
                    name: 'Är barnet oroligt?',
                    data: [<?php
                        if (isset ($_SESSION['valdPatient'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['valdPatient'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $fem = $row["5"];
                            echo "" . $fem . ",";

                        }}
                        ?>]
                }, {
                    name: 'Har barnet ont i magen?',
                    data: [<?php
                        if (isset ($_SESSION['valdPatient'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['valdPatient'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sex = $row["6"];
                            echo "" . $sex . ",";

                        }}
                        ?>]
                }, {
                    name: 'Blir barnet lugnt av att stoppas om eller hållas om?',
                    data: [<?php
                        if (isset ($_SESSION['valdPatient'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =". $_SESSION['valdPatient'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sju = $row["7"];
                            echo "" . $sju . ",";

                        }}
                        ?>]
                }, {
                    name: 'Upplever du att du kan tolka barnets signaler?',
                    data: [<?php
                        if (isset ($_SESSION['valdPatient'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['valdPatient'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $atta = $row["8"];
                            echo "" . $atta . ",";

                        }}
                        ?>]
                }, {
                    name: 'Hur mår ni som föräldrar idag?',
                    data: [<?php
                        if (isset ($_SESSION['valdPatient'])){
                        $result = mysqli_query($conn, "select * from FormData where UserID =" . $_SESSION['valdPatient'])
                        or die("Failed to query database " . mysql_error());
                        while ($row = mysqli_fetch_assoc($result)) {
                            $nio = $row["9"];
                            echo "" . $nio . ",";

                        }}
                        ?>]
                }]
            });
        
        </script>
	
	
		<div id="checklista">
        <h2>Checklista</h2>
        <h4>Här kan du fylla i hur långt du har kommit i utbildningen!</h4>
        <h4>Klicka på den knapp som motsvarar vad du har gjort.</h4>
        <br>
        <div class="checklistContainer" id="task1">
            <h2>Blöjbyte</h2>
            <input type="button" id="1" name="1" class="checklistBTN" value="Blivit visad">
            <input type="button" id="2" name="2" class="checklistBTN" value="Gjort med personal">
            <input type="button" id="3" name="3" class="checklistBTN" value="Gör själva">
        </div>

        <div class="checklistContainer" id="task2">
            <h2>Hud mot hud-vård</h2>
            <input type="button" id="4" name="4" class="checklistBTN" value="Blivit visad">
            <input type="button" id="5" name="5" class="checklistBTN" value="Gjort med personal">
            <input type="button" id="6" name="6" class="checklistBTN" value="Gör själva">
        </div>

        <div class="checklistContainer" id=task3>
            <h2>Navelvård</h2>
            <input type="button" id="7" name="7" class="checklistBTN" value="Blivit visad">
            <input type="button" id="8" name="8" class="checklistBTN" value="Gjort med personal">
            <input type="button" id="9" name="9" class="checklistBTN" value="Gör själva">
        </div>

        <div class="checklistContainer" id="task4">
            <h2>Sondmatning</h2>
            <input type="button" id="10" name="10" class="checklistBTN" value="Blivit visad">
            <input type="button" id="11" name="11" class="checklistBTN" value="Gjort med personal">
            <input type="button" id="12" name="12" class="checklistBTN" value="Gör själva">
        </div>


        <div class="checklistContainer" id="task5">
            <h2>Nakenvägning</h2>
            <input type="button" id="13" name="13" class="checklistBTN" value="Blivit visad">
            <input type="button" id="14" name="14" class="checklistBTN" value="Gjort med personal">
            <input type="button" id="15" name="15" class="checklistBTN" value="Gör själva">
        </div>

        <div class="checklistContainer" id="task6">
            <h2>Daglig avtvättning och hudinspektion</h2>
            <input type="button" id="16" name="16" class="checklistBTN" value="Blivit visad">
            <input type="button" id="17" name="17" class="checklistBTN" value="Gjort med personal">
            <input type="button" id="18" name="18" class="checklistBTN" value="Gör själva">
        </div>

        <div class="checklistContainer" id="task7">
            <h2>Temptagning</h2>
            <input type="button" id="19" name="19" class="checklistBTN" value="Blivit visad">
            <input type="button" id="20" name="20" class="checklistBTN" value="Gjort med personal">
            <input type="button" id="21" name="21" class="checklistBTN" value="Gör själva">
        </div>

        <div class="checklistContainer" id="task8">
            <h2>Badning</h2>
            <input type="button" id="22" name="22" class="checklistBTN" value="Blivit visad">
            <input type="button" id="23" name="23" class="checklistBTN" value="Gjort med personal">
            <input type="button" id="24" name="24" class="checklistBTN" value="Gör själva">
        </div>

        <div class="checklistContainer" id="task9">
            <h2>Pumpning</h2>
            <input type="button" id="25" name="25" class="checklistBTN" value="Blivit visad">
            <input type="button" id="26" name="26" class="checklistBTN" value="Gjort med personal">
            <input type="button" id="27" name="27" class="checklistBTN" value="Gör själva">
        </div>

        <div class="checklistContainer" id="task10">
            <h2>Hämtar mitt barns mat till måltiderna</h2>
            <input type="button" id="28" name="28" class="checklistBTN" value="Del av dygnet">
            <input type="button" id="29" name="29" class="checklistBTN" value="Hela dygnet">
        </div>

        <div class="checklistContainer" id="task11">
            <h2>Bor med mitt barn på föräldrarrum</h2>
            <input type="button" id="30" name="30" class="checklistBTN" value="Del av dygnet">
            <input type="button" id="31" name="31" class="checklistBTN" value="Hela dygnet">
        </div>

        <div class="checklistContainer" id="task12">
            <h2>Kontrollerar själv sondläge - mamma</h2>
            <input type="button" id="32" name="32" class="checklistBTN" value="Fått information">
            <input type="button" id="33" name="33" class="checklistBTN" value="Tränar med personal">
            <input type="button" id="34" name="34" class="checklistBTN" value="Skrivit på delegering">
        </div>

        <div class="checklistContainer" id="task13">
            <h2>Kontrollerar själv sondläge - pappa</h2>
            <input type="button" id="35" name="35" class="checklistBTN" value="Fått information">
            <input type="button" id="36" name="36" class="checklistBTN" value="Tränar med personal">
            <input type="button" id="37" name="37" class="checklistBTN" value="Skrivit på delegering">
        </div>

        <div class="checklistContainer" id="task14">
            <h2>Amning</h2>
            <input type="button" id="38" name="38" class="checklistBTN" value="Hud mot hud">
            <input type="button" id="39" name="39" class="checklistBTN" value="Ligger vid bröstet">
            <input type="button" id="40" name="40" class="checklistBTN" value="Tar tag men suger ej">
            <input type="button" id="41" name="41" class="checklistBTN" value="Suger och sväljer">
            <input type="button" id="42" name="42" class="checklistBTN" value="Drar från sondmängd">
            <input type="button" id="43" name="43" class="checklistBTN" value="Ammar fritt">
            <input type="button" id="44" name="44" class="checklistBTN" value="Inte aktuellt">
        </div>

        <div class="checklistContainer" id="task15">
            <h2>Flaskmatning</h2>
            <input type="button" id="45" name="45" class="checklistBTN" value="Hud mot hud">
            <input type="button" id="46" name="46" class="checklistBTN" value="Suger på tröstnapp under måltid">
            <input type="button" id="47" name="47" class="checklistBTN" value="Äter små mängder själv">
            <input type="button" id="48" name="48" class="checklistBTN" value="Äter några fulla mål själv">
            <input type="button" id="49" name="49" class="checklistBTN" value="Drar från sondmängd">
            <input type="button" id="50" name="50" class="checklistBTN" value="Äter all mat själv">
            <input type="button" id="51" name="51" class="checklistBTN" value="Inte aktuellt">
        </div>

        <div class="checklistContainer" id="task16">
            <h2>Tejpat om sond</h2>
            <input type="button" id="52" name="52" class="checklistBTN" value="Blivit visad">
            <input type="button" id="53" name="53" class="checklistBTN" value="Gjort med personal">
            <input type="button" id="54" name="54" class="checklistBTN" value="Gör själva">
        </div>


        <div class="checklistContainer" id="task17">
            <h2>Lärt mig sätta sond (Frivilligt)</h2>
            <input type="button" id="55" name="55" class="checklistBTN" value="Informerad om">
            <input type="button" id="56" name="56" class="checklistBTN" value="Gjort med personal">
            <input type="button" id="57" name="57" class="checklistBTN" value="Gjort själv och fått delegering">
        </div>

        <div class="checklistContainer" id="task18">
            <h2>Information om neonatal hemsjukvård</h2>
            <input type="button" id="58" name="58" class="checklistBTN" value="Informerad om">
        </div>

        <div class="checklistContainer" id="task19">
            <h2>Hantering av bröstmjölk/</h2>
            <h2>mjölkersättning</h2>
            <input type="button" id="59" name="59" class="checklistBTN" value="Läst i broschyr">
            <input type="button" id="60" name="60" class="checklistBTN" value="Muntlig information från personal">
        </div>

        <div class="checklistContainer" id="task20">
            <h2>Infektionskänslighet</h2>
            <input type="button" id="61" name="61" class="checklistBTN" value="Läst i broschyr">
            <input type="button" id="62" name="62" class="checklistBTN" value="Muntlig information från personal">
        </div>


        <div class="checklistContainer" id="task21">
            <h2>Barnets måltider</h2>
            <input type="button" id="63" name="63" class="checklistBTN" value="Läst i broschyr">
            <input type="button" id="64" name="64" class="checklistBTN" value="Muntlig information från personal">
        </div>

        <div class="checklistContainer" id="task22">
            <h2>Barnets normala temperatur</h2>
            <input type="button" id="65" name="65" class="checklistBTN" value="Läst i broschyr">
            <input type="button" id="66" name="66" class="checklistBTN" value="Muntlig information från personal">
        </div>

        <div class="checklistContainer" id="task23">
            <h2>Sovställning</h2>
            <input type="button" id="67" name="67" class="checklistBTN" value="Läst i broschyr">
            <input type="button" id="68" name="68" class="checklistBTN" value="Muntlig information från personal">
        </div>

        <div class="checklistContainer" id="task24">
            <h2>BVC under hemsjukvårdstiden</h2>
            <input type="button" id="69" name="69" class="checklistBTN" value="Läst i broschyr">
            <input type="button" id="70" name="70" class="checklistBTN" value="Muntlig information från personal">
        </div>

        <div class="checklistContainer" id="task25">
            <h2>Andningsproblem</h2>
            <h2>(HLR info)</h2>
            <input type="button" id="71" name="71" class="checklistBTN" value="Fått information om att gå utbildning">
            <input type="button" id="72" name="72" class="checklistBTN" value="Genomfört utbildning">
        </div>

        <div class="checklistContainer" id="task26">
            <h2>Reseersättning</h2>
            <input type="button" id="73" name="73" class="checklistBTN" value="Läst i broschyr">
            <input type="button" id="74" name="74" class="checklistBTN" value="Muntlig information från personal">
        </div>

        <div class="checklistContainer" id="task27">
            <h2>D-vitamin / Multivitamin</h2>
            <input type="button" id="75" name="75" class="checklistBTN" value="Informerad om">
            <input type="button" id="76" name="76" class="checklistBTN" value="Sköter själva">
        </div>

        <div class="checklistContainer" id="task28">
            <h2>Apnélarm (Gäller barn mellan v.34-35 vid hemgång)</h2>
            <input type="button" id="77" name="77" class="checklistBTN" value="Informerad om">
            <input type="button" id="78" name="78" class="checklistBTN" value="Inte aktuellt">
        </div>

        <div class="checklistContainer" id="task29">
            <h2>Järnmedicin (Gäller vissa barn)</h2>
            <input type="button" id="79" name="79" class="checklistBTN" value="Informerad om">
            <input type="button" id="80" name="80" class="checklistBTN" value="Hämtat ut på apotek">
            <input type="button" id="81" name="81" class="checklistBTN" value="Inte aktuellt">
        </div>

        <div class="checklistContainer" id="task30">
            <h2>Lånat bröstpump inför HSV</h2>
            <input type="button" id="82" name="82" class="checklistBTN" value="Informerad om">
            <input type="button" id="83" name="83" class="checklistBTN" value="Inte aktuellt">
        </div>

        <div class="checklistContainer" id="task31">
            <h2>Bilbarnstol</h2>
            <input type="button" id="84" name="84" class="checklistBTN" value="Informerad om">
            <input type="button" id="85" name="85" class="checklistBTN" value="Inte aktuellt">
        </div>


        <div class="checklistContainer" id="task32">
            <h2>Tid för första återbesöket</h2>
            <input type="button" id="86" name="86" class="checklistBTN" value="Klart">
        </div>
		</div>
		</div>
    </div>
	



<footer class="footer">
    <?php include 'footer.php'; ?>
</footer>


</body>
</html>
