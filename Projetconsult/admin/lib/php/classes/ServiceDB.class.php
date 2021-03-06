<?php

class ServiceDB {
    private $_db;
    private $_variable="valeur";

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getService() {
        try {
            $query = "SELECT * FROM service";
            $resultset = $this->_db->prepare($query);           
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = new Service($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        if(isset($_infoArray)){
            return $_infoArray;
        }else{
            return null;
        }
    }

    public function __toString() {
        return $this->_variable." ".$this->_db;
    }
    
    public function getServiceid($idserv) {
        try {
            $query = "SELECT * FROM service where id_service=:idserv";
            $resultset = $this->_db->prepare($query);    
            $resultset->bindValue(':idserv', $idserv); 
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = new Service($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        if(isset($_infoArray)){
            return $_infoArray;
        }else{
            return null;
        }
    }
    
    function creaServ($nom, $description) {
        try {
            $querry = "insert into service (nom,description) values (:nm,:descri);";
            $sql = $this->_db->prepare($querry);
            $sql->bindValue(1, $nom);
            $sql->bindValue(2, $description);
            $sql->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    
    function delServ($idserv) {
        try {
            $querry = "select supservice(:idserv)";
            $sql = $this->_db->prepare($querry);
            $sql->bindValue(':idserv', $idserv);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
}
