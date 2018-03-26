<?php
session_start();
session_destroy();
header('Location: http://webbkurs.ei.hv.se/~neonatalvard/'); 
//Loggar ut användaren och terminerar session
?>