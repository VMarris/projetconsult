<?php
header('Content-Type: application/json');
require '../dbConnect.php';
require '../classes/Connexion.class.php';
require '../classes/JsonCompteDB.class.php';

$cnx = Connexion::getInstance($dsn,$user,$pass);

try{       
    $search = new JsonCompteDB($cnx);
    $retour = $search->getNbCompte($_POST['email']);     
    print json_encode($retour);
}
catch(PDOException $e){}
