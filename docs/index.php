<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Material icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="style.css">

    <title>Prueba Técnica</title>
  </head>
  <body>

     <!-- navbar -->
      
      <nav class="navbar navbar-dark fixed-top sticky-top" style="background-color: #000; opacity: 0.6;">
        <h3 class="text-center text-light font-weight-bold text-uppercase" style="width: 100%;">Prueba Técnica</h3>
      </nav>
      
     <!-- navbar -->

     <!-- API clima -->
     <?php 

        function API_clima(){
            
            $url1 = "http://api.openweathermap.org/data/2.5/weather?q=";
            $ciudad = "medell%C3%ADn";
            $key1 = "&appid=8266c4d1a21a9d0039cd1bd9a57145a3";

            $resp1 = $url1.$ciudad.$key1;
            return $resp1;
            
        }

        ?>
     <!-- API clima -->

     <!-- fold 1 -->

      <div class="content-video">

      <video id="video">
        <source src="src/video/video.mp4" type="video/mp4">
      </video>

      <div class="overlay"></div>

      <button class="btn btn-outline-light" id="mute"><i class="material-icons align-middle">volume_off</i></button>

      <script src="main.js"></script>

      <?php

        $datosclima = API_clima();
        $jsonclima = file_get_contents($datosclima);
        $arrayclima = json_decode($jsonclima, true);
        // print_r($arrayclima['weather'][0]['icon']);

        $ciudad = $arrayclima['name'];
        $pais = $arrayclima['sys']['country'];
        $temp = round($arrayclima['main']['temp'] - 273.15);
        $icono = 'https://openweathermap.org/img/wn/'.$arrayclima['weather'][0]['icon'].'@2x.png';
        $descrip = $arrayclima['weather'][0]['description'];
        $viento = $arrayclima['wind']['speed'];
        $presion = $arrayclima['main']['pressure'];
        $humedad = $arrayclima['main']['humidity'];
        $tempmin = round($arrayclima['main']['temp_min'] - 273.15);
        $tempmax = round($arrayclima['main']['temp_max'] - 273.15);

        echo"

        <div class='container-fluid fold1 d-flex flex-column justify-content-center align-items-center'>
          <div class='card' style='width: 22rem;'>
            <div class='card-body'>
            <img src='$icono' alt='' class='float-right'>
            <h5 class='card-title'>$temp 	°C</h5>
            <h6 class='card-subtitle mb-2 text-muted'>$ciudad - $pais</h6>
            <p class='card-text text-capitalize'>
            $descrip<br>
            <table class='table table-striped mt-2'>
              <tbody>
                  <tr>
                  <td><b>Wind</b></td>
                  <td>$viento m/h</td>
                  </tr>
                  <tr>
                  <td><b>Pressure</b></td>
                  <td>$presion hpa</td>
                  </tr>
                  <tr>
                  <td><b>Humidity</b></td>
                  <td>$humedad %</td>
                  </tr>
                  <tr>
                  <td><b>Temp min</b></td>
                  <td>$tempmin °C</td>
                  </tr>
                  <tr>
                  <td><b>Temp max</b></td>
                  <td>$tempmax °C</td>
                  </tr>
              </tbody>
              </table>
            </p>
            </div>
          </div>
        </div>
    
        "
      ?>

      
    </div>
     <!-- fold 1 -->

     <!-- fold2 -->
      <div class="container my-5">
        <div class="row">

        <!-- API news -->
        <?php 

          function fecha_actual(){
              return date_default_timezone_set('America/Bogota');
          }

          function API_news(){
              fecha_actual();
              $year = date('Y');
              $month = date('m');
              $day = date('d');

              $url = "https://newsapi.org/v2/everything?q=";
              $tema = "en%20Colombia";
              $fecha = "&from=$year-$month-$day";
              $orden = "&sortBy=popularity";
              $key = "&apiKey=70abb1a6c8f645e88f3c7c8f2485e3ce";

              $resp = $url.$tema.$fecha.$orden.$key;

              return $resp;
          }

          $datos = API_news();
          $json = file_get_contents($datos);
          $arraynews = json_decode($json, true);

        ?>
        <!-- API news -->

          <!-- articulo -->

          <div class='col-12 col-lg-4 col-md-12 col-sm-12' style="position: relative; height: 70vh; width: 100vw; overflow: auto;">

            <?php 

              for ($i=0; $i <= 15; $i++) { 
                  $fuente = $arraynews['articles'][$i]['source']['name'];
                  $titulo = $arraynews['articles'][$i]['title'];
                  $descripcion = $arraynews['articles'][$i]['description'];
                  $urlnews = $arraynews['articles'][$i]['url'];
                  $urlimage = $arraynews['articles'][$i]['urlToImage'];
                  $fechapublic = $arraynews['articles'][$i]['publishedAt'];
                  $contenido = $arraynews['articles'][$i]['content'];

                  if ($titulo != '') {
                    
                    echo"
          
                      <div class='card' >
                        <div class='card-body'>
                          <a href='$urlnews'><h5 class='card-title'>$titulo</h5></a>
                          <a href='$urlnews'><h6 class='card-subtitle mb-2 text-muted'>$fuente</h6></a>
                          <a href='$urlnews' class='card-link'>Leer mas...</a>
                        </div>
                      </div>
    
                    ";

                  }

              }

            ?>

          </div>
          
          <!-- articulo -->
 
          <!-- slider -->
          <div class="col-12 col-lg-8 col-md-12 col-sm-12">
            <div class="bd-example">
              <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">

                <ol class="carousel-indicators">
                  
                  <?php 

                    for ($i=0; $i <= 15; $i++) {

                      $titulo = $arraynews['articles'][$i]['title'];
                      if ($titulo != '' && $i === 0) {
                        echo" 
                          <li data-target='#carouselExampleCaptions' data-slide-to='[$i]' class='active'></li>
                        ";
                      }elseif ($titulo != '' && $i != 0) {
                        echo" 
                          <li data-target='#carouselExampleCaptions' data-slide-to='[$i]'></li>
                        ";
                      }

                    }

                  ?> 

                </ol>

                <div class="carousel-inner">
                  <?php  

                    for ($i=0; $i <= 15 ; $i++) {

                      $fuente = $arraynews['articles'][$i]['source']['name'];
                      $titulo = $arraynews['articles'][$i]['title'];
                      $descripcion = $arraynews['articles'][$i]['description'];
                      $urlnews = $arraynews['articles'][$i]['url'];
                      $urlimage = $arraynews['articles'][$i]['urlToImage'];
                      $fechapublic = $arraynews['articles'][$i]['publishedAt'];
                      $contenido = $arraynews['articles'][$i]['content'];

                      if ($titulo != '' && $i === 0) {

                        echo"
                          <div class='carousel-item active'>
                            <img src='$urlimage' class='d-block w-100' alt='...' style='height: 70vh; width: 100vw;'>
                            <div class='carousel-caption d-none d-md-block'>
                              <h5>$titulo</h5>
                              <p>$descripcion</p>
                            </div>
                          </div>
                        ";
                        
                      } elseif ($titulo != '' && $i != 0) {

                        echo"
        
                          <div class='carousel-item'>
                            <img src='$urlimage' class='d-block w-100' alt='...' style='height: 70vh; width: 100vw;'>
                            <div class='carousel-caption d-none d-md-block'>
                              <h5>$titulo</h5>
                              <p>$descripcion</p>
                            </div>
                          </div>
        
                        ";
        
                      }
                          
                    }

                  ?>
                
                </div>

                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>

          </div>
          
          <!-- slider -->
        </div>
      </div>
     <!-- fold2 -->

     <!-- footer -->
      <div class="container-fluid bg-dark text-white py-3">
              <div class="container text-center">
              <blockquote class="blockquote">
                <a href="https://openweathermap.org/" style="text-decoration: none; color: white;"><p>OpenWeather</p></a>
                <a href="https://newsapi.org/" style="text-decoration: none; color: white;"><p>News API</p></a>
                <footer class="blockquote-footer">© Copyright 2019 por <cite title="Source Title">Jahiker Rojas</cite></footer>
              </blockquote>
              </div>
            </div>
          <!-- footer -->

          <!-- Optional JavaScript -->
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
          <script src="js/bootstrap.min.js"></script>
        </body>
      </html>