<a href="index.php?page=accueil"><button name="Accueil" class="btn btn_menu">Accueil</button></a>
<a href="index.php?page=service"><button name="Services" class="btn btn_menu" >Nos services</button></a>
<a href="index.php?page=infohosto"><button name="Infos" class="btn btn_menu" >Infos supplémentaires</button></a>
<br/>
<?php
if (isset($_SESSION['connexion'])) {
    if ($_SESSION['connexion'] == "1") {
        ?>
        <a href="index.php?page=moncompte"><button name="Compte" class="btn btn_menu" >Gestion du compte</button></a>
        <a href="index.php?page=gestionrdv"><button name="GeRdv" class="btn btn_menu" >Gestion des rendez-vous</button></a>
        <?php
    }
    if ($_SESSION['connexion'] == "2") {
        ?>
        <a href="index.php?page=moncomptedoc"><button name="Comptedoc" class="btn btn_menu" >Gestion du compte</button></a>
        <a href="index.php?page=gestionrdvdoc"><button name="GeRdvDoc" class="btn btn_menu" >Liste des rendez-vous</button></a>
        <?php
    }
}







        