<!doctype html>
<html lang="en">
   <head>
      <title>Editar mi perfil | Petty</title>
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
      <link href="assets/css/editar.css" rel="stylesheet" />
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
         <div class="card card-nav-tabs editdialog">
            <div class="card-body" style="padding: 0;">
               <div class="card-header-editdialog"></div>
               <div class="editdialog-content">
                  <h4 class="card-title editdialog-title">Editar parámetros del perfil</h4>
                  <hr>
                  <div style="width: 100%; display: flex; height: fit-content; padding: 20px;">
                     <div style="width: 50%; margin-right: 40px;">
                        <div class="form-group">
                           <label for="exampleFormControlInput1">Correo electrónico</label>
                           <div style="display: flex;"><i class="fas fa-envelope-open-text pfedit"></i><input type="text" class="form-control" id="exampleFormControlInput1" value="borja.am@outlook.com"></div>
                        </div>
                        <div class="form-group">
                           <label for="exampleFormControlInput1">Apellidos</label>
                           <div style="display: flex;"><i class="fas fa-align-justify pfedit"></i><input type="text" class="form-control" id="exampleFormControlInput1" value="Arroyo Manresa"></div>
                        </div>
                     </div>
                     <div style="width: 50%;">
                        <div class="form-group">
                           <label for="exampleFormControlInput1">Nombre</label>
                           <div style="display: flex;"><i class="fas fa-align-justify pfedit"></i><input type="text" class="form-control" id="exampleFormControlInput1" value="Borja"></div>
                        </div>
                        <div class="form-group">
                           <label for="exampleFormControlInput1">Teléfono</label>
                           <div style="display: flex;"><i class="fas fa-phone-alt pfedit"></i><input type="text" class="form-control" id="exampleFormControlInput1" value="661036390"></div>
                        </div>
                     </div>
                  </div>
                  <br>
                  <!-- javascript for init -->
                  <script>
                     $('.datetimepicker').datetimepicker({
                       icons: {
                         time: "fa fa-clock-o",
                         date: "fa fa-calendar",
                         up: "fa fa-chevron-up",
                         down: "fa fa-chevron-down",
                         previous: 'fa fa-chevron-left',
                         next: 'fa fa-chevron-right',
                         today: 'fa fa-screenshot',
                         clear: 'fa fa-trash',
                         close: 'fa fa-remove'
                       }
                     });
                  </script>
                  <div style="width: 100%; display: flex; height: fit-content; padding: 20px;">
                     <div style="width: 50%; margin-right: 40px;">
                        <div class="form-group">
                           <label for="exampleFormControlInput1">Fecha de nacimiento</label>
                           <div class="form-group">
                              <div style="display: flex;"><i class="fas fa-birthday-cake pfedit"></i><input type="text" class="form-control datetimepicker" value="10/05/2016"/></div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
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
   </body>
</html>