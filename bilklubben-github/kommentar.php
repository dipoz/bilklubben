<?php
session_start();

//sjekker om brukeren er innlogget, hvis ikke routes til home:
if( !isset($_SESSION['brukernavn'])) {
  header("Location: home.php");
  exit;
}

//tilkobling til databasen:
require_once('dbconnect.php');
?>
<!DOCTYPE html>
<html lang="no">
<head>
<style>
<?php include 'css/style.css'; ?>

</style>
  <title>Kommentar</title>
</head>

<!--dette for navbar:-->
<?php $title = 'kommentar'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'kommentar'; ?>

<!--inkluderer head.php og footer.php som er like for alle sider:-->
<?php include('head.php'); ?>
<?php include('navbar.php'); ?>

 <!--main content:-->
<body>
  <div class="content">
    <center><img src="bilder/logo.png" class = "img-responsive" alt="logo" width="200" height="200"></center>
<br>
  <div class="col-md-4 col-md-offset-4">

          <!--form for kommentar/beskjed om feil på bilen:-->
            <h4>Har du feil på bilen eller en kommentar? Vennligst send oss en melding om det:</h4>
            <p class="lead"></p>
          <form role="form" method="post" action="kommentar.php">
            <fieldset>
              <div class="form-group">
                <label for="example-text-input" name="reg_nr">Bil reg.nummer:</label>
                <input class="form-control" type="text" name="reg_nr" id="example-text-input" required>
                <div class="form-group">
                  <label for="exampleTextarea">Din melding:</label>
                  <textarea class="form-control" name="tekst" id="exampleTextarea" rows="10" required></textarea>
                </div>
                <div class="form-group">
                  <button type="submit" value="registrer" name ="registrer" class="btn btn-primary">Send</button>
                </div>
            <fieldset>
          </form>
        </div>
        </div>
        </div>



          <?php

          //hvis knappen er trykket, blir melding lagret i databasen:
          if(isset($_POST['registrer']))
          {
            //mot sql injection:
            $strReg_nr = mysqli_real_escape_string($conn, $_POST[ 'reg_nr']);
            $strTekst = mysqli_real_escape_string($conn, $_POST[ 'tekst']);
            $brukernavn = $_SESSION['brukernavn' ];
            $dato = date( "Y-m-d" ); //gir dagens dato

            // Kjører SQL-spørring mot databasen
            $sql = "INSERT INTO tabel_name (reg_nr,tekst,brukernavn,date)
            VALUES('$strReg_nr','$strTekst','$brukernavn','$dato')";
            $resultat = mysqli_query($conn, $sql );

            //beskjed til bruker i dialogboks når kommentaren er lagret:
            echo "<script>alert('Takk, $brukernavn! Din melding er sendt.')</script>";

            //bruker blir videreført til minside.php når kommentaren er lagret:
            echo"<script>window.open('minside.php','_self')</script>";
}
            // Databasetilkoblingen lukkes
            mysqli_close ($conn);
            ?>


      <!--inkluderer footer:-->
      <footer class="footer">
      <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
