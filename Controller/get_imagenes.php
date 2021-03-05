<?php


	require_once('../Datos/Connection.php');

	$db;
	$folio = $_POST['codigo'];
	$db = Conectar::conexion();
	$consulta=$db->query('SELECT * FROM imgot WHERE codfolio ='.$folio);
	$html= '';

	while($filas=$consulta->fetch_assoc()){
		$funcion = "EliminarImg('".$filas['imagen']."','".$filas['codimg']."')";
		$html.= '<li class="list-group-item">
		          <div class="row">
		             <div class="col-3">
		                <img  src="'.$filas['imagen'].'"  alt="" height="100px" width="100px" >
		             </div>
		             <div class="col-6">
		               <p class="text-center">'.$filas['descripcion'].'</p>
		             </div>
		             <div class="col">
		               <button class="btn btn-outline-danger float-left" type="button" name="EliminarI" id="EliminarI" onclick="'.$funcion.'" >Eliminar</button>
		             </div>
		           </div>
		         </li>';
	}
	echo $html;
?>
