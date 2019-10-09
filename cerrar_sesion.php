<?php

session_start();

error_reporting(0);
$varsesion = $_SESSION['u_usuario'];
if ($varsesion == null ││ $varsesion ='') {
echo 'usted no tiene autorizacion';
die(); 
} 
session_destroy();

header("location: index.php");
?>