<?php

session_start();

if(isset($_POST['SelectedPatient']))
{
    
    include 'dbConfig.php';
    
    
    //skapar en variabel med användarnamnet för den valda användaren
    $selectedPatient = $_POST['SelectedPatient'];
    
    //hämtar UserId:t för den valda användaren med hjälp av användarnamnet
    $sqlCheckUserID = mysqli_query($conn, "Select User_ID From User Where `Username`='".$selectedPatient."'");
    $sqlGetUserID = $sqlCheckUserID->fetch_assoc();
    
    //hämtar värdet i kolumnen "User_ID" för den valda användaren
    $sqlUserID = $sqlGetUserID['User_ID'];
    
    //skapar en session-varibel med ID:t för den valda användaren
	$_SESSION['valdPatient'] = $sqlGetUserID['User_ID'];
    
    //array för checklistvärden för den valda användaren
    $arrayCategoriesAndSeries = array();
    
    //hämtar alla värden i checklistan    
    $result = mysqli_query($conn, "select * from FormData where UserID =".$sqlUserID);
   
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayCategoriesAndSeries[] = $row["Date"].",".$row["1"].",".$row["2"].",".$row["3"].",".$row["4"].",".$row["5"].",".$row["6"].",".$row["7"].",".$row["8"].",".$row["9"];
    }

    echo json_encode($arrayCategoriesAndSeries);
}
?> 
