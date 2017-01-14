<?php include ('./lib/php/verifierCnx.php');?>
<?php
$tdocteur = new DocteurDB($cnx);
$docteurs = $tdocteur->getAllDocteur();
$tserv = new ServiceDB($cnx);
if (isset($_GET['delet'])) {
    $tcompte = new CompteDB($cnx);
    $tcompte->delCompteDoc($_GET['delet']);
    print "<META http-equiv=\"refresh\": Content=\"0;URL=index.php?page=supdoc\">";
}
?>
<div class="centrer">
    <h2 class="dblue">Suppression de docteur</h2>
</div>



<div class="div_aff_liste container textnorm">
    Liste des docteurs : <br/><br/>
    <div class="row">
        <div class="txtGras col-lg-3 col-md-3 col-sm-3 hidden-xs">Nom</div> 
        <div class="txtGras col-lg-3 col-md-3 col-sm-3 hidden-xs">Prénom</div> 
        <div class="txtGras col-lg-3 col-md-3 col-sm-3 hidden-xs">Service</div> 
        <div class="txtGras col-lg-3 col-md-3 col-sm-3 hidden-xs">Suppression</div> 
    </div>
    <br/>
    <?php
    for ($i = 0; $i < sizeof($docteurs); $i++) {
        $services = $tserv->getServiceid($docteurs[$i]->__get('id_service'));
        ?>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3"><span class="visible-xs txtGras">Nom :</span><?php echo utf8_encode($docteurs[$i]->__get('nom')); ?></div> 
            <div class="col-lg-3 col-md-3 col-sm-3"><span class="visible-xs txtGras">Prénom :</span><?php echo utf8_encode($docteurs[$i]->__get('prenom')); ?></div> 
            <div class="col-lg-3 col-md-3 col-sm-3"><span class="visible-xs txtGras">Service :</span><?php echo utf8_encode($services[0]->__get('nom')); ?></div> 
            <div class="col-lg-3 col-md-3 col-sm-3"><span class="visible-xs txtGras">Suppression :</span><a href="index.php?page=supdoc&amp;delet=<?php echo $docteurs[$i]->__get('id_compte'); ?>">Supprimer</a></div> 

        </div>
        <br/>
        <?php
    }
    ?>
</div>