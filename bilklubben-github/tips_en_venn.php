<?php
session_start();

?>
<!DOCTYPE html>
<html lang="no">
<head>
  <title>Tips en venn</title>
<style>
<?php include 'css/style.css'; ?>
</style>
</head>

<!--dette for navbar:-->
<?php $title = 'tips en venn'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'tips_en_venn'; ?>

<!--inkluderer head.php og footer.php som er like for alle sider:-->
<?php include('head.php'); ?>
<?php include('navbar.php'); ?>

 <!--main content:-->
<body>
  <div class="content">
  <div class="container">
<!-- hvis knappen er trykket: -->
  <?php if (isset($_POST['Submit'])) {

    $senders_email = $_POST['your_email'];
    // The person who is submitting the form
    $recipient_friend = $_POST['friend_email'];

    $text = $_POST['text'];

// The forms recipient
mail($recipient_friend,"En melding fra $senders_email", "Kjære $recipient_friend,\n\nDin venn $senders_email, synes du burde vite om oss.\n\nVennligst følg denne lenken:\nhttp://stud.iie.ntnu.no/~dianap/wtr/pro/project/home.php\n\nKommentar fra $senders_email: \n\nMed vennlig hilsen\n\nBilklubben AS", 'Fra: "Bilklubben AS" <your_email.com>');

if (isset($_POST['your_email'])) {
//echo "<br>Din venn $recipient_friend har blitt kontaktet! <br><br>Takk,  $senders_email";

echo "<script>alert('Dinn venn har blitt kontaktet. Takk, $senders_email!')</script>";
echo"<script>window.open('minside.php','_self')</script>";
}}
?>

  <center><img src="bilder/logo.png" class = "img-responsive" alt="logo" width="200" height="200"></center>
<div class="col-md-4 col-md-offset-4">
      <p class="lead"></p>
<form action="tips_en_venn.php" method="POST">
<fieldset>
  <div class="form-group">
<h3>Tips en venn</h3><br />
<label for="example-text-input">Din epost:</label>
<input class ="form-control" type="text" name="your_email" required>
</div>
<div class="form-group">
<label for="exampleTextarea">Din venns epost:</label>
<input class ="form-control" type="text" name="friend_email" required/>
</div>
<div class="form-group">
<label for="exampleTextarea">Kommentar:</label>
<textarea class ="form-control" type="text-area" name="text" rows="10" required/></textarea>
</div>
<div class="form-group">
<input type="Submit" name="Submit" class="btn btn-primary" value="Send">
</div>

</fieldset>
* Vi sender en lenke til vår side slik at vennen din kan finne oss hvis dette skulle vært aktuelt.
</form>
</div>
</div>
</div>

  <!--inkluderer footer:-->
  <div class="footer">
    <?php include 'footer.php'; ?>
  </div>
</body>
</html>
