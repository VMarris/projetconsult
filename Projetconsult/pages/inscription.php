
<?php
//traitement php formulaire
$erreur = "";
if (isset($_POST['inscrire'])) {
    extract($_POST, EXTR_OVERWRITE);

    if (empty($email1) || empty($email2) || empty($nom) || empty($prenom) || empty($mdp1) || empty($mdp2)) {
        $erreur = "- Veuillez renseigner tous les champs";
    } else {
        $test = true;
        //vérific champ téléphone
        if (!empty($telephone) and preg_match("#[0-9]{3}\/[0-9]{2}\.[0-9]{2}\.[0-9]{2}#", $telephone) == false) {
            $erreur = $erreur . "- Entrez un numero de téléphone valide<br/>";
            $test = false;
        }
        if ($email1 != $email2) {
            $erreur = $erreur . "- Entrez deux e-mails identiques<br/>";
            $test = false;
        }
        if ($mdp1 != $mdp2) {
            $erreur = $erreur . "- Entrez deux mot de passe identiques<br/>";
            $test = false;
        }

        if ($test) {
            $log = new CompteDB($cnx);
            $retour = $log->exist($email1);
            $okay = "Inscription effectuée";
            if ($retour == "0") {
                $log->inscription($email1, $mdp1, utf8_decode($nom), utf8_decode($prenom), $telephone);
            } else {
                $erreur = $erreur . "- Email déjà utilisé<br/>";
            }
        }
    }
}
?>
<div class="centrer">
    <h2 class="souligne dblue">Inscription</h2>
    <?php
    if (isset($okay))
        print "<h2 class='green'>" . $okay . "</h2>";
    ?>
</div>
<br/>
<div id="div_form_inscript" class="textnorm">
    Veuillez entrer vos coordonnées : <br/><br/>

    <div class="container ">
        <div class="row">
            <div class="col-sm-4 txtGras txtRouge" id="diverins"> 
                <?php
                if (!empty($erreur))
                    print "<span>" . $erreur . "</span>";
                ?>
            </div>
            <br/>
        </div>
        <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_inscription">

            <div class="row">
                <div class="col-sm-2"><label for="email1">Email</label></div>
                <div class="col-sm-4">
                    <input type="email" id="email1" name="email1" placeholder="aaa@aaa.aa"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2"><label for="email2" >Confirmez votre email</label></div>
                <div class="col-sm-4">
                    <input type="email" id="email2" name="email2" placeholder="aaa@aaa.aa"/>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-2"><label for="mdp1">Mot de passe</label></div>
                <div class="col-sm-4">
                    <input type="password" id="mdp1" name="mdp1"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2"><label for="mdp12">Confirmez votre mot de passe</label></div>
                <div class="col-sm-4">
                    <input type="password" id="mdp2" name="mdp2"/>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-2"><label for="nom">Nom</label></div>
                <div class="col-sm-4">
                    <input type="text" name="nom" id="nom" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"><label for="prenom">Prénom</label></div>
                <div class="col-sm-4">
                    <input type="text" name="prenom" id="prenom" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"><label for="telephone">Téléphone</label></div>
                <div class="col-sm-4">
                    <input type="text" name="telephone" id="telephone" placeholder="xxx/xx.xx.xx"/>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-sm-2 unpeuplace">
                    <input type="reset" id="reset" value="Annuler" />
                </div>
                <div class="col-sm-4 unpeuplace">
                    <input type="submit" name="inscrire" id="inscrire" value="Finaliser mon inscription" />         
                </div>
            </div>
        </form>
    </div>
</div>
