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

//henter info om bruker fra databasen og aktiverer abonnement og setter status 'aktivt' i databasen når knappen er trykket:
$sql = "SELECT * FROM bruker WHERE brukernavn = '$brukernavn'" ;
$resultat = mysqli_query($conn, $sql );
$brukernavn=$_SESSION['brukernavn'];
if(isset($_GET['aktiver']))
{
$sql2 = "UPDATE bruker
SET status = 'aktivt'
WHERE brukernavn = '$brukernavn'";
if(mysqli_query($conn,$sql2))
$resultat2 = mysqli_query($conn, $sql2 );

}


// Databasetilkoblingen lukkes
mysqli_close ($conn);
?>
<!DOCTYPE html>
<html>

<!--hoveddelen-->
  <title>Aktivere</title>
  <style>

  .container { width:100%;
    height:100%;
}
  <?php include 'css/style.css'; ?>
  </style>
  </head>
    <!--For navbar:-->
  <?php $title = 'aktivere'; ?>
  <?php $metaTags = 'tag1 tag2'; ?>
  <?php $currentPage = 'aktivere'; ?>
  <!--inkluderer eksterne filer for head og navbar:-->
  <?php include('head.php'); ?>
  <?php include('navbar.php'); ?>
  <body>
    <div class="container">
      <br>
<!--melding om at abonnementet er aktivert igjen:-->
      <div class="alert alert-success">
        <p>Gratulerer! Du har aktivert abonnementet ditt.</p><br>
      </div>
      <a  href="minside.php"class="btn btn-secondary"><i class="fa fa-angle-left"></i> Tilbake</a>
    </div>
    <!--inkluderer footer:-->
    <footer class="footer">
    <?php include 'footer.php'; ?>
  </footer>
  </body>
</html>
