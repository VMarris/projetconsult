<?php require './lib/php/verifierCnx.php';?>

<?php
$log = new CompteDB($cnx);
$retour = $log->getCompte($_SESSION['email']);

if (isset($_POST['changercompte'])) {
    extract($_POST, EXTR_OVERWRITE);
    $test = true;
    $tstpassword=false;
    $tsttele=false;
    if (!empty($mdp1) && !empty($mdp2)) {
        if ($mdp1 != $mdp2) {
            $erreur_mdp = "Entrez deux mot de passe identiques<br/>";
            $test = false;
        }else{
            $tstpassword=true;
        }
    }
    if ($retour[0]->__get('telephone') != $telephone) {
        if (!empty($telephone) and preg_match("#[0-9]{3}\/[0-9]{2}\.[0-9]{2}\.[0-9]{2}#", $telephone) == false) {
            $erreur_tel = "Entrez un numero de téléphone valide<br/>";
            $test = false;
        }else{
            $tsttele=true;
        }
    }
    if ($test) {
        $okay="";
        if($tstpassword){
            $log->updatemdp($retour[0]->__get('id_compte'),$mdp1);
            $okay=$okay."mot de passe modifié<br/>";
        }
        if($tsttele){
            $log->updatetel($retour[0]->__get('id_compte'),$telephone);
            $okay=$okay."téléphone modifié";
            $retour[0]->__set('telephone',$telephone);
        }
    }
}
?>
<div class="centrer">
    <h2 class="dblue">Votre compte</h2>
    <?php
    if (isset($okay))
        print "<h4 class='green'>" . $okay . "</h2>";
    ?>
    <br/><br/>
</div>


<div id="div_form_change_compte" class="textnorm">
    Vos coordonées : <br/><br/>

    <div class="container ">
        <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_change_compte">

            <div class="row">
                <div class="col-sm-2"><span class="txtGras">Email</span></div>
                <div class="col-sm-4">
                    <span class="txtGras">
                        <?php
                        print utf8_encode($retour[0]->__get('mail'));
                        ?>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"><span class="txtGras">Nom</span></div>
                <div class="col-sm-4">
                    <span class="txtGras">
                        <?php
                        print utf8_encode($retour[0]->__get('nom'));
                        ?>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"><span class="txtGras">Prénom</span></div>
                <div class="col-sm-4">
                    <span class="txtGras">
                        <?php
                        print utf8_encode($retour[0]->__get('prenom'));
                        ?>
                    </span>
                </div>
            </div>
            <br/>
            modifier votre mot de passe : 
            <div class="row">
            <div class="col-sm-4 txtGras txtRouge" id="diverins"> 
                <?php
                if (isset($erreur_mdp))
                    print "<span>" . $erreur_mdp . "</span>";
                ?>
            </div>
        </div>
            <br/><br/>
            <div class="row">
                <div class="col-sm-2"><label for="mdp1">Mot de passe</label></div>
                <div class="col-sm-4">
                    <input type="password" id="mdp1_change" name="mdp1"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2"><label for="mdp12">Confirmez votre mot de passe</label></div>
                <div class="col-sm-4">
                    <input type="password" id="mdp2_change" name="mdp2"/>
                </div>
            </div> 
            <br/>
            modifier votre numéro de téléphone : 
            <div class="row">
            <div class="col-sm-4 txtGras txtRouge" id="diverins"> 
                <?php
                if (isset($erreur_tel))
                    print "<span>" . $erreur_tel . "</span>";
                ?>
            </div>
        </div>
            <br/><br/>
            <div class="row">
                <div class="col-sm-2"><label for="telephone">Téléphone</label></div>
                <div class="col-sm-4">
                    <input type="text" name="telephone" id="telephone_change" placeholder="xxx/xx.xx.xx" value="<?php print utf8_encode($retour[0]->__get('telephone')); ?>"/>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-sm-2 unpeuplace">
                    <input type="reset" id="reset" value="Annuler" />
                </div>
                <div class="col-sm-4 unpeuplace">
                    <input type="submit" name="changercompte" id="changercompte" value="Modifier" />         
                </div>
            </div>
        </form>
    </div>
</div>