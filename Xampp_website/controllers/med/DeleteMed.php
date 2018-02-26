<?php

require_once("../../connect.php");
require_once('../../services/MedService.php');

if (isset($_POST['med-id'])) {
    $medId = $_POST['med-id'];

    MedService::Instance()->deleteMed($medId);
} else {
    $_SESSION['error'] = 'Please enter a medicine ID';
}

// Redirect where needed
if (isset($_POST['redirect'])) {
    header('Location: ' . $_POST['redirect']);
}