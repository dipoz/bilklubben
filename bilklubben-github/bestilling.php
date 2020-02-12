<?php
session_start();

//sjekker om brukeren er innlogget, hvis ikke routes til login:
if( !isset($_SESSION['brukernavn'])) {
  header("Location: login.php");
  exit;
}
//tilkobling til databasen:
require_once('dbconnect.php');
if (isset($_SESSION['brukernavn'])) {
  $brukernavn=$_SESSION['brukernavn'];
}

//henter brukerdata fra databasen:
$sql = "SELECT * FROM tabel_name WHERE brukernavn = '$brukernavn'" ;
$resultat = mysqli_query($conn, $sql );

// Behandler resultat med PHP og HTML
  while($rad = mysqli_fetch_array ($resultat)) {
    $abonnement = $rad[ 'abonnement'];
    $status = $rad[ 'status'];
    $saldo = $rad[ 'saldo'];
 }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Bestilling</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
      hr.new1 {
        border-top: 1px solid black;
      }
      .container { width:100%;
        height:100%;
    }


/* css for søk-knappen: */
      input[type=submit] {
          background-color: green;
          color: white;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          border-radius: 4px;
          cursor: pointer;
      }
<?php include 'css/style.css'; ?>
</style>
</head>

<!--dette for navbar:-->
<?php $title = 'bestilling'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'bestilling'; ?>

<!--inkluderer head.php og footer.php som er like for alle sider:-->
<?php include('head.php'); ?>
<?php include('navbar.php'); ?>
 <!--main content:-->
<body>
  <div class="content">
<div class="container">

     <!--Form for bestillingen:-->
    <form class = "form-signin" action = "bestilling.php" method = "post" id = "bilsok">
      <div class="jumbotron">
        <h3>Sjekk tilgjengelige biler </h3><br>
        <font color="blue">* Vi gir 10% rabatt på leie fra dag nr. 2!</font><br>

        <!--Valg av dato:-->
        <h5>Dato fra :</h5>
        <input type="text" name="dato_fra_valg" id="TextBox1" required/><br>
        <h5>Dato til: </h5>
        <input type="text" name ="dato_til_valg" id="TextBox2" required/>

        <!--Beregner antall dager, dette er ikke synlig til bruker:-->
        <input type="text" name = "antall_dager" id="TextBox3" class ="hidden"/>
        <p>
          <br>
          <!--Valg av bilklasse:-->
          <select name="Klasse">
            <option value="SUV">SUV</option>
            <option value="Familiebil">Familiebil</option>
            <option value="Varebil">Varebil</option>
            <option value="Småbil">Småbil</option>
            <option value="Van">Van</option>
          </select></p>
        <div class="blog-post">
        </form>
                      <?php
                      //sjekker om abonnementet er aktivt eller inaktivt. Melding vises om status:
                          if ($status == "aktivt") {
                          echo "<font color='blue'>Ditt abonnement $abonnement er aktivt.</font>" ;
                        }else {
                          echo "<font color='red'>OBS! $brukernavn, ditt abonnement $abonnement er inaktivt. Du må aktivere det før du bestiller bil.</font>" ;
              }

                      //Hvis man trykker på søk knappen:
                        if(isset($_POST['sokBil']))
                        {
                          $dato_fra_valg = date('Y-m-d', strtotime($_POST['dato_fra_valg']));
                          $dato_til_valg = date('Y-m-d', strtotime($_POST['dato_til_valg']));
                          $antall_dager = $_POST['antall_dager'];

                      //rabattordning hvis antall dager >=2:
                          if ($antall_dager >= "2") {
                          $rabatt=0.9;
                         }
                         else {
                          $rabatt=1;
                         };
                         $klasse = $_POST['Klasse'];
                          echo "<br>";
                          ?>
                          <!--vises det bruker vil søke (dato fra og til og bilklasse):-->
                        <strong>Du har valgt: </strong><br>
                          Dato fra: <?php echo $dato_fra_valg; ?><br>
                          Dato til: <?php echo $dato_til_valg; ?><br>
                          Klasse: <?php echo $klasse; ?><br>
                          </div>
                          <?php
                        }
                        ?>
                        <div><br>
                          <button class="btn btn-primary" name ="sokBil" type="submit">Søk biler</button>
                        </div>
                      <br>



              <?php
              //velger tilgjengelige biler fra databasen på datoer bruker har opplyst:
                $sql = "SELECT distinct b.bil_id, b.bilde, b.pris, b.navn, b.ar, b.klasse, b.lokasjon, b.lokasjon_url, b.antall_seter, b.ekstrautstyr from tabel_name left join tabel_name r on (
                  b.bil_id = r.bil_id
                  and r.dato_fra <= '$dato_til_valg'
                  and r.dato_til >= '$dato_fra_valg'
                  )
                  where
                  r.reservasjon_id is null
                  and
                  b.klasse='$klasse'
                  ";
            // Behandler resultat med PHP og HTML
                $rad = mysqli_fetch_assoc ($resultat);
                $resultat = mysqli_query($conn, $sql );
              if(isset($_POST['sokBil']))
{

    //resultates vises i tabell:

          while ($rad = mysqli_fetch_array($resultat)) {
            $bil_navn = $rad[ 'navn'];
            $lokasjon_url = $rad[ 'lokasjon_url'];
            $bil_id = $rad[ 'navn'];
            $dato = date( "Y-m-d" );
            $bagasjekapasitet = $rad[ 'bagasjekapasitet'];
            $antall_seter = $rad[ 'antall_seter'];
            $ekstrautstyr = $rad[ 'ekstrautstyr'];
            $reservasjon_id=$rad [ 'reservasjon_id'];
            $bil_id = $rad[ 'bil_id'];
            $klasse = $rad[ 'klasse'];
            $ar = $rad[ 'ar'];
            $lokasjon = $rad[ 'lokasjon'];
            $pris = $rad[ 'pris'];
            $nypris = floor($antall_dager*$pris*$rabatt);
            ?>
            <table>
                <tr><td>
            <hr class="new1">
                <?php echo "<img src='".$rad['bilde'],"' class='img-responsive' alt='Bil' width='304' height='236'>"; ?>
                </td></tr>
                <tr><td>
                  Navn:  <?php echo $bil_navn; ?>
                </td></tr>
                <tr><td>
                  Klasse: <?php echo $klasse; ?>
                </td></tr>
                <tr><td>
                  År: <?php echo $ar; ?>
                </td></tr>
                <tr><td>
                  Antall seter: <?php echo $antall_seter; ?>
                </td></tr>
                <tr><td>
                  Ekstrautstyr: <?php echo $ekstrautstyr; ?>
                </td></tr>
                <tr><td>
                  Lokasjon: <?php echo $lokasjon; ?>
                </td></tr>
                <tr><td>
                  Pris pr døgn: <?php echo $pris; ?>
                </td></tr>
                <tr><td>
                  Totalpris for <?php echo $antall_dager; ?> døgn: <?php echo $nypris; ?> poeng
                </td></tr>
                <td>
                  </table>

<!-- Videre er informasjonen videreført til skjema og informasjonen om den bilen som er valgt blir postet til prosess.php-->
<!-- process.php er ikke synlig til bruker, denne siden lagrer informasjon om valg i SESSION-->
                  <form method="post" action="prosess.php">
                      <div class="form-group">

                        <!--registrerer data i form:-->
                        <input class="form-control" name="bil_navn" type = "hidden" value="<?php echo $bil_navn ?>" />
                        <input class="form-control" name="lokasjon" type = "hidden" value="<?php echo $lokasjon ?>" />
                        <input class="form-control" name="lokasjon_url" type = "hidden" value="<?php echo $lokasjon_url ?>" />
                        <input class="form-control" name="bil_id2" type = "hidden" value="<?php echo $bil_id ?>" />
                        <input class="form-control" name="klasse2" type = "hidden" value="<?php echo $klasse ?>" />
                        <input class="form-control" name="dato_fra2" type = "hidden" value="<?php echo $dato_fra_valg ?>" />
                        <input class="form-control" name="dato_til2" type = "hidden" value="<?php echo $dato_til_valg ?>" />
                        <input class="form-control" name="dato2" type = "hidden" value="<?php echo $dato ?>" />
                        <input class="form-control" name="totalpris" type = "hidden" value="<?php echo $nypris ?>" />
                      </div>
                      <div class="form-group">

                  <!--reservasjonsknappen er kun aktiv og kan trykkes hvis brukeren har aktivt abonnement (har ikke avsluttet abonnement):-->
                  <input type="submit" value="Reserver" name = "reserver" <?php if ($status == 'inaktivt'){ ?> disabled <?php   } ?> />
                </form>
                      </div>
                </td>
            <?php
}
        }

        ?>


<!--script for datepicker:-->
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
          <script src="js/bootstrap.min.js"></script>
          <script src="js/ie10-viewport-bug-workaround.js"></script>
          <script>
        //kalender og beregning av antall dager:
          $("#TextBox1").datepicker({
          minDate: 0,
          maxDate: '+1Y+6M',
          onSelect: function (dateStr) {
          var min = $(this).datepicker('getDate'); // Få valgt dato
          $("#TextBox2").datepicker('option', 'minDate', min || '0'); // Set other min, default to today
    }
});

          $("#TextBox2").datepicker({
          minDate: '0',
          maxDate: '+1Y+6M',
         onSelect: function (dateStr) {
          var max = $(this).datepicker('getDate'); // Få valgt dato
          $('#datepicker').datepicker('option', 'maxDate', max || '+1Y+6M'); // Sette max dato, default to +18 months
          var start = $("#TextBox1").datepicker("getDate");
          var end = $("#TextBox2").datepicker("getDate");
          var days = (end - start) / (1000 * 60 * 60 * 24);
          $("#TextBox3").val(days);
    }
});
          </script>
        </div>
        </div>
      </div>

<!--inkluderer footer:-->
    <footer class="footer">
        <?php include 'footer.php'; ?>
    </footer>
  </body>
</html>
