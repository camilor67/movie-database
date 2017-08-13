<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css"> -->
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i,800,800i|Raleway:400,400i,700,700i,900" rel="stylesheet">
  <meta charset="UTF-8">
  <title>THE MOVIE DATABASE</title>
</head>
<body>
  <!-- <div id="loading-bar"></div> -->
  <header class="main">
    <div class="container-fluid clearfix" style="margin-bottom: 1em;">
      <div class="inner clearfix">
        <a href="http://www.restool.org">
          <!-- <img class="logo left" src="img/restool-2.svg" alt="Restool"> -->
        </a>
      </div>
    </div>
    <div class="clearfix">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!--  <a class="navbar-brand" href="#">Brand</a> -->
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <?php $currentPage = basename($_SERVER['PHP_SELF']);?>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav center-block" style="text-align: center">
              <li class="<?php echo ($currentPage == "index.php")?"active":""?>">
                <a href="./index.php" title="Inicio">Inicio</a>
              </li>
              <li class="<?php echo ($currentPage == "initiative.php")?"active":""?>">
                <a href="./initiative.php" title="La iniciativa">¿Cómo funciona?</a>
              </li>
              <li class="<?php echo ($currentPage == "tool.php")?"active":""?>">
                <a href="./tool.php" title="La herramienta">La herramienta</a>
              </li>
              <li class="<?php echo ($currentPage == "contact.php")?"active":""?>">
                <a href="./contact.php" title="Contacto">Contacto</a>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>
  </header>