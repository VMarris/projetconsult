<a href="index.php?page=accueil"><button name="Accueil" class="btn btn_menu">Accueil</button></a>
<a href="index.php?page=service"><button name="Services" class="btn btn_menu" >Nos services</button></a>
<a href="index.php?page=infohosto"><button name="Infos" class="btn btn_menu" >Infos supplémentaires</button></a>
<br/>
<?php
if (isset($_SESSION['connexion'])) {
    ?>
    <a href="index.php?page=moncompte"><button name="Compte" class="btn btn_menu" >Gestion du compte</button></a>
    <?php
} 







