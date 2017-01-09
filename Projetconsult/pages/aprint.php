<link rel="stylesheet" type="text/css" href="../admin/lib/css/style.css"/> 
<?php
session_start();
require '../lib/php/verifierCnx.php';
include('../admin/lib/php/dbConnect.php');
include('../admin/lib/php/classes/Vue_ConsultationDB.class.php');
include('../admin/lib/php/classes/Vue_Consultation.class.php');
include('../admin/lib/php/classes/Connexion.class.php');

$cnx = Connexion::getInstance($dsn, $user, $pass);
$tvconsul = new Vue_ConsultationDB($cnx);
$consultations = $tvconsul->getConsul($_SESSION['email']);
?>
<page>
    <div class="centrer">
        <h2 class="dblue souligne">Vos Rendez-vous</h2>
    </div>
    <br/>
    <br/>
    <table class="textnorm margauto">
            <tr>
                <th class="tdnorm centrer">Docteur</th> 
                <th class="tdnorm centrer" >Jour</th> 
                <th class="tdnorm centrer">Heure</th> 
                <th class="td4 centrer">Commentaire</th> 
            </tr>
            <br/>
            <?php
            for ($i = 0; $i < sizeof($consultations); $i++) {
                ?>
                <tr class="trligne">
                    <td class="tdnorm"><?php echo utf8_encode($consultations[$i]->__get('nom')) . ' ' . utf8_encode($consultations[$i]->__get('prenom')); ?></td> 
                    <td class="tdnorm centrer"><?php echo $consultations[$i]->__get('jour') ?></td> 
                    <td class="tdnorm centrer"><?php echo substr($consultations[$i]->__get('heure'), 0, 5) ?></td> 
                    <td class="td4 centrer"><?php echo utf8_encode($consultations[$i]->__get('commentaire')) ?></td>   
                </tr>
                <?php
            }
            ?>
    </table>

</page>



