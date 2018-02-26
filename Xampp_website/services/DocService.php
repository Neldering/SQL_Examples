<?php


final class DocService
{
    private $db;

    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new DocService();
        }
        return $inst;
    }

    private function __construct()
    {
    }

    function createDoc($name, $zip)
    {
       
            $statement = $this->db->prepare('INSERT INTO `doctor` (Doctor_Name, Doctor_ZIP) VALUES (:name, :zip)');
            $statement->bindParam(':name', $name);
            $statement->bindParam(':zip', $zip);
            $statement->execute();
            return $this->db->lastInsertId();
    
    }

    function deleteDoc($docID) {
        $statement = $this->db->prepare('DELETE FROM `doctor` WHERE Doctor_ID = :docID');
        $statement->bindParam(':docID', $docID);
        $statement->execute();
    }

    function getAllDocs()
    {
        $statement = $this->db->prepare('SELECT * FROM `doctor`');
        $statement->execute();
        return $statement->fetchAll();
    }

    function getDoc($id)
    {
        $statement = $this->db->prepare('SELECT * FROM `doctor` WHERE `Doctor_ID` = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return $statement->fetch(PDO::FETCH_OBJ);
        }
        return null;
    }


    function setDb($db)
    {
        $this->db = $db;
    }

}

