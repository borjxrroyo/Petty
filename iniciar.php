<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include 'lib/config.php';

if(isset($_SESSION['user']))
{
  header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">
   <head>
      <title>Iniciar sesión | Petty</title>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0, name="viewport" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <!--  Fonts and icons  -->
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
      <link rel="stylesheet" href="fontawesomepro/css/all.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
      <!-- Material Kit CSS -->
      <link href="assets/css/material-kit.css?v=2.0.7" rel="stylesheet" />
      <!-- Borja CSS -->
      <link href="assets/css/loginsup.css" rel="stylesheet" />
   </head>
   <body>
      <?php
         /* include 'navbar.php';
         echo "\n"; */
         ?>
      <div style="width: 40%; height: fit-content; margin: auto; margin-top: 140px;">
         <div class="card card-nav-tabs text-center" style="padding: 20px;">
            <div class="card-header card-header-success">
               Iniciar sesión
            </div>
            <div class="card-body" style="padding-left: 40px; padding-right: 40px;">
               <form action="iniciar.php" method="post">
                  <div class="form-group">
                     <label for="exampleInputEmail1"><i class="fas fa-envelope icon"></i>Correo electrónico</label>
                     <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                     <small id="emailHelp" class="form-text text-muted">Nunca compartiremos tu información personal con nadie.</small>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputPassword1"><i class="fas fa-user-secret icon"></i>Contraseña</label>
                     <input type="password" name="passwd" class="form-control" id="exampleInputPassword1">
                  </div>
                  <button type="submit" name="login" class="btn btn-success"><i class="fas fa-sign-out-alt icon" style="margin-top: 0px; margin-right: 10px;"></i>Iniciar sesión</button>
               </form>
            </div>
         </div>
      </div>

<?php
    if(isset($_POST['login']))
    {
      ini_set('display_errors', 1);
      error_reporting(E_ALL);
      $usuario = mysqli_real_escape_string($connect, $_POST['email']);
      $usuario = strip_tags($_POST['email']);
      $usuario = trim($_POST['email']);

      echo $usuario;

      $contrasena = mysqli_real_escape_string($connect, hash('sha256', $_POST['passwd']));
      $contrasena = strip_tags(hash('sha256', $_POST['passwd'])); // strip_tags - Retira las etiquetas HTML y PHP de un string
      $contrasena = trim(hash('sha256',$_POST['passwd'])); // SHA2 — Calcula el 'hash' SHA2 de un string

      $query = mysqli_query($connect, "SELECT * FROM users WHERE email = '$usuario' AND pass = '$contrasena'");
      $resultados = mysqli_num_rows($query);

      echo 'Contraseña: ' . $contrasena;

      if($resultados == 1) 

      {

        while($row=mysqli_fetch_array($query)) 

        {

          if($usuario = $row['email'] && $contrasena = $row['pass'])

          {

            $_SESSION['user'] = $usuario;
            $_SESSION['id'] = $row['user_id'];

            header('Location: index.php');

          }

        }
        
      } else { echo 'Los datos introducidos no son correctos.'; }


    }
?>

      <!--   Core JS Files   -->
      <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
      <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins/moment.min.js"></script>
      <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
      <script src="assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
      <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
      <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
      <!--  Google Maps Plugin  -->
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
      <!-- Place this tag in your head or just before your close body tag. -->
      <script async defer src="https://buttons.github.io/buttons.js"></script>
      <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
      <script src="assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
   </body>
</html>