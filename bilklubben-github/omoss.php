<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Om oss</title>
<style>
<?php include 'css/style.css'; ?>

@media (min-width: 1200px) {
    .container{
        max-width: 970px;
    }
}

.scroll {
    width: 300px;
    height: 700px;
    overflow: scroll;
}
  .container { background-color: #F5F5F5; }

  hr.new1 {
    border-top: 1px solid black;
  }
</style>
</head>

<!--dette for navbar:-->
<?php $title = 'omoss'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'omoss'; ?>

<!--inkluderer head.php og footer.php som er like for alle sider:-->
<?php include('head.php'); ?>
<?php include('navbar.php'); ?>

 <!--main content:-->
<body>
  <div class="container" style="margin-top:50px">
    <div class="header">
      <h1>Velkommen til Bilklubben AS!</h1>

          <!--Facebook share knappen:-->
          <div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = 'https://connect.facebook.net/nb_NO/sdk.js#xfbml=1&version=v3.2';
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-share-button" data-href="" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href="" class="fb-xfbml-parse-ignore">Del</a>
</div>
<br>


  <?php

  //tilkobling til databasen:
  require_once('dbconnect.php');
  if (isset($_SESSION['brukernavn'])) {
    $brukernavn=$_SESSION['brukernavn'];
  }else{

    //beskjed til bruker hvis man ikke innlogget:
    echo "<div class='alert alert-info'>* For å sjekke
              tilgjengelige biler og  bestille, vennligst logg inn.
  </div>";
  }
?>
  <p><h3>Siste nytt</h3>
    <hr>
    <?php
    $nyheter = "SELECT * FROM nyheter_bilklubben order by dato desc;" ;
    $resultat2 = mysqli_query($conn, $nyheter );
    // Behandler resultat med PHP og HTML
    while($rad2 = mysqli_fetch_array ($resultat2)) {
      $tittel = $rad2[ 'tittel'];
      $tekst = $rad2[ 'tekst'];
      $dato = $rad2[ 'dato'];
      $forfatter = $rad2[ 'forfatter'];




      echo "<br>";
      //echo "<div class = 'container'>";
      echo "<div class = 'row' style='background-color: #e6ffe6'>";
      echo "<div class = 'col-lg-6 col-md-4 thumb'>";
      echo "<center><img src='".$rad2['bilde'],"' class='img-responsive' alt='bilde' width='250' height='200' align='middle'>";
      echo "</div>";
      echo "<div class = 'col-lg-6 col-md-4'>";
      echo "<h4>$tittel</h4><br>";
      echo "<br>";
      echo "$tekst<br>";
      echo "<br>";
      echo "<br>";
      echo "<font color = 'grey'>Skrevet av: $forfatter</font><br>";
      echo "<font color = 'grey'>$dato</font><br>";
      echo "</div>";
      echo "</div>";
      echo "<br>";
      echo "<br>";


    }

      ?>


<br>
<br>


<!--informasjon om biler som bedriften eier, vises med scrollbar:-->

  <div class="row">
    <div class="col-sm-4">
      <h3 style="text-align:center">Våre biler:</h3>

      <!--scrollbar:-->
      <div class="scroll">
        <?php

        //velger alle biler from databasen. Det vises ikke all informasjon om bilene her, kun noe:
        $sql = "SELECT * FROM tabel_name;" ;
        $resultat = mysqli_query($conn, $sql );
        // Behandler resultat med PHP og HTML
        while($rad = mysqli_fetch_array ($resultat)) {
          $navn = $rad[ 'navn'];
          $klasse = $rad[ 'klasse'];
          $pris = $rad[ 'pris'];
          $ar = $rad[ 'ar'];
          $drivstoff = $rad[ 'drivstoff'];
          $girkasse = $rad[ 'girkasse'];
          echo "<p>";

          echo "<strong>$navn </strong><br>" ;
          echo "Klasse: $klasse <br>" ;
          echo "Årsmodell: $ar<br>" ;
          echo "Girkasse: $girkasse<br>" ;
          echo "<br>";
          echo "<i class='fas fa-money-bill-alt'></i></i> Pris pr døgn: $pris poeng<br>" ;
          echo "<i class='fas fa-user'></i> $antall_seter seter<br>";
          echo "<i class='fas fa-gas-pump'></i> $drivstoff" ;
          echo "<img src='".$rad['bilde'],"' class='img-responsive' alt='Bil' width='304' height='236'>";

          echo "</p>";
          echo "<hr class='new1'>" ;
                  }

                  // Databasetilkoblingen lukkes
  mysqli_close ($conn);
?>
</div>
</div>

<!--informasjon om bedriften:-->
<div class="col-sm-8">
<h3 style="text-align:center">Om oss</h3>
  <p style="text-align:left">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
<p>Vi gir 10% rabatt på leie fra dag nr. 2.
<p style="text-align:left">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
  incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
  exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
  irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
  <h3>Våre biloppstillingsplasser i Stavanger:</h3>
  <!--Google map med parkeringsplasser i Stavanger:-->
  <div class= "map-responsive" position= "center" id='googleMap' width="800" height="900" frameborder="0" style="border:0" allowfullscreen></div>
  <br>
</div>
</div>
<a href = "#">Til toppen</a>
</div>
</div>


<!--inkluderer footer:-->
 <div class="footer">
<?php include 'footer.php'; ?>

</div>

<!--script for googlr maps:-->
          <script type="text/javascript"
               src="">
          </script>
          <script>
               // Google Maps
               function initialize()
               {
                   // Koordinater
                   var Sentrum = new google.maps.LatLng ();
                   var Torg = new google.maps.LatLng ();
                   var Byhaugen = new google.maps.LatLng ();
                   var Vaulen = new google.maps.LatLng ();

                   // Instillinger for kartet
                   var mapProp = {
                      center :Sentrum ,
                      zoom :12 ,
                      mapTypeId :google.maps.MapTypeId.ROADMAP // Alternativer: ROADMAP, SATELLITE, HYBRID, TERRAIN
                   };

                   // Opprett kart
                   var map= new google.maps.Map(document.getElementById ("googleMap" ),mapProp );

                   // Markør
                   var marker= new google.maps.Marker({position :Torg ,animation :google.maps.Animation, title: 'Torg', label: 'Torg' });
                   var marker2= new google.maps.Marker({position :Byhaugen ,animation :google.maps.Animation, title: 'Byhaugen', label: 'Byhaugen' });
                   var marker3= new google.maps.Marker({position :Vaulen ,animation :google.maps.Animation, title: 'Vaulen', label: 'Vaulen' });
                   // Initialiser markør
                  marker.setMap (map);
                  marker2.setMap (map);
                  marker3.setMap (map);

                 }
                   // Initialiser kart
                  google.maps.event.addDomListener (window, 'load' , initialize );
          </script>
        </body>
        </html>
