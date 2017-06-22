<!DOCTYPE html>
<!-- saved from url=(0030)https://bootswatch.com/flatly/ -->
<html lang="it" prefix="og: http://ogp.me/ns#">
  <head>
    <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
    <meta http-equiv="Content-Language" content="italian">
    <title><?= $_['headTitle'] ?></title>
    <meta name="robots" content="index,follow">
    <meta name="description" content="<?= $_['headDescription'] ?>">
    <meta name="keywords" content="<?= $_['headKeywords'] ?>">
    <meta name="Resource-type" content="Document">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta property="og:site_name" content="Doranea" />
    <meta property="fb:app_id" content="1817282745267578" />
    <meta property="og:title" content="Doranea - Mappa Interattiva sull'immigrazione in Piemonte" />
    <meta property="og:url" content="http://doranea.altervista.org/" />
    <meta property="og:image" content="http://doranea.altervista.org/img/Logo%20_color_Medio.png" />
    <meta property="og:image:width" content="360px" />
    <meta property="og:image:height" content="404px" />
    <meta property="og:description" content="Mappa interattiva in grado di visualizzare i flussi migratori dal mondo verso la regione Piemonte utilizzando dati pubblici e tecnologie Opensource" />
    <meta property="og:locale" content="it_IT" />

    <meta name="twitter:card" content="summary" />
    <meta property="twitter:title" content="Doranea - Mappa Interattiva sull'immigrazione in Piemonte" />
    <meta property="twitter:type" content="business.business" />
    <meta property="twitter:url" content="http://doranea.altervista.org/" />
    <meta property="twitter:image" content="http://doranea.altervista.org/img/Logo%20_color_Medio.png" />
    <meta property="twitter:description" content="Mappa interattiva in grado di visualizzare i flussi migratori dal mondo verso la regione Piemonte utilizzando dati pubblici e tecnologie Opensource" />
    <meta property="twitter:locale" content="it_IT" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/custom.min.css">
    <link rel="stylesheet" href="css/simple-sidebar.css">
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css" rel="stylesheet" type="text/css" />
	<script src="https://www.google.com/recaptcha/api.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <style>
      .slider-tick{
        display:none;
      }
      #sidebar-wrapper{
        display:none;
      }
      .imgprog{
        background-image: url(../img/progetto<?=rand(1,2)?>.jpg);
      }
    </style>
  </head>
  <body>
    <!-- facebook sdk -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v2.9&appId=1817282745267578";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- end facebook sdk -->
    <!-- topbar -->
    <div class="navbar navbar-default navbar-fixed-top" itemscope itemtype="http://schema.org/WPHeader">
      <div class="container">
        <div class="navbar-header">
          <div class="logo">
            <img src="img/logoverdesmall.png"/ alt="Logo Doranea">
          </div>
          <a href="index.php" class="navbar-brand" title="<?=$_['menuProgettoTitle']?>"><?= $_['menuProgetto'] ?></a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li>
              <a href="index.php?content=map" title="<?= $_['menuMappaTitle'] ?>"><?= $_['menuMappa'] ?></a>
            </li>
            <li>
              <a href="index.php?content=xk" title="<?=$_['menuPercheTitle']?>"><?= $_['menuPerche'] ?></a>
            </li>
            <li>
              <a href="index.php?content=cred" title="<?= $_['menuCreditsTitle'] ?>"><?= $_['menuCredits'] ?></a>
            </li>
            <li>
              <a href="index.php?content=mail" title="<?= $_['menuContattiTitle'] ?>"><?= $_['menuContatti'] ?></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- end topbar -->
    <div class="container">