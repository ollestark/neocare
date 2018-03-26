<?php
session_start();
    include 'dbConfig.php';
    
	//Hämta input från index.php filen
	$username = mysqli_real_escape_string($conn, $_POST['user']);
	$password = mysqli_real_escape_string($conn, $_POST['pass']);

	

    $sqlCheckUsers = "Select * From User Where Username = '".$username."' And Password='".$password."'";
    $userResults = mysqli_query($conn, $sqlCheckUsers) or die("Failed to query database " . mysql_error());
    $row = $userResults->fetch_assoc();

	if ($row['Username'] == $username && $row['Password'] == $password && $username != null && $password != null){
		$_SESSION['userID'] = $row['User_ID'];
        $_SESSION['inloggad'] = "JA";
		$_SESSION['user'] = $row['Username'];
        
        if ($row['Role'] == 1){
		//Här skapas en session
        $_SESSION['role'] = 1;
		header('Location: user_login.php');
		//Om inloggningen gick igenom, länkar till sidan som user endast kommer åt
        }
        
        else if ($row['Role'] == 2){
            $_SESSION['role'] = 2;
            header('Location: admin_login.php');    
			//Om inloggningen gick igenom, länkar till sidan som user endast kommer åt
        }
		
	}

	
	else {
		echo "Failed to login";
		header('Location: index.php');
		/*echo '<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>DET VAR FEL!!!!</strong></div>';*/
		//Misslyckas inloggningen, hamnar man på inloggningssidan igen.
	}
	

		
?>




