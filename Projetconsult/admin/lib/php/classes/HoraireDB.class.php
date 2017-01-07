<?php

class HoraireDB {

    private $_db;

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getHoraires($id_doc, $date) {
        try {
            $query = "select b.id_horraire,b.heure from horraire b EXCEPT ";
            $query = $query . "select h.id_horraire,h.heure from horraire h ";
            $query = $query . "join consultation c on c.id_horraire=h.id_horraire where c.jour=:ddate and c.id_docteur=:iddoc ";
            $query = $query . "order by id_horraire asc;";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':iddoc', $id_doc);
            $resultset->bindValue(':ddate', $date);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = new Horaire($data);
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
