<?php
session_start();

//tilkobling til databasen:
require_once('dbconnect.php');
?>

<?php
if(isset($_POST['registrer']))
{
  //mot sql injection:
  $strBrukernavn = mysqli_real_escape_string($conn, $_POST[ 'brukernavn']);
  $strFornavn = mysqli_real_escape_string($conn, $_POST[ 'fornavn']);
  $strEtternavn = mysqli_real_escape_string($conn, $_POST[ 'etternavn']);
  $strPassord = mysqli_real_escape_string($conn, $_POST[ 'passord']);

//passord blir kryptert for at det ikke lagres i databasen i klar tekst:
$passwordHashed = password_hash($strPassord, PASSWORD_DEFAULT);
//Valg av abonnement. Beløp i poeng lagres i databasen ifbm valgt abonnement:
 $strAbonnement = mysqli_real_escape_string($conn, $_POST[ 'abonnement']);
 if($strAbonnement == 'Mini') {
 $saldo='500';
}
elseif ($strAbonnement == 'Medium') {
 $saldo='1000';
}
else {
 $saldo='2000';
};
$status='aktivt';

//sjekk om bruker er allerede registrert i databasen:
    $check_epost_query="SELECT * from bruker WHERE brukernavn='$strBrukernavn'";
    $run_query=mysqli_query($conn,$check_epost_query);

//hvis ikkr bruker er registrert fra før, legge inn i databasen:
    if(mysqli_num_rows($run_query)==0){


 $insert_user="insert into bruker (brukernavn,fornavn,etternavn,passord,abonnement,saldo,status) VALUE ('$strBrukernavn','$strFornavn','$strEtternavn','$passwordHashed','$strAbonnement','$saldo','$status')";
    if(mysqli_query($conn,$insert_user))
    {

  //hvis brukeren registreres in databasen, beskjed om det og pålogginggside åpnes:
      echo "<script>alert('Gratulerer! Du kan nå logge inn.')</script>";
      echo"<script>window.open('login.php','_self')</script>";

    }
    }else{
    echo "<script>alert('Epost $strBrukernavn er allerede registrert i databasen. Vennligst logg deg inn eller velg en annen epost!')</script>";
    if(isset($_POST) & count($_POST)) { $_SESSION['post'] = $_POST; }
if(isset($_SESSION['post']) && count($_SESSION['post'])) { $_POST = $_SESSION['post']; }
    }
}

//tilkoblingen til databasen lukkes:
mysqli_close ($conn);

?>
<!DOCTYPE html>
<html>
<head lang="no">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../../../../favicon.ico">
  <title>Registrering</title>
<style>
  body{padding-top:20px;}
</style>
</head>
<body>
  <div class="header">
  </div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                  <center><h2 class="panel-title"><a href="home.php"><strong>Bilklubben AS</strong></a></h2></center><br>
                    <center><h3 class="panel-title">Register deg</h3></center>
                </div>

                <!--Form for registrering:-->
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Epost" name="brukernavn" type="email" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Fornavn" name="fornavn" type="text"required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Etternavn" name="etternavn" type="text"required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Passord" name="passord" type="password" value="" required>
                            </div>
                            <div class="form-group">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Velg abonnement:</label>
                              <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name = "abonnement">
                                <option selected value="Mini">Mini: 500 poeng for NOK 399 pr måned</option>
                                <option value="Medium">Medium: 1 000 poeng for NOK 599 pr måned</option>
                                <option value="Maxi">Maxi: 2 000 poeng for NOK 1 000 pr måned</option>
                              </select>
                              <div class="col-50">

                                <!--Betaling med kort:-->
            <h3>Betaling</h3><br>
            <label for="fname">Vi aksepterer:</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa custom"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div><br>
            <div class="form-group">
              <label for="expmonth">Navn på kortet*</label>
          <input class="form-control" placeholder="Navn på kortet" name="navn" type="text"required>
        </div>
        <div class="form-group">
          <label for="expmonth">Kortnummer*</label>
          <input class="form-control" placeholder="1111-2222-3333-4444" name="nummer" type="number"required>
        </div>
        <div class="form-group inline">
          <label for="expmonth" class = "control-label">Utløpsdato*</label>
          <select name="måneder">
            <option value="januar">Januar</option>
            <option value="februar">Februar</option>
            <option value="mars">Mars</option>
            <option value="april">April</option>
            <option value="mai">Mai</option>
            <option value="juni">Juni</option>
            <option value="juli">Juli</option>
            <option value="august">August</option>
            <option value="september">September</option>
            <option value="oktober">Oktober</option>
            <option value="november">November</option>
            <option value="desember">Desember</option>
          </select>
          <select name="måneder" class = "control-label">
        <div class="form-group">
          <option value="2018">2018</option>
          <option value="2019">2019</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
        </select>
        </div>

          <label for="expmonth">Kontrollnummer*</label>
          <input class="form-control" placeholder="123" name="nummer" type="text"required>
        </div>
          </div>
        </div>
        <input class="btn btn-lg btn-success btn-block" type="submit" value="Registrer" name="registrer" >
      </fieldset>
      </form>
      <center><b>Allerede registrert?</b> <br></b><a href="login.php">Logg inn her</a></center><!--for centered text-->
      </div>
    </div>
  </div>
  </div>
</div>
</body>
</html>
