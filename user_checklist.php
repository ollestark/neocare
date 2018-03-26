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
<html lang="sv">
<head>
    <title>NeoCare</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#094E79"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="icon" href="vgr.png" type="image/gif" sizes="16x16">

    <script>
        $(document).ready(function () {
            var test = "true";
            //alert (test);
            $.ajax({
                type: "POST",
                url: "UserChecklistButtonColor.php",
                data: {test: test},
                success: function (data) {
                    //alert(data);
                    data = $.parseJSON(data);
                    $.each(data, function (i, item) {
                        var btnID = item;
                        $('#' + btnID).css("background-color", "#7fff00");
                    });
                }
            });

        });

        $(document).ready(function () {
            $(".checklistBTN").click(function () {
                var id = $(this).attr('id');
                var taskNumber = $(this).closest(".checklistContainer").attr("id").replace('task', '');
                var taskVariable = $(this).closest(".checklistContainer").attr("id");
                var buttonCount = $('#'+taskVariable).find('input').length;
                //alert(buttonCount);

                $.ajax({
                    type: 'POST',
                    url: 'DatabaseInsert.php',
                    data: {id: id, taskNumber: taskNumber, buttonCount:buttonCount},
                    success: function (data) {
                        //alert(data);
                        var btnId = $.parseJSON(data);
                        if (data != 0) {
                            $('#' + btnId).css("background-color", "#7fff00");
                        }
                        else {
                            $('#' + id).css("background-color", "#E1E1E1");
                        }
                    }

                });
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
            <a class="navbar-brand" href="#"></a> <!--Min checklista</a>-->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="user_login.php">Mitt frågeformulär</a></li>
                <li class="active"><a href="#">Min checklista</a></li>
                <li><a href="user_growthchart.php">Min tillväxtkurva</a></li>
                <li><a href="info.php">Information</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" data-toggle="modal" data-target="#modalRegister"><span
                            class="glyphicon glyphicon-user"></span> Inloggad som: <?php echo $_SESSION['user'] ?>
                    </a></li>
                <li><a href="#" data-toggle="modal" data-target="#modalLogin"><span
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
                        Du kommer nu bli loggas ut, men glöm inte komma tillbaka imorgon!
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


<footer class="footer">
    <?php include 'footer.php'; ?>
</footer>

</body>
</html>
