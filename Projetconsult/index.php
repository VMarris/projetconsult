<!DOCTYPE html>
<?php
include ('./lib/php/includes.php');
$cnx = Connexion::getInstance($dsn, $user, $pass);

session_start();
?>
<html>
    <head>
        <title>Hopital Condorcet</title>
        <link rel="stylesheet" type="text/css" href="./lib/css/bootstrap-3.3.7/dist/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="./lib/css/style.css"/> 
        <script src="lib/css/bootstrap-3.3.7/dist/js/bootstrap.js"></script>
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <div class="container">
                <img src="lib/images/banniere.png" alt="Bannière" title="Banhost"/>
            </div>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <nav>
                        <?php
                        if (file_exists('./lib/php/menu_normal.php')) {
                            include ('./lib/php/menu_normal.php');
                        }
                        ?>   
                    </nav>
                </div>
                <div class="col-sm-10">
                    <section id="main">
                        <?php
                        if (!isset($_SESSION['page'])) {
                            $_SESSION['page'] = "accueil";
                        }
                        if (isset($_GET['page'])) {
                            $_SESSION['page'] = $_GET['page'];
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
</body>
</html>
