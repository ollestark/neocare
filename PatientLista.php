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
    $arrayForValuesToChangeColor = array();


    
    //hämtar alla värden i checklistan    
    $sqlCheckUserProgress = mysqli_query($conn, "Select * From Progress Where `User_ID`='".$sqlUserID."'");
    
    //finns det värden i databasen för den valda användaren läggs dessa till i en array så länge som värdet i en kolumn inte är 0
    while ($rowProgress = $sqlCheckUserProgress->fetch_assoc()) {
        
        for ($i=1;$i<=7; $i++)
        {
            $valueOfColumn = $rowProgress[$i];
            if ($valueOfColumn != 0){
                $arrayForValuesToChangeColor[] = $valueOfColumn;
            }
        }
         
     }
        //skickar tillbaka arrayen till admin_patients.php
        echo json_encode($arrayForValuesToChangeColor);
     }

?> 
