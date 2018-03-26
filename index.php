
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
    <style>
	
	
        .jumbotron {
            background: url('frontpage.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;

        }


    </style>
</head>
 
<body>
<?php include 'myHeader.php' ?>

<?php
include("dbConfig.php");
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
                <li class="active"><a href="#">Hem</a></li>
                <li><a href="info_visitor.php">Information</a></li>
                <li><a href="kontakt_visitor.php">Kontakt</a></li>

            </ul>

        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav> <!-- navbar end -->


<!-- Main component for a primary marketing message or call to action -->
<div class="jumbotron" style="margin-top: -20px; margin-bottom: -20px;">
    <h1 style="margin-left: 10px;">Välkommen till Neonatalvården!</h1>
    <div class="modal-body col-sm-3">

	<!--	############
			############ 		DÖP OM TILL form action="#" för att testa skiten
								med inloggningsvalidering
																					############
																					############ -->
        <form action="process.php" method="POST">
            <div class="form-group">
                <label for="username">Användarnamn:</label>
                <input type="text" class="form-control" name="user" id="username">
            </div>
            <div class="form-group">
                <label for="pwd">Lösenord:</label>
                <input type="password" class="form-control" name="pass" id="pwd">
            </div>
            
            <button type="submit" name="loginBtn" class="btn btn-success">Logga in</button>
        </form>
		



		
		
		
		
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br>

</div>

<!-- Inkluderar en extern footer -->
<footer class="footer">
    <?php include 'footer.php' ?>
</footer>


</body>
</html>
