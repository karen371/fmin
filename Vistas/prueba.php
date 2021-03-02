<?php
session_start();
require_once('../Datos/Connection.php');
require_once('../Modelo/descripcion.php');
$guiaSali  = new descripcion_model();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
	 <link rel="stylesheet" href="../css/StyleDetalle.css" type="text/css">
	 <link rel="stylesheet" href="../css/Stylemenu.css" type="text/css">
	 <!-- Compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<!-- Minified JS library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/j"></script>
		<title></title>
	</head>
	<body>
		<!--IMAGENES-->
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="../imagenes/71img2.jpg" alt="">
            <div class="carousel-caption">
                <h3>First Slide</h3>
                <p>This is the first image slide</p>
            </div>
        </div>

        <div class="item">
            <img src="../imagenes/img2.jpg" alt="">
            <div class="carousel-caption">
                <h3>Second Slide</h3>
                <p>This is the second image slide</p>
            </div>
        </div>

        <div class="item">
            <img src="../imagenes/img1.jpg" alt="">
            <div class="carousel-caption">
                <h3>Third Slide</h3>
                <p>This is the third image slide</p>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
	<script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	// Call carousel manually
	$('#myCarousel').carousel();

	// Go to the previous item
	$("#prevBtn").click(function(){
	    $("#myCarousel").carousel("prev");
	});
	// Go to the previous item
	$("#nextBtn").click(function(){
	    $("#myCarousel").carousel("next");
	});
	</script>
	</body>
</html>
