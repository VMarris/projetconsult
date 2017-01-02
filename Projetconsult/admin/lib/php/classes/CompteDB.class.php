<?php

class CompteDB extends Compte {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    function isAuthorized($login, $password) {
        $retour = array();
        try {
            $querry = "select verifier_connexion(:login,md5(:password)) as retour;";
            $sql = $this->_db->prepare($querry);
            $sql->bindValue(':login', $login);
            $sql->bindValue(':password', $password);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        return $retour;
    }
    
    function exist($email) {
        $retour = array();
        try {
            $querry = "select count(*) from comptes where mail=:email ";
            $sql = $this->_db->prepare($querry);
            $sql->bindValue(':email', $email);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        return $retour;
    }
 
}
