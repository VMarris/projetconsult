<?php

class Vue_ConsultationDB {
    
    private $_db;

    public function __construct($cnx) {
        $this->_db = $cnx;
    }
    
    function getConsul($email){
        try {
            $query = "select * from vue_consul_fut where id_client=(select id_client from client where id_compte=(select id_compte from comptes where mail=:email))";
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
        if(isset($_infoArray)){
            return $_infoArray;
        }else{
            return null;
        }
    }
}
