<?php

class ConsultationDB {

    private $_db;

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    function inserConsul($date, $com, $iddoc, $idhor, $climail) {
        try {
            $querry = "select cree_consult(:fdat,:fcom,:fidoc,:idhor,:idcli);";
            $sql = $this->_db->prepare($querry);
            $sql->bindValue(1, $date);
            $sql->bindValue(2, $com);
            $sql->bindValue(3, $iddoc);
            $sql->bindValue(4, $idhor);
            $sql->bindValue(5, $climail);
            $sql->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function delConsul($idconsul, $email) {
        try {
            $querry = "select count(*) from consultation where :idconsul=id_consultation and id_client=(select id_client from client where id_compte=(select id_compte from comptes where mail=:email))";
            $sql = $this->_db->prepare($querry);
            $sql->bindValue(':idconsul', $idconsul);
            $sql->bindValue(':email', $email);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
            if ($retour == "0") {
                return false;
            } else {
                $querry = "delete from consultation where id_consultation=:idconsul";
                $sql = $this->_db->prepare($querry);
                $sql->bindValue(':idconsul', $idconsul);
                $sql->execute();
                return true;
            }
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

}
