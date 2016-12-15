<div class="centrer">
    <h2 class="textnorm dblue">Inscription</h2>
</div>
<?php
//traitement php formulaire
if (isset($_GET['commander'])) {
    extract($_GET, EXTR_OVERWRITE);

    if (empty($email1) || empty($email2) || empty($nom) || empty($prenom) || empty($telephone) || empty($mdp1) || empty($mdp2)) {
        $erreur = "<span class='txtGras txtRouge'>Veuillez renseigner tous les champs</span>";
    } else {
        //vérific champ téléphone
        if (preg_match("#[0-9]{3}\/[0-9]{2}\.[0-9]{2}\.[0-9]{2}#", $telephone) == true) {
            print "ok";
        } else
            print "non";

        //appel procédure

        print "ok";
    }
}
?>

    <div id="div_form_inscript">
        Veuillez entrer vos coordonnées : <br/><br/>

        <div class="container ">
            <div class="row">
                <div class="col-sm-4">
                <?php
                if (isset($erreur))
                    print $erreur;
                ?>
                </div>
            </div>
            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get" id="form_commande">

                <div class="row">
                    <div class="col-sm-2"><label for="email1">Email</label></div>
                    <div class="col-sm-4">
                        <input type="email" id="email1" name="email1" placeholder="aaa@aaa.aa"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2"><label for="email2">Confirmez votre email</label></div>
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
                        <input type="submit" name="commander" id="commander" value="Finaliser mon inscription" />&nbsp;           
                    </div>
                </div>
            </form>
        </div>
    </div>
