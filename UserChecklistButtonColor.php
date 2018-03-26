<?php

session_start();

if(isset($_POST['test']))
{
    
    //inkulderar databasinloggning
    include 'dbConfig.php';
    
    //sätter värdet på en variabel till userIDt för den inloggade användaren
    $sqlUserID = $_SESSION['userID'];
    $arrayForValuesToChangeColor = array();


    
    //sql-sats som hämtar alla knapptryckingar för den inloggade användaren    
    $sqlCheckUserProgress = mysqli_query($conn, "Select * From Progress Where `User_ID`='".$sqlUserID."'");
    
    //lägger till de värden som inte är noll för användaren i en array
    while ($rowProgress = $sqlCheckUserProgress->fetch_assoc()) {
        
        for ($i=1;$i<=7; $i++)
        {
            $valueOfColumn = $rowProgress[$i];
            if ($valueOfColumn != 0){
                $arrayForValuesToChangeColor[] = $valueOfColumn;
            }
        }
         
     }
        //skickar tillbaka arrayen med värdena till user_checklist.php
        echo json_encode($arrayForValuesToChangeColor);
     }

?> 
