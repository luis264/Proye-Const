<!DOCTYPE html>
<html>
<head>
	<title>sesion</title>
</head>
<body>
<?php
session_start();
if (isset($_SESSION['u_usuario'])) {
	echo"Sesion exitosa";
	echo "<a href='cerrar_sesion.php'>cerrar sesion</a>";
}
else{
	header("location:index.php");
}
?>
</body>
</html>