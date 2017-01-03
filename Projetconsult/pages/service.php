<div class="centrer">
    <h2 class=" dblue">Nos différents services</h2>
    <h2>Ajouter le caroussel</h2>
</div>
<?php
$tserv = new ServiceDB($cnx);
$services = $tserv->getService();

?>
<br/><br/><br/><br/>
<div id="div_aff_service" class="container textnorm">

        <?php
        for ($i = 0; $i < sizeof($services); $i++) {
            ?>
            <div class="row ">
                <div class="col-lg-2 col-md-2 col-sm-12 txtGras">
                    <br/>
                    Service <?php echo utf8_encode($services[$i]->__get('nom')); ?>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-10 justif">
                    <span class="souligne">Description :</span><br/>
                    <?php echo utf8_encode($services[$i]->__get('description')); ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <br/>
                    <a href="index.php?page=priserdv&service_id=<?php print $services[$i]->__get('id_service');?>">Prendre un rendez-vous</a>
                </div>
            </div>
            <br/><br/>
            <?php
        }
        ?>

</div>