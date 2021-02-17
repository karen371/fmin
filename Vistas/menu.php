<header>
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
   </nav>
</header>
