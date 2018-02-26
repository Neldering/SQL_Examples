<?php

final class PrescriptionService
{
    private $db;

    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new PrescriptionService();
        }
        return $inst;
    }

    private function __construct()
    {
    }



    function createPrescription($docID, $custID, $medID, $refills)
    {
       
            $statement = $this->db->prepare('INSERT INTO `prescription` (Doctor_ID, Customer_ID, Med_ID, Refill_Amount) VALUES (:Doctor_ID, :Customer_ID ,:Med_ID, :Refill_Amount)');
            $statement->bindParam(':Doctor_ID', $docID);
            $statement->bindParam(':Customer_ID', $custID);
            $statement->bindParam(':Med_ID', $medID);
			$statement->bindParam(':Refill_Amount', $refills);

            $statement->execute();
            return $this->db->lastInsertId();
    
    }
	
	function getPrescriptions()
    {
        $statement = $this->db->prepare('SELECT Pre.Prescription_ID, customer.Customer_Name, Doc.Doctor_Name, med.Med_Name, Pre.Refill_Amount, Pre.Date_Writen
	FROM prescription as Pre 
	join doctor as Doc on Doc.Doctor_ID = Pre.Doctor_ID
	JOIN customer on customer.Customer_ID = Pre.Customer_ID
	JOIN med on med.Med_ID = Pre.Med_ID');
        $statement->execute();
        return $statement->fetchAll();
    }
	
	
	

    function fulfillPrescription($prescriptionId)
    {
        $prescription = $this->getPrescription($prescriptionId);
        if ($prescription !== null) {
            $newRefills = $prescription->Refills_Left - 1;
            if ($newRefills > 0) {
                // Remove 1 from the refills and update
                $statement = $this->db->prepare('UPDATE `prescriptions` SET Refills_Left = :newRefillsLeft WHERE Prescription_ID = :prescriptionId');
                $statement->bindParam(':newRefillsLeft', $newRefills);
                $statement->bindParam(':prescriptionId', $prescriptionId);
                $statement->execute();
                return true;
            }
            // Delete the prescription because there's no refills left
            $statement = $this->db->prepare('DELETE FROM `prescriptions` WHERE Prescription_ID = :prescriptionId');
            $statement->bindParam(':prescriptionId', $prescriptionId);
            $statement->execute();
            return true;
        }
        return new ServiceError('A prescription with that ID does not exist.');
    }

    function getPrescription($id)
    {
        $statement = $this->db->prepare('SELECT * FROM `prescriptions` WHERE `Prescription_ID` = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return $statement->fetch(PDO::FETCH_OBJ);
        }
        return null;
    }

    function isRealDate($date)
    {
        if (false === strtotime($date)) {
            return false;
        }
        list($year, $month, $day) = explode('-', $date);
        return checkdate($month, $day, $year);
    }

    function setDb($db)
    {
        $this->db = $db;
    }

}

