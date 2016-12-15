<?php
if (isset($_GET['depart'])) {
    $_SESSION['connexion'] = NULL; //Deconnexion
}
if (isset($_POST['envoyer']) != NULL && isset($_POST['email']) != NULL && isset($_POST['mdp']) != NULL) {
    $log = new CompteDB($cnx);
    $retour = $log->isAuthorized($_POST['email'], $_POST['mdp']);
    if ($retour > 0) {
        $_SESSION['connexion'] = $retour;
    } else {
        print '<span class="txtRouge">Identifiant incorrect</span>';
    }
}
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
    echo "<br/>";
    ?><br/><a href="index.php?page=accueil&amp;depart=deconnect" >Déconnexion</a><?php
}
?>