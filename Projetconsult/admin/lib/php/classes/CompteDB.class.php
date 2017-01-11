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

    function creaDoc($mail, $mdp, $nom, $prenom, $service) {
        try {
            $querry = "select creadoc(:mail,md5(:mdp),:nom,:prenom,:service)";
            $sql = $this->_db->prepare($querry);
            $sql->bindValue(1, $mail);
            $sql->bindValue(2, $mdp);
            $sql->bindValue(3, $nom);
            $sql->bindValue(4, $prenom);
            $sql->bindValue(5, $service);
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
        if (isset($_infoArray)) {
            return $_infoArray;
        } else {
            return null;
        }
    }

    public function updatemdp($id_compte, $mdp) {
        try {
            $query = "update comptes set mot_de_passe=md5(:mdp) where id_compte=:idcom";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':mdp', $mdp);
            $resultset->bindValue(':idcom', $id_compte);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function updatetel($id_compte, $tel) {
        try {
            $query = "update client set telephone=:tel where id_compte=:idcom";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':tel', $tel);
            $resultset->bindValue(':idcom', $id_compte);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function __toString() {
        return $this->_variable . " " . $this->_db;
    }

    function delCompteDoc($idcompte) {
        try {
            $querry = "select supcomdoc(:idcompte)";
            $sql = $this->_db->prepare($querry);
            $sql->bindValue(':idcompte', $idcompte);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

}
