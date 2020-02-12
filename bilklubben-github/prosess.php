<?php
session_start();
//denne siden lagrer informasjon fra bestillingsskjema i SESSION og deretter vises til
//bruker på neste side reservert.php.
//Denne siden skal ikke vises til bruker, dette er en mellomside.

//sjekker om brukeren er innlogget, hvis ikke routes til home:
if( !isset($_SESSION['brukernavn'])) {
  header("Location: home.php");
  exit;
}

//tilkobling til databasen:
require_once('dbconnect.php');
  $brukernavn=$_SESSION['brukernavn'];

//henter informasjon om bruker fra databasen:
  $sql = "SELECT * FROM tabel_name WHERE brukernavn = '$brukernavn'" ;
  $resultat = mysqli_query($conn, $sql );
// Behandler resultat med PHP og HTML
  while($rad = mysqli_fetch_array ($resultat)) {
  $status = $rad[ 'status'];
  $saldo = $rad[ 'saldo'];
  $bil_navn = $_POST [ 'bil_navn'];
  $dato_fra2=$_POST [ 'dato_fra2'];
  $dato_til2=$_POST [ 'dato_til2'];
  $bil_id2=$_POST [ 'bil_id2'];
  $nypris=$_POST [ 'totalpris'];
  $lokasjon=$_POST [ 'lokasjon'];
  $lokasjon_url=$_POST [ 'lokasjon_url'];
  $nysaldo = ($saldo-$nypris);

//lagrer informasjon i session:
  $_SESSION['status'] = $status;
  $_SESSION['saldo'] = $saldo;
  $_SESSION['bil_navn'] = $bil_navn;
  $_SESSION['dato_fra2'] = $dato_fra2;
  $_SESSION['dato_til2'] = $dato_til2;
  $_SESSION['nypris'] = $nypris;
  $_SESSION['nysaldo'] = $nysaldo;
  $_SESSION['lokasjon'] = $lokasjon;
  $_SESSION['lokasjon_url'] = $lokasjon_url;

//hvis det er nok poeng på konto, legger inn bestillingen i databasen:
      if ($nysaldo >= 0) {
      $sql2 = "INSERT INTO tabel_name (bruker_navn, bil_id, dato_fra, dato_til) value ('$brukernavn','$bil_id2','$dato_fra2','$dato_til2')";
      if(mysqli_query($conn,$sql2))
      {

//og oppdaterer saldo med ny saldo:
          $sql3 = "UPDATE tabel_name
          SET saldo = '$nysaldo'
          WHERE brukernavn = '$brukernavn'";
          if(mysqli_query($conn,$sql3))
          {
          header('Location: reservert.php');
          exit();

}
}
     }else {
//hvis det ikke er nok poeng dialogboksen kommer opp og brukeren blir routet til bestilling.php:
echo "<script>alert('Du har ikke nok poeng. Vennligst velg en annen bil eller dato.')</script>";
  echo"<script>window.open('bestilling.php','_self')</script>";
        }
        }


      ?>

<?php

// Databasetilkoblingen lukkes
mysqli_close ($conn);
?>
