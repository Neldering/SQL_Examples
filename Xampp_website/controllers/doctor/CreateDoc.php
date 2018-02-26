<?php

require_once("../../connect.php");
require_once('../../services/DocService.php');
require_once('../../services/ServiceError.php');

if (isset($_POST['Doctor_Name']) && isset($_POST['Doctor_ZIP'])) {
    $name = $_POST['Doctor_Name'];
    $zip = $_POST['Doctor_ZIP'];

    $res = DocService::Instance()->createDoc($name, $zip);

    if ($res == false) {
        $_SESSION['success'] = '';
        $_SESSION['error'] = 'Error please try again.';
    } else {
        $_SESSION['error'] = '';
        $_SESSION['success'] = 'Doctor Added.';
    }
} else {
    $_SESSION['error'] = 'Please enter the name and zip of the new doctor.';
}

// Redirect where needed
if (isset($_POST['redirect'])) {
    header('Location: ' . $_POST['redirect']);
}