<?php
  if(!isset($_SESSION['connexion'])) {
     print "ACCES RESERVE";
     print "<META http-equiv=\"refresh\": Content=\"2;URL=index.php?page=accueil\">";    
     exit();
  }