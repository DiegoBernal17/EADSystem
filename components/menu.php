<header>
  <!-- Dropdown Structure -->
  <ul id="dropdown1" class="dropdown-content">
    <!--<li><a href="#!"><i class="material-icons left">settings</i>Ajustes</a></li>-->
    <li class="divider"></li>
    <li><a href="<?php echo URL?>actions/logout.php"><i class="material-icons left">input</i>Salir</a></li>
  </ul>
  <!-- Dropdown Structure 2 -->
  <ul id="dropdown2" class="dropdown-content">
    <!--<li><a href="#!">Ajustes</a></li>-->
    <li class="divider"></li>
    <li><a href="<?php echo URL?>actions/logout.php"><i class="material-icons left">input</i>Salir</a></li>
  </ul>
  <!-- Navbar -->
  <nav>
    <div class="nav-wrapper blue darken-2">
      <a href="#!" class="brand-logo"></a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="home.php"><i class="material-icons left">home</i>Inicio</a></li>
        <li><a href="specialties.php"><i class="material-icons left">school</i>Especialidades</a></li>
        <li><a href="teachers.php"><i class="material-icons left">face</i>Maestros</a></li>
        <li><a href="subjects.php"><i class="material-icons left">book</i>Materias</a></li>
        <li><a href="users.php"><i class="material-icons left">supervisor_account</i>Usuarios</a></li>
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><?php echo NAME; ?><i class="material-icons right">account_circle</i></a></li>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">    
    <li><a href="home.php"><i class="material-icons left">home</i>Inicio</a></li>
    <li><a href="specialties.php"><i class="material-icons left">school</i>Especialidades</a></li>
    <li><a href="teachers.php"><i class="material-icons left">face</i>Maestros</a></li>
    <li><a href="subjects.php"><i class="material-icons left">book</i>Materias</a></li>
    <li><a href="users.php"><i class="material-icons left">supervisor_account</i>Usuarios</a></li>
    <li><a class="dropdown-trigger2" href="#!" data-target="dropdown2"><?php echo NAME; ?><i class="material-icons right">account_circle</i></a></li>
  </ul>
</header>