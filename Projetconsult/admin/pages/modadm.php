<?php include ('./lib/php/verifierCnx.php');?>
<?php
$log = new CompteDB($cnx);


if (isset($_POST['changercompte'])) {
    extract($_POST, EXTR_OVERWRITE);
    $test = true;

    if (!empty($mdp1) && !empty($mdp2)) {
        if ($mdp1 != $mdp2) {
            $erreur_mdp = "Entrez deux mot de passe identiques<br/>";
            $test = false;
        }
    }
    if ($test) {
        $okay = "";
        $log->updatemdpadm($_SESSION['email'], $mdp1);
        $okay = $okay . "mot de passe modifié<br/>";
    }
}
?>
<div class="centrer">
    <h2 class="dblue">Modification du mot de passe</h2>
    <?php
    if (isset($okay))
        print "<h4 class='green'>" . $okay . "</h2>";
    ?>
    <br/><br/>
</div>


<div id="div_form_change_adm" class="textnorm div_form_change">

    <div class="container ">
        <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_change_compteadm">
            <div class="row">
                <div class="col-sm-4 txtGras txtRouge"> 
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
                    <input type="password" id="mdp1__modadm" name="mdp1"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2"><label for="mdp12">Confirmez votre mot de passe</label></div>
                <div class="col-sm-4">
                    <input type="password" id="mdp2__modadm" name="mdp2"/>
                </div>
            </div> 
            <br/>
            <div class="row">
                <div class="col-sm-2 unpeuplace">
                    <input type="reset" id="reset_modadm" value="Annuler" />
                </div>
                <div class="col-sm-4 unpeuplace">
                    <input type="submit" name="changercompte" id="changercompte_modadm" value="Modifier" />         
                </div>
            </div>
        </form>
    </div>
</div>