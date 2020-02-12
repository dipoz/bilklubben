<!--felles navnvar for alle sider:-->
<header>
  <nav class="navbar navbar-inverse navbar-expand-lg">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="home.php">Bilklubben AS</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">

        <!--aktive sider vises med php:-->
      <li <?php if ($currentPage === 'login') {echo 'class="active"';} ?>><a href="login.php"><i class="fas fa-user"></i> Min side</a></li>
      <li  <?php if ($currentPage === 'bestilling') {echo 'class="active"';} ?>><a href="bestilling.php"><i class="fas fa-car"></i> Lei en bil</a></li>
      <li <?php if ($currentPage === 'omoss') {echo 'class="active"';} ?>><a href="omoss.php"> Om oss</a></li>
      <li> <?php if (isset($_SESSION['brukernavn'])) {
        echo "<form action='logout.php' method = 'get'>
            <button class='btn btn-primary navbar-btn' type='submit'><span class='glyphicon glyphicon-log-in'></span> Logg  ut</button>
        </form>";
      } ?></li>
    </ul>
      </div>
      </div>
      </nav>
    </header>
