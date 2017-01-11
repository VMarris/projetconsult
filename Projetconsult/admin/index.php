<!DOCTYPE html>
<?php
session_start();
include ('./lib/php/verifierCnx.php');
include ('./lib/php/includes.php');
$cnx = Connexion::getInstance($dsn, $user, $pass);
?>
<html>
    <head>
        <title>Hopital Condorcet</title>
        <link rel="stylesheet" type="text/css" href="./lib/css/bootstrap-3.3.7/dist/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="./lib/css/style.css"/> 
        <script src="./lib/js/jquery-3.1.1.js"></script>
        <script src="./lib/js/jquery-validation-1.15.0/dist/jquery.validate.min.js" type="text/javascript"></script>
        <script src="./lib/js/messagesJqueryVal.js" type="text/javascript"></script>
        <script src="./lib/css/bootstrap-3.3.7/dist/js/bootstrap.js"></script>
        <script src="./lib/js/functionsJqueryValadm.js" type="text/javascript"></script>
        <script src="./lib/js/functionJqueryValEmailDoc.js"></script>

        <meta charset="UTF-8">
    </head>
    <body>
        <div id="conteneur">
            <header>
                <div id="connexion" class="container">
                    <img alt="croix" src="./images/iconconex.png" class="imgauche hidden-xs"/>
                    <br/><a href="../index.php?page=accueil&amp;depart=deconnect" >Déconnexion</a>
                </div>
                <div class="container centrer">
                    <a href="amdin/index.php?page=accueil">
                        <img src="./images/banadm.png" alt="Bannière" title="Banhost" class="imga"/>
                    </a>
                </div>
            </header>
            <div class="container">
                <div class="row">
                    <div class="centrer">
                        <?php
                        if (file_exists('./lib/php/menu_adm.php')) {
                            include ('./lib/php/menu_adm.php');
                        }
                        ?>    
                    </div>
                    <div class="col-sm-12 unpeuplace">
                        <section id="main">
                            <?php
                            if (!isset($_SESSION['page'])) {
                                $_SESSION['page'] = "accueil";
                            }
                            if (isset($_GET['page'])) {
                                $_SESSION['page'] = $_GET['page'];
                            }
                            if (isset($_POST['page'])) {// si on est passé la connexion
                                $_SESSION['page'] = $_POST['page'];
                            }
                            $path = './pages/' . $_SESSION['page'] . '.php';
                            if (file_exists($path)) {
                                include ($path);
                            } else {
                                ?>
                                <span class="txtGras txtRouge">Oups!La page demandée n'existe pas</span>
                                <meta http-refresh: Content="1;url=index.php?page=accueil"/>
                                <?php
                            }
                            ?>  
                        </section>
                    </div>
                </div>

                <footer class="footer">
                    <div class="centrer clear"> 
                        <img alt="logo" src="./images/logo.png" class="logo hidden-xs"/>
                        Panneau d'administration
                    </div>  
                </footer>
            </div>
        </div>
    </body>
</html>
