<!DOCTYPE html>
<?php
include ('./admin/lib/php/includes.php');
$cnx = Connexion::getInstance($dsn, $user, $pass);

session_start();
?>
<html>
    <head>
        <title>Hopital Condorcet</title>
        <link rel="stylesheet" type="text/css" href="./admin/lib/css/bootstrap-3.3.7/dist/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="./admin/lib/css/style.css"/> 
        <script src="admin/lib/js/jquery-3.1.1.js"></script>
        <script src="admin/lib/js/jquery-validation-1.15.0/dist/jquery.validate.min.js" type="text/javascript"></script>
        <script src="admin/lib/js/messagesJqueryVal.js" type="text/javascript"></script>
        <script src="admin/lib/css/bootstrap-3.3.7/dist/js/bootstrap.js"></script>
        <script src="admin/lib/js/functionsJqueryVal.js" type="text/javascript"></script>
        <script src="admin/lib/js/functionJqueryValEmail.js"></script>
        <meta charset="UTF-8">
    </head>
    <body>
        <div id="conteneur">
            <header>
                <div id="connexion" class="container">
                    <img alt="croix" src="admin/images/iconconex.png" class="imgauche hidden-xs"/>
                    <?php
                    if (file_exists("./lib/php/connexion_site.php")) {
                        include "./lib/php/connexion_site.php";
                    }
                    ?>
                </div>
                <div class="container centrer">
                    <a href="index.php?page=accueil">
                        <img src="admin/images/banniere.png" alt="Bannière" title="Banhost" class="imga"/>
                    </a>
                </div>
            </header>
            <div class="container">
                <div class="row">
                    <div class="centrer">
                        <?php
                        if (file_exists('./lib/php/menu_normal.php')) {
                            include ('./lib/php/menu_normal.php');
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
                    <?php
                    if (file_exists('./lib/php/footer.php')) {
                        include ('./lib/php/footer.php');
                    }
                    ?>  
                </footer>
            </div>
        </div>
    </body>
</html>
