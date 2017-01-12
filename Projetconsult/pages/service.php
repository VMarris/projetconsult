<div class="centrer">
    <h2 class=" dblue">Nos différents services</h2>
</div>
<?php
$tserv = new ServiceDB($cnx);
$services = $tserv->getService();
?>
<br/><br/>
<div id="gt_carousel" class="carousel slide" data-ride="carousel">
    <!-- Carousel indicators : qui indiquent l'image affichée -->
    <ol class="carousel-indicators">
        <li data-target="#gt_carousel" data-slide-to="<?php print $services[0]->__get('id_service'); ?>" class="active"></li>
        <?php
        for ($i = 1; $i < sizeof($services); $i++) {
            if (file_exists("./admin/images/carou/" . $services[$i]->__get('nom').".jpg")) {
                ?>
                <li data-target="#gt_carousel" data-slide-to="<?php print $services[$i]->__get('id_service'); ?>"></li>
                <?php
            }
        }
        ?>
    </ol>   
    <!-- Wrapper for carousel items -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="./admin/images/carou/<?php print $services[0]->__get('nom'); ?>.jpg" alt="Slide <?php print $services[0]->__get('nom'); ?>">
        </div>
        <?php
        for ($i = 1; $i < sizeof($services); $i++) {
            if (file_exists("./admin/images/carou/" . $services[$i]->__get('nom').".jpg")) {
                ?>
                <div class="item">
                    <img src="./admin/images/carou/<?php print utf8_encode($services[$i]->__get('nom')); ?>.jpg" alt="Slide <?php print utf8_encode($services[$i]->__get('nom')); ?>">
                </div>
                <?php
            }
        }
        ?>
    </div>
    <!-- Carousel controls -->

    <a class="carousel-control left" href="#gt_carousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="carousel-control right" href="#gt_carousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
<br/><br/>
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
                <?php
                if (isset($_SESSION['connexion'])) {
                    ?>
                    <a href="index.php?page=priserdv&service_id=<?php print $services[$i]->__get('id_service'); ?>">Prendre un rendez-vous</a>
                    <?php
                } else {
                    echo "Connectez vous pour prendre rendez-vous";
                }
                ?>
            </div>
        </div>
        <br/><br/>
        <?php
    }
    ?>

</div>