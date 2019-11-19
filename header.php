<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Header</title>
</head>
<body>
  
  <!-- navbar -->
   
   <nav class="navbar navbar-dark fixed-top sticky-top" style="background-color: #000; opacity: 0.6; width: 100vw;">
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
        <div class='card' style='width: 22rem; min-width: 25vw; max-width: 65vw;'>
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

</body>
</html>
