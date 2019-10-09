<?php
session_start();

$usuario=$_POST['usuario'];
$clave=$_POST['clave'];

include("api/config.php");

$proceso = $mysqli->query("SELECT * FROM usuario WHERE usuario='$usuario' AND clave='$clave' ");

if ($resultado = mysqli_fetch_array($proceso)) 
	{
	$_SESSION['u_usuario']=$usuario;
	header("location: index.html");
	}
else{
		header("location: index.php");
	}	

?>