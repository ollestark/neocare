<?php 
	session_start();
$db = mysqli_connect("localhost", "neonatalvard", "Mgc31cn9", "neonatalvard");
if (isset($_POST[´register_btn´])) {
	session_start();
	$usrname = mysql_real_escape_string($_POST['usrname']);
	$pwd = mysql_real_escape_string($_POST['pwd']);
	$pwd2 = mysql_real_escape_string($_POST['pwd2']);
	
	if ($pwd == $pwd2) {
		//create user
		$pwd = md5($password); //hash password before storing for security purposes
		$sql = "INSERT INTO User(Username, Password, Role) VALUES('$usrname', '$pwd', 1)";
		mysqli_query($db, $sql);
		$_SESSION['message'] = "User successfully inserted";
		$_SESSION['usrname'] = $usrname;
		header ("location: admin_login.php");
	}
	else {
		//failed
		$_SESSION['message'] = "The two passwords do not match";
	}
}

?>