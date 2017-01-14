<?php

if (!isset($_SESSION['connexion'])) {
    print "ACCES RESERVE";
    print "<META http-equiv=\"refresh\": Content=\"2;URL=index.php?page=accueil\">";
    exit();
} else {
    if ($_SESSION['connexion'] != "1") {
        print "ACCES RESERVE";
        print "<META http-equiv=\"refresh\": Content=\"2;URL=index.php?page=accueil\">";
        exit();
    }
}
