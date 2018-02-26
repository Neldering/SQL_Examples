<?php

require_once("../../connect.php");
require_once('../../services/CustService.php');

if (isset($_POST['cust-id'])) {
    $custID = $_POST['cust-id'];

    CustService::Instance()->deleteCust($custID);
} else {
    $_SESSION['error'] = 'Please enter a Customer ID';
}

// Redirect where needed
if (isset($_POST['redirect'])) {
    header('Location: ' . $_POST['redirect']);
}