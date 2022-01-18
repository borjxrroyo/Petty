<?php
   session_start();
   include 'lib/config.php';
   
   ini_set('error_reporting',0);
   
   if(!isset($_SESSION['user']))
   {
     header("Location: iniciar.php");
   }
   
   $query = mysqli_query($connect, "SELECT * FROM users WHERE user_id = '" . $_SESSION['id'] ."'");
   $row = mysqli_fetch_array($query);
   $nombre = $row['firstname'];
   $apellidos = $row['lastname'];

   ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
   ?>
<!doctype html>
<html lang="en">
   <head>
      <title>Inicio | Petty</title>
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
      <link href="assets/css/inicio.css" rel="stylesheet" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   </head>
   <body>

      <?php
         include 'navbar.php';
         echo "\n";
         ?>



      <div class="global">
         <div class="side">
            <div class="card" style="margin-top: 0px;">
               <div class="card-body">
                  <h4 class="card-title">Special title treatment</h4>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="javascript:;" class="btn btn-primary">Go somewhere</a>
               </div>
            </div>
            <div class="card" style="margin-top: 0px;">
               <div class="card-body">
                  <h4 class="card-title">Notificaciones <span class="badge badge-danger">3</span></h4>
                  <hr>
                  <p class="card-text"><i class="fas fa-bell iconnotif"></i> <b>Aitor Menta Fuerte</b> ha publicado en tu perfil.</p>
                  <p class="card-text"><i class="fas fa-bell iconnotif"></i> <b>Aitor Menta Fuerte</b> ha publicado en tu perfil.</p>
                  <p class="card-text"><i class="fas fa-bell iconnotif"></i> <b>Aitor Menta Fuerte</b> ha publicado en tu perfil.</p>
                  <hr>
                  <div style="display: flex;">
                     <button class="btn btn-round btn-info viewnotif"><i class="fas fa-eye view"></i> Ver todas</button>
                  </div>
               </div>
            </div>
         </div>
         <div class="center">
            <div class="logocontainer">
               <div class="form-group">
                  <h3 class="title" style="margin-bottom: 10px; margin-top: -20px;">¡Bienvenido de nuevo, <?php echo $nombre; ?>!</h3>
                  <div style="display: flex;">
                     <form action="index.php" method="post" style="display: flex;">
                        <textarea class="form-control txtpost" id="exampleFormControlTextarea1" rows="2" placeholder="¿Qué hay de nuevo por aquí?" name="txtpost"></textarea>
                        <button class="btn btn-round publish" name="publish"><i class="fab fa-telegram-plane"></i></button>
                     </form>
                  </div>
               </div>
            </div>
            <div class="options">
               <button class="btn btn-danger button1" data-toggle="modal" data-target="#exampleModalLong">
               <i class="fas fa-map-marker-alt iconbutton" style="display: block;"></i>
               Mi mascota se ha perdido</button>
               <button class="btn btn-success button2" data-toggle="modal" data-target="#exampleModalLong2">
               <i class="fas fa-eye iconbutton" style="display: block;"></i>
               He visto un animal</button>
               <button class="btn btn-info button3">
               <i class="fas fa-lightbulb-on iconbutton" style="display: block;"></i>
               Puedo aportar información</button>
            </div>

            <div class="posts">
            <?php
            $queryposts = "SELECT * FROM posts";
            $r = @mysqli_query($connect, $queryposts);

            while ($fila = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            $querycomments = "SELECT * FROM comments WHERE publishedOnPost = " . $fila['post_id'] . " ORDER BY comment_date desc LIMIT 2";
            $s = @mysqli_query($connect, $querycomments);
            echo '<div class="card card-nav-tabs post">';
            echo '<div class="card-body" style="padding: 0;">';
            echo '<div class="card-header-post"></div>';
            echo '<div class="post-content">';
            echo '<h4 class="card-title post-title">' . $fila['post_title'] . '</h4>';
            echo '<p class="card-text post-text">' . $fila['post_txt'] . '</p>';
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
            
            echo '</div>';
?>
         </div>
         <div class="side">
            <div class="card" style="margin-top: 0px;">
               <div class="card-body">
                  <h4 class="card-title">Últimos registrados</h4>
                  <hr>
                  <div class="latestregs">
                     <?php
                        $query = "SELECT * FROM users ORDER BY registered DESC LIMIT 10";
                        $r = @mysqli_query($connect, $query);
                        
                        while ($fila = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                        /* print_r($fila); */
                        echo '<div class="latestuser">';
                        echo '<img src="assets/img/faces/borja.jpg" class="latestuserphoto">';
                        echo '<p class="latestusername bold">' . $fila['firstname'] . '</p>';
                        echo '<p class="latestuserlog">' . date("d/m/Y", strtotime($fila['registered'])) . '</p>';
                        echo '<p class="latestuserlog">' . date("H:i", strtotime($fila['registered'])) .'</p>';
                        echo '</div>';
                        }
                        ?>
                  </div>
               </div>
            </div>
            <div class="card" style="margin-top: 0px;">
               <div class="card-body">
                  <h4 class="card-title">Publicidad</h4>
                  <hr>
                  <img src="assets/img/canis.png" style="width: 100%; height: 50px; margin-bottom: 25px;">
                  <img src="assets/img/cambiando.jpg" style="width: 100%; height: 150px;">
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-map-signs icons"></i>Notificar mascota perdida</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <hr>
      <div class="modal-body">
      <form method="post">
         <div class="form-group">
            <label for="exampleFormControlSelect2"><i class="fas fa-paw icons"></i>¿De qué animal se trata?</label>
            <select multiple class="form-control selectpicker" data-style="btn btn-link" id="razas" name="tipoanimal">
               <option>Perro</option>
               <option>Gato</option>
               <option>Pájaro</option>
               <option>Conejo</option>
               <option>Hámster</option>
               <option>Cobaya</option>
               <option>Ratón</option>
               <option>Otro</option>
            </select>
            <button type="submit" class="btn btn-danger" name="buscarazas"><i class="fab fa-telegram-plane icons"></i>Buscar razas</button>
         </div>
      </form>
      <?php
         if (isset($_POST['buscarazas'])) {
         /*                   ini_set('display_errors', 1);
            error_reporting(E_ALL); */
            $seleccionado = $_POST['tipoanimal'];
         
            $comboboxheader = '<div class="form-group" id="divRaza">
            <label for="exampleFormControlSelect2"><i class="fas fa-dog icons"></i>¿De qué raza es?</label>
            <select multiple class="form-control selectpicker" data-style="btn btn-link">';
         
            $comboboxfooter = '</select></div>';
         
            switch($seleccionado){
               case 'Perro':
                  echo $comboboxheader;
         
                  $query = "SELECT * FROM breeds_dog";
                  $r = @mysqli_query($connect, $query);
                  while ($fila = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                     echo '<option>'. $fila['breed_name'] . '</option>';
                  }
         
               echo $comboboxfooter;
               break;
         
               case 'Gato':
                  echo $comboboxheader;
         
                  $query = "SELECT * FROM breeds_cat";
                  $r = @mysqli_query($connect, $query);
                  while ($fila = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                     echo '<option>'. $fila['breed_name'] . '</option>';
                  }
                  
                  echo $comboboxfooter;
                  break;
         
               case 'Pájaro':
                  echo $comboboxheader;
         
                  $query = "SELECT * FROM breeds_bird";
                  $r = @mysqli_query($connect, $query);
                  while ($fila = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                     echo '<option>'. $fila['breed_name'] . '</option>';
                  }
                     
                  echo $comboboxfooter;
                  break;
         
               case 'Conejo':
                  echo $comboboxheader;
         
                  $query = "SELECT * FROM breeds_rabbit";
                  $r = @mysqli_query($connect, $query);
                  while ($fila = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                     echo '<option>'. $fila['breed_name'] . '</option>';
                  }
                        
                  echo $comboboxfooter;
                  break;
         
               case 'Hámster':
                  echo $comboboxheader;
         
                  $query = "SELECT * FROM breeds_hamster";
                  $r = @mysqli_query($connect, $query);
                  while ($fila = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                     echo '<option>'. $fila['breed_name'] . '</option>';
                  }
                           
                  echo $comboboxfooter;
                  break;
         
               case 'Cobaya':
                  echo $comboboxheader;
         
                  $query = "SELECT * FROM breeds_guineadog";
                  $r = @mysqli_query($connect, $query);
                  while ($fila = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                     echo '<option>'. $fila['breed_name'] . '</option>';
                  }
                              
                  echo $comboboxfooter;
                  break;
         
               case 'Ratón':
                  echo $comboboxheader;
            
                  $query = "SELECT * FROM breeds_mouse";
                  $r = @mysqli_query($connect, $query);
                  while ($fila = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                     echo '<option>'. $fila['breed_name'] . '</option>';
                  }
         
                  echo $comboboxfooter;
                  break;
         
               case 'Otro':
                  echo '<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Introduce la raza del animal">';
            }
         }
         ?>
      <div class="form-group">
         <label for="exampleFormControlSelect2"><i class="fas fa-venus-mars icons"></i>¿Es macho o hembra?</label>
         <select multiple class="form-control selectpicker" data-style="btn btn-link" id="exampleFormControlSelect2">
            <option>Macho</option>
            <option>Hembra</option>
            <option>No estoy seguro</option>
         </select>
      </div>
      <div class="form-group">
         <label for="exampleFormControlSelect2"><i class="fas fa-clipboard-list icons"></i>¿Con qué nombre se le conoce?</label>
         <input type="text" class="form-control" id="exampleFormControlInput1">
      </div>
      <div class="form-group">
         <label for="exampleFormControlSelect2"><i class="fas fa-map-pin icons"></i>¿Dónde se perdió?</label>
         <input type="text" class="form-control" id="exampleFormControlInput1">
      </div>
      <div class="form-group">
         <label for="exampleFormControlSelect2"><i class="fas fa-microchip icons"></i>¿El animal dispone de chip?</label>
         <select multiple class="form-control selectpicker" data-style="btn btn-link" id="exampleFormControlSelect2">
            <option>Sí</option>
            <option>No</option>
            <option>No estoy seguro</option>
         </select>
      </div>
      <div class="form-group">
         <label for="exampleFormControlSelect2"><i class="fas fa-medkit icons"></i>¿El animal necesita medicina?</label>
         <select multiple class="form-control selectpicker" data-style="btn btn-link" id="exampleFormControlSelect2">
            <option>Sí</option>
            <option>No</option>
            <option>No estoy seguro</option>
         </select>
      </div>
      <div class="form-group">
         <label class="label-control"><i class="fas fa-calendar-alt icons"></i>¿Cuándo se perdió?</label>
         <input type="text" class="form-control datetimepicker" value="10/05/2016"/>
      </div>
      <div class="form-group">
         <label for="exampleFormControlTextarea1"><i class="fas fa-align-justify icons"></i>Otra información relevante</label>
         <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
      </div>
      <!-- Modal 2 -->
      <div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle2" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle2"><i class="fas fa-map-signs icons"></i>Notificar mascota encontrada</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <hr>
               <div class="modal-body">
                  <div class="form-group">
                     <label for="exampleFormControlSelect2"><i class="fas fa-paw icons"></i>¿De qué animal se trata?</label>
                     <select multiple class="form-control selectpicker" data-style="btn btn-link" id="tipoAnimal">
                        <option>Perro</option>
                        <option>Gato</option>
                        <option>Pájaro</option>
                        <option>Conejo</option>
                        <option>Hámster</option>
                        <option>Ratón</option>
                        <option>Otro</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="exampleFormControlSelect2"><i class="fas fa-dog icons"></i>¿De qué raza es?</label>
                     <select multiple class="form-control selectpicker" data-style="btn btn-link" id="razaPerros" style="display: block;">
                        <option>Perro</option>
                        <option>Gato</option>
                        <option>Pájaro</option>
                        <option>Conejo</option>
                        <option>Hámster</option>
                        <option>Ratón</option>
                        <option>Otro</option>
                     </select>
                     <input type="text" class="form-control" id="razaOtro" placeholder="Escribe la raza del animal" style="display: none;">
                  </div>
                  <div class="form-group">
                     <label for="exampleFormControlSelect2"><i class="fas fa-venus-mars icons"></i>¿Es macho o hembra?</label>
                     <select multiple class="form-control selectpicker" data-style="btn btn-link" id="exampleFormControlSelect2">
                        <option>Macho</option>
                        <option>Hembra</option>
                        <option>No estoy seguro</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="exampleFormControlSelect2"><i class="fas fa-map-pin icons"></i>¿Dónde se ha encontrado?</label>
                     <input type="text" class="form-control" id="exampleFormControlInput1">
                  </div>
                  <div class="form-group">
                     <label for="exampleFormControlSelect2"><i class="fas fa-microchip icons"></i>¿El animal dispone de chip?</label>
                     <select multiple class="form-control selectpicker" data-style="btn btn-link" id="exampleFormControlSelect2">
                        <option>Sí</option>
                        <option>No</option>
                        <option>No estoy seguro</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="exampleFormControlSelect2"><i class="fas fa-medkit icons"></i>¿El animal necesita medicina?</label>
                     <select multiple class="form-control selectpicker" data-style="btn btn-link" id="exampleFormControlSelect2">
                        <option>Sí</option>
                        <option>No</option>
                        <option>No estoy seguro</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label class="label-control"><i class="fas fa-calendar-alt icons"></i>¿Cuándo se ha encontrado?</label>
                     <input type="text" class="form-control datetimepicker" value="10/05/2016"/>
                  </div>
                  <div class="form-group">
                     <label for="exampleFormControlTextarea1"><i class="fas fa-align-justify icons"></i>Otra información relevante</label>
                     <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger"><i class="fab fa-telegram-plane icons"></i>Enviar</button>
               </div>
            </div>
         </div>
      </div>
      <?php
         if (isset($_POST['publish'])) {
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            $texto = $_POST['txtpost'];
            $query = "INSERT INTO posts (post_user_id, post_txt) VALUES (" . $_SESSION['id'] .", '$texto')";
            $r = @mysqli_query($connect, $query);
            header("Refresh:1");
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
      <!-- Borja JS -->
      <!--<script src="assets/js/custom/custom.js" type="text/javascript"></script>-->

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