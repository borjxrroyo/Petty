<?php
require('lib/config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$usuario = mysqli_real_escape_string($connect, $_POST['usuario_id']);
$comentario = mysqli_real_escape_string($connect, $_POST['comentario']);
$publicacion = mysqli_real_escape_string($connect, $_POST['publicacion']); 

$insert = mysqli_query($connect, "INSERT INTO comments (user_id, comment, comment_date, publishedOnPost) VALUES ('$usuario', '$comentario', now(), '$publicacion')");


?>