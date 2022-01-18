<?php
session_start();
include 'lib/config.php';

ini_set('error_reporting',0);

if(!isset($_SESSION['user']))
{
  header("Location: iniciar.php");
}

$querynombre = mysqli_query($connect, "SELECT * FROM users WHERE user_id = '" . $_SESSION['id'] ."'");
$fila = mysqli_fetch_array($querynombre);
$nombre = $fila['firstname'];
$apellidos = $fila['lastname'];

$query = mysqli_query($connect, "SELECT * FROM users WHERE user_id = '" . $_GET['id'] ."'");
$row = mysqli_fetch_array($query);
?>
<!doctype html>
<html lang="en">
   <head>
      <title><?php echo $row['firstname'] . " " . $row['lastname']?> | Petty</title>
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
      <link href="assets/css/perfil.css" rel="stylesheet" />
   </head>
   <body>
      <?php
         include 'navbar.php';
         echo "\n";
         ?>
      <div class="bginfo">
         <!--<img src="assets/img/faces/avatar.jpg" class="fotoperfil">-->
         <div class="userinfo">
            <img src="assets/img/faces/borja.jpg" class="profilephoto">
            <div class="userdata">
               <p class="username"><?php
               echo $row['firstname'] . " " . $row['lastname'] . " ";
               if ($row['isVerified'] == 1) {
                  echo '<i data-toggle="tooltip" data-placement="right" title="Cuenta verificada" class="fas fa-badge-check verified"></i>';
               }
               ?> </p>
               <span class="badge badge-pill badge-info rank">Admin</span>
               
               <?php
               if ($row['info'] != "") {
                  echo '<p><i class="fas fa-info-circle icon"></i>' . $row['info'] . '</p>';
               } else {
                  echo '<br><br>';
               }

               if ($row['birthday'] != "") {
               echo '<span class="field"><i class="fas fa-birthday-cake icon"></i>' . date("d/m/Y", strtotime($row['birthday']));
               }
               ?>
               <span class="field"><i class="fas fa-phone-alt icon"></i><?php echo $row['phone']; ?></span>
            </div>
         </div>
      </div>
      <hr class="separator">
      <div class="global">
         <div class="side">
            <div class="card card-nav-tabs">
               <div class="card-header card-header-success">
                  <b><i class="fas fa-user-tag about"></i>Sobre mí</b>
               </div>
               <div class="card-body">
                  <blockquote class="blockquote mb-0">
                     <i class="fas fa-sign-in-alt about"></i><b class="about">Se registró:</b><span class="about mdata"><?php echo date("d/m/Y - H:i", strtotime($row['registered'])); ?></span>
                     <hr>
                     <i class="fas fa-envelope about"></i></i><b class="about">Correo:</b><span class="about mdata"><?php echo $row['email'] ?></span>
                     <hr>
                     <?php
                     if ($row['city'] != "") {
                        echo '<i class="fas fa-map-marker-alt about"></i><b class="about">Ciudad:</b><span class="about mdata">' . $row['city'] . '</span>';
                        echo '<hr>';
                     }

                     if ($row['vet'] != "") {
                        echo '<i class="fas fa-stethoscope about"></i><b class="about">Veterinario:</b><span class="about mdata">' . $row['vet'] . '</span>';
                        echo '<hr>';
                     }

                     if ($row['association'] != "") {
                        echo '<i class="fas fa-heart about"></i><b class="about">Asociación:</b><span class="about mdata">' . $row['association'] . '</span>';
                     }
                     ?>
                  </blockquote>
               </div>
            </div>
            <br>
            <div class="card card-nav-tabs">
               <div class="card-header card-header-success">
                  <b><i class="fas fa-camera about"></i>Fotos</b>
               </div>
               <div class="card-body">
                  <blockquote class="blockquote mb-0">
                     <div id="carouselExampleIndicators0" class="carousel slide infocarousel" data-ride="carousel">
                        <ol class="carousel-indicators">
                           <li data-target="#carouselExampleIndicators0" data-slide-to="0" class="active"></li>
                           <li data-target="#carouselExampleIndicators0" data-slide-to="1"></li>
                           <li data-target="#carouselExampleIndicators0" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                           <div class="carousel-item active">
                              <img class="d-block w-100 phprofcarousel" src="assets/img/bg.jpg" alt="First slide">
                           </div>
                           <div class="carousel-item">
                              <img class="d-block w-100 phprofcarousel" src="assets/img/bg3.jpg" alt="Second slide">
                           </div>
                           <div class="carousel-item">
                              <img class="d-block w-100 phprofcarousel" src="assets/img/bg7.jpg" alt="Third slide">
                           </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators0" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators0" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>
                     </div>
                  </blockquote>
               </div>
            </div>
         </div>
         <div class="center">
         <?php
                  ini_set('display_errors', 1);
                  error_reporting(E_ALL);
            $query = "SELECT * FROM posts where post_user_id = " . $_GET['id'];
            $r = @mysqli_query($connect, $query);

            while ($fila = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
               /* print_r($fila); */
            $querycomments = "SELECT * FROM comments WHERE publishedOnPost = " . $fila['post_id'] . " ORDER BY comment_date desc LIMIT 2";
            $s = @mysqli_query($connect, $querycomments);

                echo '<div class="card card-nav-tabs post">';
               echo '<div class="card-body" style="padding: 0;">';
               echo '<div class="card-header-post"></div>';
               echo '<div class="post-content">';
               echo '<h4 class="card-title post-title">'. $fila['post_title'] . '</h4>';
               echo '<p class="card-text post-text">' . $fila['post_txt'];
               echo '</p>';
               echo '<button class="btn btn-success btn-fab btn-fab-mini btn-round">';
               echo '<i class="material-icons">favorite</i>';
               echo '</button>';
               echo '<button class="btn btn-round details">Ver detalles</button>';
               echo '</div>';
               echo '<div class="comments" id="comments-' . $fila['post_id'] . '">';
               echo '<form method="post" action="">';
               echo '<label class="record" id="record-' . $fila['post_id'] . '">';
               echo '<input name="comentario" id="comentario-' . $fila['post_id'] . '" type="text" class="form-control enviarcmt" placeholder="Introduce un comentario..." style="margin-bottom: 20px;">';
               echo '<input type="hidden" name="usuario_id" value="' . $_SESSION['id'] . '" id="usuario_id">';
               echo '<input type="hidden" name="publicacion" value="' . $fila['post_id'] .'" id="publicacion-' . $fila['post_id']  . '">';
               echo '</form>';   
               
               while ($fcoments = mysqli_fetch_array($s, MYSQLI_ASSOC)) {
                  echo '<div class="comment">';
                  echo '<div class="cmphoto">';
                  echo '<img src="assets/img/faces/borja.jpg" class="cmphotorounded">';
                  echo '</div>';
                  echo '<div style="width: 94%;">';
                  echo '<div class="userdate">';
                  echo '<p class="cmdata bold">Nombre de usuario</p>';
                  echo '<p class="cmdata">' . $fcoments['comment_date'] . '</p>';
                  echo '</div>';
                  echo '<div class="txtcomment">';
                  echo '<p class="cmdata">' . $fcoments['comment'] . '</p>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
               }
               echo '</div>';
               echo '</div>';
               echo '</div>';
            }
            ?>
         </div>
      </div>
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

      <script type="text/javascript">
$(document).ready(function() {

    $(".enviarcmt").keypress(function(event) {

      if ( event.which == 13 ) {
         /* alert("holaa"); */
         var getpID =  $(this).attr('id').replace('comentario-','');
         /* alert(getpID); //OK */
        var usuario = $("input#usuario_id").val();
        var comentario = $("input#comentario-"+getpID).val();
        /* alert(usuario); //OK */
        /* alert (comentario); */
        var comentario = $("input#comentario-"+getpID).val();
        var publicacion = getpID;
        /*var avatar = $("input#avatar").val();*/
        /* var nombre = $("input#usuario_nombre").val(); */
        var now = new Date();
        var date_show = now.getDate() + '-' + now.getMonth() + '-' + now.getFullYear() + ' ' + now.getHours() + ':' + + now.getMinutes() + ':' + + now.getSeconds();

        if (comentario == '') {
            alert('Debes añadir un comentario');
            return false;
        }

        var dataString = { usuario_id: usuario, comentario: comentario, publicacion:  publicacion };

         $.ajax({
                type: "POST",
                url: "agregarcomentario.php",
                data: dataString,
                success: function() {
                    $('#comments-'+getpID).append(`
                    <div class="comment">
                           <div class="cmphoto"> <!-- Foto -->
                              <img src="assets/img/faces/borja.jpg" class="cmphotorounded">
                           </div>

                           <div style="width: 94%;">
                              <div class="userdate">
                                 <p class="cmdata bold">${usuario}</p>
                                 <p class="cmdata">${date_show}</p>
                              </div>
                              <div class="txtcomment">
                                 <p class="cmdata">${comentario}</p>
                              </div>
                           </div>
                     </div>
                    `);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   alert("ay no pudedorl");
                   alert(errorThrown);
                }
        });
        return false;
      }
    });

});
</script>
   </body>
</html>