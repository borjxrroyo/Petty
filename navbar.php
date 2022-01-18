<nav class="navbar navbar-expand-lg bg-primary">
   <div class="customnav">
      <a class="navbar-brand" href="javascript:;">Petty</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon"></span>
      <span class="navbar-toggler-icon"></span>
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
         <ul class="navbar-nav">
            <li class="nav-item active">
               <a class="nav-link navitem" href="javascript:;"><i class="fas fa-home about"></i>Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link navitem" href="javascript:;"><i class="fas fa-paw about"></i>Adopciones</a>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link navitem dropdown-toggle" href="javascript:;" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-chart-bar about"></i>
               Animales
               </a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="javascript:;"><i class="fas fa-compass-slash about"></i>Perdidos</a>
                  <a class="dropdown-item" href="javascript:;"><i class="fas fa-search about"></i>Encontrados</a>
               </div>
            </li>
            <li class="nav-item navitem">
               <a class="nav-link" href="javascript:;"><i class="fas fa-box-heart about"></i>Dona</a>
            </li>
            <div class="pfsettings">
               <li class="nav-item dropdown">
                  <a class="nav-link navitem dropdown-toggle" href="javascript:;" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-user about"></i>
                  <?php
                        echo $nombre . " " . $apellidos;
                  ?>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                     <a class="dropdown-item" href="javascript:;"><i class="fas fa-compass-slash about"></i>Mi perfil</a>
                     <a class="dropdown-item" href="javascript:;"><i class="fas fa-search about"></i>Encontrados</a>
                  </div>
               </li>
            </div>
      </div>
      </ul>
   </div>
   </div>
</nav>