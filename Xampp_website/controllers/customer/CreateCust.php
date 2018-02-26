<?php

require_once("../../connect.php");
require_once('../../services/CustService.php');
require_once('../../services/ServiceError.php');

if (isset($_POST['Customer_Name']) && isset($_POST['Customer_Address']) && isset($_POST['Doctor_ID'])) {
    $name = $_POST['Customer_Name'];
    $address = $_POST['Customer_Address'];
	$docID = $_POST['Doctor_ID'];

    $res = CustService::Instance()->createCust($name, $address, $docID);

    if ($res == false) {
        $_SESSION['success'] = '';
        $_SESSION['error'] = 'Error please try again.';
    } else {
        $_SESSION['error'] = '';
        $_SESSION['success'] = 'Customer Added.';
    }
} else {
    $_SESSION['error'] = 'Please enter the name, address and Doctor ID for the new customer.';
}

// Redirect where needed
if (isset($_POST['redirect'])) {
    header('Location: ' . $_POST['redirect']);
}