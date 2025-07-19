<?php    
session_start();
$_SESSION=array(); //impia el array de session
session_destroy();  //destruye 

header('Location: login.php');
exit;

?>