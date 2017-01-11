<?php
require './lib/php/verifierCnx.php';
if (isset($_GET['supprim'])) {
    $tconsul = new ConsultationDB($cnx);
    $bool = $tconsul->delConsul($_GET['supprim'], $_SESSION['email']);
    if (!$bool) {
        echo '<span class="txtRouge txtGras">Ce rendez-vous ne vous appartien pas</span><br/>';
    }
    print "<META http-equiv=\"refresh\": Content=\"0;URL=index.php?page=gestionrdv\">";
}
$tvconsul = new Vue_ConsultationDB($cnx);
$consultations = $tvconsul->getConsul($_SESSION['email']);
?>
<div class="centrer">
    <h2 class="dblue">Gestion des rendez-vous</h2>
</div>



<div id="div_aff_rdv" class="container textnorm">
    <a target="_blank" href="./pages/printrendezvous.php">Imprimer</a><br/><br/>
    Rendez-vous à venir : <br/><br/>
    <div class="row">
        <div class="txtGras col-lg-3 col-md-2 col-sm-2 hidden-xs">Docteur</div> 
        <div class="txtGras col-lg-2 col-md-2 col-sm-2 hidden-xs">Jour</div> 
        <div class="txtGras col-lg-1 col-md-2 col-sm-2 hidden-xs">Heure</div> 
        <div class="txtGras col-lg-4 col-md-4 col-sm-4 hidden-xs">Commentaire</div> 
        <div class="txtGras col-lg-2 col-md-2 col-sm-2 hidden-xs">Supprimer</div> 
    </div>
    <br/>
    <?php
    for ($i = 0; $i < sizeof($consultations); $i++) {
        ?>
        <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-2"><span class="visible-xs txtGras">Docteur :</span><?php echo utf8_encode($consultations[$i]->__get('nom')) . '<span class="hidden-md hidden-sm"> ' . utf8_encode($consultations[$i]->__get('prenom')) . '</span>' ?></div> 
            <div class="col-lg-2 col-md-2 col-sm-2"><span class="visible-xs txtGras">Jour :</span><?php echo $consultations[$i]->__get('jour') ?></div> 
            <div class="col-lg-1 col-md-2 col-sm-2"><span class="visible-xs txtGras">Heure :</span><?php echo substr($consultations[$i]->__get('heure'), 0, 5) ?></div> 
            <div class="col-lg-4 col-md-4 col-sm-4"><span class="visible-xs txtGras">Commentaire :</span><?php echo utf8_encode($consultations[$i]->__get('commentaire')) ?></div> 
            <?php
            $datum = $consultations[$i]->__get('jour');
            if (date('Y-m-d', strtotime($datum)) == date('Y-m-d')) {
                $petitun = 1;
                ?>
                <div class="col-lg-2 col-md-2 col-sm-2"><span class="visible-xs txtGras">Supprimer :</span><span class="txtRouge">Impossible<sup>1</sup></span></div> 
                <?php
            } else {
                ?>
                <div class="col-lg-2 col-md-2 col-sm-2"><span class="visible-xs txtGras">Supprimer :</span><a href="index.php?page=gestionrdv&amp;supprim=<?php echo $consultations[$i]->__get('id_consultation'); ?>">Annulation</a></div> 
                <?php
            }
            ?>
        </div>
        <br/>
        <?php
    }
    ?>
</div>
<br/>
<br/>
<?php if (isset($petitun)) { ?>
    1 : il est n'est pas possible d'annuler un rendez-vous le jour même via le site, pour annuler veuillez contactez le secrétariat.
<?php } ?>



