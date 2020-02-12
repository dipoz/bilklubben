<?php
session_start();

//sjekker om brukeren er innlogget, hvis ikke routes til home:
if( !isset($_SESSION['brukernavn'])) {
  header("Location: home.php");
  exit;
}

//tilkobling til databasen:
require_once('dbconnect.php');
if (isset($_SESSION['brukernavn'])) {
  $brukernavn=$_SESSION['brukernavn'];
}
?>
<!DOCTYPE html>
<html lang="no">
<head>
<style>
<?php include 'css/style.css'; ?>
</style>
  <meta charset="utf-8">
  <title>Reservert</title>
  </head>


  <!--dette for navbar:-->
  <?php $title = 'reservert'; ?>
  <?php $metaTags = 'tag1 tag2'; ?>
  <?php $currentPage = 'home'; ?>

  <!--inkluderer head.php og footer.php som er like for alle sider:-->
  <?php include('head.php'); ?>
  <?php include('navbar.php'); ?>
   <!--main content:-->
  <body>
    <div class="content">
    <div class="container">
      <form class = "form-signin" action = "bestilling.php" method = "post" id = "bilsok">
        <div class="jumbotron">
          <p><h3>Takk for din bestilling! </h3></p>
          <div class="blog-post">
        </form>
      </div>
      </div>
<?php

//henter informasjon om bruker fra databasen:
$sql = "SELECT * FROM bruker WHERE brukernavn = '$brukernavn'" ;
$resultat = mysqli_query($conn, $sql );

// Behandler resultat med PHP og HTML
  while($rad = mysqli_fetch_array ($resultat)) {
  $saldo = $rad[ 'saldo'];

//henter data fra prosess.php som ble lagret i SESSION:
  $bil_navn = $_SESSION [ 'bil_navn'];
  $dato_fra2=$_SESSION [ 'dato_fra2'];
  $dato_til2=$_SESSION [ 'dato_til2'];
  $bil_id2=$_SESSION [ 'bil_id2'];
  $nypris=$_SESSION [ 'nypris'];
  $nysaldo = $_SESSION['nysaldo'];
  $lokasjon = $_SESSION['lokasjon'];

    //viser indormasjon om bestillingen:
    echo "<strong>Sammendrag:</strong><br>";
    echo "<br>";
    echo "Bil: $bil_navn<br>";
    echo "Totalpris: $nypris<br>" ;
    echo "Bestilt fra: $dato_fra2<br>";
    echo "Bestilt til: $dato_til2<br>";
    echo "Hentes på: $lokasjon<br>";
    echo "<br>";
    echo "<strong>Din nye saldo er: $nysaldo</strong><br>" ;
    echo "<h3>Værevarsel de nærmeste dagene:</h3>";

//inkluderer værevarsel fra filen, hvor stedsnavn er lokasjon:
include 'yr.php';

}
mysqli_close ($conn);
      ?>

</div>
</div>
</div>
</body>
</html>
