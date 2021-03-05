<?php

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="../bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/StyleDetalle.css" type="text/css">
    <link rel="stylesheet" href="../css/Stylemenu.css" type="text/css">  </head>
  <body>

    <div class="jumbotron">
    <div class="row featurette">
      <div class="col-md-6">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                  <?php
                  $qnt_slide = mysqli_num_rows($resultado_carrusel);
                  $cont_marc = 0;
                  while($cont_marc < $qnt_slide){
                      echo "<li id='valor-car' data-target='#myCarousel' data-slide-to='$cont_marc'></li>";
                      $cont_marc++;
                  }
                  ?>
              </ol>
              <div class="carousel-inner">
                  <?php
                  $cont_slide = 0;
                  while( $row_slide = mysqli_fetch_assoc($resultado_carrusel)){
                      $active = "";
                      if($cont_slide == 0){
                          $active = "active";
                      }
                      echo "<div class='carousel-item $active'>";
                      echo "<img class='d-block w-100' src='imagen/".$row_slide['id']."/".$row_slide['imagen']."' alt='".$row_slide['nombre']."'>";
                      echo "</div>";
                      $cont_slide++;
                  }
                  ?>
              </div>
              <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previo</span>
              </a>
              <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Siguiente</span>
              </a>
          </div>


      </div>

      <div class="col-md-6">
          <?php
          $cont_contenido = 0;
          $resultado_carrusel = mysqli_query($conn, $result_carrusel);
          while($row_slide = mysqli_fetch_assoc($resultado_carrusel)){
              if($cont_contenido == 0){
                  $ap_cont = "block";
              }else{
                  $ap_cont = "none";
              }
              echo "<div class='imagen".$cont_contenido." contenido' style='display: $ap_cont;'>";
              echo "<h3>".$row_slide['titulo_lat']."</h3>";
              echo "<p>".$row_slide['texto_lat']."</p>";
              echo "<a class='btn btn-".$row_slide['cor_boton']."' href='".$row_slide['link_boton']."' role='button'>".$row_slide['texto_boton']."</a>";
              echo "</div>";
              $cont_contenido++;
          }
          ?>
      </div>
    </div>
    </div>


    <script src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script >
    $('#myCarousel').on('slid.bs.carousel', function () {
      var extension = {
        cycle: function (e, extra) {
          e || (this.paused = false)

          this.interval && clearTimeout(this.interval)

          var nextInterval;
          var $active    = this.$element.find('.item.active')
          if (!extra) {
            nextInterval = $active.data("duration") || this.options.interval;
          } else {
            var $next    = this.getItemForDirection('next', $active)
            nextInterval = $next.data("duration") || this.options.interval;
          }

          !this.paused
            && (this.interval = setTimeout($.proxy(this.nextProxy, this), nextInterval))

          return this
        },
        pause: function (e) {
          e || (this.paused = true)

          if (this.$element.find('.next, .prev').length && $.support.transition) {
            this.$element.trigger($.support.transition.end)
            this.cycle(true)
          }
          this.interval = clearTimeout(this.interval)

          return this
        },
        nextProxy: function() {
          this.next()
          this.cycle(true, true)
        }
      }

      // con esto extendemos el componente carousel
      $.extend($[ "fn" ][ "carousel" ][ "Constructor" ].prototype, extension);

      $(function() {
        $('#myCarousel').carousel();
      });
    })
    </script>
  </body>
</html>
