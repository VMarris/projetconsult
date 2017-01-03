<?php  require './lib/php/verifierCnx.php'; ?>
<div class="centrer">
    <h2 class="dblue">Votre compte</h2>
    <h3>Ajouter regex + envois serveur</h3>
    <br/><br/>
</div>
<?php
$log = new CompteDB($cnx);
$retour = $log->getCompte($_SESSION['email']);
?>
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
            <br/><br/>
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
            <br/>
            modifier votre numéro de téléphone : 
            <br/><br/>
            <div class="row">
                <div class="col-sm-2"><label for="telephone">Téléphone</label></div>
                <div class="col-sm-4">
                    <input type="text" name="telephone" id="telephone" placeholder="xxx/xx.xx.xx" value="<?php print utf8_encode($retour[0]->__get('telephone')); ?>"/>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-sm-2 unpeuplace">
                    <input type="reset" id="reset" value="Annuler" />
                </div>
                <div class="col-sm-4 unpeuplace">
                    <input type="submit" name="commander" id="inscrire" value="Finaliser mon inscription" />         
                </div>
            </div>
        </form>
    </div>
</div>