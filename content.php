      <!DOCTYPE html>
      <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="X-UA-Compatible" content="ie=edge">
          <title>Content</title>
      </head>
      <body>
          
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
         
      </body>
      </html>
      