<?php if (!isset($_SESSION['connexion'])) {
    print "ACCES RESERVE";
    print "<META http-equiv=\"refresh\": Content=\"2;URL=../index.php?page=accueil\">";
    exit();
} else {
    if ($_SESSION['connexion'] != "3") {
        print "ACCES RESERVE";
        print "<META http-equiv=\"refresh\": Content=\"2;URL=../index.php?page=accueil\">";
        exit();
    }
}?>
<?php
//traitement php formulaire
$erreur = "";
if (isset($_POST['finaliser'])) {
    extract($_POST, EXTR_OVERWRITE);

    if (empty($email1) || empty($email2) || empty($mdp1) || empty($mdp2)) {
        $erreur = "- Veuillez renseigner tous les champs";
    } else {
        $test = true;
        if ($email1 != $email2) {
            $erreur = $erreur . "- Entrez deux e-mails identiques<br/>";
            $test = false;
        }
        if ($mdp1 != $mdp2) {
            $erreur = $erreur . "- Entrez deux mot de passe identiques<br/>";
            $test = false;
        }

        if ($test) {
            $tcompte = new CompteDB($cnx);
            $retour = $tcompte->exist($email1);
            if ($retour == "0") {
                $log = new CompteDB($cnx);
                $log->creaAdm($email1, $mdp1);
                $okay = "Compte Créé";
            } else {
                $erreur = $erreur . "- Email déjà utilisé<br/>";
            }
        }
    }
}

?>
<div class="centrer">
    <h2 class="souligne dblue">Créer nouveau administrateur</h2>
    <?php
    if (isset($okay))
        print "<h2 class='green'>" . $okay . "</h2>";
    ?>
</div>
<br/>
<div class="textnorm div_form_intro">
    Veuillez entrer les données : <br/><br/>

    <div class="container ">
        <div class="row">
            <div class="col-sm-4 txtGras txtRouge" id="diverins3"> 
                <?php
                if (!empty($erreur))
                    print "<span>" . $erreur . "</span>";
                ?>
            </div>
            <br/>
        </div>
        <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_ajout_adm">

            <div class="row">
                <div class="col-sm-2"><label for="adadm_email1">Email</label></div>
                <div class="col-sm-4">
                    <input type="email" id="adadm_email1" name="email1" placeholder="aaa@aaa.aa"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2"><label for="adadm_email2" >Confirmez votre email</label></div>
                <div class="col-sm-4">
                    <input type="email" id="adadm_email2" name="email2" placeholder="aaa@aaa.aa"/>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-2"><label for="adadm_mdp1">Mot de passe</label></div>
                <div class="col-sm-4">
                    <input type="password" id="adadm_mdp1" name="mdp1"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2"><label for="adadm_mdp2">Confirmez votre mot de passe</label></div>
                <div class="col-sm-4">
                    <input type="password" id="adadm_mdp2" name="mdp2"/>
                </div>
            </div> 
            <br/>
            <div class="row">
                <div class="col-sm-2 unpeuplace">
                    <input type="reset" id="adadm_reset" value="Annuler" />
                </div>
                <div class="col-sm-4 unpeuplace">
                    <input type="submit" name="finaliser" id="adadm_inscrire" value="Finaliser" />         
                </div>
            </div>
        </form>
    </div>
</div>
