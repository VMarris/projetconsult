<?php
require './lib/php/verifierCnxdoc.php';
$tvconsul = new Vue_ConsultationDB($cnx);
$consultations = $tvconsul->getConsulDoc($_SESSION['email']);
if (isset($_GET['chjrdv'])){
    $_SESSION['chjrdv']=$_GET['chjrdv'];
}else{
    $_SESSION['chjrdv']=date('Y-m-d');
}
?>
<div class="centrer">
    <h2 class="dblue">Liste des rendez-vous</h2>
</div>
<div id="div_aff_rdv" class="container textnorm">
    Sélectionnez la date : <br/>
    <a target="_blank" href="./pages/printrendezvous.php">Imprimer</a><br/>
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="GET" id="form_aff_rdv">
        <div class="centrer">

            <select name="chjrdv" id="chjrdv">
                <option value="<?php echo date('Y-m-d'); ?>" <?php
                if (isset($_GET['chjrdv']) && $_GET['chjrdv'] == date('Y-m-d')) {
                    echo'selected="selected"';
                }
                ?>>Aujourd'hui</option>
                        <?php
                        for ($i = 1; $i < 15; $i++) {
                            ?>                    
                    <option value="<?php echo date('Y-m-d', strtotime(' +' . $i . ' day')); ?>" <?php
                    if (isset($_GET['chjrdv']) && $_GET['chjrdv'] == date('Y-m-d', strtotime(' +' . $i . ' day'))) {
                        echo'selected="selected"';
                    }
                    ?>>
                                <?php echo date('Y-m-d', strtotime(' +' . $i . ' day')); ?>
                    </option>
                    <?php
                }
                ?>
            </select>  
            <input type="submit" name="choixjourdv" id="choixjourdv" class="unpeuplace unpeuplacecote" value="Valider" />         
        </div>
    </form>
    <br/>
    <br/>
    <div class="row">
        <div class="txtGras col-lg-4 col-md-3 col-sm-3 hidden-xs">Client</div> 
        <div class="txtGras col-lg-2 col-md-2 col-sm-2 hidden-xs">Jour</div> 
        <div class="txtGras col-lg-2 col-md-2 col-sm-2 hidden-xs">Heure</div> 
        <div class="txtGras col-lg-4 col-md-5 col-sm-5 hidden-xs">Commentaire</div> 
    </div>
    <br/>
    <?php
    for ($i = 0; $i < sizeof($consultations); $i++) {
        if (isset($_GET['chjrdv'])) {
            if ($consultations[$i]->__get('jour') == $_GET['chjrdv']) {
                ?>
                <div class="row">
                    <div class="col-lg-4 col-md-3 col-sm-3"><span class="visible-xs txtGras">Client :</span><?php echo utf8_encode($consultations[$i]->__get('nomcli')) . '<span class="hidden-sm"> ' . utf8_encode($consultations[$i]->__get('prenomcli')) . '</span>' ?></div> 
                    <div class="col-lg-2 col-md-2 col-sm-2"><span class="visible-xs txtGras">Jour :</span><?php echo $consultations[$i]->__get('jour') ?></div> 
                    <div class="col-lg-2 col-md-2 col-sm-2"><span class="visible-xs txtGras">Heure :</span><?php echo substr($consultations[$i]->__get('heure'), 0, 5) ?></div> 
                    <div class="col-lg-4 col-md-5 col-sm-5"><span class="visible-xs txtGras">Commentaire :</span><?php echo utf8_encode($consultations[$i]->__get('commentaire')) ?></div> 
                </div>
                <br/>
                <?php
            }
        } else {
            if ($consultations[$i]->__get('jour') == date('Y-m-d')) {
                ?>
                <div class="row">
                    <div class="col-lg-4 col-md-3 col-sm-3"><span class="visible-xs txtGras">Client :</span><?php echo utf8_encode($consultations[$i]->__get('nomcli')) . '<span class="hidden-md hidden-sm"> ' . utf8_encode($consultations[$i]->__get('prenomcli')) . '</span>' ?></div> 
                    <div class="col-lg-2 col-md-2 col-sm-2"><span class="visible-xs txtGras">Jour :</span><?php echo $consultations[$i]->__get('jour') ?></div> 
                    <div class="col-lg-2 col-md-2 col-sm-2"><span class="visible-xs txtGras">Heure :</span><?php echo substr($consultations[$i]->__get('heure'), 0, 5) ?></div> 
                    <div class="col-lg-4 col-md-5 col-sm-5"><span class="visible-xs txtGras">Commentaire :</span><?php echo utf8_encode($consultations[$i]->__get('commentaire')) ?></div> 
                </div>
                <?php
            }
        }
    }
    ?>
</div>
<br/>
<br/>




