<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

if (isset($_SESSION['inloggad']) && $_SESSION['role'] == 1) {
    header('Location: user_login.php');
} else if (!isset($_SESSION['inloggad'])) {
    header('Location: index.php');
    //Här startas session om man är inloggad, och om man inte är inloggad hamnar man på index.php
}

if (isset($_SESSION['valdPatient'])) {
    unset($_SESSION['valdPatient']);
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
    <link rel="icon" href="vgr.png" type="image/gif" sizes="16x16">
    
</head>
<body>

<?php
//inkluderar databasinloggning till sidan    
include 'dbConfig.php';
include 'myHeader.php';
?>

    <!-- Menyraden -->
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
                <li class="active"><a href="admin_login.php">Lägg till patient</a></li>
                <li><a href="admin_patients.php">Mina patienter</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Inloggad
                        som: <?php /*srkiver ut användarnamnet*/ echo $_SESSION['user'] ?></a></li>
                <li><a href="" data-toggle="modal" data-target="#modalLogin"><span
                            class="glyphicon glyphicon-log-in"></span> Logga ut</a></li>


            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <!-- Funktion för att logga ut fårn sidan -->
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>


                </div>
            </div>
        </div>
    </div>


    
    <div class="jumbotron">
        <h1>Välkommen tillbaka <?php /*srkiver ut användarnamnet*/ echo $_SESSION['user'] ?>!</h1>

        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <h2>Här kan du lägga till en ny patient!</h2>
                <!-- Formulär för att lägga till en ny användare -->
                <form method="POST" action="admin_login.php">
                    <div class="form-group">
                        <label for="usrname">Användarnamn:</label>
                        <input type="text" name="usr" class="form-control textInput" id="usrname">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Lösenord:</label>
                        <input type="password" name="pwd" class="form-control textInput" id="pwd">
                    </div>
                    


                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                </form>
				<br>

                <?php
                if (isset($_POST["submit"])) {
                    $usr = $_POST['usr'];
                    $pwd = $_POST['pwd'];
                    $phn = $_POST['phn'];
                    $mail = $_POST['mail'];


                    $query = ("SELECT * FROM User WHERE Username='" . $usr . "'");
                    $queryCheck = ($conn->query($query));
                    //Kollar om användarnamnet redan finns i databasen, om inte läggs en ny användare till
                    $numrows = mysqli_num_rows($queryCheck);
                    if ($numrows == 0) {
                        $sql = "INSERT INTO User(Username, Password, Role, Phonenumber, Email) VALUES ('$usr','$pwd','1','$phn','$mail')";

                        $result = $conn->query($sql);

                        if ($result) {
                            //skriver ut om skapandet av kontot lyckades
                            echo '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Konto skapat!</strong></div>';

                        } else {
                            //skriver ut om kontot inte kunde skapas
                            echo "Failure!!!! (PS. Olles fel.. Ring honom för support)";
                        }
                    } else {
                        //Skriver ut om användarnamnet redan fanns
                        echo '<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Användarnamnet finns redan, prova med ett annat.</strong></div>';
                    }
                }


                ?>

            </div>

            <div class="col-md-4">
            </div>
        </div>
    </div>

    <br><br><br><br><br><br>


</div>


<footer class="footer">
    
    <?php
    //inkluderar footern till sidan
    include 'footer.php' 
    ?>
</footer>


</body>
</html>
