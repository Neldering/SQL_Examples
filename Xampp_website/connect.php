<?php

require_once('services/MedService.php');
require_once('services/DocService.php');
require_once('services/EmployeeService.php');
require_once('services/CustService.php');
require_once('services/PrescriptionService.php');

$username = 'root';
$password = '';

try {
    global $db;
    $db = new PDO('mysql:host=localhost;dbname=dbproject', $username, $password);
    session_start();

    MedService::Instance()->setDb($db);
	DocService::Instance()->setDb($db);
	CustService::Instance()->setDb($db);
    PrescriptionService::Instance()->setDb($db);


} catch (PDOException $e) {
    print 'Error!: ' . $e->getMessage() . '<br/>';
    die();
}
?>