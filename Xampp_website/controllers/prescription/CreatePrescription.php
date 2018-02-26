<?php

require_once("../../connect.php");
require_once('../../services/PrescriptionService.php');
require_once('../../services/ServiceError.php');

if (isset($_POST['Refill_Amount']) && isset($_POST['Customer_ID']) && isset($_POST['Doctor_ID']) && isset($_POST['Med_ID'])) {
    $refillsLeft = $_POST['Refill_Amount'];
    $customerId = $_POST['Customer_ID'];
    $doctorId = $_POST['Doctor_ID'];
    $medId = $_POST['Med_ID'];

    $res = PrescriptionService::Instance()->createPrescription( $doctorId, $customerId, $medId, $refillsLeft);

    if ($res instanceof ServiceError) {
        $_SESSION['error'] = $res->getError();
    } else {
        $_SESSION['error'] = '';
        $_SESSION['success'] = true;
    }
} else {
    $_SESSION['error'] = 'Please enter the date, number of refills, customer, prescribing doctor, and the medicine.';
}

// Redirect where needed
if (isset($_POST['redirect'])) {
    header('Location: ' . $_POST['redirect']);
}