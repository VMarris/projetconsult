<?php
class JsonCompteDB {
    private $_db;
    
    public function __construct($db) {
        $this->_db = $db;
    }
    
    public function getCompte($email){
        $query="select count(*) as conte from comptes where mail=:email";
        try {
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1,$email, PDO::PARAM_STR);
        $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_clientArray[]=$data;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_clientArray;
    }
}