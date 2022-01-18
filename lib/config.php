<?php
$host = "localhost";
$dbuser = "usertrap";
$dbpwd = "HyundaiSonata2001#";
$db = "petty";

$connect = mysqli_connect ($host, $dbuser, $dbpwd, $db);
	if(!$connect)
		echo ("No se ha podido establecer la conexión con la base de datos.");
	else
		$basedatos = mysqli_select_db ($connect, $db);
?>