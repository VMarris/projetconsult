<?php
$tcompte = new CompteDB($cnx);
$clients = $tcompte->getAllCompte();

if (isset($_GET['delet'])) {
    $tcompte = new CompteDB($cnx);
    $tcompte->delCompteCli($_GET['delet']);
    print "<META http-equiv=\"refresh\": Content=\"0;URL=index.php?page=supcli\">";
}
?>
<div class="centrer">
    <h2 class="dblue">Suppression de Clients</h2>
</div>

<div class="div_aff_liste container textnorm">
    Liste des Clients : <br/><br/>
    <div class="row">
        <div class="txtGras col-lg-3 col-md-3 col-sm-3 hidden-xs">Nom</div> 
        <div class="txtGras col-lg-3 col-md-3 col-sm-3 hidden-xs">Prénom</div> 
        <div class="txtGras col-lg-4 col-md-4 col-sm-4 hidden-xs">e-mail</div> 
        <div class="txtGras col-lg-2 col-md-2 col-sm-2 hidden-xs">Suppression</div> 
    </div>
    <br/>
    <?php
    for ($i = 0; $i < sizeof($clients); $i++) {
        ?>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3"><span class="visible-xs txtGras">Nom :</span><?php echo utf8_encode($clients[$i]->__get('nom')); ?></div> 
            <div class="col-lg-3 col-md-3 col-sm-3"><span class="visible-xs txtGras">Prénom :</span><?php echo utf8_encode($clients[$i]->__get('prenom')); ?></div> 
            <div class="col-lg-4 col-md-4 col-sm-4"><span class="visible-xs txtGras">e-mail :</span><?php echo utf8_encode($clients[$i]->__get('mail')); ?></div> 
            <div class="col-lg-2 col-md-2 col-sm-2"><span class="visible-xs txtGras">Suppression :</span><a href="index.php?page=supcli&amp;delet=<?php echo $clients[$i]->__get('id_compte'); ?>">Supprimer</a></div> 

        </div>
        <br/>
        <?php
    }
    ?>
</div>