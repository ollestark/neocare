

<?php
session_start();

if(isset($_POST['questOne']))


        
$servername = "localhost";
$username = "neonatalvard";
$password = "Mgc31cn9";
$dbname = "neonatalvard";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$date = date("Y-m-d");
$one = $_POST['questOne'];
$two = $_POST['questTwo'];
$three = $_POST['questThree'];
$four = $_POST['questFour'];
$five = $_POST['questFive'];
$six = $_POST['questSix'];
$seven = $_POST['questSeven'];
$eight = $_POST['questEight'];
$nine = $_POST['questNine'];
$sessionID = mysqli_real_escape_string($conn, $_SESSION['userID']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlCheckResult = "Select Date From FormData Where `UserID`='".$sessionID."'";
$resultCheck = mysqli_query($conn, $sqlCheckResult);

$sqlInsert = "Insert into FormData (`UserID`, `Date`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`) Values (".$sessionID.",'".$date."',".$one.",".$two.",".$three.",".$four.",".$five.",".$six.",".$seven.",".$eight.",".$nine.")";

if (true) {
    if (mysqli_query($conn, $sqlInsert) === TRUE) {
    echo "Record updated successfully";
	header('Location: http://webbkurs.ei.hv.se/~neonatalvard/user_login.php');
} else {
    echo "Error updating record: " . $conn->error;
}
}

$conn->close();




?>

