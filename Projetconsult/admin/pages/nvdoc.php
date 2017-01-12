
<?php
//traitement php formulaire
$erreur = "";
if (isset($_POST['finaliser'])) {
    extract($_POST, EXTR_OVERWRITE);

    if (empty($email1) || empty($email2) || empty($nom) || empty($prenom) || empty($mdp1) || empty($mdp2) || empty($service)) {
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
                $log->creaDoc($email1, $mdp1, utf8_decode($nom), utf8_decode($prenom), $service);
                $okay = "Compte Créé";
            } else {
                $erreur = $erreur . "- Email déjà utilisé<br/>";
            }
        }
    }
}
$tserv = new ServiceDB($cnx);
$services = $tserv->getService();
?>
<div class="centrer">
    <h2 class="souligne dblue">Créer nouveau docteur</h2>
    <?php
    if (isset($okay))
        print "<h2 class='green'>" . $okay . "</h2>";
    ?>
</div>
<br/>
<div  class="textnorm div_form_intro">
    Veuillez entrer les données : <br/><br/>

    <div class="container ">
        <div class="row">
            <div class="col-sm-4 txtGras txtRouge" id="diverins2"> 
                <?php
                if (!empty($erreur))
                    print "<span>" . $erreur . "</span>";
                ?>
            </div>
            <br/>
        </div>
        <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_ajout_doc">

            <div class="row">
                <div class="col-sm-2"><label for="addoc_email1">Email</label></div>
                <div class="col-sm-4">
                    <input type="email" id="addoc_email1" name="email1" placeholder="aaa@aaa.aa"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2"><label for="addoc_email2" >Confirmez votre email</label></div>
                <div class="col-sm-4">
                    <input type="email" id="addoc_email2" name="email2" placeholder="aaa@aaa.aa"/>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-2"><label for="addoc_mdp1">Mot de passe</label></div>
                <div class="col-sm-4">
                    <input type="password" id="addoc_mdp1" name="mdp1"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2"><label for="addoc_mdp2">Confirmez votre mot de passe</label></div>
                <div class="col-sm-4">
                    <input type="password" id="addoc_mdp2" name="mdp2"/>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-2"><label for="addoc_nom">Nom</label></div>
                <div class="col-sm-4">
                    <input type="text" name="nom" id="addoc_nom" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"><label for="addoc_prenom">Prénom</label></div>
                <div class="col-sm-4">
                    <input type="text" name="prenom" id="addoc_prenom" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"><label for="addoc_service">Service</label></div>
                <div class="col-sm-4">
                    <select name="service" id="addoc_service">
                        <?php
                        for ($i = 0; $i < sizeof($services); $i++) {
                            echo '<option value="' . $services[$i]->__get('id_service') . '">' . utf8_encode($services[$i]->__get('nom')) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-sm-2 unpeuplace">
                    <input type="reset" id="addoc_reset" value="Annuler" />
                </div>
                <div class="col-sm-4 unpeuplace">
                    <input type="submit" name="finaliser" id="addoc_inscrire" value="Finaliser" />         
                </div>
            </div>
        </form>
    </div>
</div>
