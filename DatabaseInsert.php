

<?php
session_start();

if(isset($_POST['id'])){

//inkluderar databasinloggning
include 'dbConfig.php';

//skapar variabler av de skickade värdena    
$btnID = mysqli_real_escape_string($conn, $_POST['id']);
$TaskID = mysqli_real_escape_string($conn, $_POST['taskNumber']);
$sessionID = mysqli_real_escape_string($conn, $_SESSION['userID']);
$buttonCount = $_POST['buttonCount'];

//hämtar     
$sqlCheckResult = "Select * From Progress Where `Task_ID`='".$TaskID."'And `User_ID`='".$sessionID."'";
$resultCheck = ($conn->query($sqlCheckResult));

//sätter in en ny rad i databasen
$sqlInsert = "Insert into Progress (`User_ID`, `Task_ID`, `1`, `2`, `3`, `4`, `5`, `6`, `7`) Values (".$sessionID."," .$TaskID.",".$btnID.",'0','0','0','0','0','0')";

//om det inte finns en rad för den specifika "tasken" och användaren läggs en ny rad till    
if (mysqli_num_rows($resultCheck) == 0) {
    if ($conn->query($sqlInsert) === TRUE) {
        //skickar tillbaka värdet för knapptrycket om raden skapades
        echo $btnID;
} else {
    echo "Error updating record: " . $conn->error;
}
}
    
else {
    //hämtar de värden som redan finns för raden och lägger dessa i en array om de inte är lika med 0
    $arrayForValuesInTheSpecificTaskRow = array();
    $sqlCheckUserProgress = mysqli_query($conn, "Select * From Progress Where `Task_ID`='".$TaskID."'And `User_ID`='".$sessionID."'");
     
    while ($rowProgress = $sqlCheckUserProgress->fetch_assoc()) {
        
        for ($i=1;$i<=7; $i++)
        {
            $valueOfColumn = $rowProgress[$i];
            if ($valueOfColumn != 0){
                $arrayForValuesInTheSpecificTaskRow[] = $valueOfColumn;
            }
        }
         
     }
    
    for ($i=1; $i<=$buttonCount; $i++)
    {
        $sqlUpdate = "UPDATE Progress SET `". $i ."` = ".$btnID." WHERE User_ID = '".$sessionID. "' And Task_ID='".$TaskID."'";
        $sqlForLoopSelect = "select `".$i."` from Progress where User_ID='".$sessionID."' AND Task_ID='".$TaskID."'";
        $sqlUpdateIfSameValue = "UPDATE Progress SET `". $i ."` = '0' WHERE User_ID = '".$sessionID. "' And Task_ID='".$TaskID."'";
        $result = mysqli_query($conn, $sqlForLoopSelect) or die("Failed to query database " . mysql_error());
        $row = $result->fetch_assoc();
        
        //om värdet för kolumnen "$i" och värdet för knappen inte redan finns i raden läggs detta värde till
        if ($row["$i"] == 0 && !in_array($btnID, $arrayForValuesInTheSpecificTaskRow)) {
            if ($conn->query($sqlUpdate) === TRUE) {
            //om det lyckas skickas värdet för knapptrycket tillbaka och "$i" sätts till maxvärdet för att stoppa for loopen     
            echo $btnID;
            $i=$buttonCount;    
            } 
            else {
                echo "Error updating record: " . $conn->error;
            }
        }
        
        //om värdet redan finns på raden sätts det till 0
        else if ($row["$i"] == $btnID)
        {
            if ($conn->query($sqlUpdateIfSameValue) === TRUE) {
                //skickar tillbaka 0 för att göra knappen grå
            echo 0;
            } 
            else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
   
}

$conn->close();
}



?>

