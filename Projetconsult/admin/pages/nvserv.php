<?php include ('./lib/php/verifierCnx.php');?>
<?php
$erreur = "";
if (isset($_POST['finaliser'])) {
    extract($_POST, EXTR_OVERWRITE);

    if (empty($nom) || empty($description)) {
        $erreur = "- Veuillez renseigner tous les champs";
    } else {
        $tserv = new ServiceDB($cnx);
        $tserv->creaServ(utf8_decode($nom),utf8_decode($description));
        $okay = "Service Créé";
    }
}
?>
<div class="centrer">
    <h2 class="souligne dblue">Créer nouveau service</h2>
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
            <div class="col-sm-4 txtGras txtRouge"> 
                <?php
                if (!empty($erreur))
                    print "<span>" . $erreur . "</span>";
                ?>
            </div>
            <br/>
        </div>
        <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_ajout_serv">

            <div class="row">
                <div class="col-sm-2"><label for="adserv_nom">Nom</label></div>
                <div class="col-sm-4">
                    <input type="text" id="adserv_nom" name="nom" />
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-sm-2"><label for="adserv_descri" >Description du service</label></div>
                <div class="col-sm-4">
                    <textarea name="description" id="adserv_descri" rows="5" cols="25"></textarea>  
                </div>
            </div> 
            <br/>
            <div class="row">
                <div class="col-sm-2 unpeuplace">
                    <input type="reset" id="adserv_reset" value="Annuler" />
                </div>
                <div class="col-sm-4 unpeuplace">
                    <input type="submit" name="finaliser" id="adserv_inscrire" value="Finaliser" />         
                </div>
            </div>
        </form>
    </div>
</div>
