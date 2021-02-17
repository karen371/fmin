<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li><a class="dropdown-item" href="#"><span class="icon-house"></span><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'] ?></a></li>
        <li><a class="dropdown-item" href="Inicio.php"><span class="icon-suitcase"></span>Inicio</a></li>
        <li><a class="dropdown-item" href="../logica/cerrarsesion.php"><span class="icon-mail"></span>Cerrar Sesión</a></li>
      </ul>
    </div>
  </div>
</nav>

<!--
<div class="menu_bar">
      <a href="#" class="bt-menu"><span class="icon-list2"></span>Menú</a>
   </div>
   <nav>
      <ul>
        <li><a href="#"><span class="icon-house"></span><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'] ?></a></li>
        <li><a href="Inicio.php"><span class="icon-suitcase"></span>Inicio</a></li>
        <li><a href="RegistrarGuia.php"><span class="icon-earth"></span>Registrar Guia</a></li>
        <li><a href="../logica/cerrarsesion.php"><span class="icon-mail"></span>Cerrar Sesión</a></li>
        <li class="submenu">
          <div class="box">
            <div class="container-1">
              <form class="" action="Busqueda.php" method="GET">
                <span class="icon"><i class="fa fa-search"></i></span>
                <input type="search" name="Search" id="Search" placeholder="Search..." />
              </form>
            </div>
          </div>
        </li>
      </ul>
   </nav>-->
</header>
