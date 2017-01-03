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

    function inscription($mail, $mdp, $nom, $prenom, $phone) {
        try {
            $querry = "select inscription(:mail,md5(:mdp),:nom,:prenom,:phone)";
            $sql = $this->_db->prepare($querry);
            $sql->bindValue(1, $mail);
            $sql->bindValue(2, $mdp);
            $sql->bindValue(3, $nom);
            $sql->bindValue(4, $prenom);
            $sql->bindValue(5, $phone);
            $sql->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
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
    
    public function getCompte($email) {
        try {
            $query = "select * from vue_client where mail=:email";
            $resultset = $this->_db->prepare($query); 
            $resultset->bindValue(':email', $email);
            $resultset->execute();
            $data = $resultset->fetchAll(); 
            
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = new Compte($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

    public function __toString() {
        return $this->_variable." ".$this->_db;
    }

}
