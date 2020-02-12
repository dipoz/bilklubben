<?php
session_start();

//hvis brukeren er innlogget, vises minside.php og ikke home.php:
if (isset($_SESSION['brukernavn'])!="") {
  header("Location: minside.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>

  <!--informasjon for 'Share på facebook' knappen:-->
  <meta property="og:url"           content="http://stud.iie.ntnu.no/~dianap/wtr/pro/project/home.php" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="Bilklubben AS" />
  <meta property="og:description"   content="Her kan du leie biler" />

  <style>
/* inkluderer css filen: */
<?php include 'css/style.css'; ?>

main.container { width:100%;
  height:100%;
}


</style>
</head>

<!--Informasjon for navbar:-->
<?php $title = 'home'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'home'; ?>
<?php include('head.php'); ?>
<?php include('navbar.php'); ?>

<body>
  <div class = "content">
  <div class="container" id = "main">
    <?php if (isset($_SESSION['brukernavn'])) {
      $brukernavn=$_SESSION['brukernavn'];
    }else {
      echo "<font color='red'><p>* For å sjekke tilgjengelighet og  bestille bil, vennligst logg inn.</p></font>";
                } ?>
      <div class="container" style="margin-top:10px">
      <div class="header">

        <!--main content-->
          <h1>Velkommen til Bilklubben AS!</h1>

        <!--Facebook share knappen-->
          <div id="fb-root"></div>
          <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/nb_NO/sdk.js#xfbml=1&version=v3.2';
            fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));</script>

          <div class="fb-share-button" data-href="" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href="" class="fb-xfbml-parse-ignore">Del</a></div>
        </div>

        <!--informasjon om abonnementer:-->
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6">
            <div class="pricingTable">
                <div class="pricingTable-header">
                    <h3 class="title">Mini</h3>
                    <span class="price-value"> NOK 399/mnd</span>
                </div>
                <ul class="pricing-content" data-heading="Mini">
                    <li><i class="fa fa-check"></i>500 poeng</li>
                    <li><i class="fa fa-check"></i>velg mellom 10 biler*</li>
                    <li><i class="fa fa-check"></i>Ingen bindingstid</li>
                </ul>
                <div class="pricingTable-signup">
                  <?php if (isset($_SESSION['brukernavn'])!="") {
                    echo "<a href='minside.php'><span>Velg</span></a>";
                  } else {
                    echo "<a href='registrering.php'><span>Velg</span></a>";
};?>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="pricingTable">
                <div class="pricingTable-header">
                    <h3 class="title">Medium</h3>
                    <span class="price-value">NOK 599/mnd</span>
                </div>
                <ul class="pricing-content" data-heading="Medium">
                  <li><i class="fa fa-check"></i>1 000 poeng</li>
                  <li><i class="fa fa-check"></i>velg mellom 10 biler*</li>
                  <li><i class="fa fa-check"></i>Ingen bindingstid</li>
                </ul>
                <div class="pricingTable-signup">
                  <?php if (isset($_SESSION['brukernavn'])!="") {
                    echo "<a href='minside.php'><span>Velg</span></a>";
                  } else {
                    echo "<a href='registrering.php'><span>Velg</span></a>";
};?>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="pricingTable">
                <div class="pricingTable-header">
                    <h3 class="title">Business</h3>
                    <span class="price-value">NOK 999/mnd</span>
                </div>
                <ul class="pricing-content" data-heading="Maxi">
                  <li><i class="fa fa-check"></i>2 000 poeng</li>
                  <li><i class="fa fa-check"></i>velg mellom 10 biler*</li>
                  <li><i class="fa fa-check"></i>Ingen bindingstid</li>
                </ul>
                <div class="pricingTable-signup">
                  <?php if (isset($_SESSION['brukernavn'])!="") {
                    echo "<a href='minside.php'><span>Velg</span></a>";
                  } else {
                    echo "<a href='registrering.php'><span>Velg</span></a>";
};?>
                </div>
            </div>
          </div>
          </div>
          </div>
          </div>
                  <p class="lead">.</p>
</div>
</div>

<!--Footer:-->
<div class="footer">
<?php include 'footer.php'; ?>
</div>

</body>
</html>
