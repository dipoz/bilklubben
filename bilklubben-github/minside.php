<?php
session_start();

//tilkobling til databasen:
require_once('dbconnect.php');

//sjekker om brukeren er innlogget, hvis ikke routes til home:
if( !isset($_SESSION['brukernavn'])) {
  header("Location: home.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="no">
<head>
  <title>Minside</title>
<style>
.container { background-color: #F5F5F5;
width:100%;}
<?php include 'css/style.css'; ?>
</style>
</head>

<!--dette for navbar:-->
<?php $title = 'minside'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'login'; ?>

<!--inkluderer head.php og footer.php som er like for alle sider:-->
<?php include('head.php'); ?>
<?php include('navbar.php'); ?>

 <!--main content:-->
<body>
  <div class="content">
    <center><img src="bilder/logo.png" class = "img-responsive" alt="logo" width="200" height="200"></center>
<br>
    <div class="container">
    <h3>Velkommen til min side</h3>
    <p class="lead"></p>
<br>

<!--hvis man trykker på knappen, kommer man til side kommentar.php for å skrive kommentar om feil/mangler på bilen:-->
        <form action="kommentar.php" method = "get">
          <button class="btn btn-success" type="submit"><i class="fa fa-envelope" aria-hidden="true"></i> Rapporter feil på bilen</button>
        </form>
        <br>
        <br>
        <h3 class="blog-post-title">Informasjon om ditt abonnement:</h3>
          <?php
          if (isset($_SESSION['brukernavn'])) {
            $brukernavn=$_SESSION['brukernavn'];
          }
          //henter informasjon om bruker fra databasen:
          $sql = "SELECT * FROM tabel_name WHERE brukernavn = '$brukernavn'" ;
          $resultat = mysqli_query($conn, $sql );

          // Behandler resultat med PHP og HTML
            while($rad = mysqli_fetch_array ($resultat)) {
              $epost = $rad[ 'epost'];
              $abonnement = $rad[ 'abonnement'];
              $status = $rad[ 'status'];
              $saldo = $rad[ 'saldo'];
              echo "<br>";
            //viser informasjon om brukerdata til brukeren:
            echo "<ul>" ;
            echo "<li>Brukernavn: $brukernavn</li>" ;
            echo "<li>Abonnement: $abonnement</li>" ;
            echo "<li>Status på abonnement: $status</li>" ;
            echo "<li>Saldo på konto: $saldo poeng</li>" ;
            echo "</ul>" ;

            //hvis brukerkonto er aktiv (dvs ikke avsluttet):
            if ($status == "aktivt") {
            echo "<br>";
            echo "<div class='alert alert-success'>Ditt abonnement $abonnement er aktivt. Du kan gå til bestilling.</div><br>" ;
            echo "<form action='deaktiver.php' method = 'get'>";

            //mulighet for å avslutte abonnement:
            echo "<input type = 'submit' class='btn btn-danger' type = 'submit' name = 'deaktiver' value = 'Avslutt abonnement'/><br>";
            echo "*Merk at dine data ikke slettes, du kan aktivere abonnementet når som helst igjen.</form>";

            //hvis brukerkonto er inaktiv:
            }else {
            echo "<div class='alert alert-danger'>OBS! $brukernavn, ditt abonnement $abonnement er inaktivt. Du må aktivere det før du bestiller bil. Du kan fortsatt sjekke tilgjengelige biler ved å gå til 'Bestill'.</div><br>";
            echo "<form action='aktiver.php' method = 'get'>";
            echo "<input type = 'submit' class='btn btn-primary' type = 'submit' name = 'aktiver' value = 'Aktiver abonnement'/></form><br>";
            }

            ?>
            <h3>Mine bestillinger:</h3>

            <?php

            //viser alle tidligere reservasjoner til bruker:
            $se_reservasjoner = " SELECT r.dato_fra, r.dato_til, r.bruker_navn, b.navn FROM tabel_name t INNER JOIN tabel_name t ON r.bil_id = b.bil_id
            where
              r.bruker_navn='$brukernavn'
              ";
            $resultat2 = mysqli_query($conn, $se_reservasjoner);

            // Behandler resultat med PHP
              while($rad = mysqli_fetch_array ($resultat2)) {
                $dato_fra = $rad[ 'dato_fra'];
                $dato_til = $rad[ 'dato_til'];
                $brukernavn = $rad[ 'bruker_navn'];
                $navn = $rad[ 'navn'];

            //informasjon om tidligere bestillinger vises til bruker:
                echo "Dato fra: $dato_fra<br>";
                echo "Dato til: $dato_til<br>";
                echo "Bil: $navn<br>";
                echo "<hr>";
            }
}
?>
<?php

// Databasetilkoblingen lukkes
mysqli_close ($conn);
?>
  </div>
  </div>

  <!--inkluderer footer:-->
  <div class="footer">
      <?php include 'footer.php'; ?>
      </div>
</body>
</html>
