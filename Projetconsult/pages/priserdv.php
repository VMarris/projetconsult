<?php
require './lib/php/verifierCnx.php';
if (!isset($_GET['service_id']) && !isset($_POST['service_id'])) {
    print "Aucun service sélectionné";
    print "<META http-equiv=\"refresh\": Content=\"2;URL=index.php?page=accueil\">";
    exit();
}
if (isset($_GET['service_id'])) {
    $serv = $_GET['service_id'];
}
if (isset($_POST['service_id'])) {
    $serv = $_POST['service_id'];
}

$tdoc = new DocteurDB($cnx);
$docteurs = $tdoc->getDocteur($serv);
$tserv = new ServiceDB($cnx);
$services = $tserv->getServiceid($serv);
if ($docteurs == null || $services == null) {
    echo '<span class="txtRouge txtGras">Service non reconnus</span><br/>';
    exit();
}
?>
<div class="centrer">
    <h2 class="dblue">Prise de rendez-vous</h2>
    <h4 class="dblue">service <?php echo utf8_encode($services[0]->__get('nom')) ?></h4>
    <br/>
</div>
<?php
if (isset($_POST['valrdv'])) {
    $tconsul = new ConsultationDB($cnx);
    $tconsul->inserConsul(date('Y-m-d', strtotime($_POST['jourrdv'])), $_POST['txta_com'], $_POST['docteur'], $_POST['heure'], $_SESSION['email']);
    ?>
    <div class="centrer">
        <h4 class="green">Consultation enregistrée</h4>
        <br/>
        <?php
        print "<META http-equiv=\"refresh\": Content=\"2;URL=index.php?page=accueil\">";
        ?>
    </div>
    <?php
} else {
    ?>
    <div id="div_aff_docteur" class="container textnorm ">
        <?php
        $testrdv = true;
        $erreur = "";
        if (isset($_POST['suiterdv'])) {
            if (isset($_POST['docteur']) || isset($_POST['jourrdv'])) {
                if (empty($_POST['docteur'])) {
                    $testrdv = false;
                    $erreur = "- Selectionnez un Docteur<br/>";
                }
                if (empty($_POST['jourrdv']) || preg_match("#[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}#", $_POST['jourrdv']) == false) {
                    $erreur = $erreur . "- Entrez un format de date valide";
                    $testrdv = false;
                } else {
                    $datt = explode("-", $_POST['jourrdv']);
                    if (!checkdate(intval($datt[1]), intval($datt[2]), intval($datt[0]))) {
                        $erreur = $erreur . "- Entrez une date valide";
                        $testrdv = false;
                    }

                    if ($testrdv) {
                        if (date('Y-m-d', strtotime($_POST['jourrdv'])) <= date('Y-m-d')) {
                            $erreur = $erreur . "- Entrez une date postérieur à aujourd'hui";
                            $testrdv = false;
                        }
                        if (date('l', strtotime($_POST['jourrdv'])) =="Sunday") {
                            $erreur = $erreur . "- Entrez une date qui n'est pas un dimanche";
                            $testrdv = false;
                        }
                    }
                }
            } else {
                $testrdv = false;
            }
        } else {
            $testrdv = false;
        }
        if (!$testrdv) {
            if (!empty($erreur)) {
                echo '<span class="txtRouge txtGras">' . $erreur . '</span><br/>';
            }
            if (sizeof($docteurs) > 0) {
                ?>
                Choississez votre docteur :<br/><br/>
                <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_choix_rdv">
                    <div class="row ">
                        <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs "></div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-112 divspe">
                            <input type="radio" name="docteur" class="radspe" value="<?php echo $docteurs[0]->__get('id_docteur'); ?>" id="<?php
                            echo utf8_encode($docteurs[0]->__get('nom'));
                            echo $docteurs[0]->__get('id_docteur');
                            ?>" checked="checked"/>

                            <label for="<?php
                            echo utf8_encode($docteurs[0]->__get('nom'));
                            echo $docteurs[0]->__get('id_docteur');
                            ?>" class="labspe">
                                <div class="check"></div>
                                <span class="txtGras">
                                    <?php echo utf8_encode($docteurs[0]->__get('nom')); ?>
                                </span>
                                <span class="nonGras">
                                    <?php echo utf8_encode($docteurs[0]->__get('prenom')); ?>
                                </span>
                            </label>
                        </div>
                    </div><?php
                    for ($i = 1; $i < sizeof($docteurs); $i++) {
                        ?>
                        <div class="row ">
                            <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs "></div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-112 divspe">
                                <input type="radio" name="docteur" class="radspe" value="<?php echo $docteurs[$i]->__get('id_docteur'); ?>" id="<?php
                                echo utf8_encode($docteurs[$i]->__get('nom'));
                                echo $docteurs[$i]->__get('id_docteur');
                                ?>"/>

                                <label for="<?php
                                echo utf8_encode($docteurs[$i]->__get('nom'));
                                echo $docteurs[$i]->__get('id_docteur');
                                ?>" class="labspe">
                                    <div class="check"></div>
                                    <span class="txtGras">
                                        <?php echo utf8_encode($docteurs[$i]->__get('nom')); ?>
                                    </span>
                                    <span class="nonGras">
                                        <?php echo utf8_encode($docteurs[$i]->__get('prenom')); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <br/>
                        <?php
                    }
                    ?>
                    <br/>
                    Choississez votre jour : <br/><br/>
                    <div class="centrer">
                        <input type="date" name="jourrdv" placeholder="aaaa-mm-jj"/>
                    </div>
                    <div class="row centrer">
                        <input type="hidden" name="service_id" value="<?php echo $serv ?>"/>
                        <input type="reset" id="reset" value="Annuler" />         
                        <input type="submit" name="suiterdv" id="suiterdv" class="unpeuplace unpeuplacecote" value="Suite" />         
                    </div>
                </form>
                <?php
            } else {
                echo '<span class="txtRouge txtGras">Plus de docteur disponibles pour ce service</span><br/>';
            }
        } else {
            $thor = new HoraireDB($cnx);
            $horaires = $thor->getHoraires($_POST['docteur'], date('Y-m-d', strtotime($_POST['jourrdv'])));
            if (sizeof($horaires) == 0) {
                echo '<span class="txtRouge txtGras">Plus d\'heures disponibles pour ce jour</span><br/>';
            } else {
                ?>
                <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_choix_rdv2">
                    <br/>
                    Selectionnez l'heure : 
                    <div class="row centrer">
                        <select name="heure" id="rdvheure">
                            <?php
                            for ($i = 0; $i < sizeof($horaires); $i++) {
                                echo '<option value="' . $horaires[$i]->__get('id_horraire') . '">' . $horaires[$i]->__get('heure') . '</option>';
                            }
                            ?>
                        </select>
                        <br/>
                        <br/>
                    </div>
                    Commentaire : <br/>
                    <div class="row centrer">
                        <textarea name="txta_com" id="txta_com" rows="5" cols="25"></textarea>            
                        <br/>
                        <br/>
                        <input type="hidden" name="service_id" value="<?php echo $serv ?>"/>
                        <input type="hidden" name="docteur" value="<?php echo $_POST['docteur'] ?>"/>
                        <input type="hidden" name="jourrdv" value="<?php echo $_POST['jourrdv'] ?>"/>
                        <input type="submit" name="valrdv" id="valrdv" class="unpeuplace" value="Valider" />      
                    </div>
                </form>
                <?php
            }
            echo '<a href="index.php?page=priserdv&amp;service_id=' . $serv . '" >Retour</a>';
        }
        ?>
    </div><?php
}

