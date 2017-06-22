<?php
$content=(isset($_GET['content'])) ? $_GET['content'] : "proj";

require_once "php/config.php";
require_once "php/Database.php";
require_once "php/request.php";
require_once "php/htmlMaker.php";

include "languages/it_IT.php";
include "includes/header.php";
switch($content)
{
  case "map":
    include "includes/mappa.php";
    include "includes/grafici.php";
    break;
  case "proj":
    include "includes/progetto.php";
    break;
  case "xk":
    include "includes/perche.php";
    break;
  case "cred":
    include "includes/credits.php";
    break;
  case "mail":
    include "includes/contact.php";
    break;
}
include "includes/footer.php";
?>