<?php


final class CustService
{
    private $db;

    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new CustService();
        }
        return $inst;
    }

    private function __construct()
    {
    }

    function createCust($name, $address, $docID)
    {
       
            $statement = $this->db->prepare('INSERT INTO `customer` (Customer_Name, Cust_Address, Doctor_ID) VALUES (:name, :address ,:docID)');
            $statement->bindParam(':name', $name);
            $statement->bindParam(':address', $address);
			$statement->bindParam(':docID', $docID);

            $statement->execute();
            return $this->db->lastInsertId();
    
    }


    function deleteCust($custID) {
		
		$this->db->beginTransaction();
        $statement = $this->db->prepare('DELETE FROM `customer` WHERE Customer_ID = :custID');
        $statement->bindParam(':custID', $custID);
        $statement->execute();
		$state = $this->db->prepare('DELETE FROM `prescription` WHERE Customer_ID = :custID');
        $state->bindParam(':custID', $custID);
		$state->execute();
		$this->db->commit();
		
    }
	
	

    function getAllCusts()
    {
        $statement = $this->db->prepare('SELECT * FROM `customer`');
        $statement->execute();
        return $statement->fetchAll();
    }

    function getCust($id)
    {
        $statement = $this->db->prepare('SELECT * FROM `customer` WHERE `Customer_ID` = :id');
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

