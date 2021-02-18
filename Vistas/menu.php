<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li>
        <a class="nav-item text-white"  aria-current="page" href="#">
          <span class="icon-house"></span><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'] ?>
        </a>
      </li>
      <li>
        <a class="nav-item text-white " aria-current="page"  href="Inicio.php">
          <span class="icon-suitcase"></span>Inicio
        </a>
      </li>
      <li>
        <a class="nav-item text-white " aria-current="page" href="RegistrarGuia.php">
          <span class="icon-earth"></span>Registrar Guia
        </a>
      </li>
      <li>
        <a class="van-item text-white " aria-current="page" href="../logica/cerrarsesion.php">
          <span class="icon-mail"></span>Cerrar Sesión
        </a>
      </li>
    </ul>
    <form class="d-flex" action="Busqueda.php" method="GET">
      <span class="input-group-text fa fa-search bg-danger border-danger" id="basic-addon1"></span>
      <input class="form-control me-2"  type="text" name="Search" id="Search" aria-label="Search" placeholder="Search..." />
      <input type="submit" name="button" class="btn btn-outline-light" value="Search"/>
    </form>
    </div>
  </div>
</nav>
</header>
