<?php include ('./lib/php/verifierCnx.php');?>
<?php
$tserv = new ServiceDB($cnx);
$servs = $tserv->getService();
if (isset($_GET['delet'])) {
    $tserv->delServ($_GET['delet']);
    print "<META http-equiv=\"refresh\": Content=\"0;URL=index.php?page=supserv\">";
}
?>
<div class="centrer">
    <h2 class="dblue">Suppression de service</h2>
</div>



<div class="div_aff_liste container textnorm">
    Liste des services : <br/><br/>
    <div class="row">
        <div class="txtGras col-lg-3 col-md-3 col-sm-3 hidden-xs">Nom</div> 
        <div class="txtGras col-lg-6 col-md-6 col-sm-6 hidden-xs">Description</div> 
        <div class="txtGras col-lg-3 col-md-3 col-sm-3 hidden-xs">Suppression</div> 
    </div>
    <br/>
    <?php
    for ($i = 0; $i < sizeof($servs); $i++) {
        ?>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3"><span class="visible-xs txtGras">Nom :</span><?php echo utf8_encode($servs[$i]->__get('nom')); ?></div> 
            <div class="col-lg-6 col-md-6 col-sm-6"><span class="visible-xs txtGras">Prénom :</span><?php echo utf8_encode($servs[$i]->__get('description')); ?></div> 
            <div class="col-lg-3 col-md-3 col-sm-3"><span class="visible-xs txtGras">Suppression :</span><a href="index.php?page=supserv&amp;delet=<?php echo $servs[$i]->__get('id_service'); ?>">Supprimer</a></div> 
        </div>
        <br/>
        <?php
    }
    ?>
</div>