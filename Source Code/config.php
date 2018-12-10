<?php
session_start();
$Srv_Host = "localhost";

// Database Settings
$Srv_Database = "databse";
$Srv_Username = "username";
$Srv_Password = "password";

$link = mysqli_connect($Srv_Host,$Srv_Username,$Srv_Password,$Srv_Database) or die(mysql_error());
mysqli_query($link, 'SET NAMES utf8');
?>