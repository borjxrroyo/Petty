<!doctype html>
<html lang="en">
   <head>
      <title>Borja Arroyo Manresa | Petty</title>
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
      <div style="width: 40%; height: fit-content; margin: auto; margin-top: 140px;">
         <div class="card card-nav-tabs text-center" style="padding: 20px;">
            <div class="card-header card-header-success">
               Registrarse
            </div>
            <div class="card-body" style="padding-left: 40px; padding-right: 40px;">
               <form action="registrarse.php" method="post">
                  <div class="form-group">
                     <label for="exampleInputEmail1"><i class="fas fa-user icon"></i>Nombre</label>
                     <input type="text" class="form-control" id="exampleFormControlInput1" name="firstname">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1"><i class="far fa-user icon"></i>Apellidos</label>
                     <input type="text" class="form-control" id="exampleFormControlInput1" name="lastname">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1"><i class="fas fa-envelope icon"></i>Correo electrónico</label>
                     <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                     <small id="emailHelp" class="form-text text-muted">Nunca compartiremos tu información personal con nadie.</small>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1"><i class="fas fa-phone-alt icon"></i>Teléfono</label>
                     <input type="text" class="form-control" id="exampleFormControlInput1" name="phone">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1"><i class="fas fa-align-justify icon"></i>Estado personal</label>
                     <input type="text" class="form-control" id="exampleFormControlInput1" name="info">
                     <small class="form-text text-muted">Escribe aquí el texto que aparecerá en tu perfil.</small>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputPassword1"><i class="fas fa-user-secret icon"></i>Contraseña</label>
                     <input type="password" class="form-control" id="exampleInputPassword1" name="pass1">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputPassword1"><i class="fas fa-user-check icon"></i>Confirmación de contraseña</label>
                     <input type="password" class="form-control" id="exampleInputPassword1" name="pass2">
                  </div>
                  <button type="submit" class="btn btn-success"><i class="fas fa-sign-out-alt icon regicon"></i>Registrarse</button>
               </form>
            </div>
         </div>
      </div>

      <?php # Script 9.5 - register.php #2
         // This script performs an INSERT query to add a record to the users table.
         
         // Check for form submission:
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         
         	require('./mysqli_connect.php'); // Connect to the db.
         
         	$errors = []; // Initialize an error array.
         
         	// Check for a first name:
         	if (empty($_POST['firstname'])) {
         		$errors[] = 'Debes especificar tu nombre.';
         	} else {
         		$fn = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
         	}
         
         	if (empty($_POST['lastname'])) {
         		$errors[] = 'Debes especificar tus apellidos.';
         	} else {
         		$ln = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
         	}
         
         	if (empty($_POST['email'])) {
         		$errors[] = 'Debes especificar tu correo.';
         	} else {
         		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
         	}
         
         	if (empty($_POST['phone'])) {
         		$errors[] = 'Debes especificar tu teléfono.';
         	} else {
         		$ph = mysqli_real_escape_string($dbc, trim($_POST['phone']));
         	}
         
         	if (empty($_POST['info'])) {
         		$i = "Sin información personal";
         	} else {
         		$i = mysqli_real_escape_string($dbc, trim($_POST['info']));
         	}
         
         	// Check for a password and match against the confirmed password:
         	if (!empty($_POST['pass1'])) {
         		if ($_POST['pass1'] != $_POST['pass2']) {
         			$errors[] = 'Las contraseñas no coinciden.';
         		} else {
         			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
         		}
         	} else {
         		$errors[] = 'Debes especificar tu contraseña.';
         	}
         
         	if (empty($errors)) { // If everything's OK.
         
         		// Register the user in the database...
         
         		// Make the query:
         		$q = "INSERT INTO users (firstname, lastname, email, phone, info, pass, registered) VALUES ('$fn', '$ln', '$e', '$ph', '$i', SHA2('$p', 256), NOW() )";
         		$r = @mysqli_query($dbc, $q); // Run the query.
         		if ($r) { // If it ran OK.
         
         			// Print a message:
         			echo '<h1>Thank you!</h1>
         		<p>You are now registered. In Chapter 12 you will actually be able to log in!</p><p><br></p>';
         
         		} else { // If it did not run OK.
         
         			// Public message:
         			echo '<h1>System Error</h1>
         			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
         
         			// Debugging message:
         			echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';
         
         		} // End of if ($r) IF.
         
         		mysqli_close($dbc); // Close the database connection.
         		exit();
         
         	} else { // Report the errors.
         
         		echo '<h1>Error!</h1>
         		<p class="error">The following error(s) occurred:<br>';
         		foreach ($errors as $msg) { // Print each error.
         			echo " - $msg<br>\n";
         		}
         		echo '</p><p>Please try again.</p><p><br></p>';
         
         	} // End of if (empty($errors)) IF.
         
         	mysqli_close($dbc); // Close the database connection.
         
         } // End of the main Submit conditional.
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