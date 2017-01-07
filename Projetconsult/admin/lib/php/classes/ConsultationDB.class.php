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

}
