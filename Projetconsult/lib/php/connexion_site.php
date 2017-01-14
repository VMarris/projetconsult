<?php
if (isset($_GET['depart'])) {
    $_SESSION['connexion'] = NULL; //Deconnexion
    $_SESSION['email'] = NULL;
}
if (isset($_POST['envoyer']) != NULL && isset($_POST['email']) != NULL && isset($_POST['mdp']) != NULL) {
    $log = new CompteDB($cnx);
    $retour = $log->isAuthorized($_POST['email'], $_POST['mdp']);
    if ($retour > 0) {
        setcookie("connexion", " ", time() + -20);
        setcookie("time", " ", time() -20);
        $_SESSION['connexion'] = $retour;
        $_SESSION['email'] = $_POST['email'];
        if ($retour == "3") {
            print "<META http-equiv=\"refresh\": Content=\"0;URL=admin/index.php?page=accueil\">";
        }
    } else {
        if (!isset($_COOKIE['connexion'])) {
            setcookie("connexion", "1", time() + 60 * 15);
            setcookie("time", time() + 60 * 15, time() + 60 * 15);
        } else {
            if ($_COOKIE['connexion'] == "1") {
                setcookie("connexion", "2");
            } else {
                setcookie("connexion", "3");
                print "<META http-equiv=\"refresh\": Content=\"0;URL=index.php?page=accueil\">";
            }
        }
        print '<span class="txtRouge">Identifiant incorrect</span>';
    }
}
$tcook = true;
if (!isset($_COOKIE['time'])) {
    if (isset($_COOKIE['connexion'])) {
        setcookie("connexion", "", time() - 10);
        print "<META http-equiv=\"refresh\": Content=\"0;URL=index.php?page=accueil\">";
    }
}
if (isset($_COOKIE['connexion'])) {
    if ($_COOKIE['connexion'] == "3") {
        $tcook = false;
    }
}
if ($tcook) {
//si on est pas connecté
    if (!isset($_SESSION['connexion'])) {
        ?>

        <form action="index.php" method="post">
            <label class="lab_conex" for="email">Email :</label>
            <input type="email" name="email" id="email_conex" /><br/>
            <label class="lab_conex" for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp_conex" />
            <br/>
            <a href="index.php?page=inscription">S'incrire</a>&emsp;&emsp;&emsp;
            <input type="hidden" name="page" value="accueil" />
            <input type="submit" class="btn" value="Confirmer" name="envoyer"/>
        </form>

        <?php
    }//affichange nom et prénom
    else {
        echo "<br/>" . $_SESSION['email'];
        ?><br/><a href="index.php?page=accueil&amp;depart=deconnect" >Déconnexion</a><?php
    }
} else {
    echo "<br/>Nombre de tentative de connexion dépassé <br/> revenez dans un quart d'heure";
}
?>