<?php


class DocteurDB {
     private $_db;
     
     public function __construct($cnx) {
        $this->_db = $cnx;
    }
    
    public function getDocteur($id_service) {
        try {
            $query = "select * from docteur where id_service=:idserv";
            $resultset = $this->_db->prepare($query); 
            $resultset->bindValue(':idserv', $id_service);            
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = new Docteur($data);
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
}
