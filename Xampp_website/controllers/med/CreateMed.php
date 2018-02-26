<?php

require_once("../../connect.php");
require_once('../../services/MedService.php');
require_once('../../services/ServiceError.php');

if (isset($_POST['name']) && isset($_POST['stock'])) {
    $name = $_POST['name'];
    $stock = $_POST['stock'];

    $res = MedService::Instance()->createMed($name, $stock);

    if ($res == false) {
        $_SESSION['success'] = '';
        $_SESSION['error'] = 'Error please try again.';
    } else {
        $_SESSION['error'] = '';
        $_SESSION['success'] = 'Medication Added.';
    }
} else {
    $_SESSION['error'] = 'Please enter the name and inventory of the new medication.';
}

// Redirect where needed
if (isset($_POST['redirect'])) {
    header('Location: ' . $_POST['redirect']);
}