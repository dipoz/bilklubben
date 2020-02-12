<?php
session_start();
//sjekker om det er registrert bruker som er kommer på siden, hvis ikke, blir den rutet til home.php:
if( !isset($_SESSION['brukernavn'])) {
  header("Location: home.php");
  exit;
}
//tilkobling til databasen:
require_once('dbconnect.php');

if (isset($_SESSION['brukernavn'])) {
  $brukernavn=$_SESSION['brukernavn'];
}

//henter info om bruker fra databasen og deaktiverer abonnement og setter status 'inaktivt' i databasen når knappen er trykket:
$sql = "SELECT * FROM tabel_name WHERE brukernavn = '$brukernavn'" ;
$resultat = mysqli_query($conn, $sql );
$brukernavn=$_SESSION['brukernavn'];
if(isset($_GET['deaktiver']))
{
$sql2 = "UPDATE bruker
SET status = 'inaktivt'
WHERE brukernavn = '$brukernavn'";
if(mysqli_query($conn,$sql2))
$resultat2 = mysqli_query($conn,$sql2);
}

// Databasetilkoblingen lukkes
mysqli_close ($conn);
?>

<!--hoveddelen-->
<!DOCTYPE html>
<html>
  <title>Deaktivere</title>
  <meta charset="utf-8">
  <style>

  .container { width:100%; height:100%; }
  <?php include 'css/style.css'; ?>
  </style>
  </head>

  <!--For navbar:-->
  <?php $title = 'deaktivere'; ?>
  <?php $metaTags = 'tag1 tag2'; ?>
  <?php $currentPage = 'deaktivere'; ?>

  <!--inkluderer eksterne filer for head og navbar:-->
  <?php include('head.php'); ?>
  <?php include('navbar.php'); ?>
  <body>
      <div class="container">
        <br>
        <!--melding om at abonnementet er avsluttet:-->
        <div class="alert alert-info">
          <p>Du har deaktivert abonnementet ditt. Du kan fortsatt se tilgjengelige biler, men ikke bestille</p><br>
        </div>
        <a  href="minside.php"class="btn btn-secondary"><i class="fa fa-angle-left"></i> Tilbake</a>
      </div>

      <!--inkluderer footer:-->
    <div class="footer">
      <?php include 'footer.php'; ?>
    </div>
  </body>
</html>
